document.querySelectorAll('.payment-option').forEach(option => {
    option.addEventListener('click', function() {
        // Bỏ chọn tất cả các options
        document.querySelectorAll('.payment-option').forEach(opt => {
            opt.classList.remove('selected');
        });

        // Chọn option hiện tại
        this.classList.add('selected');

        // Chọn radio button bên trong
        const radio = this.querySelector('input[type="radio"]');
        radio.checked = true;
    });
});

function renderCartItems(cartItems) {
    // Nếu giỏ hàng trống, hiển thị thông báo
    if (cartItems.length === 0) {
        document.querySelector('.cart-items').innerHTML = '<p>Giỏ hàng của bạn hiện tại không có sản phẩm nào.</p>';
        return;
    }

    // Xóa nội dung hiện tại trong phần giỏ hàng
    let cartItemsHtml = '';

    // Duyệt qua từng sản phẩm trong giỏ hàng
    cartItems.forEach(item => {
        cartItemsHtml += `
            <div class="d-flex align-items-center py-2 border-bottom order-item" data-product-id="${item.product.productID}">
                <img src="${item.product.image}" alt="${item.product.productName}" class="cart-item-img rounded me-3">
                <div class="flex-grow-1">
                    <h6 class="mb-0">${item.product.productName}</h6>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <span class="text-danger fw-bold product-price">${(item.product.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} đ</span>
                        <span class="badge bg-light text-dark quantity">x${item.quantity}</span>
                    </div>
                </div>
            </div>
        `;
    });
    

    // Đặt nội dung HTML cho phần giỏ hàng
    document.querySelector('#listProduct').innerHTML = cartItemsHtml;
    // Tính tổng tiền
    let totalPrice = 0;
    cartItems.forEach(item => {
        totalPrice += item.product.price * item.quantity;
    });
    let totalAmount = totalPrice + 30000; // Phí vận chuyển cố định là 30.000đ
    const discount = parseInt($('#discountVoucher').text().replace(/[^0-9]/g, '')) || 0; // Lấy giá trị giảm giá từ voucher
    totalAmount -= discount; // Giảm giá từ voucher
    // Hiển thị tổng tiền
    $('#tempAmount').text(totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " đ");
    $('#totalAmountOrder').text(totalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " đ");
}

$(document).ready(function() {
    $('#chooseVoucher').click(function(e) {
        e.preventDefault(); // Ngăn chặn hành động mặc định của nút
        $.ajax({
            url: `${baseUrl}/ajax/account.php`,
            type: 'GET',
            data: { action: 'getVoucher' },
            dataType: 'json',
            success: function(response) {
                if (response.success && response.voucher.length > 0) {
                    const vouchers = [];
                    const currentDate = new Date();
    
                    response.voucher.forEach(voucher => {
                        const startDate = new Date(voucher.startDate);
                        const endDate = new Date(voucher.endDate);
                        const isExpired = currentDate > endDate;
                        const isNotStarted = currentDate < startDate;
    
                        vouchers.push({
                            code: voucher.code,
                            description: "Giảm " + formatCurrency(voucher.discountValue) + " cho đơn từ " + formatCurrency(voucher.minOrderValue),
                            minOrderValue: voucher.minOrderValue,
                            discountValue: voucher.discountValue,
                            startDate: voucher.startDate,
                            endDate: voucher.endDate,
                            isExpired: isExpired,
                            isNotStarted: isNotStarted
                        });
                    });
    
                    // Tạo danh sách voucher
                    let voucherListHtml = `
                    <div class="list-group-item" data-code="" data-bs-dismiss="modal">
                        <span class="voucher-name">Không áp dụng</span>
                        <p class="voucher-desc">Không sử dụng mã giảm giá</p>
                    </div>`;
    
                    // Lấy tổng tiền từ giỏ hàng
                    const totalPrice = parseInt($('#tempAmount').text().replace(/[^0-9]/g, '')) || 0;
    
                    vouchers.forEach(voucher => {
                        const isExpired = voucher.isExpired;
                        const isNotStarted = voucher.isNotStarted;
                        const isNotEligible = totalPrice < voucher.minOrderValue;
                        
                        // Kiểm tra nếu voucher không đủ điều kiện
                        const isDisabled = isExpired || isNotStarted || isNotEligible;
                        const disabledClass = isDisabled ? "disabled text-muted" : "";
                        
                        // Trạng thái voucher
                        let statusText = "";
                        if (isExpired) {
                            statusText = " (Đã hết hạn)";
                        } else if (isNotStarted) {
                            statusText = " (Chưa bắt đầu)";
                        } else if (isNotEligible) {
                            statusText = ` (Đơn tối thiểu ${formatCurrency(voucher.minOrderValue)})`;
                        }
                        
                        voucherListHtml += `
                            <div class="list-group-item ${disabledClass}" 
                                data-code="${voucher.code}" 
                                data-discount="${voucher.discountValue}" 
                                data-min-order="${voucher.minOrderValue}" 
                                data-bs-dismiss="modal" 
                                ${isDisabled ? "disabled" : ""}>
                                <span class="voucher-name">${voucher.code}${statusText}</span>
                                <p class="voucher-desc">${voucher.description}</p>
                                <small class="voucher-date">
                                    Hiệu lực: từ ${new Date(voucher.startDate).toLocaleDateString('vi-VN')} đến ${new Date(voucher.endDate).toLocaleDateString('vi-VN')}
                                </small>
                            </div>
                        `;
                    });
    
                    $("#voucherList").html(voucherListHtml);
                      // Mở modal sau khi tải xong
                      const voucherModal = new bootstrap.Modal(document.getElementById('voucherModal'));
                      voucherModal.show();
    
                } else {
                    // Hiển thị thông báo không có voucher
                    $("#voucherList").html(`
                        <div class="list-group-item text-center text-muted">
                            <p>Không có mã giảm giá nào</p>
                        </div>
                    `);
                    const voucherModal = new bootstrap.Modal(document.getElementById('voucherModal'));
                      voucherModal.show();
                }
            },
            error: function() {
                console.error("Lỗi khi tải voucher từ server");
            }
        });
    
        // Chọn voucher (chỉ cho phép chọn voucher hợp lệ)
        $("#voucherList").on("click", ".list-group-item:not(.disabled)", function() {
            const code = $(this).data("code");
            const discount = $(this).data("discount");
            const minOrderValue = $(this).data("min-order");
            console.log(code, discount, minOrderValue);
    
            // Hiển thị mã giảm giá đã chọn
            $("#voucherCode").val(code);
    
            // Hiển thị số tiền giảm giá
            if (code === "") {
                $("#discountVoucher").text("");
                const tempAmount = parseInt($('#tempAmount').text().replace(/[^0-9]/g, '')) || 0;
                const newTotalAmount = tempAmount + 30000; // Cộng phí vận chuyển
                $('#totalAmountOrder').text(formatCurrency(newTotalAmount));
            } else {
                $("#discountVoucher").text(`${formatCurrency(discount)}`);
                const tempAmount = parseInt($('#tempAmount').text().replace(/[^0-9]/g, '')) || 0;
                const newTotalAmount = tempAmount - discount + 30000; // Cộng phí vận chuyển
                $('#totalAmountOrder').text(formatCurrency(newTotalAmount));
            }
        });
    });
    // Lấy danh sách voucher từ server
    // const urlParams = new URLSearchParams(window.location.search);
    // if(urlParams.get('page')==='pay'){
        
    // }
});


function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
    }).format(amount);
  }











$(document).ready(function() {
    // lay thong tin khach hang
    $.ajax({
        url: `${baseUrl}/ajax/account.php`,
        type: 'GET',
        data: { action: 'getCustomers_Cart' },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const customer = response.customer;
                $('#fullnamepayment').val(customer.customerName);
                $('#phonepayment').val(customer.phoneNumber);
                $('#addresspayment').val(customer.address);
                $('#emailpayment').val(customer.email);

                // Render giỏ hàng
                const cartItems = response.cartItems;
                renderCartItems(cartItems);
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi AJAX:', error);
            alert("Có lỗi xảy ra khi tải thông tin khách hàng!");
        }
    });
});

// Lắng nghe sự kiện khi người dùng nhấn nút "Đặt hàng" và gửi thông tin thanh toán
$(document).ready(function() {
    // Xử lý sự kiện khi người dùng nhấn nút "Đặt hàng"
    $('#createOrder').click(function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của nút
        console.log("Sự kiện đã được kích hoạt!");
        const fullname = $('#fullnamepayment').val();
        const phone = $('#phonepayment').val();
        const address = $('#addresspayment').val();
        const email = $('#emailpayment').val();
        const discountCode = $('#voucherCode').val(); // Mã giảm giá
        const paymentMethod = $('input[name="paymentMethod"]:checked').val();
        const totalAmount = $('#totalAmountOrder').text().replace(/[^0-9]/g, ''); // Lấy tổng tiền và loại bỏ dấu phẩy
        

        if (paymentMethod !== 'cod') {
            alert("Cửa hàng hiện tại chỉ hỗ trợ thanh toán khi nhận hàng (COD).");
            return;
        }

        // Kiểm tra xem tất cả các trường đã được điền chưa
        if (!fullname || !phone || !address || !email || !paymentMethod) {
            alert("Vui lòng điền đầy đủ thông tin!");
            return;
        }

        //check email dung dinh dang
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Email không hợp lệ!");
            return;
        }

        // Lấy chi tiết đơn hàng từ giỏ hàng
        


        // Gửi yêu cầu AJAX để đặt hàng
        $.ajax({
            url: `${baseUrl}/ajax/payment.php`,
            type: 'POST',
            data: {
                fullname: fullname,
                phone: phone,
                address: address,
                email: email,
                paymentMethod: paymentMethod,
                discountCode: discountCode,
                totalAmount: totalAmount,
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert("Đặt hàng thành công!");
                    // Xóa giỏ hàng sau khi đặt hàng thành công
                    $.ajax({
                        url: `${baseUrl}/ajax/cart.php`,
                        type: 'POST',
                        data: { action: 'clearCart' },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                console.log("Giỏ hàng đã được xóa.");
                            } else {
                                console.error("Không thể xóa giỏ hàng.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Lỗi AJAX:', error);
                        }
                    });
                    window.location.href = "./";
                } else {
                    alert("Có lỗi xảy ra khi đặt hàng!");
                }
            },
            error: function(response) {
                console.log('Lỗi AJAX:', response);
                alert("Có lỗi xảy ra khi đặt hàng!");
            }
        });
    });
});
