<?php

require_once __DIR__ . '/../repository/VoucherRepository.php';

class VoucherService
{
    private VoucherRepository $voucherRepository;

    public function __construct($voucherRepository)
    {
        $this->voucherRepository = $voucherRepository;
    }

    public function getAllVouchers($page, $limit, $search = null)
    {
        $vouchers = $this->voucherRepository->getAllVouchers($page, $limit, $search);
        if ($vouchers) {
            return $vouchers;
        } else {
            return null;
        }
    }

    public function addVoucher($voucherCode, $minOrderValue, $discountValue, $startDate, $endDate)
    {
        if (empty($voucherCode) || empty($minOrderValue) || empty($discountValue) || empty($startDate) || empty($endDate)) {
            return null;
        }
        $result = $this->voucherRepository->addVoucher($voucherCode, $minOrderValue, $discountValue, $startDate, $endDate);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function giveVoucher($listCustomerID, $voucherCode)
    {
        if (empty($listCustomerID) || empty($voucherCode)) {
            return null;
        }
        $result = $this->voucherRepository->giveVoucherForCustomer($listCustomerID, $voucherCode);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteVoucher($voucherID)
    {
        if (empty($voucherID)) {
            return null;
        }
        $result = $this->voucherRepository->deleteVoucher($voucherID);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
}

?>