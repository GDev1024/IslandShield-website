<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - IslandShield Security</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Header / Nav -->
<?php include "includes/header.php"; ?>

<!-- Dashboard Content -->
<section class="dashboard-section">
  <div class="container">
    <div class="dashboard-layout">
      
      <!-- Sidebar -->
      <aside class="dashboard-sidebar">
        <div class="user-profile">
          <div class="user-avatar">👤</div>
          <h3>John Doe</h3>
          <p>john.doe@example.com</p>
        </div>
        
        <nav class="dashboard-nav">
          <ul>
            <li><a href="#overview" class="active">📊 Overview</a></li>
            <li><a href="#cameras">📹 Live Cameras</a></li>
            <li><a href="#alerts">🔔 Alerts</a></li>
            <li><a href="#activity">📝 Activity Log</a></li>
            <li><a href="#services">🛡️ My Services</a></li>
            <li><a href="#billing">💳 Billing</a></li>
            <li><a href="#settings">⚙️ Settings</a></li>
            <li><a href="#support">💬 Support</a></li>
          </ul>
        </nav>
      </aside>
      
      <!-- Main Content -->
      <main class="dashboard-main">
        
        <!-- Welcome Header -->
        <div class="dashboard-header">
          <h1>Welcome Back, John!</h1>
          <p>Here's your security overview for today</p>
        </div>
        
        <!-- Quick Stats -->
        <div class="dashboard-stats">
          <div class="stat-widget">
            <div class="stat-icon green">✓</div>
            <div class="stat-info">
              <h3>System Status</h3>
              <p class="stat-value">All Active</p>
            </div>
          </div>
          
          <div class="stat-widget">
            <div class="stat-icon blue">📹</div>
            <div class="stat-info">
              <h3>Cameras Online</h3>
              <p class="stat-value">8/8</p>
            </div>
          </div>
          
          <div class="stat-widget">
            <div class="stat-icon yellow">🔔</div>
            <div class="stat-info">
              <h3>Alerts Today</h3>
              <p class="stat-value">3</p>
            </div>
          </div>
          
          <div class="stat-widget">
            <div class="stat-icon purple">👮</div>
            <div class="stat-info">
              <h3>On-Duty Guards</h3>
              <p class="stat-value">2</p>
            </div>
          </div>
        </div>
        
        <!-- Live Camera Grid -->
        <div class="dashboard-section-content">
          <div class="section-header">
            <h2>Live Camera Feeds</h2>
            <a href="#" class="view-all-link">View All →</a>
          </div>
          
          <div class="camera-grid">
            <div class="camera-card">
              <div class="camera-placeholder">
                <span class="camera-icon">📹</span>
                <span class="live-indicator">● LIVE</span>
              </div>
              <div class="camera-info">
                <h3>Front Entrance</h3>
                <p>Camera 01 • HD</p>
              </div>
            </div>
            
            <div class="camera-card">
              <div class="camera-placeholder">
                <span class="camera-icon">📹</span>
                <span class="live-indicator">● LIVE</span>
              </div>
              <div class="camera-info">
                <h3>Parking Lot</h3>
                <p>Camera 02 • HD</p>
              </div>
            </div>
            
            <div class="camera-card">
              <div class="camera-placeholder">
                <span class="camera-icon">📹</span>
                <span class="live-indicator">● LIVE</span>
              </div>
              <div class="camera-info">
                <h3>Back Gate</h3>
                <p>Camera 03 • HD</p>
              </div>
            </div>
            
            <div class="camera-card">
              <div class="camera-placeholder">
                <span class="camera-icon">📹</span>
                <span class="live-indicator">● LIVE</span>
              </div>
              <div class="camera-info">
                <h3>Side Entrance</h3>
                <p>Camera 04 • HD</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Recent Alerts -->
        <div class="dashboard-section-content">
          <div class="section-header">
            <h2>Recent Alerts</h2>
            <a href="#" class="view-all-link">View All →</a>
          </div>
          
          <div class="alerts-list">
            <div class="alert-item alert-info">
              <div class="alert-icon">ℹ️</div>
              <div class="alert-content">
                <h4>Motion Detected - Front Entrance</h4>
                <p>Camera 01 detected movement at 2:45 PM</p>
                <span class="alert-time">15 minutes ago</span>
              </div>
            </div>
            
            <div class="alert-item alert-warning">
              <div class="alert-icon">⚠️</div>
              <div class="alert-content">
                <h4>Unauthorized Access Attempt</h4>
                <p>Back Gate sensor triggered at 11:30 AM</p>
                <span class="alert-time">3 hours ago</span>
              </div>
            </div>
            
            <div class="alert-item alert-success">
              <div class="alert-icon">✓</div>
              <div class="alert-content">
                <h4>Security Patrol Completed</h4>
                <p>Officer Mitchell completed scheduled patrol</p>
                <span class="alert-time">5 hours ago</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Active Services -->
        <div class="dashboard-section-content">
          <div class="section-header">
            <h2>Active Services</h2>
            <a href="#" class="btn-small">Request Service</a>
          </div>
          
          <div class="services-list">
            <div class="service-item">
              <div class="service-icon">📹</div>
              <div class="service-details">
                <h3>CCTV Monitoring</h3>
                <p>24/7 Professional Monitoring</p>
                <span class="service-status active">Active</span>
              </div>
              <div class="service-actions">
                <button class="btn-icon">⚙️</button>
              </div>
            </div>
            
            <div class="service-item">
              <div class="service-icon">🛡️</div>
              <div class="service-details">
                <h3>Security Personnel</h3>
                <p>2 Officers on Duty • Night Shift</p>
                <span class="service-status active">Active</span>
              </div>
              <div class="service-actions">
                <button class="btn-icon">⚙️</button>
              </div>
            </div>
            
            <div class="service-item">
              <div class="service-icon">☁️</div>
              <div class="service-details">
                <h3>Cloud Storage</h3>
                <p>30-Day Retention • 45% Used</p>
                <span class="service-status active">Active</span>
              </div>
              <div class="service-actions">
                <button class="btn-icon">⚙️</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="dashboard-section-content">
          <h2>Quick Actions</h2>
          <div class="quick-actions">
            <button class="action-btn">
              <span class="action-icon">📞</span>
              <span class="action-text">Emergency Call</span>
            </button>
            <button class="action-btn">
              <span class="action-icon">📹</span>
              <span class="action-text">View Footage</span>
            </button>
            <button class="action-btn">
              <span class="action-icon">📊</span>
              <span class="action-text">Download Report</span>
            </button>
            <button class="action-btn">
              <span class="action-icon">💬</span>
              <span class="action-text">Contact Support</span>
            </button>
          </div>
        </div>
        
      </main>
      
    </div>
  </div>
</section>

<!-- Footer -->
<?php include "includes/footer.php"; ?>


<script src="assets/js/script.js"></script>
</body>
</html>