// Update quantity function
function updateQuantity(button, change) {
    const input = button.parentNode.querySelector('input');
    let value = parseInt(input.value) + change;

    if (value < 1) value = 1;
    input.value = value;

    // Here you would update the subtotal and cart total
    // updateCartTotals();
}

// Remove item function
function removeItem(button) {
    const row = button.closest('tr');
    row.remove();

    // Check if cart is empty
    const rows = document.querySelectorAll('tbody tr');
    if (rows.length === 0) {
        document.getElementById('cart-content').classList.add('d-none');
        document.getElementById('empty-cart').classList.remove('d-none');
    }

    // Here you would update the cart total
    // updateCartTotals();
}

// Input change handler for quantity
document.querySelectorAll('.input-quantity').forEach(input => {
    input.addEventListener('change', function() {
        if (this.value < 1) this.value = 1;

        // Here you would update the subtotal and cart total
        // updateCartTotals();
    });
});