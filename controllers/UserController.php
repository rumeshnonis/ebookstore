<?php
// controllers/UserController.php

include_once '../config/database.php';
include_once '../models/User.php';
include_once '../models/Address.php';

class UserController {
    public function updateProfile() {
        session_start();
        $user_id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];

            $user = new User();
            if ($user->updateProfile($user_id, $username, $email)) {
                header('Location: /ebookstore/views/user/profile.php?success=' . urlencode('Profile updated successfully!'));
            } else {
                header('Location: /ebookstore/views/user/profile.php?error=' . urlencode('Failed to update profile.'));
            }
        }
    }

    public function addAddress() {
        session_start();
        $user_id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $address = $_POST['address'];

            $addressModel = new Address();
            if ($addressModel->addAddress($user_id, $address)) {
                header('Location: /ebookstore/views/user/profile.php?success=' . urlencode('Address added successfully!'));
            } else {
                header('Location: /ebookstore/views/user/add_address.php?error=' . urlencode('Failed to add address.'));
            }
        }
    }

    public function editAddress() {
        session_start();
        $user_id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $address_id = $_POST['address_id'];
            $address = $_POST['address'];

            $addressModel = new Address();
            if ($addressModel->updateAddress($address_id, $user_id, $address)) {
                header('Location: /ebookstore/views/user/profile.php?success=' . urlencode('Address updated successfully!'));
            } else {
                header('Location: /ebookstore/views/user/edit_address.php?id=' . $address_id . '&error=' . urlencode('Failed to update address.'));
            }
        }
    }

    public function deleteAddress() {
        session_start();
        $user_id = $_SESSION['user_id'];

        if (isset($_GET['id'])) {
            $address_id = $_GET['id'];

            $addressModel = new Address();
            if ($addressModel->deleteAddress($address_id, $user_id)) {
                header('Location: /ebookstore/views/user/profile.php?success=' . urlencode('Address deleted successfully!'));
            } else {
                header('Location: /ebookstore/views/user/profile.php?error=' . urlencode('Failed to delete address.'));
            }
        }
    }
}

// Router logic to handle requests
if (isset($_GET['action'])) {
    $controller = new UserController();
    switch ($_GET['action']) {
        case 'update_profile':
            $controller->updateProfile();
            break;
        case 'add_address':
            $controller->addAddress();
            break;
        case 'edit_address':
            $controller->editAddress();
            break;
        case 'delete_address':
            $controller->deleteAddress();
            break;
        default:
            // Optionally handle unexpected actions
            header('Location: /ebookstore/views/user/profile.php?error=' . urlencode('Invalid action.'));
            break;
    }
}
?>
