<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/CartController.php';

header('Content-Type: application/json');

$database = new Database();
$cartService = new CartService(new CartRepository($database), new ProductRepository($database));
$cartController = new CartController($cartService);



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'create':
            $userID = $_POST['userID'] ?? '';
            $cartController->createCartForCustomer($userID);
            break;
        case 'add':
            session_start();
            $cartID = $_SESSION['cartID'] ?? '';
            $productID = $_POST['productID'] ?? '';
            $cartController->addToCart($cartID, $productID);
            break;
        case 'update':
            session_start();
            $cartID = $_SESSION['cartID'] ??'';
            $productID = $_POST['productID'] ??'';
            $quantity = $_POST['quantity'] ?? '';
            $cartController->updateQuantity($cartID, $productID, $quantity);
            break;
        case 'remove':
            session_start();
            $cartID = $_SESSION['cartID'] ?? '';
            $productID = $_POST['productID'] ?? '';
            $cartController->removeCartItems($cartID, $productID);
            break;
        default:
            echo json_encode(['error' => 'Action not recognized']);
    }
}

if($_SERVER["REQUEST_METHOD"]=== "GET"){
    session_start();
    $cartID = $_SESSION['cartID'] ?? '';
    
    $cartController->getAllCartItems($cartID);
}

?>