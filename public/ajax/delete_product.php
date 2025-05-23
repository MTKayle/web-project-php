<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/AdminProductController.php';
require_once __DIR__ . '/../../service/AdminProductService.php';
require_once __DIR__ . '/../../repository/AdminProductRepository.php';

header('Content-Type: application/json');

try {
    $database = new Database();
    $productRepository = new AdminProductRepository($database);
    $productService = new AdminProductService($productRepository);
    $productController = new AdminProductController($productService);

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $productId = (int)$_GET['id'];
        $result = $productController->deactivateProduct($productId);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Product deactivated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to deactivate product']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
    }
} catch (Exception $e) {
    error_log('Error in delete_product.php: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
exit;