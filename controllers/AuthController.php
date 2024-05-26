<?php
// controllers/AuthController.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Path to Composer autoload file

include_once '../models/User.php';

class AuthController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                header('Location: /ebookstore/views/auth/register.php?error=' . urlencode('Passwords do not match'));
                exit();
            }

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $role = 'user';

            $user = new User();
            if ($user->register($username, $email, $hashed_password, $role)) {
                // Send confirmation email
                $this->sendConfirmationEmail($email);
                header('Location: /ebookstore/views/auth/login.php?success=' . urlencode('Registration successful! Please check your email to confirm.'));
            } else {
                header('Location: /ebookstore/views/auth/register.php?error=' . urlencode('Registration failed. Please try again.'));
            }
        } else {
            include '/ebookstore/views/auth/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $result = $user->login($email);

            if ($result && password_verify($password, $result['password'])) {
                session_start();
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['user_role'] = $result['role'];

                if ($result['role'] === 'admin') {
                    header('Location: /ebookstore/views/admin/dashboard.php');
                } else {
                    header('Location: /ebookstore/views/user/profile.php');
                }
            } else {
                header('Location: /ebookstore/views/auth/login.php?error=' . urlencode('Invalid email or password.'));
            }
        } else {
            include '/ebookstore/views/auth/login.php';
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /ebookstore/index.php');
    }

    public function password_reset() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            $user = new User();
            if ($user->emailExists($email)) {
                // Generate a unique token
                $token = bin2hex(random_bytes(50));
                $user->storeToken($email, $token);
                // Send reset email
                $this->sendResetEmail($email, $token);
                header('Location: /ebookstore/views/auth/password_reset.php?success=' . urlencode('Password reset email sent!'));
            } else {
                header('Location: ../../views/auth/password_reset.php?error=' . urlencode('Email does not exist.'));
            }
        } else {
            include '../views/auth/password_reset.php';
        }
    }


    public function reset_password() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                header('Location: /ebookstore/views/auth/reset_password.php?token=' . urlencode($token) . '&error=' . urlencode('Passwords do not match'));
                exit();
            }

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $user = new User();
            if ($user->resetPassword($token, $hashed_password)) {
                header('Location: /ebookstore/views/auth/login.php?success=' . urlencode('Password has been reset! You can now login.'));
            } else {
                header('Location: /ebookstore/views/auth/reset_password.php?token=' . urlencode($token) . '&error=' . urlencode('Failed to reset password. Please try again.'));
            }
        } else {
            include '/ebookstore/views/auth/reset_password.php';
        }
    }

    private function sendConfirmationEmail($email) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io'; // Mailtrap SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = '3595eae1ed85e0'; // Your Mailtrap username
            $mail->Password   = '4d93ac3d3c9c0c'; // Your Mailtrap password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('your-email@example.com', 'Mailer');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Confirmation';
            $mail->Body    = "Please confirm your email by clicking the link: <a href='http://localhost/ebookstore/confirm_email.php?email=$email'>Confirm Email</a>";

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function sendResetEmail($email, $token) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.mailtrap.io'; // Mailtrap SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = '3595eae1ed85e0'; // Your Mailtrap username
            $mail->Password   = '4d93ac3d3c9c0c'; // Your Mailtrap password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('your-email@example.com', 'Mailer');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset';
            $mail->Body    = "Please reset your password by clicking the link: <a href='http://localhost/ebookstore/views/auth/reset_password.php?token=$token'>Reset Password</a>";

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

// Router logic to handle requests
if (isset($_GET['action'])) {
    $controller = new AuthController();
    switch ($_GET['action']) {
        case 'register':
            $controller->register();
            break;
        case 'login':
            $controller->login();
            break;
        case 'logout':
            $controller->logout();
            break;
        case 'password_reset':
            $controller->password_reset();
            break;
        case 'reset_password':
            $controller->reset_password();
            break;
        default:
            header('Location: /ebookstore/index.php');
            break;
    }
}
?>
