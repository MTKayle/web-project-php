<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/NewsController.php';

header('Content-Type: application/json');

$database = new Database();
$newsService = new NewsService(new NewsRepository($database));
$newsController = new NewsController($newsService);

session_start();
$userID = $_SESSION['userID'] ?? null;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? null;
    switch($action){
        case 'add':
            $title = $_POST['title'] ?? null;
            $content = $_POST['content'] ?? null;
            $overview = $_POST['overview'] ?? null;
            $image = $_FILES['image'] ?? null;
           
            $newsController->addNews($title, $content, $userID, $overview, $image);
            break;
        case 'delete':
            $newsID = $_POST['articleID'] ?? null;
        
            $newsController->deleteNews($newsID);
            break;
        case 'getNewsById':
            $newsID = $_POST['articleID'] ?? null;
            
            $newsController->getNewsById($newsID);
            break;
        case 'get3LatestNews':
            $newsController->get3LatestNews();
            break;
        case 'getAllNewsUser':
            $page = $_POST['page'] ?? 1;
            $search = $_POST['search'] ?? null;
            if(empty($search)) {
                $search = null;
            }
            $newsController->getAllNewsUser($page, 6 ,$search);
            break;
        default:
            echo json_encode(["success" => false, "message"=> "Invalid action"]);
            exit();
    }
    $userController->logout();
}

if($_SERVER["REQUEST_METHOD"] === "GET") {
    $page = $_GET['page'] ?? 1;
    $search = $_GET['search'] ?? null;
    if(empty($search)) {
        $search = null;
    }
    $newsController->getAllNews($page, 6 ,$search, $userID);
}
?>