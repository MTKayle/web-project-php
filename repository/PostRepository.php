<?php
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../config/Database.php';

class PostRepository
{
    private $connnection;

    public function __construct($db)
    {
        $this->connnection = $db->getConnection();
    }

    // public function getPostsByUserId($userId)
    // {
    //     $query = "SELECT * FROM posts WHERE userID = :userID";
    //     $statement = $this->connnection->prepare($query);
    //     $statement->execute(['userID' => $userId]);
    //     $posts = [];
    //     while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    //         $posts[] = new Post($row['postID'], $row['userID'], $row['content'], $row['createdAt']);
    //     }
    //     return $posts;
    // }

    public function addPost($post)
    {
        $query = "INSERT INTO posts (title, content, createAt, userID, isActive) VALUES (:title, :content, NOW(), :userID, 1)";
        $statement = $this->connnection->prepare($query);
        $statement->execute([
            'title' => $post['title'],
            'content' => $post['content'],
            'userID' => $post['userID']
        ]);
        return true;
    }

    // public function getPostsByUserId($userId)
    // {
    //     $query = "SELECT * FROM posts WHERE userID = :userID And isActive = 1 ORDER BY createAt DESC";
    //     $statement = $this->connnection->prepare($query);
    //     $statement->execute(['userID' => $userId]);
    //     $posts = [];
    //     while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    //         $posts[] = new Post($row['postID'], $row['userID'], $row['title'], $row['content'], $row['createAt']);
    //     }
    //     return $posts;
    // }

    public function getAllPosts()
    {
        $query = "SELECT * FROM posts WHERE isActive = 1 ORDER BY createAt DESC";
        $statement = $this->connnection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentsByPostId($postId)
    {
        $query = "SELECT * FROM comments 
                    INNER JOIN customers ON comments.customerID = customers.customerID
                    WHERE postID = :postID AND comments.isActive = 1";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['postID' => $postId]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createComment($postId, $customerId, $content)
    {
        $query = "INSERT INTO comments (postID, customerID, content, createAt, isActive) VALUES (:postID, :customerID, :content, NOW(), 1)";
        $statement = $this->connnection->prepare($query);
        $statement->execute([
            'postID' => $postId,
            'customerID' => $customerId,
            'content' => $content
        ]);
        $commentId = $this->connnection->lastInsertId();
        $query = "SELECT * FROM comments 
                    INNER JOIN customers ON comments.customerID = customers.customerID
                    WHERE commentID = :commentID";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['commentID' => $commentId]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function savePost($customerID, $postID)
    {
        try{
            $query = "INSERT INTO customer_post (customerID, postID, savedAt, isActive) VALUES (:customerID, :postID, NOW(), 1)";
            $statement = $this->connnection->prepare($query);
            $statement->execute([
                'customerID' => $customerID,
                'postID' => $postID
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
        
    }

    public function unsavePost($customerID, $postID)
    {
        try{
            $query = "DELETE FROM customer_post WHERE customerID = :customerID AND postID = :postID";
            $statement = $this->connnection->prepare($query);
            $statement->execute([
                'customerID' => $customerID,
                'postID' => $postID
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getSavedPosts($customerID)
    {
        $query = "SELECT * FROM customer_post 
                    INNER JOIN posts ON customer_post.postID = posts.postID
                    INNER JOIN customers ON posts.userID = customers.customerID
                    WHERE customer_post.customerID = :customerID AND customer_post.isActive = 1 AND posts.isActive = 1";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['customerID' => $customerID]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function postIsSaved($customerID, $postID)
    {
        $query = "SELECT * FROM customer_post WHERE customerID = :customerID AND postID = :postID AND isActive = 1";
        $statement = $this->connnection->prepare($query);
        $statement->execute([
            'customerID' => $customerID,
            'postID' => $postID
        ]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        }
        return false;
    }  
    
    public function getPostsByCustomerId($customerID)
    {
        $query = "SELECT * FROM posts WHERE userID = :userID AND isActive = 1 ORDER BY createAt DESC";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['userID' => $customerID]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePost($postID)
    {
        $query = "UPDATE posts SET isActive = 0 WHERE postID = :postID";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['postID' => $postID]);
        return true;
    }
}

?>