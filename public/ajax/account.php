<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/CustomerController.php';
require_once __DIR__ . '/../../controllers/CartController.php';

header('Content-Type: application/json');

$database = new Database();
$customerService = new CustomerService(new CustomerRepository($database));
$cartService = new CartService(new CartRepository($database), new ProductRepository($database));
$customerController = new CustomerController($customerService, $cartService);

session_start();
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : '';
$cartID = isset($_SESSION['cartID']) ? $_SESSION['cartID'] : '';
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $avatar = $_FILES['avatar'] ?? null;
    $customerName = $_POST['customerName'] ?? '';
    $phoneNumber = $_POST['phoneNumber'] ??'';
    $address = $_POST['address'] ??'';

    $customerController->updateCustomer($userID, $customerName, $phoneNumber, $address, $avatar);
}

if($_SERVER['REQUEST_METHOD']==="GET"){
    $action = $_GET['action'] ?? '';
    switch ($action) {
        case '':
            $customerID = $userID;
            $customerController->getCustomerByID($customerID);
            break;
        case 'getCustomers_Cart':
            $customerID = $userID;
            $customerController->getCustomerAndCartByID($customerID, $cartID);
            break;
        case 'getVoucher':
            if($userID){
                $customerController->getVoucherCustomer($userID);
                break;
            }else{
                echo json_encode(["success" => false, "message" => "User not logged in"]);
                break;
            }
        case 'getAllCustomer':
            $searchName = $_GET['searchName'] ?? null;
            if (empty($searchName)) {
                $searchName = null;
            }  
            $customerController->getAllCustomer($searchName);
            break;
        default:
            echo json_encode(['error' => 'Action not recognized']);
    }
    
}

?>