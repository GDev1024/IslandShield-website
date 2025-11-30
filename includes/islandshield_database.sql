-- ============================================
-- IslandShield Security Database Setup
-- ============================================

-- Create database
CREATE DATABASE IF NOT EXISTS islandshield_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE islandshield_db;

-- Users Table
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address VARCHAR(200),
    parish VARCHAR(50),
    property_type VARCHAR(50),
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    INDEX idx_email (email),
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- Contact Messages Table
CREATE TABLE contact_messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    service VARCHAR(50),
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'read', 'responded', 'archived') DEFAULT 'new',
    admin_notes TEXT,
    INDEX idx_status (status),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- Services Table
CREATE TABLE services (
    service_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    service_type ENUM('cctv', 'personnel', 'event', 'emergency') NOT NULL,
    package_name VARCHAR(100),
    status ENUM('active', 'inactive', 'pending', 'cancelled') DEFAULT 'pending',
    start_date DATE,
    end_date DATE,
    monthly_cost DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- Cameras Table
CREATE TABLE cameras (
    camera_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    camera_name VARCHAR(100) NOT NULL,
    location VARCHAR(200),
    status ENUM('online', 'offline', 'maintenance') DEFAULT 'online',
    last_online TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_user (user_id)
) ENGINE=InnoDB;

-- Alerts Table
CREATE TABLE alerts (
    alert_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    camera_id INT,
    alert_type ENUM('motion', 'unauthorized', 'system', 'other') NOT NULL,
    title VARCHAR(200) NOT NULL,
    message TEXT,
    severity ENUM('info', 'warning', 'critical') DEFAULT 'info',
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (camera_id) REFERENCES cameras(camera_id) ON DELETE SET NULL,
    INDEX idx_user (user_id),
    INDEX idx_read (is_read),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- Event Bookings Table
CREATE TABLE event_bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_name VARCHAR(200) NOT NULL,
    event_type VARCHAR(100),
    event_date DATE NOT NULL,
    event_location VARCHAR(200),
    guest_count INT,
    security_package VARCHAR(100),
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    total_cost DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_date (event_date)
) ENGINE=InnoDB;

-- Sample Data (for testing)

INSERT INTO users (first_name, last_name, email, phone, address, parish, property_type, password_hash) 
VALUES (
    'Garyson', 
    'Walker', 
    'garysonwalker@test.com', 
    '(473) 555-0123',
    '123 Main Street',
    'St. Andrew',
    'residential',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
);

-- Insert sample service for the user
INSERT INTO services (user_id, service_type, package_name, status, start_date, monthly_cost)
VALUES (1, 'cctv', 'Professional Package', 'active', CURDATE(), 75.00);

-- Insert sample cameras
INSERT INTO cameras (user_id, camera_name, location, status)
VALUES 
    (1, 'Front Entrance', 'Main Gate', 'online'),
    (1, 'Parking Lot', 'East Side', 'online'),
    (1, 'Back Gate', 'Rear Access', 'online'),
    (1, 'Side Entrance', 'West Side', 'online');

-- Insert sample alert
INSERT INTO alerts (user_id, camera_id, alert_type, title, message, severity)
VALUES (
    1, 
    1, 
    'motion', 
    'Motion Detected - Front Entrance',
    'Camera 01 detected movement at 2:45 PM',
    'info'
);

-- Insert sample contact message
INSERT INTO contact_messages (name, email, phone, service, subject, message)
VALUES (
    'Jaden Joseph',
    'jaden@test.com',
    '(473) 555-9876',
    'cctv',
    'Quote Request for CCTV System',
    'I would like to get a quote for installing a 6-camera system for my business.'
);

-- Create Views for Dashboard

-- View for user dashboard summary
CREATE VIEW user_dashboard_summary AS
SELECT 
    u.user_id,
    u.first_name,
    u.last_name,
    u.email,
    COUNT(DISTINCT s.service_id) as active_services,
    COUNT(DISTINCT c.camera_id) as total_cameras,
    SUM(CASE WHEN c.status = 'online' THEN 1 ELSE 0 END) as cameras_online,
    COUNT(DISTINCT CASE WHEN a.is_read = FALSE THEN a.alert_id END) as unread_alerts
FROM users u
LEFT JOIN services s ON u.user_id = s.user_id AND s.status = 'active'
LEFT JOIN cameras c ON u.user_id = c.user_id
LEFT JOIN alerts a ON u.user_id = a.user_id AND DATE(a.created_at) = CURDATE()
GROUP BY u.user_id;

-- Stored Procedures

DELIMITER //

-- Get user services
CREATE PROCEDURE GetUserServices(IN p_user_id INT)
BEGIN
    SELECT 
        service_type,
        package_name,
        status,
        start_date,
        monthly_cost
    FROM services
    WHERE user_id = p_user_id
    ORDER BY created_at DESC;
END //

-- Get recent alerts
CREATE PROCEDURE GetRecentAlerts(IN p_user_id INT, IN p_limit INT)
BEGIN
    SELECT 
        a.alert_type,
        a.title,
        a.message,
        a.severity,
        a.is_read,
        a.created_at,
        c.camera_name
    FROM alerts a
    LEFT JOIN cameras c ON a.camera_id = c.camera_id
    WHERE a.user_id = p_user_id
    ORDER BY a.created_at DESC
    LIMIT p_limit;
END //

DELIMITER ;

-- Additional composite indexes
CREATE INDEX idx_user_status ON services(user_id, status);
CREATE INDEX idx_user_date ON alerts(user_id, created_at);
CREATE INDEX idx_camera_status ON cameras(user_id, status);