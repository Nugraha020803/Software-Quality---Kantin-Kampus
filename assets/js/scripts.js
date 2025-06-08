// JavaScript untuk efek scroll dan animasi
document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll('.welcome-section');

    window.addEventListener('scroll', function() {
        sections.forEach((section) => {
            const sectionTop = section.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (sectionTop < windowHeight - 100) {
                section.style.opacity = 1;
                section.style.transform = 'translateY(0)';
            }
        });
    });
});
