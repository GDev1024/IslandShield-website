<?php
// User Login Handler

require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'Please provide email and password'
        ]);
        exit;
    }
    
    try {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Get user from database
        $stmt = $connection->prepare("
            SELECT user_id, first_name, last_name, email, password_hash, status 
            FROM users 
            WHERE email = :email
        ");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password_hash'])) {
            
            if ($user['status'] !== 'active') {
                echo json_encode([
                    'success' => false,
                    'message' => 'Account is inactive. Please contact support.'
                ]);
                exit;
            }
            
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['logged_in'] = true;
            
            // Update last login
            $stmt = $connection->prepare("UPDATE users SET last_login = NOW() WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $user['user_id']]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Login successful!',
                'redirect' => 'dashboard.php',
                'user' => [
                    'name' => $_SESSION['user_name'],
                    'email' => $_SESSION['user_email']
                ]
            ]);
            
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid email or password'
            ]);
        }
        
    } catch(PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => 'Login failed. Please try again.'
        ]);
    }
    
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}