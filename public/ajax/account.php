<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/CustomerController.php';

header('Content-Type: application/json');

$database = new Database();
$customerService = new CustomerService(new CustomerRepository($database));
$customerController = new CustomerController($customerService);

session_start();
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : '';

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $avatar = $_FILES['avatar'] ?? null;
    $customerName = $_POST['customerName'] ?? '';
    $phoneNumber = $_POST['phoneNumber'] ??'';
    $address = $_POST['address'] ??'';

    $customerController->updateCustomer($userID, $customerName, $phoneNumber, $address, $avatar);
}

if($_SERVER['REQUEST_METHOD']==="GET"){
    $customerID = $userID;

    $customerController->getCustomerByID($customerID);
}
?>