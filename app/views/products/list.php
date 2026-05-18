<?php include dirname(__DIR__, 2) . '/views/shares/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">
        <i class="fas fa-mobile-alt"></i> Danh sách sản phẩm
    </h1>
    <a href="/webbanhang/public/Product/add" class="btn btn-success">
        <i class="fas fa-plus"></i> Thêm sản phẩm mới
    </a>
</div>

<?php if (empty($products)): ?>
    <div class="alert alert-info d-flex align-items-center" style="border-radius: 15px; padding: 30px;">
        <i class="fas fa-info-circle fa-2x mr-3"></i>
        <div>
            <strong>Không có sản phẩm nào!</strong><br>
            <small>Hãy thêm sản phẩm đầu tiên của bạn.</small>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card h-100 product-card" style="border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); overflow: hidden; transition: all 0.3s;">
                    
                    <!-- Khu vực hình ảnh -->
                    <div style="position: relative; overflow: hidden; height: 220px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                        <?php if (!empty($product->image) && file_exists(PROJECT_ROOT . '/public/uploads/' . $product->image)): ?>
                            <img src="/webbanhang/public/uploads/<?php echo htmlspecialchars($product->image); ?>"
                                 alt="<?php echo htmlspecialchars($product->name); ?>"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        <?php else: ?>
                            <i class="fas fa-mobile-alt" style="font-size: 4rem; color: #ddd;"></i>
                        <?php endif; ?>
                        
                        <!-- Badge giảm giá -->
                        <span class="badge badge-danger" style="position: absolute; top: 10px; left: 10px; font-size: 0.7rem; padding: 5px 10px; border-radius: 20px;">-10%</span>
                    </div>

                    <div class="card-body p-3">
                        <!-- Tên sản phẩm -->
                        <h6 class="card-title font-weight-bold text-truncate" style="color: #2d3748; min-height: 40px;">
                            <a href="/webbanhang/public/Product/show/<?php echo $product->id; ?>" class="text-dark text-decoration-none">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h6>
                        
                        <!-- Giá -->
                        <h5 class="text-primary font-weight-bold mb-2">
                            <?php echo number_format($product->price, 0, ',', '.'); ?> ₫
                        </h5>
                        
                        <!-- Danh mục -->
                        <p class="mb-3" style="font-size: 0.85rem; color: #666;">
                            <i class="fas fa-layer-group mr-1"></i> <?php echo htmlspecialchars($product->category_name ?? 'Chưa phân loại', ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        
                        <!-- Nút hành động -->
                        <div class="d-flex justify-content-between mt-auto">
                            <a href="/webbanhang/public/Product/edit/<?php echo $product->id; ?>" 
                               class="btn btn-outline-warning btn-sm" 
                               style="border-radius: 20px; padding: 5px 15px;">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a href="/webbanhang/public/Product/delete/<?php echo $product->id; ?>" 
                               class="btn btn-outline-danger btn-sm" 
                               style="border-radius: 20px; padding: 5px 15px;"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- CSS riêng cho hiệu ứng ảnh -->
<style>
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .product-card:hover img {
        transform: scale(1.05);
    }
    .text-truncate {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<?php include dirname(__DIR__, 2) . '/views/shares/footer.php'; ?>