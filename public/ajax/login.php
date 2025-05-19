<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/UserController.php';

header('Content-Type: application/json');

$database = new Database();
$userService = new UserService(new UserRepository($database), new CartRepository($database));
$userController = new UserController($userService);


if($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $userController->login($email, $password);
}

if($_SERVER["REQUEST_METHOD"] === "GET") {
    session_start();
    $email = $_SESSION['email'] ?? '';
    $userController->getUserByEmail($email);
}
?>