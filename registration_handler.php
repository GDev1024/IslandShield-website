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
    
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $parish = trim($_POST['parish'] ?? '');
    $propertyType = trim($_POST['propertyType'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    
    $errors = [];
    
    if (empty($firstName) || strlen($firstName) < 2) {
        $errors[] = "First name must be at least 2 characters";
    }
    
    if (empty($lastName) || strlen($lastName) < 2) {
        $errors[] = "Last name must be at least 2 characters";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }
    
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    if (empty($errors)) {
        $stmt = mysqli_prepare($connection, "SELECT user_id FROM users WHERE email = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_fetch_assoc($result)) {
                $errors[] = "Email already registered";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = mysqli_prepare($connection, "INSERT INTO users (first_name, last_name, email, phone, address, parish, property_type, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssss", $firstName, $lastName, $email, $phone, $address, $parish, $propertyType, $hashedPassword);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success_message'] = 'Registration successful! Please log in.';
                header('Location: login.php');
                exit;
            } else {
                $_SESSION['error_message'] = 'Registration failed. Please try again.';
                header('Location: register.php');
                exit;
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        $_SESSION['error_message'] = implode(', ', $errors);
        header('Location: register.php');
        exit;
    }
} else {
    $_SESSION['error_message'] = 'Invalid request method';
    header('Location: register.php');
    exit;
}
?>
