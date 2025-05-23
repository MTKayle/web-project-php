<?php
require_once __DIR__ . '/../repository/CustomerRepository.php';
require_once __DIR__ . '/../models/Customer.php';

class CustomerService{
    private CustomerRepository $customerRepository;

    public function __construct($customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function updateCustomer($currentID, $customerName, $phoneNumber, $address, $avatar){
        $avatarPath = '';
        if ($avatar) {
            $uploadDir = 'C:/xampp/htdocs/web-project-php/assets/avatar/';
            $avatarName = uniqid() . '_' . basename($avatar['name']);
            $avatarDir = '/web-project-php/assets/avatar/'. $avatarName;
            $avatarPath = move_uploaded_file($avatar['tmp_name'], $uploadDir.$avatarName) ? $avatarDir : '';
        }

        return $this->customerRepository->updateCustomer($currentID, $customerName, $phoneNumber, $address, $avatarPath);
    }

    public function getCustomerByID($customerID){
        $customer = $this->customerRepository->getCustomerByID($customerID);
        return $customer;
    }

    public function getVoucherCustomer($customerID){
        $voucher = $this->customerRepository->getVoucherCustomer($customerID);
        return $voucher;
    }

    public function getAllCustomer($searchName = null){
        $customers = $this->customerRepository->getAllCustomers($searchName);
        if ($customers) {
            return $customers;
        } else {
            return null;
        }
    }
}