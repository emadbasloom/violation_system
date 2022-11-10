<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">

    <!-- sweetalert2 -->
    <script src="assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <title><?= isset($title) ? $title : 'school' // اذا في تاتيل للصفحة يعرضها 
            ?></title>

</head>

<body>
    <?php
error_reporting(0);
    if (isset($_SESSION['user_authenticated'])) {
        include_once "components/navbar.php";
    }
