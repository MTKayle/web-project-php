
// Khai báo biến để lưu trữ biểu đồ
let lineChartInstance = null;

function renderLineChart(canvasId, labels, values, chartTitle, color, text) {
    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext('2d', { willReadFrequently: true }); // Tối ưu context

    // Tăng độ phân giải cho canvas
    const dpr = window.devicePixelRatio || 1;
    const width = canvas.offsetWidth; // Sử dụng offsetWidth để lấy kích thước chính xác
    const height = canvas.offsetHeight;

    // Đặt kích thước canvas
    canvas.width = width * dpr;
    canvas.height = height * dpr;
    canvas.style.width = `${width}px`;
    canvas.style.height = `${height}px`;

    // Không gọi ctx.scale(dpr, dpr), để Chart.js xử lý DPR

    // Tạo biểu đồ
    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu',
                data: values,
                backgroundColor: color,
                borderColor: color,
                borderWidth: 2, // Tăng độ dày đường để nét hơn
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointStyle: 'circle', // Điểm dạng tròn, sắc nét
                pointBackgroundColor: color,
                pointBorderColor: '#fff', // Viền trắng cho điểm nổi bật
                pointBorderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            devicePixelRatio: dpr, // Để Chart.js tự xử lý DPR
            plugins: {
                tooltip: {
                    enabled: true,
                    mode: 'index', // Hiển thị tooltip theo trục x
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)', // Nền tooltip đậm hơn
                    titleFont: { family: 'Arial', size: 14 },
                    bodyFont: { family: 'Arial', size: 12 },
                    callbacks: {
                        label: function(context) {
                            return formatCurrency(context.raw);
                        }
                    }
                },
                title: {
                    display: true,
                    text: `${chartTitle} ${text}`,
                    font: {
                        family: 'Arial',
                        size: 18, // Tăng kích thước chữ
                        weight: 'bold'
                    },
                    color: '#333' // Màu chữ đậm
                }
            },
            scales: {
                x: {
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: 16,
                        font: { family: 'Arial', size: 12 },
                        color: '#333'
                    },
                    grid: {
                        display: false // Tắt lưới trục x để biểu đồ gọn hơn
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { family: 'Arial', size: 12 },
                        color: '#333',
                        callback: function(value) {
                            return formatCurrency(value);
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)' // Lưới nhạt để không lấn át đường
                    }
                }
            },
            elements: {
                line: {
                    borderCapStyle: 'round', // Đầu đường bo tròn, sắc nét
                    borderJoinStyle: 'round'
                },
                point: {
                    radius:  'round' // Đảm bảo điểm tròn
                }
            }
        }
    });
}




function getCurrentMonth() {
    return new Date().getMonth() + 1; // Trả về tháng từ 1 đến 12
}


$(document).ready(function () {
    $.ajax({
        url: `${baseUrl}/ajax/dashboard.php`,
        type: 'GET',
        data:{action: 'getChartData', type: 'month'},
        dataType: 'json',
        success: function (response) {
            if(response.success){
                const ctx = document.getElementById("revenueChart");
                ctx.removeAttribute("width");
                ctx.removeAttribute("height");
                // Xóa biểu đồ cũ nếu đã tồn tại
                if (lineChartInstance !== null) {
                    lineChartInstance.destroy();
                }

                // Tạo biểu đồ mới
                lineChartInstance = renderLineChart(
                    'revenueChart', 
                    response.response.labels, 
                    response.response.values, 
                    response.response.chartTitle, 
                    '#007bff',
                    `${getCurrentMonth()} năm ${new Date().getFullYear()}` // Thêm thông tin tháng và năm
                );
            }
        },
        error: function (error) {
            console.error('Error fetching chart data:', error);
        }
    });
});



function formatCurrency(value) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(value);
}

$(document).ready(function () {
    $(document).on('click', '#thisWeek', function () {
        // activate the button
        $(this).addClass('active').siblings().removeClass('active');
        // remove active class from all other buttons
        $('#thisMonth').removeClass('active');
        $('#thisYear').removeClass('active');
        $.ajax({
            url: `${baseUrl}/ajax/dashboard.php`,
            type: 'GET',
            data:{action: 'getChartData', type: 'week'},
            dataType: 'json',
            success: function (response) {
                if(response.success){
                    const ctx = document.getElementById("revenueChart");
                    ctx.removeAttribute("width");
                    ctx.removeAttribute("height");
                    // Xóa biểu đồ cũ nếu đã tồn tại
                    if (lineChartInstance !== null) {
                        lineChartInstance.destroy();
                    }

                    // Tạo biểu đồ mới
                    lineChartInstance = renderLineChart(
                        'revenueChart', 
                        response.response.labels, 
                        response.response.values, 
                        response.response.chartTitle, 
                        '#007bff',
                        'này'
                    );
                }
            },
            error: function (error) {
                console.error('Error fetching chart data:', error);
            }
        });
    });
});

$(document).ready(function () {
    $(document).on('click', '#thisMonth', function () {
        // activate the button
        $(this).addClass('active').siblings().removeClass('active');
        // remove active class from all other buttons
        $('#thisWeek').removeClass('active');
        $('#thisYear').removeClass('active');
        $.ajax({
            url: `${baseUrl}/ajax/dashboard.php`,
            type: 'GET',
            data:{action: 'getChartData', type: 'month'},
            dataType: 'json',
            success: function (response) {
                if(response.success){
                    const ctx = document.getElementById("revenueChart");
                    ctx.removeAttribute("width");
                    ctx.removeAttribute("height");
                    // Xóa biểu đồ cũ nếu đã tồn tại
                    if (lineChartInstance !== null) {
                        lineChartInstance.destroy();
                    }

                    // Tạo biểu đồ mới
                    lineChartInstance = renderLineChart(
                        'revenueChart', 
                        response.response.labels, 
                        response.response.values, 
                        response.response.chartTitle, 
                        '#007bff',
                        `${getCurrentMonth()} năm ${new Date().getFullYear()}` // Thêm thông tin tháng và năm
                    );
                }
            },
            error: function (error) {
                console.error('Error fetching chart data:', error);
            }
        });
    });
});

$(document).ready(function () {
    $(document).on('click', '#thisYear', function () {
        // activate the button
        $(this).addClass('active').siblings().removeClass('active');
        // remove active class from all other buttons
        $('#thisWeek').removeClass('active');
        $('#thisMonth').removeClass('active');
        $.ajax({
            url: `${baseUrl}/ajax/dashboard.php`,
            type: 'GET',
            data:{action: 'getChartData', type: 'year'},
            dataType: 'json',
            success: function (response) {
                if(response.success){
                    const ctx = document.getElementById("revenueChart");
                    ctx.removeAttribute("width");
                    ctx.removeAttribute("height");
                    // Xóa biểu đồ cũ nếu đã tồn tại
                    if (lineChartInstance !== null) {
                        lineChartInstance.destroy();
                    }

                    // Tạo biểu đồ mới
                    lineChartInstance = renderLineChart(
                        'revenueChart', 
                        response.response.labels, 
                        response.response.values, 
                        response.response.chartTitle, 
                        '#007bff',
                        `${new Date().getFullYear()}` // Thêm thông tin tháng và năm
                    );
                }
            },
            error: function (error) {
                console.error('Error fetching chart data:', error);
            }
        });
    });
});


$(document).ready(function () {
    //lay thong tin user admin
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
});

//lay thong tin tong quan
$(document).ready(function () {
    $.ajax({
        url: `${baseUrl}/ajax/dashboard.php`,
        type: 'GET',
        data:{action: 'getDashboardData'},
        dataType: 'json',
        success: function (response) {
            if(response.success){
                const overview = response.response;
                $('#totalRevenue').text(formatCurrency(overview.totalRevenue));
                $('#totalOrder').text(overview.totalOrders);
                $('#totalProduct').text(overview.totalProducts);
                $('#totalInvestment').text(overview.totalInevestment);
                $('#growRevenue').text(overview.totalRevenueMonthBefore +'% so với tháng trước');
                $('#growOrder').text(overview.totalOrdersMonthBefore +'% so với tháng trước');
                $('#growProduct').text(overview.totalProductMonthBefore +'% so với tháng trước');
                $('#growInvestment').text(overview.totalInevestmentMonthBefore +'% so với tháng trước');    
            }
        },
        error: function (error) {
            console.error('Error fetching overview data:', error);
        }
    });

    //lay top 5 san pham ban chay
    $.ajax({
        url: `${baseUrl}/ajax/dashboard.php`,
        type: 'GET',
        data:{action: 'getTop5Product'},
        dataType: 'json',
        success: function (response) {
            if(response.success){   
                const products = response.response  ;
                const productList = $('#top5Product-list');
                productList.empty(); // Clear existing items

                products.forEach(product => {
                    const productItem = renderProductItem(product);
                    productList.append(productItem);
                });
            }
        },
        error: function (error) {
            console.error('Error fetching overview data:', error);
        }
    })

    //lay 6 order dang cho xu li
    $.ajax({
        url: `${baseUrl}/ajax/dashboard.php`,
        type: 'GET',
        data:{action: 'getListOrderPending', statusID: 1},
        dataType: 'json',
        success: function (response) {
            if(response.success){   
                const orders = response.response  ;
                const orderList = $('#orderPending-list');
                orderList.empty(); // Clear existing items

                $('#orderPending-list').html(renderOrderTable(orders));
            }
            $('#orderProcessing').text("Đơn hàng chờ xử lí ("+ response.response[0].discount +")");
        },
        error: function (error) {
            console.error('Error fetching overview data:', error);
        }
    })
});

function renderProductItem(product) {
    return `
        <div class="list-group-item">
            <div class="d-flex align-items-center gap-3">
                <img src="${product.image}" class="product-img" alt="${product.productName}">
                <div class="flex-grow-1">
                    <h6 class="mb-0">${product.productName}</h6>
                    <div class="text-muted small">${formatCurrency(product.price)}</div>
                </div>
                <div class="text-end">
                    <div>${product.quantitySold} sold</div>
                    <div class="${product.stockQuantity > 0 ? 'text-success' : 'text-danger'} small">${product.stockQuantity} còn lại</div>
                </div>
            </div>
        </div>
    `;
}

function renderOrderTable(orders) {
    return `
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                ${orders.map(order => `
                    <tr>
                        <td>#${order.orderID}</td>
                        <td>${order.guestName}</td>
                        <td>${formatDateToVietnamese(order.createAt)}</td>
                        <td>${formatCurrency(order.totalAmount)}</td>
                        <td><span class="badge bg-warning">Chờ xử lí</span></td>
                    </tr>
                `).join('')}
            </tbody>
        </table>
    `;
}


// function getStatusBadgeClass(status) {
//     switch (status) {
//         case 'Completed': return 'bg-success';
//         case 'Processing': return 'bg-primary';
//         case 'Failed': return 'bg-danger';
//         default: return 'bg-warning';
//     }
// }

function formatDateToVietnamese(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('vi-VN', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
    }).replace(',', '');
}



