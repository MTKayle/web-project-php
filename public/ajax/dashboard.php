<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/DashboardController.php';

header('Content-Type: application/json');

$database = new Database();
$dashboardService = new DashboardService(new DashboardRepository($database));
$dashboardController = new DashboardController($dashboardService);


if($_SERVER["REQUEST_METHOD"] === "GET") {
    $action = $_GET['action'] ?? '';
    switch ($action) {
        case 'getChartData':
            $type = $_GET['type'] ?? '';
            $dashboardController->getRevenueData($type);
            break;
        case 'getDashboardData':
            $dashboardController->getDashboardData();
            break;
        case 'getTop5Product':
            $dashboardController->getTop5Products();
        case 'getListOrderPending':
            $statusID = $_GET['statusID'] ?? '';
            $dashboardController->getListOrderForStatus($statusID);
            break;
        case 'getProductNew':
            $dashboardController->getProductNew();
            break;
        default:
            echo json_encode(['error' => 'Action not recognized']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>