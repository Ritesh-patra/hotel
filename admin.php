<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

// Initialize variables
$name = $email = $phone = $checkIn = $checkOut = $roomType = $adults = $children = $specialRequests = '';
$message = '';
$messageType = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone"] ?? "";
    $checkIn = $_POST["check_in"] ?? "";
    $checkOut = $_POST["check_out"] ?? "";
    $roomType = $_POST["room_type"] ?? "";
    $adults = $_POST["adults"] ?? "";
    $children = $_POST["children"] ?? "";
    $specialRequests = $_POST["special_requests"] ?? "";

    // Validate form data
    if (empty($name) || empty($email) || empty($phone) || empty($checkIn) || empty($checkOut) || empty($roomType) || empty($adults)) {
        $message = "Please fill all required fields.";
        $messageType = "error";
    } else {
        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'patrasagarika654@gmail.com'; // Your Gmail address
            $mail->Password = 'jshf iluj zotb yatn';       // Your Gmail app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Recipients
            $mail->setFrom('patrasagarika654@gmail.com', 'Gayatri\'s Hotel');
            $mail->addAddress($email, $name);     // Send to customer
            $mail->addBCC('patrasagarika654@gmail.com'); // BCC to admin

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Booking Confirmation - Gayatri\'s Hotel';

            $mail->Body = "
                <h2>Booking Details</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Check-in Date:</strong> $checkIn</p>
                <p><strong>Check-out Date:</strong> $checkOut</p>
                <p><strong>Room Type:</strong> $roomType</p>
                <p><strong>Adults:</strong> $adults</p>
                <p><strong>Children:</strong> $children</p>
                <p><strong>Special Requests:</strong> " . nl2br($specialRequests) . "</p>
                <hr>
                <p>We have received your booking request and will contact you shortly to confirm your reservation.</p>
                <p>Thank you for choosing Gayatri's Hotel!</p>
            ";

            $mail->AltBody = "Booking Details\n\n" .
                "Name: $name\n" .
                "Email: $email\n" .
                "Phone: $phone\n" .
                "Check-in Date: $checkIn\n" .
                "Check-out Date: $checkOut\n" .
                "Room Type: $roomType\n" .
                "Adults: $adults\n" .
                "Children: $children\n" .
                "Special Requests: $specialRequests\n\n" .
                "We have received your booking request and will contact you shortly.";

            $mail->send();

            $message = "Thank you for your booking! We have received your request and will contact you shortly to confirm your reservation.";
            $messageType = "success";

        } catch (Exception $e) {
            $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Gayatri's Hotel - Booking System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #8e44ad;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 2.5rem;
        }

        .booking-form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .row {
            display: flex;
            gap: 20px;
        }

        .col {
            flex: 1;
        }

        button {
            background-color: #8e44ad;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #7d3c98;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .hotel-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .hotel-info p {
            color: #666;
            margin-top: 10px;
            font-size: 18px;
        }
    </style>
</head>

<body>

<header class="bg-white shadow-md">
  <div class="w-full py-1 bg-red-600"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg> 
    </div>
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Hotel Title -->
        <div class="text-right">
            <a href="index.html"><h1 class="text-2xl font-bold text-gray-800">Gayatri's Hotel</h1></a>
            <p class="text-sm text-gray-500">Experience luxury and comfort</p>
        </div>
    </div>
</header>


    <div class="container">
        <div class="hotel-info">
            <h2>Welcome to Gayatri's Hotel</h2>
            <p>Book your stay with us and enjoy our premium services and amenities</p>
        </div>

        <?php if (!empty($message)): ?>
            <div class="<?php echo $messageType; ?>-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="booking-form">
            <h2>Book Your Stay</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                                required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>"
                                required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="check_in">Check-in Date *</label>
                            <input type="date" id="check_in" name="check_in"
                                value="<?php echo htmlspecialchars($checkIn); ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="check_out">Check-out Date *</label>
                            <input type="date" id="check_out" name="check_out"
                                value="<?php echo htmlspecialchars($checkOut); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="room_type">Room Type *</label>
                    <select id="room_type" name="room_type" required>
                        <option value="">Select Room Type</option>
                        <option value="standard" <?php echo ($roomType == 'standard') ? 'selected' : ''; ?>>Standard Room
                        </option>
                        <option value="deluxe" <?php echo ($roomType == 'deluxe') ? 'selected' : ''; ?>>Deluxe Room
                        </option>
                        <option value="suite" <?php echo ($roomType == 'suite') ? 'selected' : ''; ?>>Executive Suite
                        </option>
                        <option value="family" <?php echo ($roomType == 'family') ? 'selected' : ''; ?>>Family Room
                        </option>
                    </select>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="adults">Adults *</label>
                            <select id="adults" name="adults" required>
                                <option value="1" <?php echo ($adults == '1') ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($adults == '2') ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($adults == '3') ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo ($adults == '4') ? 'selected' : ''; ?>>4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="children">Children</label>
                            <select id="children" name="children">
                                <option value="0" <?php echo ($children == '0') ? 'selected' : ''; ?>>0</option>
                                <option value="1" <?php echo ($children == '1') ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($children == '2') ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($children == '3') ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo ($children == '4') ? 'selected' : ''; ?>>4</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="special_requests">Special Requests</label>
                    <textarea id="special_requests" name="special_requests"
                        rows="4"><?php echo htmlspecialchars($specialRequests); ?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit">Book Now</button>
                </div>
            </form>
        </div>
    </div>

    <footer style="background-color: #333; color: white; text-align: center; padding: 20px 0; margin-top: 50px;">
        <div class="container">
            <p>&copy; 2025 Gayatri's Hotel. All rights reserved.</p>
            <p>Contact: info@gayatrishotel.com | Phone: +91 1234567890</p>
        </div>
    </footer>
</body>

</html>