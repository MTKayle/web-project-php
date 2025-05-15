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

        $queryEmail = "SELECT email FROM users WHERE userID = :customerID";
        $statementEmail = $this->connnection->prepare($queryEmail);
        $statementEmail->execute(['customerID' => $customerID]);
        $email = $statementEmail->fetch(PDO::FETCH_ASSOC);

        if($customer){
            return new Customer($customer['customerID'], $customer['customerName'], $customer['phoneNumber'], $customer['address'], $email['email'], $customer['avatar']);
        }
        return null;
    }

    public function getVoucherCustomer($customerID){
        $query = "SELECT * FROM customer_voucher 
                    INNER JOIN vouchers ON customer_voucher.code = vouchers.code
                    WHERE customerID = :customerID AND vouchers.endDate >= NOW() AND vouchers.isActive = 1 AND customer_voucher.isUsed = 0";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['customerID' => $customerID]);
        $vouchers = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($vouchers){
            return $vouchers;
        }
        return null;
    }

    public function updateIsUsedVoucher($customerID, $voucherCode){
        $query = "UPDATE customer_voucher SET isUsed = 1 WHERE customerID = :customerID AND code = :voucherCode";
        $statement = $this->connnection->prepare($query);
        return $statement->execute(['customerID' => $customerID, 'voucherCode' => $voucherCode]);
    }

    public function getVoucherByCode($voucherCode){
        $query = "SELECT * FROM vouchers WHERE code = :voucherCode";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['voucherCode' => $voucherCode]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}