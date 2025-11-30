document.addEventListener('DOMContentLoaded', () => {

  // ------------------------------
  // Utility Functions
  // ------------------------------
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
    document.querySelectorAll('input, textarea, select').forEach(input => input.style.borderColor='');
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

  // ------------------------------
  // Mobile Nav
  // ------------------------------
  const hamburger = document.getElementById('hamburger');
  const navMenu = document.getElementById('navMenu');
  if(hamburger && navMenu){
    hamburger.addEventListener('click', () => {
      navMenu.classList.toggle('open');
      hamburger.classList.toggle('active');
    });

    document.addEventListener('click', e => {
      if(!navMenu.contains(e.target) && !hamburger.contains(e.target)){
        navMenu.classList.remove('open');
        hamburger.classList.remove('active');
      }
    });

    document.querySelectorAll('.has-dropdown').forEach(parent => {
      parent.addEventListener('click', e => {
        if(window.innerWidth <= 768){
          e.preventDefault();
          parent.classList.toggle('show-dropdown');
        }
      });
    });
  }

  // ------------------------------
  // Smooth Scroll
  // ------------------------------
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', e => {
      e.preventDefault();
      const target = document.querySelector(anchor.getAttribute('href'));
      if(target){
        target.scrollIntoView({ behavior:'smooth', block:'start' });
        navMenu?.classList.remove('open');
        hamburger?.classList.remove('active');
      }
    });
  });

  // ------------------------------
  // Forms: Registration, Login, Contact
  // ------------------------------
  const handleFormSubmit = (formId, handlerUrl, successRedirect=null) => {
    const form = document.getElementById(formId);
    if(!form) return;

    form.addEventListener('submit', async e => {
      e.preventDefault();
      clearErrors();
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.textContent = formId==='registerForm' ? 'Creating Account...' : formId==='loginForm' ? 'Logging In...' : 'Sending...';
      submitBtn.disabled = true;

      try {
        const res = await fetch(handlerUrl, { method:'POST', body: new FormData(form) });
        const data = await res.json();

        if(data.success){
          showMessage(submitBtn, data.message, 'success');
          if(formId==='contactForm') form.reset();
          if(successRedirect) setTimeout(()=>window.location.href=data.redirect, 1500);
          else setTimeout(()=>{ submitBtn.textContent = originalText; submitBtn.disabled=false; }, 2000);
        } else {
          if(data.errors?.length) data.errors.forEach(err => showMessage(form, err));
          else showMessage(form, data.message);
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
        }
      } catch {
        showMessage(form, 'Network error. Please try again.');
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    });
  };

  handleFormSubmit('registerForm', 'Includes/registration_handler.php', true);
  handleFormSubmit('loginForm', 'Includes/login_handler.php', true);
  handleFormSubmit('contactForm', 'Includes/contact_form_handler.php');

  // ------------------------------
  // Logout
  // ------------------------------
  document.querySelectorAll('.btn-logout, [href*="logout"]').forEach(btn => {
    btn.addEventListener('click', async e => {
      e.preventDefault();
      try{ await fetch('Includes/logout_handler.php'); sessionStorage.clear(); window.location.href='index.php'; }
      catch{ window.location.href='index.php'; }
    });
  });

  // ------------------------------
  // FAQ Toggle
  // ------------------------------
  document.querySelectorAll('.faq-item').forEach(item => {
    const q = item.querySelector('.faq-question');
    q?.addEventListener('click', () => {
      const isActive = item.classList.contains('active');
      document.querySelectorAll('.faq-item').forEach(i=>i.classList.remove('active'));
      if(!isActive) item.classList.add('active');
    });
  });

  // ------------------------------
  // Scroll To Top Button
  // ------------------------------
  const scrollBtn = document.createElement('button');
  scrollBtn.textContent = '↑';
  scrollBtn.className='scroll-to-top';
  scrollBtn.style.cssText=`
    position: fixed; bottom:30px; right:30px; width:50px; height:50px;
    border-radius:50%; background:#ffcc00; color:#0b1e3d;
    border:none; font-size:24px; cursor:pointer; opacity:0;
    transition: all 0.3s ease; z-index:999; box-shadow:0 5px 15px rgba(0,0,0,0.3);
  `;
  document.body.appendChild(scrollBtn);

  window.addEventListener('scroll', ()=> {
    scrollBtn.style.opacity = window.scrollY>300 ? '1':'0';
    scrollBtn.style.pointerEvents = window.scrollY>300 ? 'auto':'none';
  });

  scrollBtn.addEventListener('click', ()=> window.scrollTo({ top:0, behavior:'smooth' }));
  scrollBtn.addEventListener('mouseenter', ()=> scrollBtn.style.transform='scale(1.1)');
  scrollBtn.addEventListener('mouseleave', ()=> scrollBtn.style.transform='scale(1)');

  // ------------------------------
  // Animate Stats Counters
  // ------------------------------
  const animateCounters = () => {
    const counters = document.querySelectorAll('.stat-number[data-target]');

    counters.forEach(counter => {
      const target = parseInt(counter.getAttribute('data-target'));
      if (isNaN(target) || target === 0) return;

      const duration = 2000; // 2 seconds
      const startTime = performance.now();

      const updateCounter = (currentTime) => {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Easing function for smooth animation
        const easeOutQuart = 1 - Math.pow(1 - progress, 4);
        const current = Math.floor(easeOutQuart * target);

        counter.textContent = current + '+';

        if (progress < 1) {
          requestAnimationFrame(updateCounter);
        } else {
          counter.textContent = target + '+';
        }
      };

      requestAnimationFrame(updateCounter);
    });
  };

  // Trigger animation when stats section is visible
  const statsSection = document.querySelector('.stats');
  if (statsSection) {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounters();
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 }); // Trigger when 30% visible
    
    observer.observe(statsSection);
  }

  // ------------------------------
  // Console Branding
  // ------------------------------
  console.log('%cIslandShield Security', 'font-size: 24px; color: #ffcc00; font-weight: bold;');
  console.log('%cProtecting what matters most 🛡️', 'font-size: 14px; color: #00bfff;');

});
