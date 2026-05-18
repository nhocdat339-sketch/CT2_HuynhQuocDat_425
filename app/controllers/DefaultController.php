<?php
// ✅ Từ app/controllers/ lên 2 cấp là gốc dự án
define('PROJECT_ROOT', dirname(__DIR__, 2));

require_once PROJECT_ROOT . '/app/config/database.php';
require_once PROJECT_ROOT . '/app/models/ProductModel.php';

class DefaultController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index()
    {
        header('Location: /webbanhang/public/Product');
        exit;
    }
}