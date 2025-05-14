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
    renderOrders(statusID);
}

// Hàm render các đơn hàng
function renderOrders(orders) {
    const orderListContainer = document.getElementById('order-list');
    orderListContainer.innerHTML = ''; // Xóa danh sách cũ

    // // Lọc các đơn hàng theo trạng thái
    // const filteredOrders = orders.filter(order => order.orderStatusID === orderStatusID);

    // Cập nhật các đơn hàng vào phần tử HTML
    orders.forEach(order => {
                const orderCard = document.createElement('div');
                orderCard.classList.add('order-card', 'card', 'shadow-sm', 'mb-4');
                orderCard.innerHTML = `
            <div class="card-header fw-bold">
                Mã đơn: ${order.orderID}
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    ${order.orderDetails.map(item => `<li class="list-group-item d-flex justify-content-between"><span>${item.productName}</span><span>${formatCurrency(item.price)}</span></li>`).join('')}
                </ul>
                <div class="text-end fw-bold">
                    Tổng: ${formatCurrency(order.totalAmount)}
                </div>
            </div>
        `;
        orderListContainer.appendChild(orderCard);
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


$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.get('page')==='ordertracking'){
        $.ajax({
            url: `${baseUrl}/ajax/order_tracking.php`,
            type: 'GET',
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