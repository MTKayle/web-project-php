$(document).ready(function() {
    //lay thong tin user
    $.ajax({
        url: `${baseUrl}/ajax/login.php`,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if(response.success){
                const user = response.user;
                $('#adminName').text(user.name);
            }
        },
        error: function (error) {
            console.error('Error fetching user info:', error);
        }
    });


    // Get all orders
    $.ajax({
        url: `${baseUrl}/ajax/order.php`,
        type: 'GET',
        data:{action: 'getListOrderForStatusAdmin', page: 1, statusID: 1},
        dataType: 'json',
        success: function (response) {
            if(response.success){   
                const orders = response.response;
                const orderTable = renderOrderTable(orders);
                $('#orderTable').html(orderTable);
                // Get total pages for pagination
                $('#pagination').html(renderPagination(orders[0].code));
            }else{
                $('#orderTable').html(`
                            <div class="alert alert-warning text-center mt-4">
                                Không có đơn hàng nào.
                            </div>
                        `);
                $('#pagination').html(''); // Xóa phân trang khi không có đơn hàng
            }
            
        },
        error: function (error) {
            console.error('Error fetching overview data:', error);
        }
    })

    

    // Pagination
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        const status = $('.form-select').find('option:selected').text(); // Lấy text của option đang được chọn
        console.log(status);                
        const statusID = getStatusIDFromSelect(status);
        if(statusID <0){
            $.ajax({
                url: `${baseUrl}/ajax/order.php`,
                type: 'GET',
                data:{action: 'getListOrdersAllStatus', page: page},
                dataType: 'json',
                success: function (response) {
                    if(response.success){   
                        const orders = response.response;
                        const orderTable = renderOrderTable(orders);
                        $('#orderTable').html(orderTable);
                        // Get total pages for pagination
                        $('#pagination').html(renderPagination(orders[0].code, page));
                    }
                },
                error: function (error) {
                    console.error('Error fetching overview data:', error);
                }
            })
        }else{
            $.ajax({
                url: `${baseUrl}/ajax/order.php`,
                type: 'GET',
                data:{action: 'getListOrderForStatusAdmin', page: page, statusID: statusID},
                dataType: 'json',
                success: function (response) {
                    if(response.success){   
                        const orders = response.response;
                        const orderTable = renderOrderTable(orders);
                        $('#orderTable').html(orderTable);
                        $('#pagination').html(renderPagination(orders[0].code, page));
                    } 
                },
                error: function (error) {
                    console.error('Error fetching overview data:', error);
                }
            })
        }
        
    });

    $(document).on('change', '.form-select', function() {
        const status = $(this).find('option:selected').text();
        const statusID = getStatusIDFromSelect(status);
        console.log(statusID)
        if(statusID <0){
            $.ajax({
                url: `${baseUrl}/ajax/order.php`,
                type: 'GET',
                data:{action: 'getListOrdersAllStatus', page: 1},
                dataType: 'json',
                success: function (response) {
                    if(response.success){   
                        const orders = response.response;
                        const orderTable = renderOrderTable(orders);
                        $('#orderTable').html(orderTable);
                        // Get total pages for pagination
                        $('#pagination').html(renderPagination(orders[0].code));
                    }else{
                        $('#orderTable').html(`
                            <div class="alert alert-warning text-center mt-4">
                                Không có đơn hàng nào.
                            </div>
                        `);
                        $('#pagination').html(''); // Xóa phân trang khi không có đơn hàng
                    }
                },
                error: function (error) {
                    console.error('Error fetching overview data:', error);
                }
            })
        } else{
            $.ajax({
                url: `${baseUrl}/ajax/order.php`,
                type: 'GET',
                data:{action: 'getListOrderForStatusAdmin', page: 1, statusID: statusID},
                dataType: 'json',
                success: function (response) {
                    if(response.success){   
                        const orders = response.response;
                        const orderTable = renderOrderTable(orders);
                        $('#orderTable').html(orderTable);
                        // Get total pages for pagination
                        $('#pagination').html(renderPagination(orders[0].code));
                    }  else{
                        $('#orderTable').html(`
                            <div class="alert alert-warning text-center mt-4">
                                Không có đơn hàng nào.
                            </div>
                        `);
                        $('#pagination').html(''); // Xóa phân trang khi không có đơn hàng
                    }
                },
                error: function (error) {
                    console.error('Error fetching overview data:', error);
                }
            })
        }
    });

    $(document).on('click', '#viewOrderDetail', function () {
        const orderID = $(this).data('order-id');
        
        $.ajax({
            url: `${baseUrl}/ajax/order.php`,
            type: 'GET',
            data: { action: 'getOrderDetail', orderID: orderID },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const order = response.response;
                    
                    // Cập nhật thông tin khách hàng
                    $('#orderCode').text(order[0].orderID);
                    $('#customerName').text(order[0].guestName);
                    $('#customerPhone').text(order[0].guestPhoneNumber);
                    $('#customerEmail').text(order[0].guestEmail);
                    $('#customerAddress').text(order[0].shippingAddress);
                    $('#orderDate').text(formatDateToVietnamese(order[0].createAt));    
                    $('#paymentMethod').text(order[0].paymentMethod);
                    
                    // Cập nhật bảng sản phẩm
                    let productRows = '';
                    let totalAmountTemp = 0;
                    order.forEach(product => {
                        totalAmountTemp += product.subTotal;
                        productRows += `
                            <tr>
                                <td>${product.productName}</td>
                                <td>${product.quantity}</td>
                                <td>${formatCurrency(product.unitPrice)}</td>
                                <td>${formatCurrency(product.subTotal)}</td>
                            </tr>
                        `;
                    });
                    $('#productTableBody').html(productRows);
                    
                    // Cập nhật tổng kết hóa đơn
                    $('#subtotal').text(formatCurrency(totalAmountTemp));
                    $('#shippingFee').text("30.000 đ");
                    $('#discount').text(formatCurrency(order[0].discount));
                    $('#totalAmount').text(formatCurrency(order[0].totalAmount));   
                    
                    // Mở modal
                    $('#orderDetailsModal').modal('show');
                } else {        
                    alert('Không tìm thấy chi tiết đơn hàng.');
                }
            },
            error: function (error) {
                console.error('Error fetching order details:', error);
                alert('Đã xảy ra lỗi khi tải chi tiết đơn hàng.');
            }
        });
    });

    // In chi tiết đơn hàng
    $(document).on('click', '#printDetail', function () {
        const orderID = $(this).data('order-id');
        
        $.ajax({
            url: `${baseUrl}/ajax/order.php`,
            type: 'GET',
            data: { action: 'getOrderDetail', orderID: orderID },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const order = response.response;
                    
                    // Cập nhật thông tin khách hàng
                    $('#orderCode').text(order[0].orderID);
                    $('#customerName').text(order[0].guestName);
                    $('#customerPhone').text(order[0].guestPhoneNumber);
                    $('#customerEmail').text(order[0].guestEmail);
                    $('#customerAddress').text(order[0].shippingAddress);
                    $('#orderDate').text(formatDateToVietnamese(order[0].createAt));    
                    $('#paymentMethod').text(order[0].paymentMethod);
                    
                    // Cập nhật bảng sản phẩm
                    let productRows = '';
                    let totalAmountTemp = 0;
                    order.forEach(product => {
                        totalAmountTemp += product.subTotal;
                        productRows += `
                            <tr>
                                <td>${product.productName}</td>
                                <td>${product.quantity}</td>
                                <td>${formatCurrency(product.unitPrice)}</td>
                                <td>${formatCurrency(product.subTotal)}</td>
                            </tr>
                        `;
                    });
                    $('#productTableBody').html(productRows);
                    
                    // Cập nhật tổng kết hóa đơn
                    $('#subtotal').text(formatCurrency(totalAmountTemp));
                    $('#shippingFee').text("30.000 đ");
                    $('#discount').text(formatCurrency(order[0].discount));
                    $('#totalAmount').text(formatCurrency(order[0].totalAmount));   
                    
                    //in chi tiết đơn hàng
                    printOrderDetails();
                } else {        
                    alert('Không tìm thấy chi tiết đơn hàng.');
                }
            },
            error: function (error) {
                console.error('Error fetching order details:', error);
                alert('Đã xảy ra lỗi khi tải chi tiết đơn hàng.');
            }
        });
    });

    // Cập nhật trạng thái đơn hàng
    $(document).on('click', '#updateStatus', function () {
        const orderID = $(this).data('order-id');
        const status = $(this).closest('tr').find('td:nth-child(5)').text().trim();
        
        // Mapping trạng thái hiện tại sang data-status
        const statusMapping = {
            'Chờ xử lí': 'processing',
            'Đang giao hàng': 'shipping',
            'Đã giao hàng': 'delivered',
            'Đã hủy': 'canceled'
        };
        
        // Reset tất cả nút về trạng thái outline
        $('.modal-body .btn-group .btn').each(function() {
            $(this).removeClass('btn-primary btn-warning btn-success btn-danger active');
            $(this).addClass('btn-outline-warning btn-outline-primary btn-outline-success btn-outline-danger'.split(' ')[$(this).index()]);
        });
        
        // Set active cho nút tương ứng với trạng thái hiện tại
        const currentStatusData = statusMapping[status];
        if (currentStatusData) {
            const currentButton = $(`.modal-body .btn[data-status="${currentStatusData}"]`);
            setActiveButton(currentButton);
        }
        
        // Store order ID for later use
        $('#orderStatusModal').data('order-id', orderID);
        
        // Open modal
        $('#orderStatusModal').modal('show');
    });

    // Xử lý khi click vào các nút trạng thái trong modal
    $(document).on('click', '.modal-body .btn-group .btn', function() {
        const clickedButton = $(this);
        setActiveButton(clickedButton);
    });

    

    
    
});

/// Hàm set active button và remove active khỏi các button khác
function setActiveButton(button) {
    // Remove active class từ tất cả buttons và reset về outline style
    $('.modal-body .btn-group .btn').each(function() {
        $(this).removeClass('active');
        const status = $(this).data('status');
        
        // Reset về outline style based on original class
        $(this).removeClass('btn-primary btn-warning btn-success btn-danger');
        switch(status) {
            case 'processing':
                $(this).addClass('btn-outline-warning');
                break;
            case 'shipping':
                $(this).addClass('btn-outline-primary');
                break;
            case 'delivered':
                $(this).addClass('btn-outline-success');
                break;
            case 'canceled':
                $(this).addClass('btn-outline-danger');
                break;
        }
    });
    
    // Set active cho button được chọn
    const status = button.data('status');
    button.addClass('active');
    button.removeClass('btn-outline-primary btn-outline-warning btn-outline-success btn-outline-danger');
    
    // Set solid color cho active button
    switch(status) {
        case 'processing':
            button.addClass('btn-warning');
            break;
        case 'shipping':
            button.addClass('btn-primary');
            break;
        case 'delivered':
            button.addClass('btn-success');
            break;
        case 'canceled':
            button.addClass('btn-danger');
            break;
    }
}

//ham lay statusID tu button
function getStatusIDFromButton(status) {
    // lay text thanh statusID
    let statusID;
    switch (status) {
        case 'processing':
            statusID = 1;   
            break;
        case 'shipping':
            statusID = 2;
            break;
        case 'delivered':
            statusID = 3;
            break;  
        case 'canceled':
            statusID = 4;
            break;
        default:
            statusID = -1; // Default value
    }
    return statusID;
}

// Function cập nhật trạng thái đơn hàng
function updateOrderStatus() {
    const activeButton = document.querySelector('.modal-body .btn.active');
    
    if (!activeButton) {
        alert('Vui lòng chọn trạng thái đơn hàng!');
        return;
    }
    
    const selectedStatus = activeButton.dataset.status;
    statusID = getStatusIDFromButton(selectedStatus);
    const orderID = $('#orderStatusModal').data('order-id');
    
    // Gửi yêu cầu cập nhật trạng thái đơn hàng 
    $.ajax({
        url: `${baseUrl}/ajax/order.php`,
        type: 'POST',
        data: {orderID: orderID, statusID: statusID},
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Cập nhật trạng thái thành công
                console.log('Cập nhật trạng thái thành công:', response);
                // Cập nhật lại danh sách đơn hàng
                window.location.reload();
            } else {
                // Cập nhật trạng thái thất bại
                console.error('Cập nhật trạng thái thất bại:', response);
            }
        },
        error: function (error) {
            console.error('Error updating order status:', error);
        }
    });
    // Đóng modal sau khi cập nhật
    $('#orderStatusModal').modal('hide');
}



// ham lay statusID tu select
function getStatusIDFromSelect(status) {
    // lay text thanh statusID
    let statusID;
    switch (status) {
        case 'Chờ xử lí':
            statusID = 1;
            break;
        case 'Đang giao hàng':
            statusID = 2;
            break;
        case 'Đã giao hàng':
            statusID = 3;
            break;
        case 'Đã hủy':
            statusID = 4;
            break;
        default:
            statusID = -1; // Default value
    }
    return statusID;
}

//ham in chi tiet don hang
function printOrderDetails() {
    const printContent = document.getElementById('orderDetailsPrint').innerHTML;
    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write('<html><head><title>Chi tiết đơn hàng</title>');
    printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">');
    printWindow.document.write(`
        <style>
            @media print {
                /* Style cho tiêu đề */
                .modal-title, #orderDetailsModalLabel {
                    font-size: 24px !important;
                    font-weight: bold !important;
                    text-align: center !important;
                    margin-bottom: 20px !important;
                    text-transform: uppercase !important;
                }
                
                /* Grid layout cho thông tin đơn hàng */
                .row {
                    display: flex !important;
                    flex-wrap: wrap !important;
                    margin-right: -15px !important;
                    margin-left: -15px !important;
                }
                .col-md-6 {
                    flex: 0 0 50% !important;
                    max-width: 50% !important;
                    padding-left: 15px !important;
                    padding-right: 15px !important;
                    box-sizing: border-box !important;
                }
                
                /* Table style */
                .table-responsive {
                    max-height: none !important;
                    overflow: visible !important;
                }
                
                body {
                    font-size: 12px;
                    line-height: 1.4;
                    margin: 20px;
                }
            }
        </style>
    `);
    printWindow.document.write('</head><body>');
    
    // Thêm tiêu đề vào đầu content
    const titleHTML = '<h5 class="modal-title" id="orderDetailsModalLabel">Chi tiết đơn hàng</h5>';
    printWindow.document.write(titleHTML + printContent);
    
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    
    printWindow.onload = function() {
        printWindow.print();
    };
}


//ham render danh sach don hang
function renderOrderTable(orders) {
    return `
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            ${orders.map(order => `
            <tr>
                <td>#${order.orderID}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="${order.discount}" alt="Customer" class="avatar me-2">
                        <div>
                            <h6 class="mb-0">${order.guestName}</h6>
                            <small class="text-muted">${order.guestEmail}</small>
                        </div>
                    </div>
                </td>
                <td>${formatDateToVietnamese(order.createAt)}</td>
                <td>${formatCurrency(order.totalAmount)}</td>
                <td><span class="badge ${getBadgeClass(order.statusID)}">${getStatusText(order.statusID)}</span></td>
                <td>
                    <button class="btn btn-sm btn-light me-2" title="Xem chi tiết" data-order-id="${order.orderID}" id="viewOrderDetail"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-light me-2" title="In" data-order-id="${order.orderID}" id="printDetail"><i class="bi bi-printer"></i></button>
                    <button class="btn btn-sm btn-light" title="Cập nhật trạng thái" data-order-id="${order.orderID}" id="updateStatus"><i class="bi bi-arrow-repeat"></i></button>
                
                </td>
            </tr>
            `).join('')}
        </tbody>
    </table>
    `;
}

//ham dinh dang ngay thang
function formatDateToVietnamese(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('vi-VN', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
    }).replace(',', '');
}

//ham dinh dang tien te
function formatCurrency(value) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(value);
}

//ham lay class cho trang thai
function getBadgeClass(status) {
    switch (status) {
        case 1:
            return 'bg-warning'; // Pending
        case 2:
            return 'bg-primary'; // Processing
        case 3:
            return 'bg-success';  // Completed    
        case 4:
            return 'bg-danger'; //  Failed
        default:
            return 'bg-secondary'; // Unknown status
    }
}

//ham lay trang thai
function getStatusText(status) {
    switch (status) {
        case 1:
            return 'Chờ xử lí';
        case 2:
            return 'Đang giao hàng';
        case 3:
            return 'Đã giao hàng';
        case 4:
            return 'Đã hủy';
        default:
            return 'Không xác định';
    }
}

//ham phan trang
function renderPagination(totalPages, currentPage = 1, maxVisiblePages = 7) {
    let html = '';

    // Nút "Trang đầu"
    if (currentPage > 1) {
        html += `<li class="page-item">
                    <a class="page-link" href="#" data-page="1">&laquo;</a>
                 </li>`;
    }

    // Tính toán phạm vi trang hiển thị
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    // Điều chỉnh nếu ở gần đầu hoặc cuối
    if (endPage - startPage + 1 < maxVisiblePages) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    // Nút "..." trước
    if (startPage > 1) {
        html += `<li class="page-item">
                    <a class="page-link disabled" href="#">...</a>
                 </li>`;
    }

    // Nút trang trong phạm vi
    for (let i = startPage; i <= endPage; i++) {
        html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                 </li>`;
    }

    // Nút "..." sau
    if (endPage < totalPages) {
        html += `<li class="page-item">
                    <a class="page-link disabled" href="#">...</a>
                 </li>`;
    }

    // Nút "Trang cuối"
    if (currentPage < totalPages) {
        html += `<li class="page-item">
                    <a class="page-link" href="#" data-page="${totalPages}">&raquo;</a>
                 </li>`;
    }

    return html;
}


