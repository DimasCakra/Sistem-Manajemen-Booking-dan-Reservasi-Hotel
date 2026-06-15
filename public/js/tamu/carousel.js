document.addEventListener('DOMContentLoaded', () => {
    const slider = document.getElementById('autoCarouselSlider');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dots = document.querySelectorAll('.carousel-dot');

    if (!slider) return;

    const totalSlides = parseInt(slider.getAttribute('data-total')) || 0;
    let currentIndex = 0;
    let slideInterval;

    function updateCarousel() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;

        dots.forEach((dot, index) => {
            dot.classList.remove('bg-white', 'w-6', 'bg-white/50');
            if (index === currentIndex) {
                dot.classList.add('bg-white', 'w-6');
            } else {
                dot.classList.add('bg-white/50');
            }
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateCarousel();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateCarousel();
    }

    function startAutoplay() {
        slideInterval = setInterval(nextSlide, 3000);
    }

    function resetAutoplay() {
        clearInterval(slideInterval);
        startAutoplay();
    }

    nextBtn?.addEventListener('click', () => {
        nextSlide();
        resetAutoplay();
    });

    prevBtn?.addEventListener('click', () => {
        prevSlide();
        resetAutoplay();
    });

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            currentIndex = parseInt(dot.getAttribute('data-index'));
            updateCarousel();
            resetAutoplay();
        });
    });

    // Inisialisasi awal saat halaman selesai dimuat
    if (totalSlides > 0) {
        updateCarousel();
        startAutoplay();
    }
});
