
// // Remove item function
// function removeItem(button) {
//     const row = button.closest('tr');
//     row.remove();

//     // Check if cart is empty
//     const rows = document.querySelectorAll('tbody tr');
//     if (rows.length === 0) {
//         document.getElementById('cart-content').classList.add('d-none');
//         document.getElementById('empty-cart').classList.remove('d-none');
//     }

//     // Here you would update the cart total
//     // updateCartTotals();
// }

// Input change handler for quantity
// document.querySelectorAll('.input-quantity').forEach(input => {
//     input.addEventListener('change', function() {
//         if (this.value < 1) this.value = 1;

//         // Here you would update the subtotal and cart total
//         // updateCartTotals();
//     });
// });
// Update quantity function
// function updateQuantity(button, change) {
//     const input = button.parentNode.querySelector('input');
//     let value = parseInt(input.value) + change;

//     if (value < 1) value = 1;
//     input.value = value;

//     // Here you would update the subtotal and cart total
//     // updateCartTotals();
// }

// Remove item function
// function removeItem(button) {
//     const row = button.closest('tr');
//     row.remove();

//     // Check if cart is empty
//     const rows = document.querySelectorAll('tbody tr');
//     if (rows.length === 0) {
//         document.getElementById('cart-content').classList.add('d-none');
//         document.getElementById('empty-cart').classList.remove('d-none');
//     }

//     // Here you would update the cart total
//     // updateCartTotals();
// }

// Input change handler for quantity
// document.querySelectorAll('.input-quantity').forEach(input => {
//     input.addEventListener('change', function() {
//         if (this.value < 1) this.value = 1;

//         // Here you would update the subtotal and cart total
//         // updateCartTotals();
//     });
// });



$(document).ready(function () {
    $(document).on('click', '.btn-add-to-cart', function(e) {
        e.preventDefault();
    
        const productID = $(this).data('productid');
    
        $.ajax({
            url: `${baseUrl}/ajax/cart.php`,
            method: "POST",
            data: {
                action: "add",
                productID: productID
            },
            success: function (res) {
                if (res.error) {
                    toastr.error(res.message);
                    return;
                }
                console.log("✅ Thêm vào giỏ (DB):", res);
                toastr.success("Đã thêm vào giỏ hàng!");
            },
            error: function () {
                toastr.error("Lỗi khi thêm vào giỏ hàng!");
            }
        });
    });
});


function renderCartItem(product) {
    return `
        <tr data-product-id="${product.productID}">
            <td class="py-3 ps-4 align-middle">
                <div class="d-flex align-items-center">
                    <div class="cart-item-img-container me-3">
                        <img src="${product.image}" alt="${product.productName}" class="cart-item-img rounded" style="width: 60px; height: 60px; object-fit: cover;">
                    </div>
                    <h6 class="mb-0">${product.productName}</h6>
                </div>
            </td>
            <td class="py-3 text-center align-middle">
                <span class="fw-bold unit-price" data-price="${product.price}">${formatCurrency(+product.price)}</span>
            </td>
            <td class="py-3 text-center align-middle">
                <div class="d-flex justify-content-center align-items-center">
                    <input type="number" class="form-control quantity-input text-center" value="${product.quantity}" min="1" max="99" style="width: 60px;">
                    <div class="d-flex flex-column me-1 ms-2">
                        <button onclick="changeQuantity(this, 1)"
                            class="btn p-0"
                            style="width: 45px !important; height: 15px !important; padding: 0 !important; min-width: 0 !important; font-size: 10px !important; display: flex; align-items: center; justify-content: center;">
                            ▲
                        </button>
                        <button onclick="changeQuantity(this, -1)"
                            class="btn p-0 mt-1"
                            style="width: 45px !important; height: 15px !important; padding: 0 !important; min-width: 0 !important; font-size: 10px !important; display: flex; align-items: center; justify-content: center;">
                            ▼
                        </button>
                    </div>

                </div>
            </td>
            <td class="py-3 text-center align-middle">
                <span class="fw-bold line-total">${formatCurrency(product.price * product.quantity)}</span>
            </td>
            <td class="py-3 text-center align-middle">
                <button class="btn btn-sm btn-outline-danger" onclick="removeItem(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    `;
}





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
    if(urlParams.get('page')==='cart'){
        $.ajax({
            url: `${baseUrl}/ajax/cart.php`,
            type: 'GET',
            // data: { userID: userID },
            //type of data we are expecting in return
            dataType: 'json',
            //if success
            success: function(response) {
                if(response.success){
                    $('#cart-body').html('');
                    response.cartItems.forEach(item=>{
                        const product = {
                            ...item.product,
                            quantity: parseInt(item.quantity) // thêm quantity từ cartItem vào
                        };

                        const html = renderCartItem(product);
                        $('#cart-body').append(html);
                        checkIfCartIsEmpty();
                        updateCartTotals();
                    })
                } else{
                    checkIfCartIsEmpty();
                }
            },
        })
    }
});


async function changeQuantity(button, delta) {
    const row = button.closest("tr");
    const input = row.querySelector(".quantity-input");

    let quantity = parseInt(input.value);
    quantity += delta;

    if (quantity < 1) quantity = 1;
    if (quantity > 99) quantity = 99;

    input.value = quantity;

    // Cập nhật lại dòng tiền
    const price = parseFloat(row.querySelector(".unit-price").dataset.price);
    const lineTotal = price * quantity;
    row.querySelector(".line-total").innerText = formatCurrency(lineTotal);

    // Gọi API cập nhật server (tuỳ vào backend của bạn, ví dụ dùng fetch)
    const productId = row.dataset.productId;
    const isUpdated =  await updateCartItemOnServer(productId, quantity); // doi ket qua promise tu updateCartItemOnServer

    // Cập nhật tổng tiền giỏ hàng
    if (isUpdated) {
        updateCartTotals();
    }
}

function updateCartTotals() {
    let subtotal = 0;
    document.querySelectorAll("tr[data-product-id]").forEach(row => {
        const price = parseFloat(row.querySelector(".unit-price").dataset.price);
        const qty = parseInt(row.querySelector(".quantity-input").value);
        subtotal += price * qty;
    });

    const shipping = 30000;
    const total = subtotal + shipping;

    document.querySelector(".cart-subtotal").innerText = formatCurrency(subtotal);
    document.querySelector(".cart-shipping").innerText = formatCurrency(shipping);
    document.querySelector(".cart-total").innerText = formatCurrency(total);
}

function removeItem(button) {
    const row = $(button).closest("tr");
    const productID = row.data("product-id");

    $.ajax({
        url: `${baseUrl}/ajax/cart.php`,
        type: 'POST',
        data: {
            action: 'remove',
            productID: productID
        },
        success: function(response) {
            if (response.success) {
                row.remove();
                checkIfCartIsEmpty();
                updateCartTotals();
                console.log("✅ Xóa sản phẩm khỏi giỏ hàng thành công:", response.message);
            } else {
                console.error("❌ Xóa sản phẩm khỏi giỏ hàng thất bại:", response.message);
            }
        },
        error: function() {
            console.error("❌ Lỗi xóa sản phẩm khỏi giỏ hàng trên server");
        }
    })
}


function checkIfCartIsEmpty() {
    const cartItems = document.querySelectorAll('tr[data-product-id]');
    if (cartItems.length === 0) {
        // Giỏ hàng trống, bạn có thể hiển thị thông báo hoặc redirect
        document.getElementById('cart-content').classList.add('d-none');
        document.getElementById('title-cart').classList.add('d-none');
        document.getElementById('empty-cart').classList.remove('d-none');
    }
}

function updateCartItemOnServer(productId, quantity) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${baseUrl}/ajax/cart.php`,
            type: 'POST',
            data: {
                action: 'update',
                productID: productId,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    console.log("✅ Cập nhật giỏ hàng thành công:", response);
                    resolve(true);  // Cập nhật thành công
                } else {
                    console.error("❌ Cập nhật giỏ hàng thất bại:", response.message);
                    resolve(false);  // Cập nhật thất bại
                }
            },
            error: function() {
                console.error("❌ Lỗi cập nhật giỏ hàng trên server");
                reject(false);  // Lỗi khi gọi API
            }
        });
    });
}



  



