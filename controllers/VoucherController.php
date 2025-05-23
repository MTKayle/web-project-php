<?php
require_once __DIR__ . '/../service/VoucherService.php';

class VoucherController
{
    private VoucherService $voucherService;

    public function __construct($voucherService)
    {
        $this->voucherService = $voucherService;
    }

    public function addVoucher($voucherCode, $minOrderValue, $discountValue, $startDate, $endDate)
    {
        if (empty($voucherCode) || empty($minOrderValue) || empty($discountValue) || empty($startDate) || empty($endDate)) {
            echo json_encode(["success" => false, "message"=> "Thiếu thông tin voucher"]);
            exit();
        }

        $result = $this->voucherService->addVoucher($voucherCode, $minOrderValue, $discountValue, $startDate, $endDate);
        if ($result) {
            echo json_encode(["success" => true, "message"=> "Thêm voucher thành công"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Thêm voucher thất bại"]);
            exit();
        }
    }  
    
    public function getAllVouchers($page, $limit, $search = null)
    {
        $vouchers = $this->voucherService->getAllVouchers($page, $limit, $search);
        if ($vouchers) {
            echo json_encode(["success" => true, "response" => $vouchers]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Không tìm thấy thông tin voucher"]);
            exit();
        }
    }

    public function giveVoucher($listCustomerID, $voucherCode)
    {
        if (empty($listCustomerID) || empty($voucherCode)) {
            echo json_encode(["success" => false, "message"=> "Thiếu thông tin voucher"]);
            exit();
        }

        $result = $this->voucherService->giveVoucher($listCustomerID, $voucherCode);
        if ($result) {
            echo json_encode(["success" => true, "message"=> $result]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Thêm voucher thất bại"]);
            exit();
        }
    }

    public function deleteVoucher($voucherID)
    {
        if (empty($voucherID)) {
            echo json_encode(["success" => false, "message"=> "Thiếu thông tin voucher"]);
            exit();
        }

        $result = $this->voucherService->deleteVoucher($voucherID);
        if ($result) {
            echo json_encode(["success" => true, "message"=> "Xóa voucher thành công"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message"=> "Xóa voucher thất bại"]);
            exit();
        }
    }
    
}