<?php
$page_title = "Contact Us - IslandShield Security";
require_once __DIR__ . '/../database/config.php';
require_once __DIR__ . '/../database/auth.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'Please fill in all fields';
    } else {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        
        if ($stmt->execute([$name, $email, $subject, $message])) {
            $success = 'Thank you! Your message has been sent successfully.';
        } else {
            $error = 'Failed to send message. Please try again.';
        }
    }
}

require_once __DIR__ . '/../functions/header.php';
?>

<section class="contact-page py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Contact Us</h2>
            <p>Get in touch with our security experts</p>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="contact-form-card">
                    <h4 class="mb-4">Send us a Message</h4>

                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <select class="form-control" id="subject" name="subject" required>
                                <option value="">Select a subject</option>
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="CCTV Installation">CCTV Installation</option>
                                <option value="Security Personnel">Security Personnel</option>
                                <option value="Event Security">Event Security</option>
                                <option value="Quote Request">Quote Request</option>
                                <option value="Support">Support</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-info-card mb-4">
                    <h4 class="mb-4">Contact Information</h4>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h6>Address</h6>
                            <p>Grenville, St. Andrew Parish<br>Grenada</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h6>Phone</h6>
                            <p>(473) 555-SAFE<br>(473) 555-7233</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h6>Email</h6>
                            <p>info@islandshield.com<br>support@islandshield.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h6>Hours</h6>
                            <p>24/7 Emergency Response<br>Mon-Fri: 8AM - 6PM (Office)</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-card">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h5>Emergency?</h5>
                    <p>For urgent security situations, call our 24/7 hotline</p>
                    <a href="tel:4735557233" class="btn btn-danger w-100">
                        <i class="fas fa-phone me-2"></i>Call Emergency Line
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../functions/footer.php'; ?>