-- ============================================
-- IslandShield Security Database Setup (PostgreSQL)
-- ============================================

-- Note: Database creation is handled by Render
-- Connect to your database before running this script

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    user_id SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address VARCHAR(200),
    parish VARCHAR(50),
    property_type VARCHAR(50),
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    last_login TIMESTAMP NULL,
    status VARCHAR(20) DEFAULT 'active' CHECK (status IN ('active', 'inactive', 'suspended'))
);

CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);
CREATE INDEX IF NOT EXISTS idx_users_status ON users(status);

-- Contact Messages Table
CREATE TABLE IF NOT EXISTS contact_messages (
    message_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    service VARCHAR(50),
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    status VARCHAR(20) DEFAULT 'new' CHECK (status IN ('new', 'read', 'responded', 'archived')),
    admin_notes TEXT
);

CREATE INDEX IF NOT EXISTS idx_contact_status ON contact_messages(status);
CREATE INDEX IF NOT EXISTS idx_contact_created ON contact_messages(created_at);

-- Services Table
CREATE TABLE IF NOT EXISTS services (
    service_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    service_type VARCHAR(20) NOT NULL CHECK (service_type IN ('cctv', 'personnel', 'event', 'emergency')),
    package_name VARCHAR(100),
    status VARCHAR(20) DEFAULT 'pending' CHECK (status IN ('active', 'inactive', 'pending', 'cancelled')),
    start_date DATE,
    end_date DATE,
    monthly_cost DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_services_user ON services(user_id);
CREATE INDEX IF NOT EXISTS idx_services_status ON services(status);
CREATE INDEX IF NOT EXISTS idx_services_user_status ON services(user_id, status);

-- Cameras Table
CREATE TABLE IF NOT EXISTS cameras (
    camera_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    camera_name VARCHAR(100) NOT NULL,
    location VARCHAR(200),
    status VARCHAR(20) DEFAULT 'online' CHECK (status IN ('online', 'offline', 'maintenance')),
    last_online TIMESTAMP DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_cameras_user ON cameras(user_id);
CREATE INDEX IF NOT EXISTS idx_cameras_user_status ON cameras(user_id, status);

-- Trigger to update last_online timestamp
CREATE OR REPLACE FUNCTION update_camera_last_online()
RETURNS TRIGGER AS $$
BEGIN
    NEW.last_online = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_update_camera_last_online
BEFORE UPDATE ON cameras
FOR EACH ROW
EXECUTE FUNCTION update_camera_last_online();

-- Alerts Table
CREATE TABLE IF NOT EXISTS alerts (
    alert_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    camera_id INTEGER REFERENCES cameras(camera_id) ON DELETE SET NULL,
    alert_type VARCHAR(20) NOT NULL CHECK (alert_type IN ('motion', 'unauthorized', 'system', 'other')),
    title VARCHAR(200) NOT NULL,
    message TEXT,
    severity VARCHAR(20) DEFAULT 'info' CHECK (severity IN ('info', 'warning', 'critical')),
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_alerts_user ON alerts(user_id);
CREATE INDEX IF NOT EXISTS idx_alerts_read ON alerts(is_read);
CREATE INDEX IF NOT EXISTS idx_alerts_created ON alerts(created_at);
CREATE INDEX IF NOT EXISTS idx_alerts_user_date ON alerts(user_id, created_at);

-- Event Bookings Table
CREATE TABLE IF NOT EXISTS event_bookings (
    booking_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    event_name VARCHAR(200) NOT NULL,
    event_type VARCHAR(100),
    event_date DATE NOT NULL,
    event_location VARCHAR(200),
    guest_count INTEGER,
    security_package VARCHAR(100),
    status VARCHAR(20) DEFAULT 'pending' CHECK (status IN ('pending', 'confirmed', 'completed', 'cancelled')),
    total_cost DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT NOW()
);

CREATE INDEX IF NOT EXISTS idx_bookings_user ON event_bookings(user_id);
CREATE INDEX IF NOT EXISTS idx_bookings_date ON event_bookings(event_date);

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
) ON CONFLICT (email) DO NOTHING;

-- Insert sample service for the user
INSERT INTO services (user_id, service_type, package_name, status, start_date, monthly_cost)
VALUES (1, 'cctv', 'Professional Package', 'active', CURRENT_DATE, 75.00);

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

-- Create View for Dashboard

CREATE OR REPLACE VIEW user_dashboard_summary AS
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
LEFT JOIN alerts a ON u.user_id = a.user_id AND DATE(a.created_at) = CURRENT_DATE
GROUP BY u.user_id, u.first_name, u.last_name, u.email;

-- Stored Functions (PostgreSQL equivalent of procedures)

-- Get user services
CREATE OR REPLACE FUNCTION get_user_services(p_user_id INTEGER)
RETURNS TABLE (
    service_type VARCHAR,
    package_name VARCHAR,
    status VARCHAR,
    start_date DATE,
    monthly_cost DECIMAL
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        s.service_type,
        s.package_name,
        s.status,
        s.start_date,
        s.monthly_cost
    FROM services s
    WHERE s.user_id = p_user_id
    ORDER BY s.created_at DESC;
END;
$$ LANGUAGE plpgsql;

-- Get recent alerts
CREATE OR REPLACE FUNCTION get_recent_alerts(p_user_id INTEGER, p_limit INTEGER)
RETURNS TABLE (
    alert_type VARCHAR,
    title VARCHAR,
    message TEXT,
    severity VARCHAR,
    is_read BOOLEAN,
    created_at TIMESTAMP,
    camera_name VARCHAR
) AS $$
BEGIN
    RETURN QUERY
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
END;
$$ LANGUAGE plpgsql;

-- Grant permissions (adjust username as needed)
-- GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO islandshield_user;
-- GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO islandshield_user;
-- GRANT EXECUTE ON ALL FUNCTIONS IN SCHEMA public TO islandshield_user;
