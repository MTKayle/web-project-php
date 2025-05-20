<?php
require_once __DIR__ . '/../service/NewsService.php';

class NewsController
{
    private NewsService $newsService;
    public function __construct($newsService)
    {
        $this->newsService = $newsService;
    }

    public function getAllNews($page, $limit, $search = null, $userID)
    {
        if (empty($userID)) {
            echo json_encode(["success" => false, "message"=> "Thiếu thông tin Người dùng"]);
            exit();
        }
        $news = $this->newsService->getAllNews($page, $limit , $search, $userID);
        if ($news) {
            echo json_encode(["success" => true, "response" => $news]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin bài viết"]);
            exit();
        }
    }

    public function addNews($title, $content, $userID)
    {
        if (empty($title) || empty($content) || empty($userID)) {
            echo json_encode(["success" => false, "message"=> "Thiếu thông tin bài viết"]);
            exit();
        }

        $result = $this->newsService->addNews($title, $content, $userID);
        if ($result) {
            echo json_encode(["success" => true, "message"=> "Thêm bài viết thành công"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Thêm bài viết thất bại"]);
            exit();
        }
    }

    public function deleteNews($newsID)
    {
        if (empty($newsID)) {
            echo json_encode(["success" => false, "message"=> "Thiếu thông tin bài viết"]);
            exit();
        }

        $result = $this->newsService->deleteNews($newsID);
        if ($result) {
            echo json_encode(["success" => true, "message"=> "Xóa bài viết thành công"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Xóa bài viết thất bại"]);
            exit();
        }
    }
    
}