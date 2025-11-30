// global fetch
function showErrorMessage(container, message) {
  const errorDiv = document.createElement('div');
  errorDiv.className = 'error-message alert-message';
  errorDiv.style.cssText = `
    background: rgba(255, 68, 68, 0.2);
    border: 1px solid #ff4444;
    color: #ff4444;
    padding: 1rem;
    border-radius: 8px;
    margin: 1rem 0;
    animation: fadeIn 0.3s ease;
  `;
  errorDiv.textContent = message;
  container.insertBefore(errorDiv, container.firstChild);
  setTimeout(() => errorDiv.remove(), 5000);
}

function showSuccess(element, message) {
  const successDiv = document.createElement('div');
  successDiv.className = 'success-message alert-message';
  successDiv.style.cssText = `
    background: rgba(0, 255, 0, 0.2);
    border: 1px solid #00ff00;
    color: #00ff00;
    padding: 1rem;
    border-radius: 8px;
    margin: 1rem 0;
    animation: fadeIn 0.3s ease;
  `;
  successDiv.textContent = message;
  element.parentElement.insertBefore(successDiv, element);
}

function clearErrors() {
  document.querySelectorAll('.error-message, .alert-message').forEach(el => el.remove());
  const inputs = document.querySelectorAll('input, textarea, select');
  inputs.forEach(input => input.style.borderColor = '');
}

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

// mobile nav toggle
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('navMenu');

if (hamburger && navMenu) {
  hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("open");
    hamburger.classList.toggle("active");
  });

  document.addEventListener('click', (e) => {
    if (!hamburger.contains(e.target) && !navMenu.contains(e.target)) {
      navMenu.classList.remove('open');
      hamburger.classList.remove('active');
    }
  });

  document.querySelectorAll('.has-dropdown').forEach(parent => {
    parent.addEventListener('click', (e) => {
      if (window.innerWidth <= 768) {
        e.preventDefault();
        parent.classList.toggle('show-dropdown');
      }
    });
  });
}

// smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      navMenu?.classList.remove('open');
      hamburger?.classList.remove('active');
    }
  });
});

// registration form   
const registerForm = document.getElementById('registerForm');
if (registerForm) {
  registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    clearErrors();
    const formData = new FormData(registerForm);
    const submitBtn = registerForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Creating Account...';
    submitBtn.disabled = true;

    try {
      const response = await fetch('Includes/registration_handler.php', { method: 'POST', body: formData });
      const data = await response.json();

      if (data.success) {
        showSuccess(submitBtn, data.message);
        setTimeout(() => window.location.href = data.redirect, 2000);
      } else {
        if (data.errors?.length) data.errors.forEach(error => showErrorMessage(registerForm, error));
        else showErrorMessage(registerForm, data.message);
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    } catch {
      showErrorMessage(registerForm, 'Network error. Please try again.');
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }
  });
}

// login form
const loginForm = document.getElementById('loginForm');
if (loginForm) {
  loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    clearErrors();
    const formData = new FormData(loginForm);
    const submitBtn = loginForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Logging In...';
    submitBtn.disabled = true;

    try {
      const response = await fetch('Includes/login_handler.php', { method: 'POST', body: formData });
      const data = await response.json();

      if (data.success) {
        showSuccess(submitBtn, data.message);
        sessionStorage.setItem('user', JSON.stringify(data.user));
        setTimeout(() => window.location.href = data.redirect, 1500);
      } else {
        showErrorMessage(loginForm, data.message);
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    } catch {
      showErrorMessage(loginForm, 'Network error. Please try again.');
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }
  });
}

// contact form
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
      const response = await fetch('Includes/contact_form_handler.php', { method: 'POST', body: formData });
      const data = await response.json();

      if (data.success) {
        showSuccess(submitBtn, data.message);
        contactForm.reset();
        setTimeout(() => { submitBtn.textContent = originalText; submitBtn.disabled = false; }, 3000);
      } else {
        if (data.errors?.length) data.errors.forEach(error => showErrorMessage(contactForm, error));
        else showErrorMessage(contactForm, data.message);
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    } catch {
      showErrorMessage(contactForm, 'Network error. Please try again.');
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }
  });
}

// logout
document.querySelectorAll('.btn-logout, [href*="logout"]').forEach(btn => {
  btn.addEventListener('click', async (e) => {
    e.preventDefault();
    try {
      await fetch('Includes/logout_handler.php');
      sessionStorage.clear();
      window.location.href = 'index.php';
    } catch {
      window.location.href = 'index.php';
    }
  });
});

// dashboard data
async function loadDashboardData() {
  try {
    const authResponse = await fetch('Includes/check_auth.php');
    const authData = await authResponse.json();
    if (!authData.authenticated) return window.location.href = 'login.php';
    updateUserProfile(authData.user);

    const dashResponse = await fetch('Includes/dashboard_data.php');
    const dashData = await dashResponse.json();

    if (dashData.success) {
      updateDashboardStats(dashData);
      updateServicesList(dashData.services);
      updateAlertsList(dashData.alerts);
      updateCameraStats(dashData.cameras);
    }
  } catch {
    showErrorMessage(document.body, 'Failed to load dashboard data');
  }
}

function updateUserProfile(user) {
  const userName = document.querySelector('.user-profile h3');
  const userEmail = document.querySelector('.user-profile p');
  if (userName) userName.textContent = user.name;
  if (userEmail) userEmail.textContent = user.email;
}

function updateDashboardStats(data) {
  if (data.cameras) {
    const onlineElement = document.querySelector('.stat-value');
    if (onlineElement) onlineElement.textContent = `${data.cameras.online}/${data.cameras.total}`;
  }
}

function updateServicesList(services) {
  const servicesContainer = document.querySelector('.services-list');
  if (!servicesContainer || !services) return;
  servicesContainer.innerHTML = services.map(service => `
    <div class="service-item">
      <div class="service-icon">🛡️</div>
      <div class="service-details">
        <h3>${service.service_type.toUpperCase()} Monitoring</h3>
        <p>${service.package_name || 'Standard Package'}</p>
        <span class="service-status active">Active</span>
      </div>
      <div class="service-actions">
        <button class="btn-icon">⚙️</button>
      </div>
    </div>
  `).join('');
}

function updateAlertsList(alerts) {
  const alertsContainer = document.querySelector('.alerts-list');
  if (!alertsContainer || !alerts) return;
  alertsContainer.innerHTML = alerts.map(alert => `
    <div class="alert-item alert-${alert.type}">
      <div class="alert-icon">${getAlertIcon(alert.type)}</div>
      <div class="alert-content">
        <h4>${alert.title}</h4>
        <p>${alert.message}</p>
        <span class="alert-time">${alert.time}</span>
      </div>
    </div>
  `).join('');
}

function getAlertIcon(type) {
  const icons = { 'info': 'ℹ️', 'warning': '⚠️', 'success': '✓', 'critical': '🚨' };
  return icons[type] || 'ℹ️';
}

function updateCameraStats(cameras) {
  // camera stats logic
}

// auto load dashboard data
if (window.location.pathname.includes('dashboard.php')) loadDashboardData();

//  stats counters animation
const animateCounters = () => {
  const counters = document.querySelectorAll('.stat-number');
  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-target'));
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;
    const updateCounter = () => {
      current += increment;
      counter.textContent = current < target ? Math.floor(current) + '+' : target + '+';
      if (current < target) requestAnimationFrame(updateCounter);
    };
    updateCounter();
  });
};

const statsSection = document.querySelector('.stats');
if (statsSection) {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounters();
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5, rootMargin: '0px' });
  observer.observe(statsSection);
}

// service cards animation
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
  }, { threshold: 0.1, rootMargin: '0px' });

  serviceCards.forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'all 0.5s ease';
    cardObserver.observe(card);
  });
}

// scroll to top button
const createScrollToTop = () => {
  const button = document.createElement('button');
  button.innerHTML = '↑';
  button.className = 'scroll-to-top';
  button.style.cssText = `
    position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px;
    border-radius: 50%; background-color: #ffcc00; color: #0b1e3d;
    border: none; font-size: 24px; cursor: pointer; opacity: 0;
    transition: all 0.3s ease; z-index: 999; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
  `;
  document.body.appendChild(button);

  window.addEventListener('scroll', () => {
    button.style.opacity = window.pageYOffset > 300 ? '1' : '0';
    button.style.pointerEvents = window.pageYOffset > 300 ? 'auto' : 'none';
  });

  button.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  button.addEventListener('mouseenter', () => button.style.transform = 'scale(1.1)');
  button.addEventListener('mouseleave', () => button.style.transform = 'scale(1)');
};
createScrollToTop();


// video fallback
const heroVideo = document.querySelector('.hero-video');
if (heroVideo) {
  heroVideo.addEventListener('error', () => {
    heroVideo.style.display = 'none';
    document.querySelector('.hero-fallback')?.style.display = 'block';
  });
}

// faq 
document.querySelectorAll('.faq-item').forEach(item => {
  const question = item.querySelector('.faq-question');
  question?.addEventListener('click', () => {
    item.classList.toggle('active');
    document.querySelectorAll('.faq-item').forEach(other => {
      if (other !== item) other.classList.remove('active');
    });
  });
});

 
console.log('%cIslandShield Security', 'font-size: 24px; color: #ffcc00; font-weight: bold;');
console.log('%cProtecting what matters most 🛡️', 'font-size: 14px; color: #00bfff;');
