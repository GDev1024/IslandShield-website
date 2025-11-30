# 🛡️ IslandShield Security

Professional security solutions website built with PHP, MySQL, and modern web technologies.

## 🌟 Features

- **Modern UI/UX** - Responsive design with smooth animations
- **Service Pages** - CCTV, Security Personnel, Event Security, Emergency Response
- **User Authentication** - Login/Register system
- **Contact Forms** - Integrated contact and inquiry forms
- **Dashboard** - Client dashboard for managing services
- **FAQ Section** - Comprehensive help and support
- **Resources** - Security guides and educational content

## 🚀 Quick Start

### Local Development with Docker

```bash
# Clone the repository
git clone https://github.com/YOUR_USERNAME/islandshield-security.git
cd islandshield-security

# Make start script executable
chmod +x start.sh

# Run setup
./start.sh

# Access the application
# Website: http://localhost:8080
# phpMyAdmin: http://localhost:8081
```

### Manual Setup

```bash
# Start Docker containers
docker-compose up -d

# Import database
docker-compose exec -T db mysql -uislandshield_user -psecure_password islandshield_db < includes/islandshield_database.sql

# View logs
docker-compose logs -f web
```

## 📦 Deployment to Render

See [DEPLOYMENT.md](DEPLOYMENT.md) for detailed deployment instructions.

**Quick Deploy:**
1. Push code to GitHub
2. Connect repository to Render
3. Configure environment variables
4. Deploy!

## 🛠️ Tech Stack

- **Backend**: PHP 8.2
- **Database**: MySQL 8.0
- **Server**: Apache
- **Frontend**: HTML5, CSS3, JavaScript
- **Containerization**: Docker
- **Deployment**: Render

## 📁 Project Structure

```
islandshield-security/
├── assets/
│   ├── css/          # Stylesheets
│   ├── js/           # JavaScript files
│   └── images/       # Images and media
├── includes/
│   ├── config.php    # Database configuration
│   ├── header.php    # Site header
│   ├── footer.php    # Site footer
│   └── *_handler.php # Form handlers
├── *.php             # Page files
├── Dockerfile        # Docker configuration
├── docker-compose.yml
├── render.yaml       # Render deployment config
└── README.md
```

## 🔧 Configuration

### Environment Variables

Create a `.env` file:

```env
DB_HOST=localhost
DB_NAME=islandshield_db
DB_USER=islandshield_user
DB_PASSWORD=your_password
APP_ENV=production
APP_DEBUG=false
```

### Database Setup

The database schema is located in `includes/islandshield_database.sql`

## 🧪 Testing

```bash
# Run local tests
docker-compose up -d

# Check logs
docker-compose logs -f

# Stop containers
docker-compose down
```

## 📝 Pages

- **Home** (`index.php`) - Landing page with hero section
- **About** (`about.php`) - Company information
- **Services** (`services.php`) - Service overview
- **CCTV** (`cctv.php`) - CCTV installation details
- **Personnel** (`personnel.php`) - Security guard services
- **Event** (`event.php`) - Event security services
- **Emergency** (`emergency.php`) - Emergency response
- **Contact** (`contact.php`) - Contact form
- **FAQ** (`faq.php`) - Frequently asked questions
- **Resources** (`resources.php`) - Security guides
- **Login/Register** - User authentication
- **Dashboard** - Client portal

## 🔐 Security Features

- ✅ Prepared SQL statements (SQL injection prevention)
- ✅ Password hashing
- ✅ Session management
- ✅ Input validation
- ✅ HTTPS ready
- ✅ Secure cookies in production

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support, email info@islandshield.com or call (473) 555-SAFE

## 🎉 Acknowledgments

- Font Awesome for icons
- Google Fonts for typography
- Render for hosting platform

---

**Built with ❤️ for IslandShield Security**
