<div class="d-flex">
    <!-- Main Content -->
    <div class="main-content">
        

        <!-- VOUCHER CONTENT -->
<div class="container mt-4">
    <h3 class="mb-4">Quản lý Voucher</h3>

    <!-- Nút hành động -->
    <div class="mb-3 d-flex justify-content-between">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addVoucherModal">
            + Thêm Voucher
        </button>
        <div class="input-group w-25">
                            <input type="text" id="searchArticle" class="form-control" placeholder="Tìm kiếm voucher">
                            <button class="input-group-text" id="btnSearch">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
    </div>

    <!-- Danh sách voucher -->
    <div class="card">
        <div class="card-header bg-info text-white">Danh sách Voucher</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Mã Voucher</th>
                        <th>Đơn hàng tối thiểu</th>
                        <th>Giảm giá</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="voucherTableBody">
                    <!-- Render voucher rows bằng JS -->
                </tbody>
            </table>
            <!-- Pagination -->
            <nav aria-label="Order Pagination" class="mt-4">
                        <ul class="pagination justify-content-center" id="pagination">
                            <!-- render pagination here -->
                        </ul>
            </nav>
        </div>
    </div>
</div>

<!-- MODAL: Thêm Voucher -->
<div class="modal fade" id="addVoucherModal" tabindex="-1" aria-labelledby="addVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="addVoucherForm" class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addVoucherModalLabel">Thêm Voucher Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-4">
                    <label for="code" class="form-label">Mã Voucher</label>
                    <input type="text" class="form-control" id="code" name="code" required>
                </div>
                <div class="col-md-4">
                    <label for="minOrder" class="form-label">Đơn hàng tối thiểu (VNĐ)</label>
                    <input type="number" class="form-control" id="minOrder" name="minOrder" required>
                </div>
                <div class="col-md-4">
                    <label for="discount" class="form-label">Giảm giá</label>
                    <input type="number" class="form-control" id="discount" name="discount" required>
                </div>
                <div class="col-md-4">
                    <label for="startDate" class="form-label">Ngày bắt đầu</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                </div>
                <div class="col-md-4">
                    <label for="endDate" class="form-label">Ngày kết thúc</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Lưu Voucher</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL: Phát Voucher -->
<div class="modal fade" id="assignVoucherModal" tabindex="-1" aria-labelledby="assignVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="assignVoucherForm" class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="assignVoucherModalLabel">Phát Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>

            <div class="modal-body">
            <div class="row align-items-end mb-3">
    <!-- Cột mã voucher -->
    <div class="col-md-6">
        <label for="selectedVoucher" class="form-label fw-bold">Mã Voucher</label>
        <input type="text" id="selectedVoucher" class="form-control" readonly>
        <input type="hidden" id="selectedVoucherId" name="voucherID">
    </div>  

    <!-- Cột tìm kiếm -->
    <div class="col-md-6">
        <label for="searchArticle" class="form-label fw-bold">Tìm kiếm khách hàng</label> 
        <div class="input-group">
            <input type="text" id="searchCustomer" class="form-control" placeholder="Nhập email khách hàng">
            <button class="input-group-text" id="btnSearchCustomer">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</div>


                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" id="selectAllCheckbox">
                                </th>
                                <th>Mã khách hàng</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody">
                            <!-- Dữ liệu khách hàng sẽ được render ở đây bằng JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Phát Voucher</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </form>
    </div>
</div>



    </div>
</div>

  








