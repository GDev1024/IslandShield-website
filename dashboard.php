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
          <h3><?php echo htmlspecialchars($userName); ?></h3>
          <p><?php echo htmlspecialchars($userEmail); ?></p>
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
          <h1>Welcome Back, <?php echo htmlspecialchars(explode(' ', $userName)[0]); ?>!</h1>
          <p>Here's your security overview for today</p>
        </div>
        
        <!-- Quick Stats -->
        <div class="dashboard-stats">
          <div class="stat-widget">
            <div class="stat-icon green">✓</div>
            <div class="stat-info">
              <h3>Active Services</h3>
              <p class="stat-value"><?php echo $dashboardData['active_services'] ?? 0; ?></p>
            </div>
          </div>
          
          <div class="stat-widget">
            <div class="stat-icon blue">📹</div>
            <div class="stat-info">
              <h3>Cameras Online</h3>
              <p class="stat-value"><?php echo ($dashboardData['cameras_online'] ?? 0) . '/' . ($dashboardData['total_cameras'] ?? 0); ?></p>
            </div>
          </div>
          
          <div class="stat-widget">
            <div class="stat-icon yellow">🔔</div>
            <div class="stat-info">
              <h3>Alerts Today</h3>
              <p class="stat-value"><?php echo $dashboardData['unread_alerts'] ?? 0; ?></p>
            </div>
          </div>
          
          <div class="stat-widget">
            <div class="stat-icon purple">🛡️�<️</div>
            <div class="stat-info">
              <h3>Total Cameras</h3>
              <p class="stat-value"><?php echo $dashboardData['total_cameras'] ?? 0; ?></p>
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
            <?php 
            $cameraNum = 1;
            while ($camera = mysqli_fetch_assoc($cameras)): 
              $statusClass = $camera['status'] === 'online' ? 'live' : 'offline';
            ?>
            <div class="camera-card">
              <div class="camera-placeholder">
                <span class="camera-icon">📹</span>
                <span class="live-indicator <?php echo $statusClass; ?>">● <?php echo strtoupper($camera['status']); ?></span>
              </div>
              <div class="camera-info">
                <h3><?php echo htmlspecialchars($camera['camera_name']); ?></h3>
                <p><?php echo htmlspecialchars($camera['location']); ?> • HD</p>
              </div>
            </div>
            <?php 
            $cameraNum++;
            endwhile; 
            ?>
          </div>
        </div>
        
        <!-- Recent Alerts -->
        <div class="dashboard-section-content">
          <div class="section-header">
            <h2>Recent Alerts</h2>
            <a href="#" class="view-all-link">View All →</a>
          </div>
          
          <div class="alerts-list">
            <?php 
            $alertIcons = ['info' => 'ℹ️', 'warning' => '⚠️', 'critical' => '🚨'];
            while ($alert = mysqli_fetch_assoc($alerts)): 
              $severityClass = 'alert-' . $alert['severity'];
              $icon = $alertIcons[$alert['severity']] ?? 'ℹ️';
              $timeAgo = time() - strtotime($alert['created_at']);
              $timeStr = $timeAgo < 3600 ? floor($timeAgo/60) . ' minutes ago' : floor($timeAgo/3600) . ' hours ago';
            ?>
            <div class="alert-item <?php echo $severityClass; ?>">
              <div class="alert-icon"><?php echo $icon; ?></div>
              <div class="alert-content">
                <h4><?php echo htmlspecialchars($alert['title']); ?></h4>
                <p><?php echo htmlspecialchars($alert['message']); ?></p>
                <span class="alert-time"><?php echo $timeStr; ?></span>
              </div>
            </div>
            <?php endwhile; ?>
            <?php if (mysqli_num_rows($alerts) == 0): ?>
            <div class="alert-item alert-info">
              <div class="alert-icon">✓</div>
              <div class="alert-content">
                <h4>No Recent Alerts</h4>
                <p>All systems operating normally</p>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
        
        <!-- Active Services -->
        <div class="dashboard-section-content">
          <div class="section-header">
            <h2>Active Services</h2>
            <a href="#" class="btn-small">Request Service</a>
          </div>
          
          <div class="services-list">
            <?php 
            $serviceIcons = ['cctv' => '📹', 'personnel' => '🛡️', 'event' => '🎉', 'emergency' => '🚨'];
            while ($service = mysqli_fetch_assoc($services)): 
              $icon = $serviceIcons[$service['service_type']] ?? '🛡️';
              $statusClass = strtolower($service['status']);
            ?>
            <div class="service-item">
              <div class="service-icon"><?php echo $icon; ?></div>
              <div class="service-details">
                <h3><?php echo htmlspecialchars($service['package_name'] ?? ucfirst($service['service_type'])); ?></h3>
                <p><?php echo ucfirst($service['service_type']); ?> Service • $<?php echo number_format($service['monthly_cost'], 2); ?>/month</p>
                <span class="service-status <?php echo $statusClass; ?>"><?php echo ucfirst($service['status']); ?></span>
              </div>
              <div class="service-actions">
                <button class="btn-icon">⚙️</button>
              </div>
            </div>
            <?php endwhile; ?>
            <?php if (mysqli_num_rows($services) == 0): ?>
            <div class="service-item">
              <div class="service-icon">📋</div>
              <div class="service-details">
                <h3>No Active Services</h3>
                <p>Request a service to get started</p>
              </div>
            </div>
            <?php endif; ?>
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
              <span class="action-icon">📥</span>
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