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
            <div class="d-flex align-items-center py-2 border-bottom">
                <img src="${item.product.image}" alt="${item.product.productName}" class="cart-item-img rounded me-3">
                <div class="flex-grow-1">
                    <h6 class="mb-0">${item.product.productName}</h6>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <span class="text-danger fw-bold">${(item.product.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} đ</span>
                        <span class="badge bg-light text-dark">x${item.quantity}</span>
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
    // Hiển thị tổng tiền
    $('#tempAmount').text(totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " đ");
    $('#totalAmountOrder').text(totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " đ");
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