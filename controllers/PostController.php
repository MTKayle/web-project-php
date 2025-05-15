<?php

require_once __DIR__ . '/../service/PostService.php';

class PostController
{
    private PostService $postService;

    public function __construct($postService)
    {
        $this->postService = $postService;
    }

    public function createPost($postData)
    {
        if (empty($postData)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin bài viết"]);
            exit();
        }

        try {
            $post = $this->postService->createPost($postData);
            if ($post) {
                echo json_encode(["success" => true, "message" => "Tạo bài viết thành công"]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Tạo bài viết thất bại"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }

    // public function getPostsByUserId($userId)
    // {
    //     if (empty($userId)) {
    //         echo json_encode(["success" => false, "message" => "Không có thông tin người dùng"]);
    //         exit();
    //     }

    //     try {
    //         $posts = $this->postService->getPostsByUserId($userId);
    //         if ($posts) {
    //             echo json_encode(["success" => true, "posts" => $posts]);
    //             exit();
    //         } else {
    //             echo json_encode(["success" => false, "message" => "Không tìm thấy bài viết nào"]);
    //             exit();
    //         }
    //     } catch (Exception $e) {
    //         echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
    //         exit();
    //     }
    // }

    public function getAllPosts()
    {
        try {
            $posts = $this->postService->getAllPosts();
            if ($posts) {
                echo json_encode(["success" => true, "posts" => $posts]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Không tìm thấy bài viết nào"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }

    public function getCommentsByPostID($postID)
    {
        if (empty($postID)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin bài viết"]);
            exit();
        }

        try {
            $comments = $this->postService->getCommentsByPostId($postID);
            if ($comments) {
                echo json_encode(["success" => true, "comments" => $comments]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Không tìm thấy bình luận nào"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }

    public function createComment($postID, $userID, $content)
    {
        if (empty($postID) || empty($userID) || empty($content)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin bình luận"]);
            exit();
        }

        try {
            $comment = $this->postService->createComment($postID, $userID, $content);
            if ($comment) {
                echo json_encode(["success" => true, "response" => $comment]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Tạo bình luận thất bại"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }

    public function savePost($customerID, $postID)
    {
        if (empty($customerID) || empty($postID)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin bài viết"]);
            exit();
        }

        try {
            $savedPost = $this->postService->savePost($customerID, $postID);
            if ($savedPost) {
                echo json_encode(["success" => true, "message" => "Lưu bài viết thành công"]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Lưu bài viết thất bại"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }

    public function unsavePost($customerID, $postID)
    {
        if (empty($customerID) || empty($postID)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin bài viết"]);
            exit();
        }

        try {
            $unsavedPost = $this->postService->unsavePost($customerID, $postID);
            if ($unsavedPost) {
                echo json_encode(["success" => true, "message" => "Bỏ lưu bài viết thành công"]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Bỏ lưu bài viết thất bại"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }

    public function getSavedPosts($customerID)
    {
        if (empty($customerID)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin người dùng"]);
            exit();
        }

        try {
            $savedPosts = $this->postService->getSavedPosts($customerID);
            if ($savedPosts) {
                echo json_encode(["success" => true, "posts" => $savedPosts]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Không tìm thấy bài viết nào"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }

    public function getPostsByCustomerID($customerID)
    {
        if (empty($customerID)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin người dùng"]);
            exit();
        }

        try {
            $posts = $this->postService->getPostsByCustomerID($customerID);
            if ($posts) {
                echo json_encode(["success" => true, "posts" => $posts]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Không tìm thấy bài viết nào"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }

    public function deletePost($postID)
    {
        if (empty($postID)) {
            echo json_encode(["success" => false, "message" => "Không có thông tin bài viết"]);
            exit();
        }

        try {
            $deletedPost = $this->postService->deletePost($postID);
            if ($deletedPost) {
                echo json_encode(["success" => true, "message" => "Xóa bài viết thành công"]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "Xóa bài viết thất bại"]);
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Hệ thống gặp lỗi, vui lòng thử lại sau!"]);
            exit();
        }
    }
}

?>