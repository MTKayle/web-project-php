<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/ProductController.php';

header('Content-Type: application/json');

$database = new Database();
$productService = new ProductService(new ProductRepository($database));
$productController = new ProductController($productService);

if($_SERVER["REQUEST_METHOD"] === "GET") {

    $filters = [];

    if (isset($_GET['tuoi'])) {
        $filters['age'] = explode(',', $_GET['tuoi']); // ["0-3", "4-6"]
    }

    if(isset($_GET['gia'])) {
        $filters['price'] = explode(',', $_GET['gia']); // ["0-100", "100-200"]
    } 

    if(isset($_GET['q'])) {
        $filters['search'] = $_GET['q'];
    }

    if(isset($_GET['danhmuc'])) {
        $filters['category'] = $_GET['danhmuc'];
    }

    $productController->getAllProducts($filters);
}
?>