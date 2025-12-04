<?php
require_once 'config.php';

header('Content-Type: application/json');

// Enable error logging
error_log("Registration handler called - Method: " . $_SERVER['REQUEST_METHOD']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get and sanitize input
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $parish = trim($_POST['parish'] ?? '');
    $propertyType = trim($_POST['propertyType'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    
    error_log("Registration attempt for email: " . $email);
    
    // Validation
    $errors = [];
    
    // First name validation
    if (empty($firstName) || strlen($firstName) < 2) {
        $errors[] = "First name must be at least 2 characters";
    }
    
    // Last name validation
    if (empty($lastName) || strlen($lastName) < 2) {
        $errors[] = "Last name must be at least 2 characters";
    }
    
    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // Phone validation
    if (empty($phone)) {
        $errors[] = "Phone number is required";
    }
    
    // Address validation
    if (empty($address)) {
        $errors[] = "Address is required";
    }
    
    // Parish validation
    if (empty($parish)) {
        $errors[] = "Please select a parish";
    }
    
    // Property type validation
    if (empty($propertyType)) {
        $errors[] = "Please select a property type";
    }
    
    // Password validation
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }
    
    // Password match validation
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    // Check if email already exists
    if (empty($errors)) {
        $stmt = mysqli_prepare($connection, "SELECT user_id FROM users WHERE email = ?");
        if (!$stmt) {
            error_log("Database prepare error: " . mysqli_error($connection));
            $errors[] = "Database error. Please try again later.";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            if (!mysqli_stmt_execute($stmt)) {
                error_log("Execute error: " . mysqli_stmt_error($stmt));
                $errors[] = "Database error. Please try again.";
            } else {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_fetch_assoc($result)) {
                    $errors[] = "An account with this email already exists";
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // If validation passes, insert user
    if (empty($errors)) {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        error_log("Attempting to insert user: " . $email);
        
        $stmt = mysqli_prepare($connection, 
            "INSERT INTO users (first_name, last_name, email, phone, address, parish, property_type, password_hash) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        
        if (!$stmt) {
            error_log("Prepare failed: " . mysqli_error($connection));
            echo json_encode([
                'success' => false,
                'message' => 'Database error occurred. Please contact support.'
            ]);
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssss", 
                $firstName, $lastName, $email, $phone, $address, $parish, $propertyType, $hashedPassword
            );
            
            if (mysqli_stmt_execute($stmt)) {
                $userId = mysqli_insert_id($connection);
                error_log("Registration successful - User ID: " . $userId . ", Email: " . $email);
                
                // Optional: Send welcome email
                $to = $email;
                $subject = "Welcome to IslandShield Security";
                $message = "Dear $firstName $lastName,\n\nThank you for registering with IslandShield Security. Your account has been created successfully.\n\nYou can now log in at: " . BASE_URL . "login.php\n\nBest regards,\nIslandShield Security Team";
                $headers = "From: noreply@islandshield.com\r\n";
                @mail($to, $subject, $message, $headers);
                
                echo json_encode([
                    'success' => true,
                    'message' => 'Account created successfully! Redirecting to login...',
                    'redirect' => 'login.php'
                ]);
            } else {
                $error = mysqli_stmt_error($stmt);
                error_log("Insert failed: " . $error);
                
                // Check for duplicate email (shouldn't happen due to earlier check, but just in case)
                if (strpos($error, 'Duplicate entry') !== false) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'An account with this email already exists'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to create account. Please try again or contact support.'
                    ]);
                }
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        // Return validation errors
        error_log("Validation errors: " . implode(', ', $errors));
        echo json_encode([
            'success' => false,
            'errors' => $errors
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
?>