<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Cart.php';

class CartRepository
{
    private $connnection;

    public function __construct($db)
    {
        $this->connnection = $db->getConnection();
    }

    public function addToCart($cartID, $productID)
    {
        try {
            $query = 'INSERT INTO cart_item (cartID, productID, quantity) VALUES (:cartID, :productID, 1)';
            $statement = $this->connnection->prepare($query);
            $statement->execute([
                'cartID' => $cartID,
                'productID' => $productID,
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createCartForCustomer($customerID)
    {
        try {
            $query = 'INSERT INTO carts (customerID) VALUES (:customerID)';
            $statement = $this->connnection->prepare($query);
            $statement->execute(['customerID' => $customerID]);

            $cartID = $this->connnection->lastInsertId();
            return $cartID;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function itemExists($cartID, $productID)
    {
        try {
            $query = 'SELECT 1 FROM cart_item WHERE cartID = :cartID AND productID = :productID AND isActive = 1';
            $statement = $this->connnection->prepare($query);
            $statement->execute(['cartID' => $cartID, 'productID' => $productID]);
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function increaseQuantity($cartID, $productID)
    {
        try {
            $query = 'UPDATE cart_item SET quantity = quantity + 1 WHERE cartID = :cartID AND productID = :productID';
            $statement = $this->connnection->prepare($query);
            $statement->execute(['cartID' => $cartID, 'productID' => $productID]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllCartItems($cartID)
    {
        try {
            $query = 'SELECT * FROM cart_item WHERE cartID = :cartID AND isActive = 1';
            $statement = $this->connnection->prepare($query);
            $statement->execute(['cartID' => $cartID]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getCartIDByCustomerID($customerID)
    {
        try {
            $query = 'SELECT cartID FROM carts WHERE customerID = :customerID';
            $statement = $this->connnection->prepare($query);
            $statement->execute(['customerID' => $customerID]);
            return $statement->fetchColumn();
        } catch (PDOException $e) {
            return null;
        }
    }

    public function updateQuantity($cartID, $productID, $quantity)
    {
        try {
            $query = 'UPDATE cart_item SET quantity = :quantity WHERE cartID = :cartID AND productID = :productID';
            $statement = $this->connnection->prepare($query);
            $statement->execute(['cartID' => $cartID, 'productID' => $productID, 'quantity' => $quantity]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function removeCartItem($cartID, $productID)
    {
        try {
            $query = 'DELETE FROM cart_item WHERE cartID = :cartID AND productID = :productID';
            $statement = $this->connnection->prepare($query);
            $statement->execute(['cartID' => $cartID, 'productID' => $productID]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function clearCart($cartID)
    {
        try {
            $query = "UPDATE cart_item SET isActive = 0 WHERE cartID = :cartID";
            $statement = $this->connnection->prepare($query);
            $statement->execute(['cartID' => $cartID]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}

