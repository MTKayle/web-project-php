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