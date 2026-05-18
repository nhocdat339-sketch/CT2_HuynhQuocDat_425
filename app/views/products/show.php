<?php include 'app/views/shares/header.php'; ?>

<h1>Chi tiết sản phẩm</h1>

<div class="product-item">
    <h3><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h3>
    <p><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
    <p><strong>Giá:</strong> <?php echo number_format($product->price, 2); ?> VNĐ</p>
    <?php if (isset($product->category_name) && $product->category_name): ?>
        <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    
    <div class="mt-4">
        <a href="/webbanhang/public/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning">Sửa</a>
        <a href="/webbanhang/public/Product" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>