<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

// Get form data
$firstName = $_POST['firstName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'patrasagarika654@gmail.com'; // Your Gmail address
    $mail->Password   = 'jshf iluj zotb yatn';         // App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Sender & recipient
    $mail->setFrom('patrasagarika654@gmail.com', 'Website Contact Form');
    $mail->addAddress('patrasagarika654@gmail.com'); // You can change this to another receiver

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Message from Contact Form';
    $mail->Body    = "
        <h3>New Contact Form Submission</h3>
        <p><strong>First Name:</strong> {$firstName}</p>
        <p><strong>Last Name:</strong> {$lastName}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

    $mail->send();
    header('Location: thankyou.html');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>