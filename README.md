# 🛡️ IslandShield Security

Professional security solutions website for IslandShield Security — Grenada's *FICTONAL* trusted security provider.

---

## 📋 Project Overview

IslandShield Security is a fully functional, production-ready website for a professional security company. Built with a mobile-first approach, it features user authentication, dynamic content management and a comprehensive client dashboard.

### Key Highlights

- ✅ **Mobile-First Responsive Design** — Optimized for phones to desktops
- ✅ **User Authentication System** — Secure registration, login, and session handling
- ✅ **Dynamic Client Dashboard** — Camera monitoring, alerts, and service controls
- ✅ **Professional UI/UX** — Animations, modern layout, and smooth transitions
- ✅ **Comprehensive Service Pages** — CCTV, personnel, events, emergency response
- ✅ **Security-First Practices** — Password hashing, prepared statements, XSS prevention

---

## 📑 Table of Contents

- [Overview](#-project-overview)
- [Features](#-features)
  - [Public Features](#public-features)
  - [User Features](#user-features)
  - [Technical Features](#technical-features)
- [Tech Stack](#️-tech-stack)
- [Project Structure](#-project-structure)
- [Usage](#️-usage)
- [Responsive Design](#-responsive-design)
- [Design System](#-design-system)
- [Security Features](#-security-features)
- [Database Schema](#️-database-schema)
- [Testing](#-testing)
- [Future Enhancements](#-future-enhancements)
- [License](#-license)
- [Acknowledgments](#-acknowledgments)
- [Changelog](#-changelog)

---

## 🌟 Features

### Public Features

| Feature | Description |
|---------|-------------|
| **Homepage** | Video hero section, service cards, animated statistics, client testimonials |
| **Service Pages** | Detailed pages for CCTV, Security Personnel, Event Security, Emergency Response |
| **Contact System** | Functional contact form with backend processing and email notifications |
| **FAQ Section** | Searchable, accordion-style frequently asked questions |
| **Resources Hub** | Security guides, downloadable PDFs, video tutorials, and safety tips |
| **About Page** | Company story, team profiles, mission/vision, certifications |

### User Features

| Feature | Description |
|---------|-------------|
| **Registration** | Secure account creation with comprehensive validation |
| **Login System** | Session-based authentication with "remember me" option |
| **Client Dashboard** | Camera status monitoring, security alerts display, service management interface |

### Technical Features

- **Modular CSS architecture** (base, layout, components and page-specific files)
- **Client-side (JavaScript) and server-side (PHP) validation**
- **Animated counters** triggered on scroll
- **Mobile hamburger navigation** with slide-in animation
- **Responsive, optimized images** for different screen sizes
- **Password security** with bcrypt hashing and input validation 
- **Prepared statements** to prevent SQL injection
- **Input sanitization and output escaping** to mitigate XSS

---

## 🛠️ Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Server:** Apache
- **Icons:** Font Awesome
- **Fonts:** Google Fonts
- **Version Control:** Git

---

## 📁 Project Structure

```
IslandShield/
├── assets/
│   ├── css/
│   │   ├── base.css              # Variables, resets, utilities
│   │   ├── layout.css            # Header, footer, navigation, page structure
│   │   ├── components.css        # Reusable UI components
│   │   └── pages/
│   │       ├── auth.css          # Login & registration styling
│   │       ├── dashboard.css     # Dashboard-specific styles
│   │       └── pages.css         # General page styles
│   ├── js/
│   │   └── script.js             # Main JavaScript functionality
│   └── images/                   # Logos, service images, media assets
│
├── includes/
│   ├── config.php                # Database configuration (local + production)
│   ├── header.php                # Global site header
│   ├── footer.php                # Global site footer
│   ├── contact_form_handler.php  # Contact form processing
│   ├── logout_handler.php        # Session termination
│   └── islandshield_database.sql # Database schema and sample data
│
├── registration_handler.php      # User registration logic (root for InfinityFree)
├── login_handler.php             # User authentication (root for InfinityFree)
│
├── Page Files (*.php)
│   ├── index.php                 # Homepage
│   ├── about.php                 # About page
│   ├── services.php              # Services overview
│   ├── cctv.php                  # CCTV services
│   ├── personnel.php             # Security personnel
│   ├── event.php                 # Event security
│   ├── emergency.php             # Emergency response
│   ├── contact.php               # Contact page
│   ├── faq.php                   # FAQ page
│   ├── resources.php             # Resources hub
│   ├── login.php                 # User login
│   ├── register.php              # User registration
│   └── dashboard.php             # Client dashboard (UI & logic)
│
├── Utility Files
│   ├── check_db.php              # Database connection test
│   ├── test_connection.php       # Connection diagnostics
│   └── test_registration.php     # Registration testing utility
│
├── Documentation
│   ├── README.md                 # Project README 
│   ├── TESTING_CHECKLIST.md      # Testing procedures
│   ├── .gitignore                # Git exclusions
│   └── LICENSE                   # Apache 2.0 License
│
└── Configuration
    └── .env                      # Environment variables
```

---

## ▶️ Usage

1. Open the site in your local server environment (`http://localhost/your-folder/`)
2. Browse public pages: home, services, about, resources
3. Use contact form for submissions (backend processing included)
4. Register and login to access the client dashboard (if deployed)

**Note:** Database schema and sample data are included in `includes/islandshield_database.sql`.

---

## 📱 Responsive Design

### Breakpoints & Layouts

| Device | Width | Layout Changes |
|--------|-------|----------------|
| **Mobile** | ≤ 480px | Single-column layout, full-width elements, hamburger nav |
| **Tablet** | 481–768px | Two-column layouts, collapsible navigation |
| **Desktop** | 769–1024px | Multi-column grids, expanded navigation |
| **Large Desktop** | ≥ 1025px | Maximum-width containers, advanced grid layouts |

**Approach:** Mobile-first CSS with progressive enhancement and media queries.

---

## 🎨 Design System

### Color Palette

```css
--primary-navy:      #1e3c72;
--primary-gold:      #ffcc00;
--accent-cyan:       #00bfff;
--accent-purple:     #667eea;

--bg-dark:           #0a1628;
--bg-card:           rgba(30, 60, 114, 0.15);

--text-light:        #f8fafc;
--text-gray:         #cbd5e1;
--text-muted:        #94a3b8;
```

### Typography

- **Headings:** Nunito (700) — bold, modern
- **Body:** Nunito (400) — readable, neutral
- **Base font size:** 16px with responsive scaling

### Principles

- **Consistency** in spacing & components
- **Accessibility** (WCAG 2.1 AA focus)
- **Performance-first:** optimized assets & minimal blocking JS
- **Clear visual hierarchy** & readable typography

---

## 🔐 Security Features

### Authentication

- Password hashing (bcrypt)
- Secure session handling (httpOnly cookies)
- Login throttling considerations

### Database Security

- All DB queries use prepared statements
- Server-side input validation
- Sanitization of user inputs

### Application Security

- Output escaping to reduce XSS risk
- CSRF token-ready forms (structure included)
- Secrets stored in `.env` (not committed)

---

## 🗄️ Database Schema

### Main Tables (overview):

- **users** — stores user account information (id, name, email, password_hash, timestamps, status)
- **services** — user service subscriptions (service_id, user_id, package, status, dates, cost)
- **cameras** — CCTV assets (camera_id, user_id, name, location, status, last_online)
- **alerts** — system notifications (alert_id, user_id, camera_id, type, message, severity, is_read, created_at)
- **contact_messages** — messages from contact form (message_id, name, email, phone, subject, message, created_at, status)

### Sample Data

- **Test User:** `garysonwalker@test.com` / `password`
- **4 sample cameras** (Front Entrance, Parking Lot, Back Gate, Side Entrance)
- **1 active service** (Professional CCTV Package)
- **Sample motion-detection alerts** included


---

## 🔮 Future Enhancements

- [ ] Email notification system for alerts
- [ ] Payment gateway (subscriptions)
- [ ] Admin panel for user/content management
- [ ] Real-time chat support widget
- [ ] Mobile app companion (iOS/Android)
- [ ] Advanced analytics dashboard with charts
- [ ] Multi-language support (English, French)
- [ ] Public API for integrations
- [ ] Automated invoice generation
- [ ] SMS alert notifications

---

## 📄 License

This project is licensed under the **Apache License 2.0**. See the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- **Mr. Christopher Miginon** — instructor & guidance
- **MDN Web Docs & W3Schools** — references & examples
- **Web Design Community via Discord** — documentation & help


---


## 📝 Changelog

### v1.0.0 — December 2024

- ✅ Initial release
- ✅ Full frontend (13+ pages)
- ✅ Authentication system implemented
- ✅ Interactive client dashboard (UI + sample data)
- ✅ Responsive design verified
- ✅ Sample DB & alerts included
- ✅ Documentation completed

---

**Built with ❤️ by Garyson at T.A. Marryshow Community College**
*For educational purposes — Web Design Final Project 2024–2025*
