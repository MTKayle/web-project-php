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
        if (!$avatar || $avatar['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(["success" => false, "message" => "Có lỗi xảy ra khi upload ảnh"]);
        }else {
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
}