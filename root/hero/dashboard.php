<?php
$page_title = "Dashboard - IslandShield Security";
require_once __DIR__ . '/../database/config.php';
require_once __DIR__ . '/../database/auth.php';

requireLogin();

$user = getUserData();

// Get user's service requests
$stmt = $pdo->prepare("SELECT * FROM service_requests WHERE user_id = ? ORDER BY request_date DESC");
$stmt->execute([$_SESSION['user_id']]);
$requests = $stmt->fetchAll();

require_once __DIR__ . '/../functions/header.php';
?>

<div class="dashboard-page py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="dashboard-sidebar">
                    <div class="sidebar-header">
                        <i class="fas fa-user-circle fa-3x text-primary mb-2"></i>
                        <h5><?php echo htmlspecialchars($user['name']); ?></h5>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['email']); ?></p>
                        <?php if ($user['role'] === 'admin'): ?>
                            <span class="badge bg-danger mt-2">Administrator</span>
                        <?php endif; ?>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="active"><a href="#overview"><i class="fas fa-tachometer-alt me-2"></i>Overview</a></li>
                        <li><a href="#requests"><i class="fas fa-list me-2"></i>Service Requests</a></li>
                        <li><a href="#profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a href="#security"><i class="fas fa-lock me-2"></i>Security</a></li>
                        <li><a href="../functions/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <!-- Welcome Section -->
                <div class="dashboard-card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-tachometer-alt me-2"></i>Dashboard Overview</h4>
                    </div>
                    <div class="card-body">
                        <h2>Welcome back, <?php echo htmlspecialchars($user['name']); ?>!</h2>
                        <p class="text-muted">Here's an overview of your security account.</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="stat-card">
                            <i class="fas fa-clipboard-list"></i>
                            <h3><?php echo count($requests); ?></h3>
                            <p>Service Requests</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="stat-card">
                            <i class="fas fa-shield-alt"></i>
                            <h3>Active</h3>
                            <p>Account Status</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="stat-card">
                            <i class="fas fa-clock"></i>
                            <h3>24/7</h3>
                            <p>Support Available</p>
                        </div>
                    </div>
                </div>

                <!-- Service Requests -->
                <div class="dashboard-card" id="requests">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-list me-2"></i>Your Service Requests</h5>
                        <a href="services.php" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus me-2"></i>New Request
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if (count($requests) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Service Type</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($requests as $req): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($req['service_type']); ?></strong></td>
                                            <td><?php echo htmlspecialchars(substr($req['description'], 0, 50)); ?>...</td>
                                            <td><?php echo date('M d, Y', strtotime($req['request_date'])); ?></td>
                                            <td>
                                                <?php
                                                $statusClass = 'secondary';
                                                if ($req['status'] === 'pending') $statusClass = 'warning';
                                                elseif ($req['status'] === 'approved') $statusClass = 'success';
                                                elseif ($req['status'] === 'completed') $statusClass = 'info';
                                                ?>
                                                <span class="badge bg-<?php echo $statusClass; ?>">
                                                    <?php echo ucfirst($req['status']); ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No service requests yet.</p>
                                <a href="services.php" class="btn btn-primary">Request a Service</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../functions/footer.php'; ?>
