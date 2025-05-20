<?php
require_once __DIR__ . '/../config/Database.php';

class VoucherRepository
{
    private $connnection;

    public function __construct($db)
    {
        $this->connnection = $db->getConnection();
    }

    //them moi voucher
    public function addVoucher($voucherCode, $minOrderValue, $discountValue, $startDate, $endDate)
    {
        try {
            $query = "INSERT INTO vouchers (code, minOrderValue, discountValue, startDate, endDate, isActive) 
                      VALUES (:voucherCode, :minOrderValue, :discountValue, :startDate, :endDate, :isActive)";
            $statement = $this->connnection->prepare($query);
            $statement->execute([
                'voucherCode' => $voucherCode,
                'minOrderValue' => $minOrderValue,
                'discountValue' => $discountValue,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'isActive' => 1
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    //lay danh sach voucher
    public function getAllVouchers($page = 1, $limit = 7, $search = null)
    {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM vouchers WHERE isActive = 1 AND endDate >= NOW()";
        if ($search) {
            $query .= " AND code LIKE :search";
        }
        $query .= " LIMIT :limit OFFSET :offset";
        $statement = $this->connnection->prepare($query);
        if ($search) {
            $statement->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        }
        $statement->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $statement->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $statement->execute();

        $countQuery = "SELECT COUNT(*) FROM vouchers WHERE isActive = 1 AND endDate >= NOW()";
        if ($search) {
            $countQuery .= " AND code LIKE :search";
        }
        $countStmt = $this->connnection->prepare($countQuery);
        if ($search) {
            $countStmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        }
        $countStmt->execute();
        $totalRows = $countStmt->fetchColumn();
        $totalPages = ceil($totalRows / $limit);
        $currentPage = $page;
        $vouchers = $statement->fetchAll(PDO::FETCH_ASSOC);
        return [
            'vouchers' => $vouchers,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
        ];
    }

    //ham them voucher cho customer
    public function giveVoucherForCustomer($listCustomerID, $code){
        $query = "INSERT INTO customer_voucher (customerID, code, isUsed, isActive) VALUES (:customerID, :code, 0, 1)";
        
        $statement = $this->connnection->prepare($query);
        foreach ($listCustomerID as $customerID) {
            $statement->execute([
                'customerID' => $customerID,
                'code' => $code
            ]);
        }
        return true;
    }

    //xoa voucher
    public function deleteVoucher($voucherID)
    {
        $query = "UPDATE vouchers SET isActive = 0 WHERE code = :voucherID";
        $statement = $this->connnection->prepare($query);
        $statement->execute(['voucherID' => $voucherID]);
        return true;
    }   
}
?>