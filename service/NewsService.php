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
    public function addNews($title, $content, $userID)
    {
        if (empty($title) || empty($content) || empty($userID)) {
            return null;
        }
        $result = $this->newsRepository->addNews($title, $content, $userID);
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
}

?>