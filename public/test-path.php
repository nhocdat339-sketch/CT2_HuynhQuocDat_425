<?php
echo "📍 __DIR__ = " . __DIR__ . "<br>";
echo "📍 dirname(__DIR__) = " . dirname(__DIR__) . "<br>";

$modelPath = dirname(__DIR__) . '/app/models/ProductModel.php';
echo "🔍 Đường dẫn model: $modelPath <br>";
echo "✅ Tồn tại: " . (file_exists($modelPath) ? 'CÓ' : 'KHÔNG') . "<br>";

// Liệt kê thư mục app/models
$dir = dirname(__DIR__) . '/app/models/';
if (is_dir($dir)) {
    echo "📁 Danh sách file trong app/models/:<br>";
    foreach (scandir($dir) as $file) {
        echo "- $file <br>";
    }
}