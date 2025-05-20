<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/VoucherController.php';

header('Content-Type: application/json');

$database = new Database();
$voucherService = new VoucherService(new VoucherRepository($database));
$voucherController = new VoucherController($voucherService);

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? null;
    switch ($action) {
        case 'add':
            $voucherCode = $_POST['code'] ?? null;
            $minOrderValue = $_POST['minOrderValue'] ?? null;
            $discountValue = $_POST['discountValue'] ?? null;
            $startDate = $_POST['startDate'] ?? null;
            $endDate = $_POST['endDate'] ?? null;

            $voucherController->addVoucher($voucherCode, $minOrderValue, $discountValue, $startDate, $endDate);
            break;
        case 'give':
            $listCustomerID = $_POST['listCustomerID'] ?? null;
            $voucherCode = $_POST['code'] ?? null;

            $voucherController->giveVoucher($listCustomerID, $voucherCode);
            break;
        case 'delete':
            $voucherID = $_POST['code'] ?? null;

            $voucherController->deleteVoucher($voucherID);
            break;
        default:
            echo json_encode(["success" => false, "message" => "Invalid action"]);
            exit();
    }
}

if($_SERVER["REQUEST_METHOD"] === "GET") {
    $page = $_GET['page'] ?? 1;
    $search = $_GET['search'] ?? null;
    if (empty($search)) {
        $search = null;
    }
    $voucherController->getAllVouchers($page, 7, $search);
}

?>