<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../repository/AdminBrandRepository.php';

class AdminBrandService {
    private $repo;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->repo = new AdminBrandRepository($db);
    }

    public function getAllActiveBrands() {
        return $this->repo->getAllActiveBrands();
    }
}
