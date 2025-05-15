<?php

require_once __DIR__ . '/../repository/PostRepository.php';
require_once __DIR__ . '/../repository/CustomerRepository.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Customer.php';

class PostService
{
    private PostRepository $postRepository;
    private CustomerRepository $customerRepository;

    public function __construct($postRepository, $customerRepository)
    {
        $this->postRepository = $postRepository;
        $this->customerRepository = $customerRepository;
    }

    public function createPost($postData)
    {
        if (empty($postData)) {
            return false;
        }
        $this->postRepository->addPost($postData);
        return true;
    }

    // public function getPostsByUserId($userId)
    // {
    //     return $this->postRepository->getPostsByUserId($userId);
    // }

    public function getAllPosts()
    {
        //lây danh sách bài viết
        $posts = $this->postRepository->getAllPosts();
        $postsArray = [];
        // tao bien luu ID cua nguoi dung hien tai de danh dau cac bai viet da luu
        $ownerID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
        // duyệt qua từng bài viết
        foreach ($posts as $post) {
            //lấy thông tin tác giả bài viết
            $author = $this->customerRepository->getCustomerByID($post['userID']);
            // kiểm tra xem bài viết đã được lưu hay chưa
            $isSaved = $this->postRepository->postIsSaved($ownerID, $post['postID']);
            // tạo đối tượng Post và thêm vào mảng
            $postsArray[] = new Post(
                $post['postID'],
                $post['userID'],
                $post['title'],
                $post['content'],
                $post['createAt'],
                $author->customerName,
                $author->avatar,
                $isSaved
            );
        }

        return $postsArray;
    }

    public function getCommentsByPostId($postId)
    {
        return $this->postRepository->getCommentsByPostId($postId);
    }

    public function createComment($postId, $userId, $content)
    {
        return $this->postRepository->createComment($postId, $userId, $content);
    }

    public function savePost($customerID, $postID)
    {
        return $this->postRepository->savePost($customerID, $postID);
    }

    public function unsavePost($customerID, $postID)
    {
        return $this->postRepository->unsavePost($customerID, $postID);
    }

    public function getSavedPosts($customerID)
    {
        return $this->postRepository->getSavedPosts($customerID);
    }

    public function getPostsByCustomerID($customerID)
    {
        //lây danh sách bài viết
        $posts = $this->postRepository->getPostsByCustomerID($customerID);
        $postsArray = [];
        // duyệt qua từng bài viết
        foreach ($posts as $post) {
            //lấy thông tin tác giả bài viết
            $author = $this->customerRepository->getCustomerByID($post['userID']);
            // tạo đối tượng Post và thêm vào mảng
            $postsArray[] = new Post(
                $post['postID'],
                $post['userID'],
                $post['title'],
                $post['content'],
                $post['createAt'],
                $author->customerName,
                $author->avatar,
                null
            );
        }

        return $postsArray;
    }

    public function deletePost($postID)
    {
        return $this->postRepository->deletePost($postID);
    }
}

?>