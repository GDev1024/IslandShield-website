<?php
// Contact Form Handler

require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = trim($_POST['name'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validation
    $errors = [];
    
    if (empty($name) || strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($subject) || strlen($subject) < 3) {
        $errors[] = "Subject must be at least 3 characters";
    }
    
    if (empty($message) || strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters";
    }
    
    if (empty($errors)) {
        // Insert into database
        $stmt = mysqli_prepare($connection, "INSERT INTO contact_messages (name, email, phone, service, subject, message) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $phone, $service, $subject, $message);
        
        if (mysqli_stmt_execute($stmt)) {
            
            // Send email notification (optional)
            $to = "info@islandshield.com";
            $emailSubject = "New Contact Form: " . $subject;
            $emailBody = "
                Name: $name
                Email: $email
                Phone: $phone
                Service: $service
                
                Message:
                $message
            ";
            $headers = "From: noreply@islandshield.com\r\n";
            $headers .= "Reply-To: $email\r\n";
            
            mail($to, $emailSubject, $emailBody, $headers);
            
            echo json_encode([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully. We will contact you within 24 hours.'
            ]);
            
        } else {
            error_log("Contact form error: " . mysqli_error($connection));
            echo json_encode([
                'success' => false,
                'message' => 'Failed to send message. Please try again or call us directly.'
            ]);
        }
    } else {
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