<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repository/AdminCategoryRepository.php';

class AdminCategoryService {
    private $repo;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->repo = new AdminCategoryRepository($db);
    }

    public function getAllActiveCategories() {
        return $this->repo->getAllActiveCategories();
    }
}
