<div class="d-flex">
    <!-- Main Content -->
    <div class="main-content">
        

        <!-- Orders Content -->
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Danh sách đơn hàng</h2>
                <div class="d-flex gap-2">
                    <select class="form-select">
                        <option>Chờ xử lí</option>
                        <option>Tất cả</option>
                        <option>Đang giao hàng</option>
                        <option>Đã giao hàng</option>   
                        <option>Đã hủy</option>
                    </select>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="orderTable">
                        <!-- render order table here -->
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="Order Pagination" class="mt-4">
                        <ul class="pagination justify-content-center" id="pagination">
                            <!-- render pagination here -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Chi tiết đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="orderDetailsPrint">
            <table class="info-table mb-3" style="width: 100%; border: none;">
                <tr>
                    <td style="width: 50%; vertical-align: top; border: none;">
                        <strong>Mã đơn hàng:</strong> <span id="orderCode"></span><br>
                        <strong>Tên khách hàng:</strong> <span id="customerName"></span><br>
                        <strong>Số điện thoại:</strong> <span id="customerPhone"></span><br>
                        <strong>Email:</strong> <span id="customerEmail"></span><br>
                    </td>
                    <td style="width: 50%; vertical-align: top; border: none;">
                        <strong>Địa chỉ:</strong> <span id="customerAddress"></span><br>
                        <strong>Thanh toán:</strong> <span id="paymentMethod"></span><br>
                        <strong>Ngày đặt hàng:</strong> <span id="orderDate"></span><br>
                    </td>
                </tr>
            </table>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered" id="orderTablePrint">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            <!-- render products here -->
                        </tbody>
                    </table>
                </div>
                <div class="text-end">
                    <p><strong>Tạm tính:</strong> <span id="subtotal"></span></p>
                    <p><strong>Phí vận chuyển:</strong> <span id="shippingFee"></span></p>
                    <p><strong>Giảm giá:</strong> <span id="discount"></span></p>
                    <h5><strong>Tổng tiền:</strong> <span id="totalAmount"></span></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="printOrderDetails()"><i class="bi bi-printer"></i> In</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Order Status Update -->
<div class="modal fade" id="orderStatusModal" tabindex="-1" aria-labelledby="orderStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderStatusModalLabel">Cập nhật trạng thái đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Chọn trạng thái mới:</label>
                </div>
                <div class="btn-group d-flex" role="group" aria-label="Order Status">
                    <button type="button" class="btn btn-outline-warning flex-fill" data-status="processing">
                        <i class="bi bi-hourglass-split"></i>
                        Chờ xử lí
                    </button>
                    <button type="button" class="btn btn-outline-primary flex-fill" data-status="shipping">
                        <i class="bi bi-truck"></i>
                        Đang giao
                    </button>
                    <button type="button" class="btn btn-outline-success flex-fill" data-status="delivered">
                        <i class="bi bi-check-circle"></i>
                        Đã giao
                    </button>
                    <button type="button" class="btn btn-outline-danger flex-fill" data-status="canceled">
                        <i class="bi bi-x-circle"></i>
                        Hủy đơn
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                    Đóng
                </button>
                <button type="button" class="btn btn-primary" onclick="updateOrderStatus()">
                    <i class="bi bi-check-lg"></i>
                    Xác nhận cập nhật
                </button>
            </div>
        </div>
    </div>
</div>


