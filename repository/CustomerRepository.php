<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/User.php';

class CustomerRepository
{
    private $connnection;

    public function __construct($db)
    {
        $this->connnection = $db->getConnection();
    }

    public function updateCustomer($currentID, $customerName, $phoneNumber, $address, $avatar){
        try {
            $this->connnection->beginTransaction();
            if($avatar) {
                $query = 'UPDATE customers SET customerName = :customerName, phoneNumber = :phoneNumber, address = :address, avatar = :avatar WHERE customerID = :currentID';
                $params = [
                    'customerName' => $customerName,
                    'phoneNumber' => $phoneNumber,
                    'address' => $address,
                    'avatar' => $avatar,
                    'currentID' => $currentID
                ];
            } else {
                $query = 'UPDATE customers SET customerName = :customerName, phoneNumber = :phoneNumber, address = :address WHERE customerID = :currentID';
                $params = [
                    'customerName' => $customerName,
                    'phoneNumber' => $phoneNumber,
                    'address' => $address,
                    'currentID' => $currentID
                ];
            }
            $statement = $this->connnection->prepare($query);
            $statement->execute($params);
            $this->connnection->commit();
            return true;
        } catch (PDOException $e) {
            $this->connnection->rollBack();
            return false;
        }
    }

    public function getCustomerByID($customerID){
        $query = "SELECT * FROM customers WHERE customerID = :customerID";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['customerID' => $customerID]);
        $customer = $statement->fetch(PDO::FETCH_ASSOC);
        if($customer){
            return new Customer($customer['customerID'], $customer['customerName'], $customer['phoneNumber'], $customer['address'], $customer['avatar']);
        }
        return null;
    }
}