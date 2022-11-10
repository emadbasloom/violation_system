<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');
error403();

if (isset($_POST['create_violation'])) {

    $violation_name  = $_POST['violation_name'];
    $violation_level = $_POST['violation_level'];

    $columns = "violation_name, violation_level_number"; // الحقول التي يجب ادخالها في الجدول
    $data    = "( '$violation_name' , '$violation_level' )"; // البيانات

    insertIntoDatabase('violations', $columns, $data);

    header("Location: ../../violations.php");
    exit;
}
