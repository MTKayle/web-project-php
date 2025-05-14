<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/PaymentController.php';

header('Content-Type: application/json');

$database = new Database();
$paymentService = new PaymentService(new OrderRepository($database), new OrderDetailsRepository($database)
                  , new CartRepository($database), new ProductRepository($database)
                    , new CustomerRepository($database));
$paymentController = new PaymentController($paymentService);

session_start();
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

if($_SERVER["REQUEST_METHOD"] === "GET") {
    $paymentController->getOrderDetailsPending($userID);
}
?>