// Authentication System
function checkAuthStatus() {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const currentPage = window.location.pathname.split('/').pop();

    if (currentPage === 'index.html' || currentPage === '') {
        // If on home page and not logged in, redirect to login
        if (!isLoggedIn) {
            window.location.href = 'login.html';
        }
    } else if (currentPage === 'login.html' || currentPage === 'register.html') {
        // If on login/register page and already logged in, redirect to home
        if (isLoggedIn) {
            window.location.href = 'index.html';
        }
    }
}

function loginUser(email, password) {
    // Clear previous error messages
    clearErrorMessages();

    // Get stored user data
    const userData = localStorage.getItem('userData');
    if (!userData) {
        showErrorMessage('loginForm', 'No registered user found. Please register first.');
        return false;
    }

    const user = JSON.parse(userData);

    // Check if email matches registered email
    if (email !== user.email) {
        showErrorMessage('loginForm', 'Invalid email or password.');
        return false;
    }

    // Check if password matches registered password
    if (password !== user.password) {
        showErrorMessage('loginForm', 'Invalid email or password.');
        return false;
    }

    // Login successful
    localStorage.setItem('isLoggedIn', 'true');
    localStorage.setItem('userEmail', email);
    localStorage.setItem('loginTime', new Date().toISOString());

    // Redirect to home page
    window.location.href = 'index.html';
    return true;
}

function registerUser(fullName, email, password, confirmPassword) {
    // Clear previous error messages
    clearErrorMessages();

    // Basic validation
    if (!fullName || !email || !password || !confirmPassword) {
        showErrorMessage('registerForm', 'Please fill in all fields.');
        return false;
    }

    if (password !== confirmPassword) {
        showErrorMessage('registerForm', 'Passwords do not match.');
        return false;
    }

    if (password.length < 6) {
        showErrorMessage('registerForm', 'Password must be at least 6 characters long.');
        return false;
    }

    // Store user data in localStorage (demo only)
    const userData = {
        fullName: fullName,
        email: email,
        password: password, // In real app, never store plain password
        registeredAt: new Date().toISOString()
    };

    localStorage.setItem('userData', JSON.stringify(userData));

    // Redirect to login page (do not auto-login after registration)
    window.location.href = 'login.html';
    return true;
}

function logoutUser() {
    localStorage.removeItem('isLoggedIn');
    localStorage.removeItem('userEmail');
    localStorage.removeItem('loginTime');
    window.location.href = 'login.html';
}

function showErrorMessage(formId, message) {
    // Remove existing error message
    const existingError = document.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Create and show new error message
    const form = document.getElementById(formId);
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    errorDiv.style.cssText = `
        color: #ff6b6b;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        text-align: center;
        padding: 0.5rem;
        background: rgba(255, 107, 107, 0.1);
        border-radius: 8px;
        border: 1px solid rgba(255, 107, 107, 0.2);
    `;

    form.insertBefore(errorDiv, form.firstChild);
}

function clearErrorMessages() {
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(msg => msg.remove());
}

document.addEventListener('DOMContentLoaded', function() {
    // Check authentication status on page load
    checkAuthStatus();

    // Login form handling
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            loginUser(email, password);
        });
    }

    // Register form handling
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            registerUser(fullName, email, password, confirmPassword);
        });
    }

    // Add logout functionality to navbar (if user is logged in)
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    if (isLoggedIn) {
        const navbar = document.querySelector('.navbar');
        if (navbar) {
            const logoutBtn = document.createElement('li');
            logoutBtn.innerHTML = '<a href="#" id="logoutBtn">Logout</a>';
            navbar.querySelector('ul').appendChild(logoutBtn);

            document.getElementById('logoutBtn').addEventListener('click', function(e) {
                e.preventDefault();
                logoutUser();
            });
        }
    }

    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Hero slider functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.prev-btn');

    if (slides.length > 0) {
        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            slides[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);

        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    }

    // Testimonial slider with auto-slide and dots
    let currentTestimonial = 0;
    const testimonials = document.querySelectorAll('.testimonial');
    const testimonialDots = document.querySelector('.testimonial-dots');

    if (testimonials.length > 0) {
        // Create dot indicators
        for (let i = 0; i < testimonials.length; i++) {
            const dot = document.createElement('button');
            dot.className = 'testimonial-dot';
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => showTestimonial(i));
            testimonialDots.appendChild(dot);
        }

        function showTestimonial(index) {
            testimonials.forEach((testimonial, i) => {
                testimonial.classList.remove('active');
                if (i === index) {
                    testimonial.classList.add('active');
                }
            });
            // Update dots
            const dots = document.querySelectorAll('.testimonial-dot');
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            currentTestimonial = index;
        }

        function nextTestimonialSlide() {
            currentTestimonial = (currentTestimonial + 1) % testimonials.length;
            showTestimonial(currentTestimonial);
        }

        // Auto slide every 4 seconds
        setInterval(nextTestimonialSlide, 4000);
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Scroll reveal animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.feature, .service-card, .blog-card, .destination-card').forEach(el => {
        observer.observe(el);
    });

    // Destinations page category handling
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');

    function showCategoryGrid(categoryName) {
        const domesticGrid = document.getElementById('domestic-destinations');
        const internationalGrid = document.getElementById('international-destinations');
        const unexploredGrid = document.getElementById('unexplored-destinations');
        const categoryBtns = document.querySelectorAll('.category-btn');

        // Hide all grids
        if (domesticGrid) domesticGrid.style.display = 'none';
        if (internationalGrid) internationalGrid.style.display = 'none';
        if (unexploredGrid) unexploredGrid.style.display = 'none';

        // Remove active class from all buttons
        categoryBtns.forEach(btn => btn.classList.remove('active'));

        // Show the appropriate grid and activate button
        if (categoryName === 'domestic' && domesticGrid) {
            domesticGrid.style.display = 'grid';
            document.querySelector('[data-category="domestic"]').classList.add('active');
        } else if (categoryName === 'international' && internationalGrid) {
            internationalGrid.style.display = 'grid';
            document.querySelector('[data-category="international"]').classList.add('active');
        } else if (categoryName === 'unexplored' && unexploredGrid) {
            unexploredGrid.style.display = 'grid';
            document.querySelector('[data-category="unexplored"]').classList.add('active');
        }
    }

    // Handle URL parameter or default to domestic
    if (category) {
        showCategoryGrid(category);
    } else {
        showCategoryGrid('domestic');
    }

    // Category button click handlers
    const categoryBtns = document.querySelectorAll('.category-btn');
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const selectedCategory = this.getAttribute('data-category');
            showCategoryGrid(selectedCategory);
            // Update URL without page reload
            const newUrl = `${window.location.pathname}?category=${selectedCategory}`;
            window.history.pushState({ category: selectedCategory }, '', newUrl);
        });
    });

    // Form validation and submission
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic validation
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#ff6b6b';
                    isValid = false;
                } else {
                    field.style.borderColor = '#ffd700';
                }
            });

            if (isValid) {
                // Show success message (in a real app, this would send data to server)
                alert('Thank you for your inquiry! We will get back to you soon.');
                form.reset();
            } else {
                alert('Please fill in all required fields.');
            }
        });
    });

    // Input field focus effects
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#ffd700';
            this.style.boxShadow = '0 0 10px rgba(255, 215, 0, 0.3)';
        });

        input.addEventListener('blur', function() {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        });
    });


});





