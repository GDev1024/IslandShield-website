<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!file_exists('includes/config.php')) {
    die('Config file not found');
}

require_once 'includes/config.php';

if (!isset($connection)) {
    die('Database connection not established');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = 'Please provide email and password';
        header('Location: login.php');
        exit;
    }
    
    $stmt = mysqli_prepare($connection, "SELECT user_id, first_name, last_name, email, password_hash, status FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    
    if ($user && password_verify($password, $user['password_hash'])) {
        
        if ($user['status'] !== 'active') {
            $_SESSION['error_message'] = 'Account is inactive. Please contact support.';
            header('Location: login.php');
            exit;
        }
        
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
        $_SESSION['logged_in'] = true;
        
        $update_stmt = mysqli_prepare($connection, "UPDATE users SET last_login = NOW() WHERE user_id = ?");
        mysqli_stmt_bind_param($update_stmt, "i", $user['user_id']);
        mysqli_stmt_execute($update_stmt);
        
        header('Location: dashboard.php');
        exit;
        
    } else {
        $_SESSION['error_message'] = 'Invalid email or password';
        header('Location: login.php');
        exit;
    }
    
} else {
    $_SESSION['error_message'] = 'Invalid request method';
    header('Location: login.php');
    exit;
}
?>
