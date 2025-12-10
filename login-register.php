<?php

session_start();
require_once 'config.php';

//  redirection with error message
function redirect_with_error($error, $form = 'login') {
    $_SESSION[$form . '_error'] = $error;
    $_SESSION['active_form'] = $form;
    header("Location: public/pages/login.php");
    exit();
}

// sanitize input
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// registration start
if (isset($_POST['register'])) {
    $username_input = sanitize(trim($_POST['username']));
    $email_input = sanitize(trim($_POST['email']));
    $password_input = trim($_POST['password']);
    $municipality_id = isset($_POST['municipality_id']) ? (int)$_POST['municipality_id'] : null;


    // checks if fields are empty
    if (empty($username_input) || empty($email_input) || empty($password_input)) {
        redirect_with_error('Alle felter skal udfyldes!', 'register');
    }
    
    if ($municipality_id <= 0) {
        redirect_with_error('Vælg venligst en kommune!', 'register');
    }
    // validate email
    if (!filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
        redirect_with_error('Ugyldig e-mail adresse!', 'register');
    }

    // Validate password strength
    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{12,}$/', $password_input)) {
        redirect_with_error('Adgangskode skal indeholde: mindst 12 tegn, 1 stort bogstav, 1 lille bogstav, 1 tal og 1 specialtegn.', 'register');
    }

    // checks if email already exists
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email_input);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        redirect_with_error('E-mail bruges allerede!', 'register');
    } else {
        // insert to db
        $hashed_password = password_hash($password_input, PASSWORD_DEFAULT);
        $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password, municipality_id) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param("sssi", $username_input, $email_input, $hashed_password, $municipality_id);
        if ($insert_stmt->execute()) {
            header("Location: public/pages/login.php");
            exit;
        } else {
            redirect_with_error('Der opstod en fejl, prøv venligst igen!', 'register');
        }
    }
}
// registration end

// login start
if (isset($_POST['login'])) {
    $email_input = sanitize(trim($_POST['email']));
    $password_input = trim($_POST['password']);

    // checks if fields are empty
    if (empty($email_input) || empty($password_input)) {
        redirect_with_error('Alle felter skal udfyldes!', 'login');
    }

    // safe select to check db
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_record = $result->fetch_assoc();
        if (password_verify($password_input, $user_record['password'])) {
            $_SESSION['email'] = $user_record['email'];
            $_SESSION['user_id'] = $user_record['id'];
            session_regenerate_id(true);
            header("Location: public/pages/my-profile.php");
            exit;
        }
    }

    redirect_with_error('Forkert email eller adgangskode!', 'login');
}
// login end

?>