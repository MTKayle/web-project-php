const orders = [{
    orderID: "DH123456",
    items: ["Xe mô hình BMW", "Robot biến hình"],
    total: "850.000₫",
    orderStatusID: "processing"
}, {
    orderID: "DH123457",
    items: ["Xe mô hình Audi", "Đồ chơi lắp ráp"],
    total: "1.200.000₫",
    orderStatusID: "waiting"
}, {
    orderID: "DH123458",
    items: ["Xe mô hình Tesla"],
    total: "1.000.000₫",
    orderStatusID: "delivered"
}, {
    orderID: "DH123459",
    items: ["Máy bay mô hình"],
    total: "600.000₫",
    orderStatusID: "processing"
}, {
    orderID: "DH123460",
    items: ["Robot biến hình", "Xe mô hình BMW"],
    total: "850.000₫",
    orderStatusID: "delivered"
}, {
    orderID: "DH123461",
    items: ["Ô tô điều khiển từ xa"],
    total: "500.000₫",
    orderStatusID: "waiting"
}, {
    orderID: "DH123462",
    items: ["Máy bay điều khiển"],
    total: "750.000₫",
    orderStatusID: "delivered"
}, {
    orderID: "DH123463",
    items: ["Robot biến hình"],
    total: "350.000₫",
    orderStatusID: "processing"
}];

// Hàm thay đổi trạng thái tab khi nhấp
function changeTab(statusID) {
    // Lấy tất cả các tab và loại bỏ class 'active'
    const tabs = document.querySelectorAll('.status-tab');
    tabs.forEach(tab => {
        tab.classList.remove('active');
    });

    // Thêm class 'active' vào tab được nhấp
    const activeTab = document.getElementById(statusID + '-tab');
    activeTab.classList.add('active');

    // Cập nhật danh sách đơn hàng khi thay đổi tab
    // renderOrders(statusID);
}

// Hàm render các đơn hàng
function renderOrders(orders) {
    const orderListContainer = document.getElementById('order-list');
    orderListContainer.innerHTML = ''; // Xóa danh sách cũ

    orders.forEach(order => {
         // Tính tạm tính cho đơn hàng
         const subtotalAmount = order.orderDetails.reduce((total, item) => {
            return total + (item.price * item.quantity);
        }, 0);
        const orderCard = document.createElement('div');
        orderCard.classList.add('order-card', 'card', 'shadow-sm', 'mb-4');
        orderCard.innerHTML = `
            <div class="card-header fw-bold">
                Ngày đặt hàng: ${formatDateVN(order.createAt)}
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    ${order.orderDetails.map(item => `
                        <li class="list-group-item d-flex align-items-center">
                            <img src="${item.productImage}" alt="${item.productName}" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <span>${item.productName}</span>
                                <span class="text-muted d-block">x${item.quantity}</span>
                            </div>
                            <span>${formatCurrency(item.subTotal)}</span>
                        </li>
                    `).join('')}
                </ul>

                <div class="text-end fw-bold mb-2">
                    Tạm tính: ${formatCurrency(subtotalAmount)}
                </div>

                <div class="text-end text-success mb-2">
                    Vận chuyển: 30.000 đ
                </div>

                <div class="text-end text-success mb-2">
                    Giảm giá: ${formatCurrency(order.discount)}
                </div>

                <div class="text-end fw-bold text-danger">
                    Tổng: ${formatCurrency(order.totalAmount)}
                </div>
            </div>
        `;
        orderListContainer.appendChild(orderCard);
    });
}

function formatDateVN(dateString) {
    return new Date(dateString).toLocaleDateString('vi-VN', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    });
}



// Hàm tính số lượng đơn hàng cho mỗi trạng thái
// function calculateOrderCounts() {
//     const counts = {
//         'processing': 0,
//         'waiting': 0,
//         'delivered': 0
//     };

//     orders.forEach(order => {
//         if (order.orderStatusID === 'processing') {
//             counts['processing']++;
//         } else if (order.orderStatusID === 'waiting') {
//             counts['waiting']++;
//         } else if (order.orderStatusID === 'delivered') {
//             counts['delivered']++;
//         }
//     });

//     // Cập nhật số lượng đơn hàng vào các tab
//     document.getElementById('processing-count').innerText = counts['processing'];
//     document.getElementById('waiting-count').innerText = counts['waiting'];
//     document.getElementById('delivered-count').innerText = counts['delivered'];
// }

function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
    }).format(amount);
  }

//hàm này được gọi khi trang được tải
// danh sach don hang dang cho xac nhan
$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.get('page')==='ordertracking'){
        $.ajax({
            url: `${baseUrl}/ajax/order_tracking.php`,
            type: 'GET',
            data: {statusID: '1'},
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    renderOrders(response.orders);
                } else {
                    alert("Không tìm thấy đơn hàng!");
                }
            },
            error: function(response) {
                console.error('Lỗi AJAX:', response);
                alert("Có lỗi xảy ra khi tải đơn hàng!");
            }
        });
    }
});

//ham nay goi khi tab waiting duoc chon
//danh sach don hang dang giao hàng
$(document).ready(function () {
    $(document).on('click', '#waiting-tab', function () {
        changeTab('waiting');
        $.ajax({
            url: `${baseUrl}/ajax/order_tracking.php`,
            type: 'GET',
            data: {statusID: '2'},
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    renderOrders(response.orders);
                } else {
                    alert("Không tìm thấy đơn hàng!");
                }
            },
            error: function(response) {
                console.error('Lỗi AJAX:', response);
                alert("Có lỗi xảy ra khi tải đơn hàng!");
            }
        });
    });
});

// hàm này được gọi khi tab processing được chọn
// danh sach don hang dang cho xac nhan
$(document).ready(function () {
    $(document).on('click', '#processing-tab', function () {
        changeTab('processing');
        $.ajax({
            url: `${baseUrl}/ajax/order_tracking.php`,
            type: 'GET',
            data: {statusID: '1'},
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    renderOrders(response.orders);
                } else {
                    alert("Không tìm thấy đơn hàng!");
                }
            },
            error: function(response) {
                console.error('Lỗi AJAX:', response);
                alert("Có lỗi xảy ra khi tải đơn hàng!");
            }
        });
    });
});


// hàm này được gọi khi tab delivered được chọn
// danh sach don hang da giao
$(document).ready(function () {
    $(document).on('click', '#delivered-tab', function () {
        changeTab('delivered');
        $.ajax({
            url: `${baseUrl}/ajax/order_tracking.php`,
            type: 'GET',
            data: {statusID: '3'},
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    renderOrders(response.orders);
                } else {
                    alert("Không tìm thấy đơn hàng!");
                }
            },
            error: function(response) {
                console.error('Lỗi AJAX:', response);
                alert("Có lỗi xảy ra khi tải đơn hàng!");
            }
        });
    });
});
