<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/PaymentController.php';

header('Content-Type: application/json');

$database = new Database();
$paymentService = new PaymentService(new OrderRepository($database), 
              new OrderDetailsRepository($database), new CartRepository($database), 
              new ProductRepository($database), new CustomerRepository($database));
$paymentController = new PaymentController($paymentService);

session_start();
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
$cartID = isset($_SESSION['cartID']) ? $_SESSION['cartID'] : null;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $paymentMethod = $_POST['paymentMethod'] ?? '';
    $totalAmount = $_POST['totalAmount'] ?? 0;
    $code = $_POST['discountCode'] ?? null;

    $order = [
        'fullname' => $fullname,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'paymentMethod' => $paymentMethod,
        'totalAmount' => $totalAmount,
        'customerID' => $userID,
        'code' => $code,
        'cartID' => $cartID
    ];

    $paymentController->createOrder($order);
}

?>