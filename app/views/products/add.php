<?php include dirname(__DIR__, 2) . '/views/shares/header.php'; ?>

<h1 class="page-title">
    <i class="fas fa-plus-circle"></i> Thêm sản phẩm mới
</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger" style="border-radius: 15px;">
        <h6><i class="fas fa-exclamation-triangle"></i> Có lỗi xảy ra:</h6>
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/CT2_HuynhQuocDat_425/public/Product/save" enctype="multipart/form-data" style="background: #f7fafc; padding: 30px; border-radius: 15px;">
    <div class="form-group">
        <label for="name">
            <i class="fas fa-tag"></i> Tên sản phẩm
        </label>
        <input type="text" 
               id="name" 
               name="name" 
               class="form-control" 
               placeholder="Ví dụ: iPhone 15 Pro Max"
               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
               required>
    </div>
    
    <div class="form-group">
        <label for="description">
            <i class="fas fa-align-left"></i> Mô tả
        </label>
        <textarea id="description" 
                  name="description" 
                  class="form-control" 
                  rows="4"
                  placeholder="Mô tả chi tiết về sản phẩm..."
                  required><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="price">
                    <i class="fas fa-dollar-sign"></i> Giá bán
                </label>
                <div class="input-group">
                    <input type="number" 
                           id="price" 
                           name="price" 
                           class="form-control" 
                           placeholder="0"
                           step="0.01"
                           min="0"
                           value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
                           required>
                    <div class="input-group-append">
                        <span class="input-group-text">VNĐ</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="category_id">
                    <i class="fas fa-folder"></i> Danh mục
                </label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id; ?>" 
                                <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $category->id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Upload hình ảnh -->
    <div class="form-group">
        <label for="image">
            <i class="fas fa-image"></i> Hình ảnh sản phẩm
        </label>
        <div class="custom-file">
            <input type="file" 
                   class="custom-file-input" 
                   id="image" 
                   name="image" 
                   accept="image/*">
            <label class="custom-file-label" for="image">Chọn hình ảnh...</label>
        </div>
        <small class="form-text text-muted">
            <i class="fas fa-info-circle"></i> Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB
        </small>
    </div>

    <!-- Preview ảnh -->
    <div class="form-group" id="preview-container" style="display: none;">
        <label>Preview:</label>
        <div class="text-center">
            <img id="image-preview" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border-radius: 10px; border: 2px solid #ddd;">
        </div>
    </div>
    
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Thêm sản phẩm
        </button>
        <a href="/webbanhang/public/Product" class="btn btn-secondary" style="border-radius: 50px; padding: 12px 30px; margin-left: 10px;">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
</form>

<script>
// Preview ảnh khi chọn file
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('preview-container').style.display = 'block';
        }
        reader.readAsDataURL(file);
        
        // Cập nhật tên file vào label
        const fileName = file.name;
        document.querySelector('.custom-file-label').textContent = fileName;
    }
});
</script>

<?php include dirname(__DIR__, 2) . '/views/shares/footer.php'; ?>