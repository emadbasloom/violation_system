<?php
include_once "../functions.php";

redirectNotAuthenticated('login.php');
error403();


if (isset($_POST['add_address'])) {
    
    $school_name = $_POST['school_name'];
    $school_city = $_POST['school_city'];
    $school_address = $_POST['school_address'];
    $school_logo = '';
    $school_email = $_POST['school_email'];
    $school_mobile_number = $_POST['school_mobile_number'];
    $school_tel_number = $_POST['school_tel_number'];
    $school_website = $_POST['school_website'];

    if ($school_logo = $_FILES['school_logo']['name']) {
        $school_logo = uploadPhoto($_FILES['school_logo']);
    }
    $id =1;

    // الحقول التي يجب ادخالها في الجدول
    $columns = " `id`, `school_name`, `school_city`, `school_address`,`school_logo`,
                `school_email`, `school_mobile_number`, `school_tel_number`, `school_website` ";
    // البيانات
    $data    = "(
        $id,
        '$school_name',
        '$school_city',
        '$school_address',
        '$school_logo',
        '$school_email',
        $school_mobile_number,
        $school_tel_number,
        '$school_website'
    )";
    
    deleteFromTable('school_deitails',1);
    insertIntoDatabase('school_deitails', $columns, $data);

    
    

    header("Location: ../../schoolAddress_deitails.php");
    exit;
}

header("Location: ../../index.php");
exit;
