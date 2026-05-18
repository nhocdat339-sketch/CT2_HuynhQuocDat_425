<?php
define('PROJECT_ROOT', dirname(__DIR__, 2));

require_once PROJECT_ROOT . '/app/config/database.php';
require_once PROJECT_ROOT . '/app/models/ProductModel.php';
require_once PROJECT_ROOT . '/app/models/CategoryModel.php';

class ProductController
{
    private $productModel;
    private $categoryModel;
    private $db;
    private $uploadDir;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->categoryModel = new CategoryModel($this->db);
        // Thư mục lưu trữ ảnh
        $this->uploadDir = PROJECT_ROOT . '/public/images/products/';
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        include PROJECT_ROOT . '/app/views/products/list.php';
    }

    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include PROJECT_ROOT . '/app/views/products/show.php';
        } else {
            http_response_code(404);
            echo "Không tìm thấy sản phẩm.";
        }
    }

    public function add()
    {
        $categories = $this->categoryModel->getCategories();
        include PROJECT_ROOT . '/app/views/products/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            
            // Xử lý upload ảnh
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->uploadImage($_FILES['image']);
                if ($imagePath === false) {
                    $errors['image'] = 'Upload ảnh thất bại. Vui lòng thử lại.';
                }
            }

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $imagePath);

            if (is_array($result)) {
                // Xóa ảnh đã upload nếu có lỗi
                if ($imagePath && file_exists($this->uploadDir . basename($imagePath))) {
                    unlink($this->uploadDir . basename($imagePath));
                }
                
                $errors = $result;
                $categories = $this->categoryModel->getCategories();
                include PROJECT_ROOT . '/app/views/products/add.php';
            } else {
                header('Location: /webbanhang/public/Product');
                exit;
            }
        }
    }

    public function edit($id)
    {
        $product = $this->productModel->getProductById($id);
        $categories = $this->categoryModel->getCategories();
        
        if ($product) {
            include PROJECT_ROOT . '/app/views/products/edit.php';
        } else {
            http_response_code(404);
            echo "Không tìm thấy sản phẩm.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            
            // Lấy thông tin sản phẩm cũ
            $oldProduct = $this->productModel->getProductById($id);
            $oldImage = $oldProduct->image ?? null;
            
            // Xử lý upload ảnh mới
            $imagePath = $oldImage; // Giữ ảnh cũ nếu không upload ảnh mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK && $_FILES['image']['size'] > 0) {
                $newImagePath = $this->uploadImage($_FILES['image']);
                if ($newImagePath === false) {
                    $errors['image'] = 'Upload ảnh thất bại. Vui lòng thử lại.';
                } else {
                    // Xóa ảnh cũ nếu có
                    if ($oldImage && file_exists($this->uploadDir . basename($oldImage))) {
                        unlink($this->uploadDir . basename($oldImage));
                    }
                    $imagePath = $newImagePath;
                }
            }

            $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $imagePath);

            if (is_array($result)) {
                $errors = $result;
                $product = (object)[
                    'id' => $id,
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'category_id' => $category_id,
                    'image' => $imagePath
                ];
                $categories = $this->categoryModel->getCategories();
                include PROJECT_ROOT . '/app/views/products/edit.php';
            } elseif ($result) {
                header('Location: /webbanhang/public/Product');
                exit;
            } else {
                echo "Đã xảy ra lỗi khi cập nhật sản phẩm.";
            }
        }
    }

    public function delete($id)
    {
        // Xóa ảnh khi xóa sản phẩm
        $product = $this->productModel->getProductById($id);
        if ($product && !empty($product->image)) {
            $imagePath = $this->uploadDir . basename($product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /webbanhang/public/Product');
            exit;
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    /**
     * Upload và xử lý hình ảnh
     */
    private function uploadImage($file)
    {
        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }

        // Kiểm tra loại file
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($file['tmp_name']);
        
        if (!in_array($fileType, $allowedTypes)) {
            return false;
        }

        // Kiểm tra kích thước (tối đa 2MB)
        if ($file['size'] > 2 * 1024 * 1024) {
            return false;
        }

        // Tạo tên file mới
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid('product_') . '_' . time() . '.' . $extension;
        $targetPath = $this->uploadDir . $newFileName;

        // Di chuyển file
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Trả về đường dẫn tương đối để lưu vào database
            return '/webbanhang/public/images/products/' . $newFileName;
        }

        return false;
    }
}