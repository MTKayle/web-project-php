// Thêm hiệu ứng loading cho hình ảnh
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.product-image');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '0';
            this.style.transform = 'scale(0.8)';
            setTimeout(() => {
                this.style.transition = 'all 0.5s ease';
                this.style.opacity = '1';
                this.style.transform = 'scale(1)';
            }, 100);
        });
    });

    // Hiệu ứng hover cho các phần tử
    const detailItems = document.querySelectorAll('.detail-item');
    detailItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Animation cho summary values
    const summaryValues = document.querySelectorAll('.summary-value');
    summaryValues.forEach(value => {
        value.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.2s ease';
        });
        
        value.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});