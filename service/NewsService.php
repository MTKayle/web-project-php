<?php

require_once __DIR__ . '/../repository/NewsRepository.php';



class NewsService
{
    private NewsRepository $newsRepository;
    public function __construct($newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getAllNews($page, $limit, $search = null, $userID)
    {
        $news = $this->newsRepository->getAllNews($page, $limit,$search, $userID);
        if ($news) {
            return $news;
        } else {
            return null;
        }
    }
    public function addNews($title, $content, $userID, $overview, $avatar)
    {
        if (empty($title) || empty($content) || empty($userID)) {
            return null;
        }
        $avatarPath = '';
        if ($avatar) {
            $uploadDir = 'C:/xampp/htdocs/web-project-php/assets/news/';
            $avatarName = uniqid() . '_' . basename($avatar['name']);
            $avatarDir = '/web-project-php/assets/news/'. $avatarName;
            $avatarPath = move_uploaded_file($avatar['tmp_name'], $uploadDir.$avatarName) ? $avatarDir : '';
        }
        $result = $this->newsRepository->addNews($title, $content, $userID, $overview, $avatarPath);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteNews($newsID)
    {
        if (empty($newsID)) {
            return null;
        }
        $result = $this->newsRepository->deleteNews($newsID);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getNewsById($newsID)
    {
        if (empty($newsID)) {
            return null;
        }
        $result = $this->newsRepository->getNewsById($newsID);
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
}

?>