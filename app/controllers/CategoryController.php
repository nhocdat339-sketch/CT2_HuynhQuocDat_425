<?php
define('PROJECT_ROOT', dirname(__DIR__, 2));

require_once PROJECT_ROOT . '/app/config/database.php';
require_once PROJECT_ROOT . '/app/models/CategoryModel.php';

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include PROJECT_ROOT . '/app/views/category/list.php';
    }
}