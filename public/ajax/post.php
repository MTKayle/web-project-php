<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controllers/PostController.php';


header('Content-Type: application/json');

$database = new Database();
$PostService = new PostService(new PostRepository($database), new CustomerRepository($database));
$PostController = new PostController($PostService);

session_start();
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $action = $_POST['action'] ?? '';
    switch ($action) {
        case 'postComment':
            $postID = $_POST['postID'] ?? null;
            $commentContent = $_POST['content'] ?? '';
            $PostController->createComment($postID, $userID, $commentContent);
            break;
        case '':
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';

            $postData = [
                'userID' => $userID,
                'title' => $title,
                'content' => $content
            ];
            $PostController->createPost($postData);
            break;
        case 'savePost':
            $postID = $_POST['postID'] ?? null;
            $customerID = $userID;
            $PostController->savePost($customerID, $postID);
            break;
        case 'unsavePost':
            $postID = $_POST['postID'] ?? null;
            $customerID = $userID;
            $PostController->unsavePost($customerID, $postID);
            break;
        case 'deletePost':
            $postID = $_POST['postID'] ?? null;
            $PostController->deletePost($postID);
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
}

if($_SERVER["REQUEST_METHOD"] === "GET") {
    switch ($_GET['action']) {
        case 'getPosts':
            $PostController->getAllPosts();
            break;
        // case 'deletePost':
        //     $postID = $_GET['postID'] ?? null;
        //     $PostController->deletePost($postID);
        //     break;
        case 'getComments':
            $postID = $_GET['postID'] ?? null;
            $PostController->getCommentsByPostID($postID);
            break;
        case 'getSavedPosts':
            $customerID = $userID;
            $PostController->getSavedPosts($customerID);
            break;
        case 'getMyPosts':
            $customerID = $userID;
            $PostController->getPostsByCustomerID($customerID);
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
}

?>