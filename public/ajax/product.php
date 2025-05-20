<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/ProductController.php';

header('Content-Type: application/json');

$database = new Database();
$productService = new ProductService(new ProductRepository($database));
$productController = new ProductController($productService);

if($_SERVER["REQUEST_METHOD"] === "GET") {

    $filters = [];
    $page = $_GET['pageNum'] ?? 1;

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

    if(isset($_GET['thuonghieu'])) {
        $filters['brand'] = explode(',', $_GET['thuonghieu']); // ["0-3", "4-6"]
    }

    $productController->getAllProducts($filters, $page);
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? '';
    switch ($action) {
        case 'get':
            $productID = $_POST['productID'] ?? null;
            $productController->getProductByID($productID);
            break;
        case 'edit':
            $productID = $_POST['productID'] ?? null;
            $productName = $_POST['productName'] ?? '';
            $productPrice = $_POST['price'] ?? '';
            $productDescription = $_POST['description'] ?? '';
            $title = $_POST['title'] ?? '';
            $stockQuantity = $_POST['stockQuantity'] ?? '';

            $productData = [
                'productID' => $productID,
                'productName' => $productName,
                'price' => $productPrice,
                'description' => $productDescription,
                'title' => $title,
                'stockQuantity' => $stockQuantity
            ];

            $productController->updateProduct($productData['productID'], $productData);
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
}
?>