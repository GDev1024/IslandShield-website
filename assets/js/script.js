document.addEventListener('DOMContentLoaded', () => {

  // Helper functions for alerts and validation
  const createAlert = (type, message) => {
    const div = document.createElement('div');
    div.className = `${type}-message alert-message`;
    div.style.cssText = `
      background: ${type === 'error' ? 'rgba(255,68,68,0.2)' : 'rgba(0,255,0,0.2)'};
      border: 1px solid ${type === 'error' ? '#ff4444' : '#00ff00'};
      color: ${type === 'error' ? '#ff4444' : '#00ff00'};
      padding: 1rem; border-radius: 8px; margin: 1rem 0;
      animation: fadeIn 0.3s ease;
    `;
    div.textContent = message;
    return div;
  };

  const showMessage = (container, message, type='error') => {
    const alert = createAlert(type, message);
    container.insertBefore(alert, container.firstChild);
    if(type==='error') setTimeout(() => alert.remove(), 5000);
  };

  const clearErrors = () => {
    document.querySelectorAll('.error-message, .alert-message').forEach(el => el.remove());
    document.querySelectorAll('input, textarea, select').forEach(input => {
      input.style.borderColor = '';
    });
  };

  const showInputError = (input, message) => {
    const span = document.createElement('span');
    span.className = 'error-message';
    span.textContent = message;
    span.style.cssText = 'color:#ff4444;font-size:0.875rem;margin-top:0.25rem;display:block';
    input.style.borderColor = '#ff4444';
    input.parentElement.appendChild(span);
  };

  const isValidEmail = email => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  
  const isValidPhone = phone => /^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/.test(phone);

  // Mobile navigation menu toggle
  const hamburger = document.getElementById('hamburger');
  const navMenu = document.getElementById('navMenu');
  
  if (hamburger && navMenu) {
    console.log('Hamburger and menu found');
    
    // Toggle menu when clicking hamburger
    hamburger.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      
      const isOpen = navMenu.classList.contains('open');
      console.log('Menu was:', isOpen ? 'open' : 'closed');
      
      if (isOpen) {
        navMenu.classList.remove('open');
        hamburger.classList.remove('active');
        document.body.classList.remove('menu-open');
      } else {
        navMenu.classList.add('open');
        hamburger.classList.add('active');
        document.body.classList.add('menu-open');
      }
      
      console.log('Menu now:', navMenu.classList.contains('open') ? 'open' : 'closed');
    });
    
    // Close menu if you click outside of it
    document.addEventListener('click', (e) => {
      if (!navMenu.contains(e.target) && !hamburger.contains(e.target)) {
        navMenu.classList.remove('open');
        hamburger.classList.remove('active');
        document.body.classList.remove('menu-open');
      }
    });
    
    // Close menu after clicking a link
    navMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', (e) => {
        // Keep open if it's a dropdown parent on mobile
        if (window.innerWidth <= 768 && link.closest('.has-dropdown') && !link.getAttribute('href').startsWith('#')) {
          return;
        }
        navMenu.classList.remove('open');
        hamburger.classList.remove('active');
        document.body.classList.remove('menu-open');
      });
    });
    
    // Mobile dropdown behavior
    document.querySelectorAll('.has-dropdown').forEach(parent => {
      const link = parent.querySelector('a');
      
      link.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          e.stopPropagation();
          
          // Close any other open dropdowns
          document.querySelectorAll('.has-dropdown').forEach(other => {
            if (other !== parent) {
              other.classList.remove('show-dropdown');
            }
          });
          
          // Toggle this dropdown
          parent.classList.toggle('show-dropdown');
        }
      });
    });
    
    // Reset everything when switching to desktop view
    window.addEventListener('resize', () => {
      if (window.innerWidth > 768) {
        navMenu.classList.remove('open');
        hamburger.classList.remove('active');
        document.body.classList.remove('menu-open');
        document.querySelectorAll('.has-dropdown').forEach(parent => {
          parent.classList.remove('show-dropdown');
        });
      }
    });
  }

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', e => {
      const href = anchor.getAttribute('href');
      if (href === '#' || href === '#!') return;
      
      e.preventDefault();
      const target = document.querySelector(href);
      if(target){
        target.scrollIntoView({ behavior:'smooth', block:'start' });
        navMenu?.classList.remove('open');
        hamburger?.classList.remove('active');
      }
    });
  });

  // FIXED: Registration Form Handler
  const registerForm = document.getElementById('registerForm');
  if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      clearErrors();
      
      // Get form data
      const formData = new FormData(registerForm);
      const firstName = formData.get('firstName')?.trim();
      const lastName = formData.get('lastName')?.trim();
      const email = formData.get('email')?.trim();
      const phone = formData.get('phone')?.trim();
      const password = formData.get('password');
      const confirmPassword = formData.get('confirmPassword');
      const terms = formData.get('terms');
      
      // Client-side validation
      let hasError = false;
      
      if (!firstName || firstName.length < 2) {
        showInputError(registerForm.querySelector('#firstName'), 'First name must be at least 2 characters');
        hasError = true;
      }
      
      if (!lastName || lastName.length < 2) {
        showInputError(registerForm.querySelector('#lastName'), 'Last name must be at least 2 characters');
        hasError = true;
      }
      
      if (!isValidEmail(email)) {
        showInputError(registerForm.querySelector('#email'), 'Please enter a valid email address');
        hasError = true;
      }
      
      if (!isValidPhone(phone)) {
        showInputError(registerForm.querySelector('#phone'), 'Please enter a valid phone number');
        hasError = true;
      }
      
      if (password.length < 8) {
        showInputError(registerForm.querySelector('#password'), 'Password must be at least 8 characters');
        hasError = true;
      }
      
      if (password !== confirmPassword) {
        showInputError(registerForm.querySelector('#confirmPassword'), 'Passwords do not match');
        hasError = true;
      }
      
      if (!terms) {
        showMessage(registerForm, 'You must agree to the Terms of Service');
        hasError = true;
      }
      
      if (hasError) return;
      
      // Submit form
      const submitBtn = registerForm.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.textContent = 'Creating Account...';
      submitBtn.disabled = true;

      try {
        const response = await fetch('includes/registration_handler.php', { 
          method: 'POST', 
          body: formData 
        });
        
        const data = await response.json();
        
        if (data.success) {
          showMessage(registerForm, data.message, 'success');
          registerForm.reset();
          
          // Redirect to login after 2 seconds
          setTimeout(() => {
            window.location.href = data.redirect || 'login.php';
          }, 2000);
        } else {
          if (data.errors && Array.isArray(data.errors)) {
            data.errors.forEach(err => showMessage(registerForm, err));
          } else {
            showMessage(registerForm, data.message || 'Registration failed. Please try again.');
          }
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
        }
      } catch (error) {
        console.error('Registration error:', error);
        showMessage(registerForm, 'Network error. Please check your connection and try again.');
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    });
  }

  // Login Form Handler
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      clearErrors();
      
      const formData = new FormData(loginForm);
      const email = formData.get('email')?.trim();
      const password = formData.get('password');
      
      // Validation
      let hasError = false;
      
      if (!isValidEmail(email)) {
        showInputError(loginForm.querySelector('#email'), 'Please enter a valid email address');
        hasError = true;
      }
      
      if (!password || password.length < 1) {
        showInputError(loginForm.querySelector('#password'), 'Please enter your password');
        hasError = true;
      }
      
      if (hasError) return;
      
      const submitBtn = loginForm.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.textContent = 'Logging In...';
      submitBtn.disabled = true;

      try {
        const response = await fetch('includes/login_handler.php', {
          method: 'POST',
          body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
          showMessage(loginForm, data.message, 'success');
          setTimeout(() => {
            window.location.href = data.redirect || 'dashboard.php';
          }, 1000);
        } else {
          showMessage(loginForm, data.message || 'Login failed. Please try again.');
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
        }
      } catch (error) {
        console.error('Login error:', error);
        showMessage(loginForm, 'Network error. Please try again.');
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    });
  }

  // Contact Form Handler
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      clearErrors();
      
      const formData = new FormData(contactForm);
      const submitBtn = contactForm.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.textContent = 'Sending...';
      submitBtn.disabled = true;

      try {
        const response = await fetch('includes/contact_form_handler.php', {
          method: 'POST',
          body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
          showMessage(contactForm, data.message, 'success');
          contactForm.reset();
        } else {
          if (data.errors) {
            data.errors.forEach(err => showMessage(contactForm, err));
          } else {
            showMessage(contactForm, data.message);
          }
        }
      } catch (error) {
        console.error('Contact form error:', error);
        showMessage(contactForm, 'Network error. Please try again.');
      } finally {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    });
  }

  // Logout functionality
  document.querySelectorAll('.btn-logout, [href*="logout"]').forEach(btn => {
    btn.addEventListener('click', async (e) => {
      e.preventDefault();
      try { 
        await fetch('includes/logout_handler.php'); 
        sessionStorage.clear(); 
        window.location.href = 'index.php'; 
      } catch { 
        window.location.href = 'index.php'; 
      }
    });
  });

  // FAQ accordion toggle
  document.querySelectorAll('.faq-item').forEach(item => {
    const question = item.querySelector('.faq-question');
    if (question) {
      question.addEventListener('click', () => {
        const isOpen = item.classList.contains('open');
        
        // Close all items
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
        
        // Open clicked item if it was closed
        if (!isOpen) {
          item.classList.add('open');
        }
      });
    }
  });

  // Back to top button
  const scrollBtn = document.createElement('button');
  scrollBtn.textContent = '↑';
  scrollBtn.className = 'scroll-to-top';
  scrollBtn.setAttribute('aria-label', 'Scroll to top');
  scrollBtn.style.cssText = `
    position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px;
    border-radius: 50%; background: #ffcc00; color: #0b1e3d;
    border: none; font-size: 24px; cursor: pointer; opacity: 0;
    transition: all 0.3s ease; z-index: 999; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    pointer-events: none;
  `;
  document.body.appendChild(scrollBtn);

  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      scrollBtn.style.opacity = '1';
      scrollBtn.style.pointerEvents = 'auto';
    } else {
      scrollBtn.style.opacity = '0';
      scrollBtn.style.pointerEvents = 'none';
    }
  });

  scrollBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  scrollBtn.addEventListener('mouseenter', () => scrollBtn.style.transform = 'scale(1.1)');
  scrollBtn.addEventListener('mouseleave', () => scrollBtn.style.transform = 'scale(1)');

  // FIXED: Animated number counters for stats
  const animateCounters = () => {
    const counters = document.querySelectorAll('.stat-number[data-target]');
    
    if (counters.length === 0) {
      return;
    }

    counters.forEach(counter => {
      const target = parseInt(counter.getAttribute('data-target'));
      
      if (isNaN(target) || target === 0) {
        return;
      }

      const duration = 2000; // 2 seconds
      const steps = 60; // 60 frames
      const increment = target / steps;
      const stepTime = duration / steps;
      
      let current = 0;

      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          counter.textContent = target + '+';
          clearInterval(timer);
        } else {
          counter.textContent = Math.floor(current) + '+';
        }
      }, stepTime);
    });
  };

  // Start counting when stats section comes into view
  const statsSection = document.querySelector('.stats');
  if (statsSection) {
    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            animateCounters();
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.2 });
      
      observer.observe(statsSection);
    } else {
      // Fallback for older browsers
      animateCounters();
    }
  }

  // Fun console message
  console.log('%cIslandShield Security', 'font-size: 24px; color: #ffcc00; font-weight: bold;');
  console.log('%cProtecting what matters most 🛡️', 'font-size: 14px; color: #00bfff;');

});