# 🛡️ IslandShield Security

Professional security solutions website for IslandShield Security - Grenada's trusted security provider.

**Project:** Web Design Final Project  
**Institution:** T.A. Marryshow Community College  
**Year:** 2025

---

## 📋 Project Overview

IslandShield Security is a complete website built from front to back for a professional security company. Think of it as a digital storefront that works on any device - phone, tablet, or computer. Users can create accounts, log in, and access their own personalized dashboard to manage their security services.

**Key Highlights:**
- **Mobile-first responsive design** - Built to look great on phones first, then scaled up for bigger screens
- **User authentication** - Secure login system so clients can access their personal information
- **Dynamic content** - Pages that pull real information from a database instead of showing the same thing to everyone
- **Interactive features** - Smooth animations, clickable elements, and real-time feedback
- **Professional design** - Clean, modern look that builds trust

---

## 🌟 Features

### Public Features
- **Homepage** - Video hero section, service cards, animated stats, testimonials
- **Service Pages** - CCTV, Security Personnel, Event Security, Emergency Response
- **Contact System** - Form with backend processing and validation
- **FAQ Section** - Accordion-style frequently asked questions
- **Resources Hub** - Security guides, tips, and educational content
- **About Page** - Company story, mission, team information

### User Features
- **Registration** - Secure account creation with validation
- **Login System** - Session-based authentication
- **Client Dashboard** - Live camera feeds, alerts, service management
- **Profile Management** - View and update account information

### Technical Features
- **Responsive Design** - Automatically adjusts to fit any screen size, from phones to large monitors
- **Animated Counters** - Numbers that count up smoothly when you scroll to them (like "500+ Clients")
- **Form Validation** - Checks your input twice - once in the browser for speed, once on the server for security
- **Smooth Animations** - Subtle movements and transitions that make the site feel polished and professional
- **Security** - Passwords are encrypted, database queries are protected, and user input is cleaned to prevent attacks

---

## 🛠️ Tech Stack

Here's what powers the website:

| Layer | Technology | What It Does |
|-------|-----------|--------------|
| **Frontend** | HTML5, CSS3, JavaScript | The stuff you see and interact with in your browser |
| **Backend** | PHP 8.2 | Server-side code that handles logins, database queries, and business logic |
| **Database** | MySQL 8.0 | Where we store user accounts, services, alerts, and other data |
| **Server** | Apache | The software that serves up the website when you visit it |
| **Styling** | Custom CSS (modular) | Organized style files that control colors, layouts, and animations |
| **Icons** | Font Awesome 6.5.1 | Professional icon library for visual elements |
| **Fonts** | Nunito, Libre Baskerville | Clean, readable fonts from Google Fonts |

---

## 🎨 Design & Planning

### Project Timeline

| Phase | Duration | Tasks | Status |
|-------|----------|-------|--------|
| **Planning** | Days 1-2 days | Research, requirements gathering, feasibility study | ✅ Complete |
| **Design** | Days 3-4 | Mockups, color scheme, sitemap | ✅ Complete |
| **Development** | Days 5-10  | Frontend development, backend integration, database setup | ✅ Complete |
| **Testing** | Days 11-13  | Cross-browser testing, mobile testing, bug fixes | ✅ Complete |
| **Deployment** | Day 14 | Server setup, deployment, final testing | ✅ Complete |

### Sitemap

```
IslandShield Security
│
├── Home (index.php)
│
├── About Us (about.php)
│
├── Services (services.php)
│   ├── CCTV Installation (cctv.php)
│   ├── Security Personnel (personnel.php)
│   ├── Event Security (event.php)
│   └── Emergency Response (emergency.php)
│
├── Resources (resources.php)
│
├── Contact (contact.php)
│
├── FAQ (faq.php)
│
└── User System
    ├── Login (login.php)
    ├── Register (register.php)
    └── Dashboard (dashboard.php)
```

### Wireframes & Mockups

These are the blueprints we followed when building the site:

#### Desktop Layout
- **Header:** Logo on the left, main menu in the center, login button on the right
- **Hero Section:** Big video background with text overlay and action buttons (like "Get Started")
- **Content Sections:** Cards and information arranged in neat grids
- **Footer:** Four columns with links, contact details, and social media icons

#### Mobile Layout
- **Header:** Logo on the left, hamburger menu icon (☰) on the right
- **Navigation:** Tapping the hamburger opens a full-screen menu
- **Content:** Everything stacks in a single column for easy scrolling
- **Touch-Optimized:** Bigger buttons that are easy to tap with your thumb

### Color Scheme & Branding

**Primary Colors:**
```css
Navy Blue:    #1e3c72  /* Trust, professionalism */
Gold:         #ffcc00  /* Premium, attention */
Cyan:         #00bfff  /* Technology, clarity */
Purple:       #667eea  /* Innovation */
```

**Typography:**
- **Headings:** Libre Baskerville (serif) - Professional, authoritative
- **Body:** Nunito (sans-serif) - Clean, readable

### Use Case Diagrams

**User Registration Flow:**
1. User visits register.php
2. Fills out registration form
3. System validates input
4. Password is hashed
5. User data stored in database
6. Confirmation message displayed
7. Redirect to login page

**Dashboard Access Flow:**
1. User logs in
2. Session created
3. Dashboard loads user-specific data
4. Displays cameras, alerts, services
5. User can interact with features
6. Logout destroys session

---

## 📁 Project Structure

```
IslandShield/
├── assets/
│   ├── css/
│   │   ├── base.css           # Base styles, variables, resets
│   │   ├── layout.css         # Header, footer, navigation, page structure
│   │   ├── components.css     # Reusable components (buttons, cards, forms)
│   │   ├── style.css          # Main stylesheet import
│   │   └── pages/             # Page-specific styles
│   ├── js/
│   │   └── script.js          # Main JavaScript (nav, forms, animations)
│   └── images/                # Logos, service images, media files
│
├── includes/
│   ├── config.php                  # Database configuration
│   ├── header.php                  # Site header with navigation
│   ├── footer.php                  # Site footer
│   ├── registration_handler.php   # User registration logic
│   ├── login_handler.php           # User login logic
│   ├── logout_handler.php          # Logout functionality
│   ├── contact_form_handler.php    # Contact form processing
│   ├── dashboard_data.php          # Dashboard data queries
│   └── islandshield_database.sql   # Database schema
│
├── index.php              # Homepage
├── about.php              # About page
├── services.php           # Services overview
├── cctv.php               # CCTV services
├── personnel.php          # Security personnel
├── event.php              # Event security
├── emergency.php          # Emergency response
├── contact.php            # Contact page
├── faq.php                # FAQ page
├── resources.php          # Resources hub
├── login.php              # User login
├── register.php           # User registration
├── dashboard.php          # Client dashboard
├── check_db.php           # Database connection test
├── test_registration.php  # Registration testing
│
├── .env                   # Environment variables (not in git)
├── .gitignore             # Git ignore file
├── README.md              # Project documentation
└── LICENSE                # License file
```

---

## 🎨 Design System

### Color Palette
```css
Primary Navy:   #1e3c72
Navy Light:     #2a5298
Navy Dark:      #152a52
Gold Accent:    #ffcc00
Cyan:           #00bfff
Purple:         #667eea
Text Light:     #e0e6ed
Text Gray:      #b0bac9
```

### Typography
- **Headings:** Libre Baskerville (serif) - Professional, elegant
- **Body Text:** Nunito (sans-serif) - Clean, readable
- **Font Sizes:** Responsive scaling with rem units

### Responsive Breakpoints
- **Mobile:** 480px and below
- **Tablet:** 768px
- **Desktop:** 1024px
- **Large Desktop:** 1280px+

### Design Features
- **Modern UI/UX** - Clean, professional look with a navy blue and gold color scheme that conveys trust and premium quality
- **Glassmorphism** - Trendy frosted glass effect on cards that gives depth and sophistication
- **Smooth Animations** - Subtle movements when you hover over buttons or scroll down the page
- **Video Hero** - Eye-catching background video on the homepage with a blur effect and text overlay
- **Grid Layouts** - Content arranged in neat, organized grids that adapt to any screen
- **Mobile-First** - Designed for phones first, then enhanced for larger screens (since most people browse on mobile)

---

## 📄 Pages Overview

### Public Pages
| Page | Description | Key Features |
|------|-------------|--------------|
| **index.php** | Homepage | Video hero, service cards, animated stats, testimonials, CTA |
| **about.php** | About Us | Company story, mission, team, certifications |
| **services.php** | Services Overview | All services with features and links |
| **cctv.php** | CCTV Services | Camera packages, features, installation process |
| **personnel.php** | Security Personnel | Guard services, packages, qualifications |
| **event.php** | Event Security | Event types, crowd management, pricing |
| **emergency.php** | Emergency Response | 24/7 response, packages, process timeline |
| **contact.php** | Contact | Contact form, location, phone, email |
| **faq.php** | FAQ | Accordion-style questions and answers |
| **resources.php** | Resources Hub | Security guides, tips, educational content |

### User Pages
| Page | Description | Access |
|------|-------------|--------|
| **login.php** | User Login | Public |
| **register.php** | Registration | Public |
| **dashboard.php** | Client Dashboard | Authenticated users only |

---

## 🗄️ Database Schema

### Main Tables

**users**
- `id` - Primary key
- `name` - Full name
- `email` - Email address (unique)
- `password` - Hashed password (bcrypt)
- `phone` - Contact number
- `created_at` - Registration timestamp

**contact_messages**
- `id` - Primary key
- `name` - Sender name
- `email` - Sender email
- `phone` - Contact number
- `service` - Service interested in
- `message` - Message content
- `created_at` - Submission timestamp

**services** (User subscriptions)
- `id` - Primary key
- `user_id` - Foreign key to users
- `service_type` - Type of service
- `status` - Active/Inactive
- `start_date` - Service start date

**cameras** (CCTV tracking)
- `id` - Primary key
- `user_id` - Foreign key to users
- `location` - Camera location
- `status` - Online/Offline
- `last_check` - Last status check

**alerts** (Security notifications)
- `id` - Primary key
- `user_id` - Foreign key to users
- `type` - Alert type
- `message` - Alert message
- `status` - Read/Unread
- `created_at` - Alert timestamp

### Database Features
- **Prepared statements** - A secure way to talk to the database that prevents hackers from injecting malicious code
- **Password hashing with bcrypt** - Passwords are scrambled using a one-way encryption algorithm, so even we can't see them
- **Foreign key relationships** - Tables are connected logically (like linking a camera to its owner)
- **Indexed columns** - Speed boosters that help the database find information faster
- **UTF-8 character encoding** - Supports all languages and special characters

---

## 🔐 Security Features

Security is baked into every layer of this project. Here's how we keep things safe:

### Authentication & Authorization
- **Password Hashing** - Passwords are encrypted using bcrypt, a battle-tested algorithm that makes them virtually impossible to crack
- **Session Management** - When you log in, the server remembers you securely without storing your password
- **Login Protection** - The system tracks failed login attempts to prevent brute-force attacks

### Database Security
- **Prepared Statements** - pre-approved forms that prevent hackers from sneaking in malicious database commands
- **Input Validation** - Every form submission is checked on the server to make sure it's legitimate
- **Data Sanitization** - User input is cleaned and filtered before being stored or displayed

### Application Security
- **XSS Prevention** - Protects against cross-site scripting attacks where hackers try to inject malicious code into pages
- **CSRF Protection** - Ready to implement tokens that verify requests are coming from legitimate users
- **Secure Cookies** - Browser cookies are configured to be inaccessible to JavaScript and only sent over secure connections
- **Environment Variables** - Sensitive info like database passwords are kept in a separate file that's never uploaded to GitHub

### Production Ready
- **HTTPS Support** - Ready to run on secure encrypted connections (the padlock in your browser)
- **Error Handling** - Detailed errors during development, generic messages in production to avoid leaking information
- **Secure Headers** - HTTP headers configured to add extra layers of protection

---

## 🎯 Key JavaScript Features

### Mobile Navigation
- Hamburger menu toggle
- Smooth open/close animations
- Click outside to close
- Dropdown menu handling
- Responsive breakpoint detection

### Form Handling
- AJAX form submission
- Real-time validation
- Error message display
- Success notifications
- Loading states on buttons

### Animations
- **Stat Counters** - Numbers count up when scrolled into view
- **Intersection Observer** - Triggers animations on scroll
- **Smooth Scrolling** - Anchor link smooth scroll behavior
- **Hover Effects** - Interactive button and card effects

### User Experience
- **Scroll to Top Button** - Appears after scrolling down
- **FAQ Accordion** - Expandable question/answer sections
- **Alert System** - Dynamic success/error messages
- **Logout Handler** - Secure session cleanup

### Performance
- **Vanilla JavaScript** - Pure JavaScript without heavy libraries, keeping the site fast and lightweight
- **Efficient event delegation** - Smart event handling that uses less memory and runs faster
- **Debounced scroll events** - Scroll animations are throttled so they don't bog down your browser
- **Optimized animations** - Smooth transitions that use GPU acceleration for buttery performance

---

## 📱 Responsive Design

### Mobile-First Approach
The site is built with a mobile-first methodology, ensuring optimal performance on all devices.

### Responsive Features
- **Flexible Grids** - Modern CSS layout systems that automatically arrange content based on screen size
- **Fluid Typography** - Text sizes that scale smoothly from phone to desktop
- **Adaptive Images** - Images are optimized and sized appropriately for each device
- **Touch-Friendly** - Buttons and links are big enough to tap easily on touchscreens
- **Hamburger Menu** - The classic three-line menu icon that saves space on mobile
- **Stacked Layouts** - On small screens, side-by-side content automatically stacks vertically

### Testing
Tested on:
- Mobile devices (320px - 480px)
- Tablets (768px - 1024px)
- Laptops (1024px - 1440px)
- Desktop monitors (1440px+)

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.2 or higher
- MySQL 8.0 or higher
- Apache server (or similar)
- Web browser

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/islandshield-security.git
   cd islandshield-security
   ```

2. **Set up the database**
   - Create a MySQL database named `islandshield_db`
   - Import the SQL file: `includes/islandshield_database.sql`

3. **Configure environment**
   - Copy `.env.example` to `.env` (if available)
   - Update database credentials in `.env`:
     ```
     DB_HOST=localhost
     DB_USER=root
     DB_PASSWORD=yourpassword
     DB_NAME=islandshield_db
     APP_DEBUG=true
     ```

4. **Start the server**
   - Place files in your web server directory (e.g., `htdocs`, `www`)
   - Access via browser: `http://localhost/islandshield-security/`

5. **Test the application**
   - Visit `check_db.php` to verify database connection
   - Register a new user account
   - Test login and dashboard access

---

## 📞 Contact Information

**IslandShield Security (Fictional Company)**
- **Phone:** (473) 555-SAFE
- **Emergency:** (473) 555-9111
- **Email:** info@islandshield.com
- **Location:** Bruce Street, Grenville, St. Andrew, Grenada

---

## 🎓 Academic Information

**Course:** Web Design  
**Institution:** T.A. Marryshow Community College (TAMCC)  
**Project Type:** Final Project - Academic Web Development  
**Year:** 2025

### Learning Objectives Demonstrated
- ✅ Responsive web design principles
- ✅ PHP backend development
- ✅ MySQL database integration
- ✅ User authentication systems
- ✅ Form handling and validation
- ✅ JavaScript interactivity
- ✅ Modern CSS techniques
- ✅ Security best practices
- ✅ Project documentation

---

## 📝 Development Notes

### Code Organization
- **Modular CSS** - Styles are split into logical files (base styles, layout, reusable components, page-specific) instead of one giant file
- **Reusable Components** - Header and footer are written once and included on every page, making updates easy
- **Clean Code** - Well-commented, properly indented, and organized so other developers can understand it
- **Best Practices** - Following industry standards and conventions that make the code maintainable and professi

### Future Enhancements
- Email notification system
- Payment gateway integration
- Admin panel for management
- Real-time chat support
- Mobile app integration
- Advanced analytics dashboard

---

## 📄 License

This is an academic project created for educational purposes at T.A. Marryshow Community College.

---

## 🙏 Acknowledgments

- Mr. Christopher Miginon Web Design education
- w3 and GeeksforGeeks
- Font Awesome for icons
- Google Fonts for typography
- PHP and MySQL communities for excellent documentation

---

**Built with ❤️**
