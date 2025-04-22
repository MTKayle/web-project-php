<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository{
    private $connnection;

    public function __construct($db)
    {
        $this->connnection = $db->getConnection();
    }

    public function getUserByEmail($email){
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['email' => $email]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        // if($user){
        //     return new User($user['userID'], $user['email'], $user['password'], $user['userName']);
        // }
        return $user;
    }

    public function registerUser($name, $email, $password){
        try {
            $this->connnection->beginTransaction();
            $query = "INSERT INTO users (userName, email, password, userRoleID) VALUES (:name, :email, :password, 2)";
            $statement = $this->connnection->prepare($query);
            $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

            $userID =  $this->connnection->lastInsertId();

            $queryCustomer = "INSERT INTO customers (customerID) VALUES (:userID)";
            $stmtCustomer = $this->connnection->prepare($queryCustomer);
            $stmtCustomer->execute(['userID' => $userID]); 
            $this->connnection->commit(); 
            return $userID;
        } catch (PDOException $e) {
            //throw $th;
            $this->connnection->rollback();
            return null;
        }
        
    }

    


}