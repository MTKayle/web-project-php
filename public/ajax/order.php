<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/OrderController.php';

header('Content-Type: application/json');

$database = new Database();
$orderService = new OrderService(new OrderRepository($database));
$orderController = new OrderController($orderService);


if($_SERVER["REQUEST_METHOD"] === "GET") {
    $action = $_GET['action'] ?? '';
    $page = $_GET['page'] ?? 1;
    $orderID = $_GET['orderID'] ?? '';
    switch ($action) {
        case 'getListOrdersAllStatus':
            $orderController->getListOrdersAllStatus($page);
            break;
        case 'getListOrderForStatusAdmin':
            $statusID = $_GET['statusID'] ?? '';
            $orderController->getListOrderForStatusAdmin($statusID, $page);
            break;
        case 'getOrderDetail':
            $orderController->getOrderDetailsByOrderID($orderID);
            break;
        default:
            echo json_encode(['error' => 'Action not recognized']);
    }
} 

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderID = $_POST['orderID'] ?? '';
    $statusID = $_POST['statusID'] ?? '';
    
    $orderController->updateOrderStatus($orderID, $statusID);
}
?>