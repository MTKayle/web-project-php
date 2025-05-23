<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/ProductController.php';

header('Content-Type: application/json');

$database = new Database();
$productService = new ProductService(new ProductRepository($database));
$productController = new ProductController($productService);

if($_SERVER["REQUEST_METHOD"] === "GET") {

    $productId = $_GET['productID'] ?? null;

    if ($productId) {
        $productController->getProductDetailById($productId);
    } else {
        echo json_encode(['error' => 'Product ID is required']);
    }
}
?>