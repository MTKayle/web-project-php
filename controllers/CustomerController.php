<?php
require_once __DIR__ . '/../service/customerService.php';

class CustomerController{

    private CustomerService $customerService;
    private CartService $cartService;

    public function __construct($customerService, $cartService)
    {
        $this->cartService = $cartService;
        $this->customerService = $customerService;
    }

    public function updateCustomer($currentID, $customerName, $phoneNumber, $address, $avatar){
        if(empty($customerName) && empty($phoneNumber) && empty($address) && empty($avatar)){
            echo json_encode(["success" => false, "message" => "Không có thông tin thay đổi"]);
            exit();
        }
        $customer = $this->customerService->updateCustomer($currentID, $customerName, $phoneNumber, $address, $avatar);
        if(is_array($avatar) && $avatar["error"] !== UPLOAD_ERR_OK){
            $message = "Lỗi khi tải ảnh";
        }else {
            $message = "Cập nhật thông tin thành công";
        }
        if($customer){
            echo json_encode( ["success" => true, "message" => $message]);  
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> $message]);
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
                        "avatar" => $customer->avatar ?? '',
                        "email" => $customer->email ?? '',
                    ]
                ];
            echo json_encode( $response);  
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Không tìm thấy thông tin khách hàng"]);
            exit();
        }
    }

    public function getCustomerAndCartByID($customerID, $cartID){
        
        
        $customer = $this->customerService->getCustomerByID($customerID);
        if(empty($cartID)){
            echo json_encode(["success"=> false, "message"=> "Không có thông tin giỏ hàng"]);
            exit();
        }
        $cartItems = $this->cartService->getAllCartItems($cartID);
        
        if(empty($cartItems)){
            echo json_encode(["success"=> false, "message"=> "Không có sản phẩm nào trong giỏ hàng"]);
            exit();
        }

    
            $response = [
                "success"=> true,
                "customer" => [
                    "customerName" => $customer->customerName ?? '',
                        "phoneNumber" => $customer->phoneNumber ?? '',
                        "address" => $customer->address ?? '',
                        "avatar" => $customer->avatar ?? '',
                        "email" => $customer->email ?? '',
                    ],
                "cartItems" => $cartItems
            ];
            echo json_encode( $response);  
            exit();
       
    }

    public function getVoucherCustomer($customerID){
        $voucher = $this->customerService->getVoucherCustomer($customerID);
        if($voucher){
            echo json_encode( ["success" => true, "voucher" => $voucher]);  
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin voucher"]);
            exit();
        }
    }
}
