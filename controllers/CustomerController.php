<?php
require_once __DIR__ . '/../service/customerService.php';

class CustomerController{

    private CustomerService $customerService;

    public function __construct($customerService)
    {
        $this->customerService = $customerService;
    }

    public function updateCustomer($currentID, $customerName, $phoneNumber, $address, $avatar){
        $customer = $this->customerService->updateCustomer($currentID, $customerName, $phoneNumber, $address, $avatar);
        if($customer){
            echo json_encode( ["success" => true, "message" => "Cập nhật thông tin thành công"]);  
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Cập nhật thông tin thất bại"]);
            exit();
        }
    }

    public function getCustomerByID($customerID){
        $customer = $this->customerService->getCustomerByID($customerID);
        if($customer){
            $response = [
                "success"=> true,
                "customer" => [
                    "customerName" => $customer->customerName ?? '',
                        "phoneNumber" => $customer->phoneNumber ?? '',
                        "address" => $customer->address ?? '',
                        "avatar" => $customer->avatar ?? ''
                    ]
                ];
            echo json_encode( $response);  
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Không tìm thấy thông tin khách hàng"]);
            exit();
        }
    }
}
