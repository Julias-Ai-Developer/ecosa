// Scripts extracted from original index.html

// Mobile Toggle
const mobileToggle = document.getElementById('mobile-toggle');
const navbar = document.querySelector('.navbar');

if (mobileToggle) {
    mobileToggle.addEventListener('click', () => {
        navbar.classList.toggle('mobile-active');
        const icon = mobileToggle.querySelector('i');
        if (navbar.classList.contains('mobile-active')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
}

// Mobile Dropdowns
const navItems = document.querySelectorAll('.nav-item');
navItems.forEach(item => {
    const link = item.querySelector('.nav-link');
    if (item.querySelector('.dropdown-menu')) {
        link.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                item.classList.toggle('active');
            }
        });
    }
});

// Sticky Navbar on Scroll
window.addEventListener('scroll', () => {
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.style.padding = '10px 0';
        } else {
            navbar.style.padding = '15px 0';
        }
    }
});

// Hero Animation
function initHeroSlider() {
    const slides = document.querySelectorAll('.hero-slide');
    const nextBtn = document.getElementById('next-slide');
    const prevBtn = document.getElementById('prev-slide');
    
    if (slides.length > 0) {
        let currentSlide = 0;
        let slideInterval;

        function showSlide(index) {
            slides[currentSlide].classList.remove('active');
            currentSlide = (index + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        function startAutoSlide() {
            clearInterval(slideInterval);
            slideInterval = setInterval(() => {
                showSlide(currentSlide + 1);
            }, 8000);
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                showSlide(currentSlide + 1);
                startAutoSlide();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                showSlide(currentSlide - 1);
                startAutoSlide();
            });
        }

        // Start initial auto slide
        startAutoSlide();
    }
}

// Reveal on Scroll
function reveal() {
    var reveals = document.querySelectorAll(".reveal");
    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;
        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("active");
        }
    }
    
    // Hero Animation
    const hero = document.querySelector('.hero');
    if (hero && !hero.classList.contains('active')) {
        setTimeout(() => {
            hero.classList.add('active');
            initHeroSlider();
        }, 100);
    }
}

window.addEventListener("scroll", reveal);
// Trigger once on load
reveal();

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const targetId = this.getAttribute('href');
        if (targetId === '#' || targetId.includes('.php')) return;

        // Handle internal anchors on same page
        if (targetId.startsWith('#')) {
            e.preventDefault();
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                // Close mobile menu if open
                if (navbar) navbar.classList.remove('mobile-active');
                if (mobileToggle) {
                    const icon = mobileToggle.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }

                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        }
    });
});

// Form Submission (Demo)
const contactForm = document.getElementById('main-contact-form');
if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();
        alert('Thank you for your inquiry. ECOSA will contact you soon!');
        this.reset();
    });
}
