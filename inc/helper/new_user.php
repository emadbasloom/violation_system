<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');
error403();

if (isset($_POST['create_user'])) {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $school_email = $_POST['school_email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $is_admin = isset($_POST['make_admin']) ? 1 : 0;

    $columns = "full_name, email,school_email, password, is_admin"; // الحقول التي يجب ادخالها في الجدول
    $data    = "( '$full_name' , '$email' ,'$school_email' , '$password' , $is_admin )"; // البيانات

    insertIntoDatabase('users', $columns, $data);

    header("Location: ../../users.php");
    exit;
}
