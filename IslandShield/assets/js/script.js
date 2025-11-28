// ===========================
// Mobile Navigation Toggle
// ===========================
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('navMenu');

if (hamburger && navMenu) {
  hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("open");
    hamburger.classList.toggle("active");
});

  // Close menu when clicking outside
  document.addEventListener('click', (e) => {
    if (!hamburger.contains(e.target) && !navMenu.contains(e.target)) {
      navMenu.classList.remove('open');
      hamburger.classList.remove('active');
    }
  });

  // Handle dropdown in mobile
  const dropdownParents = document.querySelectorAll('.has-dropdown');
  dropdownParents.forEach(parent => {
    parent.addEventListener('click', (e) => {
      if (window.innerWidth <= 768) {
        e.preventDefault();
        parent.classList.toggle('show-dropdown');
      }
    });
  });
  
}

// ===========================
// Animated Counter for Stats
// ===========================
const animateCounters = () => {
  const counters = document.querySelectorAll('.stat-number');
  
  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-target'));
    const duration = 2000; // 2 seconds
    const increment = target / (duration / 16); // 60fps
    let current = 0;
    
    const updateCounter = () => {
      current += increment;
      if (current < target) {
        counter.textContent = Math.floor(current) + '+';
        requestAnimationFrame(updateCounter);
      } else {
        counter.textContent = target + '+';
      }
    };
    
    updateCounter();
  });
};

// ===========================
// Intersection Observer for Stats
// ===========================
const statsSection = document.querySelector('.stats');
if (statsSection) {
  const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px'
  };

  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounters();
        statsObserver.unobserve(entry.target);
      }
    });
  }, observerOptions);

  statsObserver.observe(statsSection);
}

// ===========================
// Smooth Scroll for Navigation Links
// ===========================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
      // Close mobile menu if open
      if (navMenu) {
        navMenu.classList.remove('show');
      }
      if (hamburger) {
        hamburger.classList.remove('active');
      }
    }
  });
});

// ===========================
// Active Navigation Link on Scroll
// ===========================
window.addEventListener('scroll', () => {
  const sections = document.querySelectorAll('section[id]');
  const scrollY = window.pageYOffset;

  sections.forEach(section => {
    const sectionHeight = section.offsetHeight;
    const sectionTop = section.offsetTop - 100;
    const sectionId = section.getAttribute('id');
    const navLink = document.querySelector(`nav a[href="#${sectionId}"]`);

    if (navLink) {
      if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
        navLink.classList.add('active');
      } else {
        navLink.classList.remove('active');
      }
    }
  });
});

// ===========================
// Form Validation (for Registration/Login pages)
// ===========================
const registerForm = document.getElementById('registerForm');
if (registerForm) {
  registerForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const email = document.getElementById('email');
    const name = document.getElementById('name');
    
    // Reset previous error messages
    clearErrors();
    
    let isValid = true;
    
    // Name validation
    if (name && name.value.trim().length < 2) {
      showError(name, 'Name must be at least 2 characters long');
      isValid = false;
    }
    
    // Email validation
    if (email && !isValidEmail(email.value)) {
      showError(email, 'Please enter a valid email address');
      isValid = false;
    }
    
    // Password validation
    if (password && password.value.length < 8) {
      showError(password, 'Password must be at least 8 characters long');
      isValid = false;
    }
    
    // Confirm password validation
    if (confirmPassword && password.value !== confirmPassword.value) {
      showError(confirmPassword, 'Passwords do not match');
      isValid = false;
    }
    
    if (isValid) {
      // Here you would normally send data to PHP backend
      alert('Registration successful! (This is a demo - integrate with PHP backend)');
      registerForm.reset();
    }
  });
}

// Login Form Validation
const loginForm = document.getElementById('loginForm');
if (loginForm) {
  loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    
    clearErrors();
    
    let isValid = true;
    
    if (email && !isValidEmail(email.value)) {
      showError(email, 'Please enter a valid email address');
      isValid = false;
    }
    
    if (password && password.value.length < 1) {
      showError(password, 'Please enter your password');
      isValid = false;
    }
    
    if (isValid) {
      // Here you would normally send data to PHP backend
      alert('Login successful! (This is a demo - integrate with PHP backend)');
      // Redirect to dashboard
      // window.location.href = 'dashboard.html';
    }
  });
}

// Contact Form Validation
const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const subject = document.getElementById('subject');
    const message = document.getElementById('message');
    
    clearErrors();
    
    let isValid = true;
    
    if (name && name.value.trim().length < 2) {
      showError(name, 'Name must be at least 2 characters long');
      isValid = false;
    }
    
    if (email && !isValidEmail(email.value)) {
      showError(email, 'Please enter a valid email address');
      isValid = false;
    }
    
    if (subject && subject.value.trim().length < 3) {
      showError(subject, 'Subject must be at least 3 characters long');
      isValid = false;
    }
    
    if (message && message.value.trim().length < 10) {
      showError(message, 'Message must be at least 10 characters long');
      isValid = false;
    }
    
    if (isValid) {
      // Here you would normally send data to PHP backend
      alert('Message sent successfully! (This is a demo - integrate with PHP backend)');
      contactForm.reset();
    }
  });
}

// ===========================
// Form Helper Functions
// ===========================
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function showError(input, message) {
  const formGroup = input.parentElement;
  const errorElement = document.createElement('span');
  errorElement.className = 'error-message';
  errorElement.textContent = message;
  errorElement.style.color = '#ff4444';
  errorElement.style.fontSize = '0.875rem';
  errorElement.style.marginTop = '0.25rem';
  errorElement.style.display = 'block';
  
  input.style.borderColor = '#ff4444';
  formGroup.appendChild(errorElement);
}

function clearErrors() {
  const errorMessages = document.querySelectorAll('.error-message');
  errorMessages.forEach(error => error.remove());
  
  const inputs = document.querySelectorAll('input, textarea');
  inputs.forEach(input => {
    input.style.borderColor = '';
  });
}

// ===========================
// Video Fallback Handler
// ===========================
const heroVideo = document.querySelector('.hero-video');
if (heroVideo) {
  heroVideo.addEventListener('error', () => {
    heroVideo.style.display = 'none';
    const fallback = document.querySelector('.hero-fallback');
    if (fallback) {
      fallback.style.display = 'block';
    }
  });
}

// ===========================
// Scroll-to-Top Button (Optional Enhancement)
// ===========================
const createScrollToTop = () => {
  const button = document.createElement('button');
  button.innerHTML = '↑';
  button.className = 'scroll-to-top';
  button.style.cssText = `
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #ffcc00;
    color: #0b1e3d;
    border: none;
    font-size: 24px;
    cursor: pointer;
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 999;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
  `;
  
  document.body.appendChild(button);
  
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
      button.style.opacity = '1';
      button.style.pointerEvents = 'auto';
    } else {
      button.style.opacity = '0';
      button.style.pointerEvents = 'none';
    }
  });
  
  button.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
  
  button.addEventListener('mouseenter', () => {
    button.style.transform = 'scale(1.1)';
  });
  
  button.addEventListener('mouseleave', () => {
    button.style.transform = 'scale(1)';
  });
};

// Initialize scroll-to-top button
createScrollToTop();

// FAQ Accordion (if on FAQ page)
const faqItems = document.querySelectorAll('.faq-item');
if (faqItems.length > 0) {
  faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    if (question) {
      question.addEventListener('click', () => {
        item.classList.toggle('active');
        
        // Close other FAQ items
        faqItems.forEach(otherItem => {
          if (otherItem !== item) {
            otherItem.classList.remove('active');
          }
        });
      });
    }
  });
}

// Service Cards Animation on Scroll

const serviceCards = document.querySelectorAll('.service-card');
if (serviceCards.length > 0) {
  const cardObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }, index * 100);
        cardObserver.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px'
  });

  serviceCards.forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'all 0.5s ease';
    cardObserver.observe(card);
  });
}

//  Console Welcome Message
 
console.log('%cIslandShield Security', 'font-size: 24px; color: #ffcc00; font-weight: bold;');
console.log('%cProtecting what matters most 🛡️', 'font-size: 14px; color: #00bfff;');