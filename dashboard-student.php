<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once 'connection.php'; // Ensure connection.php is available

// Load Composer's autoloader
require 'vendor/autoload.php';

// Function to send OTP email
function sendOTP($email, $name) {
    $mail = new PHPMailer(true);
    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mukulverma12344@gmail.com'; // Update with your Gmail
        $mail->Password = 'Mukul2005@'; // Update with your Gmail password or App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'Your Website Name');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email verification';
        $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
        $mail->send();

        return $verification_code;
    } catch (Exception $e) {
        return false; // You can add better error handling/logging here
    }
}

// Handle POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // Connect with database
    $conn = mysqli_connect("localhost", "root", "root", "test"); // Update credentials

    if ($action == 'request_otp') {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        // Send OTP
        $verification_code = sendOTP($email, $name);
        if ($verification_code) {
            // Insert into users table
            $sql = "INSERT INTO users (name, email, password, verification_code, email_verified_at) VALUES ('$name', '$email', '$encrypted_password', '$verification_code', NULL)";
            mysqli_query($conn, $sql);

            $response = ['success' => true, 'message' => 'OTP sent successfully.'];
        } else {
            $response = ['success' => false, 'message' => 'Failed to send OTP.'];
        }

        echo json_encode($response);
        exit();
    }

    // Verify OTP
    if ($action == 'verify_otp') {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $verification_code = mysqli_real_escape_string($conn, $_POST["otp"]);

        $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '$email' AND verification_code = '$verification_code'";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $response = ['success' => true, 'message' => 'Email verified successfully.'];
        } else {
            $response = ['success' => false, 'message' => 'Invalid OTP.'];
        }

        echo json_encode($response);
        exit();
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up with OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            transition: all 0.3s ease;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }
        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
            font-size: 24px;
            margin-bottom: 1.5rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin-bottom: 1rem;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        button {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }
        button:hover {
            background-color: #3a7bd5;
        }
        button:active {
            transform: scale(0.98);
        }
        .toggle {
            margin-top: 1rem;
            text-align: center;
            color: #666;
        }
        .toggle a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: bold;
        }
        .toggle a:hover {
            text-decoration: underline;
        }
        #message {
            text-align: center;
            margin-top: 1rem;
            font-weight: bold;
        }
        .success {
            color: #28a745;
        }
        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="signin-form">
            <h2>Sign In</h2>
            <form id="signin-form-element">
                <input type="email" id="signin-email" name="email" placeholder="Email" required aria-label="Email">
                <button type="submit">Request OTP</button>
            </form>
            <div class="toggle">
                Don't have an account? <a href="#" onclick="toggleForm('signup-form')">Sign Up</a>
            </div>
        </div>

        <div id="signup-form" style="display: none;">
            <h2>Sign Up</h2>
            <form id="signup-form-element">
                <input type="email" id="signup-email" name="email" placeholder="Email" required aria-label="Email">
                <input type="password" id="signup-password" name="password" placeholder="Password" required aria-label="Password">
                <button type="submit">Request OTP</button>
            </form>
            <div class="toggle">
                Already have an account? <a href="#" onclick="toggleForm('signin-form')">Sign In</a>
            </div>
        </div>

        <div id="otp-form" style="display: none;">
            <h2>Enter OTP</h2>
            <form id="otp-form-element">
                <input type="text" id="otp-input" name="otp" placeholder="Enter OTP" required aria-label="One-Time Password">
                <button type="submit">Verify OTP</button>
            </form>
        </div>

        <div id="message"></div>
    </div>

    <script>
        function toggleForm(formId) {
            document.getElementById('signin-form').style.display = 'none';
            document.getElementById('signup-form').style.display = 'none';
            document.getElementById('otp-form').style.display = 'none';
            document.getElementById(formId).style.display = 'block';
        }

        function showMessage(message, isSuccess) {
            const messageElement = document.getElementById('message');
            messageElement.textContent = message;
            messageElement.className = isSuccess ? 'success' : 'error';
        }

        function handleFormSubmit(event, action) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            formData.append('action', action);

            fetch('index.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, true);
                    if (action === 'request_otp') {
                        toggleForm('otp-form');
                    } else if (action === 'verify_otp') {
                        showMessage('Email verified! You can log in now.', true);
                    }
                } else {
                    showMessage(data.message, false);
                }
            })
            .catch(error => {
                showMessage('An error occurred. Please try again.', false);
            });
        }

        document.getElementById('signin-form-element').addEventListener('submit', (event) => handleFormSubmit(event, 'request_otp'));
        document.getElementById('signup-form-element').addEventListener('submit', (event) => handleFormSubmit(event, 'request_otp'));
        document.getElementById('otp-form-element').addEventListener('submit', (event) => handleFormSubmit(event, 'verify_otp'));
    </script>
</body>
</html>
