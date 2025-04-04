<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/UserController.php';

header('Content-Type: application/json');

$database = new Database();
$userService = new UserService(new UserRepository($database));
$userController = new UserController($userService);


if($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $userController->logout();
}
?>