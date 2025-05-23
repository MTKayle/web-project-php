<?php

class Post
{
    public $postID;
    public $userID;
    public $userName;
    public $userImage;
    public $title;
    public $content;
    public $createdAt;
    public $isActive;
    public $isSaved;

    public function __construct($postID, $userID, $title, $content, $createdAt, $userName, $userImage, $isSaved)
    {
        $this->postID = (int)$postID;
        $this->userID = (int)$userID;
        $this->title = htmlspecialchars($title);
        $this->content = htmlspecialchars($content);
        $this->createdAt = htmlspecialchars($createdAt);
        $this->userName = htmlspecialchars($userName);
        $this->userImage = htmlspecialchars($userImage);
        $this->isSaved = (int)$isSaved;
    }
}

?>