<?php
require "../functions.php";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $plaintext_password = $_POST['password'];

    $user = selectWhere("users", "email = '$email'");

    // Verify the hash against the password entered
    $verify = password_verify($plaintext_password, $user->password);

    // Print the result depending if they match
    if ($verify) {
        session_start();
        $_SESSION['user_authenticated'] = true;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $user->full_name;
        $_SESSION['user_school_email'] = $user->school_email;
        header("Location: ../../index.php");
        exit();
    } else {
        header("Location: ../../login.php?error");
        exit();
    }

}

header("Location: ../../login.php");
exit();
