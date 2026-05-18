<?php
// ✅ ĐÚNG: Từ public/ lên 1 cấp là gốc dự án webbanhang/
define('ROOT_PATH', dirname(__DIR__));

// Require các file cần thiết
require_once ROOT_PATH . '/app/config/database.php';
require_once ROOT_PATH . '/app/models/ProductModel.php';
require_once ROOT_PATH . '/app/models/CategoryModel.php';

// Lấy và xử lý URL từ query string
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Kiểm tra phần đầu tiên của URL để xác định controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'DefaultController';

// Kiểm tra phần thứ hai của URL để xác định action
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Kiểm tra xem controller có tồn tại không
if (!file_exists(ROOT_PATH . '/app/controllers/' . $controllerName . '.php')) {
    die('Controller not found: ' . $controllerName);
}

require_once ROOT_PATH . '/app/controllers/' . $controllerName . '.php';
$controller = new $controllerName();

// Kiểm tra xem action có tồn tại không
if (!method_exists($controller, $action)) {
    die('Action not found: ' . $action);
}

// Gọi action với các tham số còn lại (nếu có)
call_user_func_array([$controller, $action], array_slice($url, 2));