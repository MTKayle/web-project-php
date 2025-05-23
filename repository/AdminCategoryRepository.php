<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Product.php';
class AdminCategoryRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllActiveCategories() {
        $sql = "SELECT categoryID, categoryName FROM Category WHERE isActive = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
