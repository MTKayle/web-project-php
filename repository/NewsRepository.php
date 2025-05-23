<?php
require_once __DIR__ . '/../config/Database.php';


class NewsRepository
{
    private $connection;
    public function __construct($db)
    {
        $this->connection = $db->getConnection();
    }

    public function getAllNews($page = 1, $limit = 7, $search = null, $userID)
    {
        $offset = ($page - 1) * $limit;

        // Lấy danh sách tin tức (với limit & offset)
        $query = "SELECT * FROM articles WHERE isActive = 1";
        if ($search) {
            $query .= " AND title LIKE :search";
        }
        $query .= " ORDER BY createAt DESC LIMIT :limit OFFSET :offset";

        $statement = $this->connection->prepare($query);
        if ($search) {
            $searchLike = "%$search%";
            $statement->bindParam(':search', $searchLike);
        }
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        $articles = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Đếm tổng số bản ghi 
        $countQuery = "SELECT COUNT(*) FROM articles WHERE isActive = 1";
        if ($search) {
            $countQuery .= " AND title LIKE :search";
        }

        $countStmt = $this->connection->prepare($countQuery);
        if ($search) {
            $countStmt->bindParam(':search', $searchLike);
        }
        $countStmt->execute();
        $totalRows = $countStmt->fetchColumn();
        $totalPages = ceil($totalRows / $limit);

        // Lấy thông tin người dùng
        $userQuery = "SELECT * FROM users WHERE userID = :userID";
        $statementUser = $this->connection->prepare($userQuery);
        $statementUser->bindParam(':userID', $userID);
        $statementUser->execute();
        $userRow = $statementUser->fetch(PDO::FETCH_ASSOC);

        return [
            'articles' => $articles,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'author' => $userRow['userName'] ?? 'Unknown',
        ];
    }


    public function addNews($title, $content, $userID, $overview, $image)
    {
        $query = "INSERT INTO articles (title, content, createAt, userID, isActive, description, image) VALUES (:title, :content, NOW(), :userID, 1, :overview, :image)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':content', $content);
        $statement->bindParam(':userID', $userID);
        $statement->bindParam(':overview', $overview);
        $statement->bindParam(':image', $image);
        return $statement->execute();
    }

    public function deleteNews($newsID)
    {
        $query = "UPDATE articles SET isActive = 0 WHERE articleID = :newsID";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':newsID', $newsID);
        return $statement->execute();
    }

    public function getNewsById($newsID)
    {
        $query = "SELECT * FROM articles WHERE articleID = :newsID";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':newsID', $newsID);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function get3LatestNews()
    {
        $query = "SELECT * FROM articles WHERE isActive = 1 ORDER BY createAt DESC LIMIT 3";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllNewsUser($page = 1, $limit = 7, $search = null)
    {
        $offset = ($page - 1) * $limit;

        // Lấy danh sách tin tức (với limit & offset)
        $query = "SELECT * FROM articles WHERE isActive = 1";
        if ($search) {
            $query .= " AND title LIKE :search";
        }
        $query .= " ORDER BY createAt DESC LIMIT :limit OFFSET :offset";

        $statement = $this->connection->prepare($query);
        if ($search) {
            $searchLike = "%$search%";
            $statement->bindParam(':search', $searchLike);
        }
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        $articles = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Đếm tổng số bản ghi 
        $countQuery = "SELECT COUNT(*) FROM articles WHERE isActive = 1";
        if ($search) {
            $countQuery .= " AND title LIKE :search";
        }

        $countStmt = $this->connection->prepare($countQuery);
        if ($search) {
            $countStmt->bindParam(':search', $searchLike);
        }
        $countStmt->execute();
        $totalRows = $countStmt->fetchColumn();
        $totalPages = ceil($totalRows / $limit);

        

        return [
            'articles' => $articles,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            
        ];
    }
    


}
?>