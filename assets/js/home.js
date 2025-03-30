document.addEventListener('DOMContentLoaded', function() {
    // Initialize all carousels with Bootstrap
    const carousels = document.querySelectorAll('.carousel');
    carousels.forEach(carouselEl => {
        const carousel = new bootstrap.Carousel(carouselEl, {
            interval: 5000,
            pause: 'hover'
        });
    });
});