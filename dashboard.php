<?php
session_start();
require_once 'includes/config.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}

// Get user data
$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];

// Get dashboard data
$stmt = mysqli_prepare($connection, "SELECT * FROM user_dashboard_summary WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$dashboardData = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

// Get cameras
$stmt = mysqli_prepare($connection, "SELECT * FROM cameras WHERE user_id = ? ORDER BY camera_id LIMIT 4");
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$cameras = mysqli_stmt_get_result($stmt);

// Get recent alerts
$stmt = mysqli_prepare($connection, "SELECT a.*, c.camera_name FROM alerts a LEFT JOIN cameras c ON a.camera_id = c.camera_id WHERE a.user_id = ? ORDER BY a.created_at DESC LIMIT 3");
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$alerts = mysqli_stmt_get_result($stmt);

// Get active services
$stmt = mysqli_prepare($connection, "SELECT * FROM services WHERE user_id = ? AND status = 'active'");
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$services = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - IslandShield Security</title>
  <!-- Modular CSS -->
  <link rel="stylesheet" href="assets/css/base.css">
  <link rel="stylesheet" href="assets/css/layout.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/pages/dashboard.css">
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
          <h3><?php echo htmlspecialchars($userName); ?></h3>
          <p><?php echo htmlspecialchars($userEmail); ?></p>
        </div>
        
        <nav class="dashboard-nav">
          <ul>
            <li>
              <a href="#overview" class="dashboard-nav-link active" data-section="overview">
                <span class="nav-icon">📊</span>
                <span class="nav-text">Overview</span>
              </a>
            </li>
            <li>
              <a href="#cameras" class="dashboard-nav-link" data-section="cameras">
                <span class="nav-icon">📹</span>
                <span class="nav-text">Live Cameras</span>
              </a>
            </li>
            <li>
              <a href="#alerts" class="dashboard-nav-link" data-section="alerts">
                <span class="nav-icon">🔔</span>
                <span class="nav-text">Alerts</span>
              </a>
            </li>
            <li>
              <a href="#activity" class="dashboard-nav-link" data-section="activity">
                <span class="nav-icon">📝</span>
                <span class="nav-text">Activity Log</span>
              </a>
            </li>
            <li>
              <a href="#services" class="dashboard-nav-link" data-section="services">
                <span class="nav-icon">🛡️</span>
                <span class="nav-text">My Services</span>
              </a>
            </li>
            <li>
              <a href="#billing" class="dashboard-nav-link" data-section="billing">
                <span class="nav-icon">💳</span>
                <span class="nav-text">Billing</span>
              </a>
            </li>
            <li>
              <a href="#settings" class="dashboard-nav-link" data-section="settings">
                <span class="nav-icon">⚙️</span>
                <span class="nav-text">Settings</span>
              </a>
            </li>
            <li>
              <a href="#support" class="dashboard-nav-link" data-section="support">
                <span class="nav-icon">💬</span>
                <span class="nav-text">Support</span>
              </a>
            </li>
          </ul>
        </nav>
        
        <div class="dashboard-logout">
          <a href="includes/logout_handler.php" class="btn-logout">
            <span class="logout-icon">🚪</span>
            <span class="logout-text">Log Out</span>
          </a>
        </div>
      </aside>
      
      <!-- Main Content -->
      <main class="dashboard-main">
        
        <!-- Welcome Header -->
        <div class="dashboard-header">
          <div class="welcome-content">
            <h1>Welcome Back, <?php echo htmlspecialchars(explode(' ', $userName)[0]); ?>! 👋</h1>
            <p>Here's your security overview for <?php echo date('l, F j, Y'); ?></p>
          </div>
          <div class="header-actions">
            <a href="tel:4735559111" class="btn-emergency-small">🚨 Emergency</a>
            <a href="contact.php" class="btn-contact-small">📞 Contact</a>
          </div>
        </div>
        
        <!-- Overview Section -->
        <div id="overview" class="dashboard-section-content active">
        
        <!-- Quick Stats Grid -->
        <div class="dashboard-stats-grid">
          <div class="stat-card stat-primary">
            <div class="stat-card-header">
              <span class="stat-label">Active Services</span>
              <span class="stat-icon-badge green">✓</span>
            </div>
            <div class="stat-card-body">
              <div class="stat-number"><?php echo $dashboardData['active_services'] ?? 0; ?></div>
              <div class="stat-description">Services running</div>
            </div>
          </div>
          
          <div class="stat-card stat-info">
            <div class="stat-card-header">
              <span class="stat-label">Cameras Online</span>
              <span class="stat-icon-badge blue">📹</span>
            </div>
            <div class="stat-card-body">
              <div class="stat-number"><?php echo ($dashboardData['cameras_online'] ?? 0); ?><span class="stat-total">/ <?php echo ($dashboardData['total_cameras'] ?? 0); ?></span></div>
              <div class="stat-description">Currently active</div>
            </div>
          </div>
          
          <div class="stat-card stat-warning">
            <div class="stat-card-header">
              <span class="stat-label">Alerts Today</span>
              <span class="stat-icon-badge yellow">🔔</span>
            </div>
            <div class="stat-card-body">
              <div class="stat-number"><?php echo $dashboardData['unread_alerts'] ?? 0; ?></div>
              <div class="stat-description">Notifications</div>
            </div>
          </div>
          
          <div class="stat-card stat-secondary">
            <div class="stat-card-header">
              <span class="stat-label">Total Cameras</span>
              <span class="stat-icon-badge purple">🛡️</span>
            </div>
            <div class="stat-card-body">
              <div class="stat-number"><?php echo $dashboardData['total_cameras'] ?? 0; ?></div>
              <div class="stat-description">Installed devices</div>
            </div>
          </div>
        </div>
        
        <!-- Two Column Layout -->
        <div class="dashboard-two-column">
          
          <!-- Left Column -->
          <div class="dashboard-column-left">
            
            <!-- Live Camera Grid -->
            <div class="dashboard-card">
              <div class="card-header">
                <h2>📹 Live Camera Feeds</h2>
                <a href="#" class="view-all-link">View All →</a>
              </div>
              
              <div class="camera-grid-enhanced">
                <?php 
                $cameraCount = mysqli_num_rows($cameras);
                if ($cameraCount > 0):
                  mysqli_data_seek($cameras, 0);
                  while ($camera = mysqli_fetch_assoc($cameras)): 
                    $statusClass = $camera['status'] === 'online' ? 'live' : 'offline';
                ?>
                <div class="camera-card-enhanced">
                  <div class="camera-preview">
                    <span class="camera-icon-large">📹</span>
                    <span class="live-badge <?php echo $statusClass; ?>">
                      <span class="pulse-dot"></span>
                      <?php echo strtoupper($camera['status']); ?>
                    </span>
                  </div>
                  <div class="camera-details">
                    <h4><?php echo htmlspecialchars($camera['camera_name']); ?></h4>
                    <p class="camera-location">📍 <?php echo htmlspecialchars($camera['location']); ?></p>
                    <span class="camera-quality">HD • 1080p</span>
                  </div>
                </div>
                <?php 
                  endwhile;
                else:
                ?>
                <div class="empty-state">
                  <div class="empty-icon">📹</div>
                  <h3>No Cameras Installed</h3>
                  <p>Add cameras to start monitoring your property</p>
                  <a href="cctv.php" class="btn-small">Browse CCTV Systems</a>
                </div>
                <?php endif; ?>
              </div>
            </div>
            
            <!-- Active Services -->
            <div class="dashboard-card">
              <div class="card-header">
                <h2>🛡️ Active Services</h2>
                <a href="services.php" class="btn-small-outline">+ Add Service</a>
              </div>
              
              <div class="services-list-enhanced">
                <?php 
                $serviceIcons = ['cctv' => '📹', 'personnel' => '🛡️', 'event' => '🎉', 'emergency' => '🚨'];
                $serviceCount = mysqli_num_rows($services);
                if ($serviceCount > 0):
                  mysqli_data_seek($services, 0);
                  while ($service = mysqli_fetch_assoc($services)): 
                    $icon = $serviceIcons[$service['service_type']] ?? '🛡️';
                    $statusClass = strtolower($service['status']);
                ?>
                <div class="service-card-enhanced">
                  <div class="service-icon-large"><?php echo $icon; ?></div>
                  <div class="service-info-enhanced">
                    <h4><?php echo htmlspecialchars($service['package_name'] ?? ucfirst($service['service_type'])); ?></h4>
                    <p class="service-type"><?php echo ucfirst($service['service_type']); ?> Service</p>
                    <div class="service-meta">
                      <span class="service-price">$<?php echo number_format($service['monthly_cost'], 2); ?>/mo</span>
                      <span class="service-status-badge <?php echo $statusClass; ?>"><?php echo ucfirst($service['status']); ?></span>
                    </div>
                  </div>
                  <button class="btn-icon-enhanced" title="Manage Service">⚙️</button>
                </div>
                <?php 
                  endwhile;
                else:
                ?>
                <div class="empty-state-compact">
                  <div class="empty-icon-small">📋</div>
                  <div class="empty-content">
                    <h4>No Active Services</h4>
                    <p>Explore our security services to get started</p>
                  </div>
                  <a href="services.php" class="btn-small">Browse Services</a>
                </div>
                <?php endif; ?>
              </div>
            </div>
            
          </div>
          
          <!-- Right Column -->
          <div class="dashboard-column-right">
            
            <!-- Recent Alerts -->
            <div class="dashboard-card">
              <div class="card-header">
                <h2>🔔 Recent Alerts</h2>
                <a href="#" class="view-all-link">View All →</a>
              </div>
              
              <div class="alerts-list-enhanced">
                <?php 
                $alertIcons = ['info' => 'ℹ️', 'warning' => '⚠️', 'critical' => '🚨'];
                $alertCount = mysqli_num_rows($alerts);
                if ($alertCount > 0):
                  mysqli_data_seek($alerts, 0);
                  while ($alert = mysqli_fetch_assoc($alerts)): 
                    $severityClass = 'alert-' . $alert['severity'];
                    $icon = $alertIcons[$alert['severity']] ?? 'ℹ️';
                    $timeAgo = time() - strtotime($alert['created_at']);
                    $timeStr = $timeAgo < 3600 ? floor($timeAgo/60) . ' min ago' : floor($timeAgo/3600) . ' hrs ago';
                ?>
                <div class="alert-card <?php echo $severityClass; ?>">
                  <div class="alert-icon-enhanced"><?php echo $icon; ?></div>
                  <div class="alert-details">
                    <h4><?php echo htmlspecialchars($alert['title']); ?></h4>
                    <p><?php echo htmlspecialchars($alert['message']); ?></p>
                    <span class="alert-timestamp">⏱️ <?php echo $timeStr; ?></span>
                  </div>
                </div>
                <?php 
                  endwhile;
                else:
                ?>
                <div class="alert-card alert-success">
                  <div class="alert-icon-enhanced">✅</div>
                  <div class="alert-details">
                    <h4>All Clear!</h4>
                    <p>No recent alerts. All systems operating normally.</p>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="dashboard-card">
              <div class="card-header">
                <h2>⚡ Quick Actions</h2>
              </div>
              
              <div class="quick-actions-grid">
                <a href="tel:4735559111" class="action-card action-emergency">
                  <div class="action-icon-large">📞</div>
                  <div class="action-info">
                    <h4>Emergency Call</h4>
                    <p>24/7 Hotline</p>
                  </div>
                </a>
                
                <a href="#cameras" class="action-card action-primary">
                  <div class="action-icon-large">📹</div>
                  <div class="action-info">
                    <h4>View Footage</h4>
                    <p>Camera recordings</p>
                  </div>
                </a>
                
                <a href="#" class="action-card action-secondary">
                  <div class="action-icon-large">📥</div>
                  <div class="action-info">
                    <h4>Download Report</h4>
                    <p>Activity logs</p>
                  </div>
                </a>
                
                <a href="contact.php" class="action-card action-info">
                  <div class="action-icon-large">💬</div>
                  <div class="action-info">
                    <h4>Contact Support</h4>
                    <p>Get help</p>
                  </div>
                </a>
              </div>
            </div>
            
          </div>
          
        </div>
        
      </main>
      
    </div>
  </div>
</section>

<!-- Footer -->
<?php include "includes/footer.php"; ?>


<script src="/assets/js/script.js"></script>
</body>
</html>