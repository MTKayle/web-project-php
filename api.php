<?php
// api.php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

header('Content-Type: application/json');
require_once __DIR__ . '/service/AdminProductService.php';
require_once __DIR__ . '/repository/AdminProductRepository.php';
require_once __DIR__ . '/controllers/AdminProductController.php';
require_once __DIR__ . '/config/Database.php';

$controller = $_GET['controller'] ?? '';
$action = $_GET['action'] ?? '';

file_put_contents(__DIR__ . '/debug.log', "Controller: $controller, Action: $action\n", FILE_APPEND);

if ($controller === 'adminProduct' && $action === 'add') {
    try {
        $database = new Database();
        $productRepository = new AdminProductRepository($database);
        $productService = new AdminProductService($productRepository);
        $productController = new AdminProductController($productService);

        $productController->add(); // Gọi phương thức add của AdminProductController
    } catch (Exception $e) {
        file_put_contents(__DIR__ . '/debug.log', "Error: " . $e->getMessage() . "\n", FILE_APPEND);
        echo json_encode(['success' => false, 'message' => 'Lỗi server: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ']);
}
exit;