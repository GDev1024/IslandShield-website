<?php
// Get dashboard data for logged-in user

require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode([
        'error' => 'Not authenticated'
    ]);
    exit;
}

$userId = $_SESSION['user_id'];

try {
    // Get user services
    $stmt = $pdo->prepare("
        SELECT service_type, status, start_date 
        FROM services 
        WHERE user_id = ? AND status = 'active'
    ");
    $stmt->execute([$userId]);
    $services = $stmt->fetchAll();
    
    // Get recent alerts (example - you'd need to create alerts table)
    $alerts = [
        [
            'type' => 'info',
            'title' => 'Motion Detected - Front Entrance',
            'message' => 'Camera 01 detected movement',
            'time' => '15 minutes ago'
        ]
    ];
    
    // Get camera stats
    $cameraStats = [
        'online' => 8,
        'total' => 8,
        'alerts_today' => 3
    ];
    
    echo json_encode([
        'success' => true,
        'user' => [
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email']
        ],
        'services' => $services,
        'alerts' => $alerts,
        'cameras' => $cameraStats
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to load dashboard data'
    ]);
}