$(document).ready(function() {
    // lay thong tin user
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

    //them voucher 
    $('#addVoucherForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn form submit mặc định

        // Lấy dữ liệu từ form
        const code = $('#code').val().trim();
        const discount = $('#discount').val().trim();
        const startDate = $('#startDate').val().trim();
        const endDate = $('#endDate').val().trim();
        const minOrder = $('#minOrder').val().trim();

        // Kiểm tra dữ liệu
        if (code === '') {
            alert('⚠️ Vui lòng nhập mã voucher.');
            $('#code').focus();
            return;
        }

        if (discount === '') {
            alert('⚠️ Vui lòng nhập giá trị giảm giá.');
            $('#discount').focus();
            return;
        }

        if (startDate === '') {
            alert('⚠️ Vui lòng chọn ngày bắt đầu.');
            $('#startDate').focus();
            return;
        }

        if (endDate === '') {
            alert('⚠️ Vui lòng chọn ngày kết thúc.');
            $('#endDate').focus();
            return;
        }

        if (minOrder === '') {
            alert('⚠️ Vui lòng nhập giá trị đơn hàng tối thiểu.');
            $('#minOrder').focus();
            return;
        }

        //kiem tra discount > minOrder
        if (parseFloat(discount) > parseFloat(minOrder)) {
            alert('⚠️ Giá trị giảm giá không được lớn hơn giá trị đơn hàng tối thiểu.');
            $('#discount').focus();
            return;
        }

        // Gửi AJAX nếu hợp lệ
        $.ajax({
            url: `${baseUrl}/ajax/voucher.php`,
            method: 'POST',
            data: {
                code: code,
                discountValue: discount,
                startDate: startDate,
                endDate: endDate,
                minOrderValue: minOrder,
                action: 'add'
            },
            success: function(response) {
                if (response.success) {
                    alert('✅ Thêm voucher thành công!');
                    location.reload(); // Tải lại trang để cập nhật danh sách voucher
                } else {
                    alert('❌ Lỗi khi thêm voucher: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding voucher:', error);
                alert('❌ Đã xảy ra lỗi khi thêm voucher.');
            }
        });
    });

    //lay danh sach voucher khi moi load
    $.ajax({
        url: `${baseUrl}/ajax/voucher.php`,
        type: 'GET',
        dataType: 'json',
        data: {
            page: 1,
        },
        success: function (response) {
            if(response.success){
                const voucherList = response.response.vouchers;
                renderVoucherTable(voucherList);    
                $('#pagination').html(renderPagination(response.response.totalPages, 1));
            }
        },
        error: function (error) {
            console.error('Error fetching vouchers:', error);
        }
    });

    //tim kiem cuc bo
    let searchQuery = '';

    //khi nhan tim kiếm
    $('#btnSearch').on('click', function() {
        searchQuery = $('#searchArticle').val().trim();
        $.ajax({
            url: `${baseUrl}/ajax/voucher.php`,
            type: 'GET',
            data: { search: searchQuery, page: 1 },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const vouchers = response.response.vouchers;
                    if (vouchers.length === 0) {
                        console.log('Không tìm thấy bài viết nào.');
                        $('#voucherTableBody').html(`
                            <td colspan="5" class="text-center mt-4">Không tìm thấy voucher nào.</td>
                        `); 
                        $('#pagination').html('');
                    } else {
                        renderVoucherTable(vouchers);    
                        $('#pagination').html(renderPagination(response.response.totalPages, 1));
                    }
                }
            },
            error: function(error) {
                console.error('Error fetching search results:', error);
            }
        });
    });


    // Xử lý sự kiện phân trang
    // Pagination
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');           
            $.ajax({
                url: `${baseUrl}/ajax/voucher.php`,
                type: 'GET',
                data:{search: searchQuery, page: page},
                dataType: 'json',
                success: function (response) {
                    if(response.success){   
                        const voucherList = response.response.vouchers;
                        renderVoucherTable(voucherList);    
                        $('#pagination').html(renderPagination(response.response.totalPages, page));
                    }
                },
                error: function (error) {
                    console.error('Error fetching overview data:', error);
                }
            })
    });
    

});




//ham render voucher
function renderVoucherTable(voucherList) {
    const tbody = document.getElementById("voucherTableBody");
    tbody.innerHTML = ""; // Xóa bảng cũ

    voucherList.forEach(voucher => {
        const statusText = getStatus(voucher.startDate, voucher.endDate);
        let statusClass = "";

        switch (statusText) {
            case "Đang hoạt động":
                statusClass = "text-success";
                break;
            case "Chưa bắt đầu":
                statusClass = "text-warning";
                break;
            case "Đã kết thúc":
                statusClass = "text-secondary";
                break;
        }

        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${voucher.code}</td>
            <td>${formatCurrency(voucher.minOrderValue)}</td>
            <td>${formatCurrency(voucher.discountValue)}</td>
            <td>${formatDateToVietnamese(voucher.startDate)}</td>
            <td>${formatDateToVietnamese(voucher.endDate)}</td>
            <td><span class="${statusClass} fw-bold">${statusText}</span></td>
            <td class="text-center">
                <i class="fas fa-paper-plane text-primary me-3" style="cursor:pointer;" title="Phát voucher" onclick="openAssignModal('${voucher.code}')"></i>
                <i class="fas fa-trash text-danger" style="cursor:pointer;" title="Xóa voucher" onclick="deleteVoucher('${voucher.code}')"></i>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

//ham lay ngay vn
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


// ham lay trang thai tu startDate va endDate
function getStatus(startDate, endDate) {
    const currentDate = new Date();
    const start = new Date(startDate);
    const end = new Date(endDate);

    if (currentDate < start) {
        return "Chưa bắt đầu";
    } else if (currentDate > end) {
        return "Đã kết thúc";
    } else {
        return "Đang hoạt động";
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

//phat voucher
// Mở modal và truyền voucher ID + tên
function openAssignModal(voucherId) {
    // Gán mã voucher và ID vào form
    document.getElementById("selectedVoucher").value = voucherId;
    document.getElementById("selectedVoucherId").value = voucherId;

    // Gọi API để lấy danh sách khách hàng
    $.ajax({
        url: `${baseUrl}/ajax/account.php`,
        type: 'GET',
        dataType: 'json',
        data: {action: 'getAllCustomer'},
        success: function (response) {
            if (response.success) {
                const customerList = response.customers;
                renderCustomerTable(customerList); // Gọi hàm render danh sách khách hàng
            } else {
                alert('❌ Lỗi khi lấy danh sách khách hàng: ' + response.message);
            }
        },
        error: function (error) {
            console.error('Error fetching customer list:', error);
        }
    });

    


    // Reset checkbox chọn tất cả
    document.getElementById("selectAllCheckbox").checked = false;

    // Hiển thị modal
    const modal = new bootstrap.Modal(document.getElementById("assignVoucherModal"));
    modal.show();

    let searchQuery = '';
    
    // Tìm kiếm khách hàng
    $('#btnSearchCustomer').on('click', function(e) {
        e.preventDefault(); // Ngăn form submit mặc định    
        searchQuery = $('#searchCustomer').val().trim();
        $.ajax({
            url: `${baseUrl}/ajax/account.php`,
            type: 'GET',
            data: { searchName: searchQuery, action: 'getAllCustomer' },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const customers = response.customers;
                    if (customers.length === 0) {
                        console.log('Không tìm thấy khách hàng nào.');
                        $('#customerTableBody').html(`
                            <td colspan="2" class="text-center mt-4">Không tìm thấy khách hàng nào.</td>
                        `); 
                    } else {
                        renderCustomerTable(customers);    
                    }
                }
            },
            error: function(error) {
                console.error('Error fetching search results:', error);
            }
        });
    });
}

// Hàm render danh sách khách hàng
function renderCustomerTable(customers) {
    const tbody = document.getElementById("customerTableBody");
    tbody.innerHTML = "";

    customers.forEach((customer, index) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td class="text-center">
                <input type="checkbox" class="customer-checkbox" value="${customer.customerID}">
            </td>       
            <td>#${customer.customerID}</td>
            <td>${customer.email}</td>  
        `;
        tbody.appendChild(tr);
    });
}

// Checkbox "Chọn tất cả"
document.getElementById("selectAllCheckbox").addEventListener("change", function () {
    const checkboxes = document.querySelectorAll(".customer-checkbox");
    checkboxes.forEach(cb => cb.checked = this.checked);
});

// Xử lý submit form
document.getElementById("assignVoucherForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const voucherId = document.getElementById("selectedVoucherId").value;
    const selectedIDs = Array.from(document.querySelectorAll(".customer-checkbox:checked"))
        .map(cb => cb.value);

    if (selectedIDs.length === 0) {
        alert("Vui lòng chọn ít nhất một khách hàng.");
        return;
    }

    $.ajax({
        url: `${baseUrl}/ajax/voucher.php`,
        type: 'POST',
        dataType: 'json',
        data: {
            code: voucherId,
            listCustomerID: selectedIDs,
            action: 'give'
        },
        success: function (response) {
            if (response.success) {
                alert('✅ Phát voucher thành công!');
                //  Đóng modal sau khi xong
                bootstrap.Modal.getInstance(document.getElementById("assignVoucherModal")).hide();
            } else {
                alert('❌ Lỗi khi phát voucher: ' + response.message);
            }
        },
        error: function (error) {
            console.error('Error assigning voucher:', error);
            alert('❌ Đã xảy ra lỗi khi phát voucher.');
        }
    });


   
});

// Xóa voucher
function deleteVoucher(voucherId) {
    if (confirm(`Bạn có chắc chắn muốn xóa voucher ${voucherId}?`)) {
        $.ajax({
            url: `${baseUrl}/ajax/voucher.php`,
            type: 'POST',
            dataType: 'json',
            data: {
                code: voucherId,
                action: 'delete'
            },
            success: function (response) {
                if (response.success) {
                    alert('✅ Xóa voucher thành công!');
                    location.reload(); // Tải lại trang để cập nhật danh sách voucher
                } else {
                    alert('❌ Lỗi khi xóa voucher: ' + response.message);
                }
            },
            error: function (error) {
                console.error('Error deleting voucher:', error);
                alert('❌ Đã xảy ra lỗi khi xóa voucher.');
            }
        });
    }
}