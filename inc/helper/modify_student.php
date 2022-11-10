<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');

// اضافة طالب
if (isset($_POST['modify_student'])) {

    $student_name = $_POST['student_name'];
    $student_father_name = $_POST['student_father_name'];
    $student_grade = $_POST['student_grade'];
    $student_email = $_POST['student_email'];
    $student_number = $_POST['student_number'];
    $student_parent_number = $_POST['student_parent_number'];
    $student_address = $_POST['student_address'];

    // البيانات
    $set = " `student_name` = '$student_name',
             `student_father_name` = '$student_father_name',
             `student_grade` = $student_grade,
             `student_email` = '$student_email',
             `student_number` = $student_number,
             `student_parent_number` = $student_parent_number,
             `student_address` = '$student_address'";

    if ($student_image = $_FILES['student_image']['name']) {
        $student_image = uploadPhoto($_FILES['student_image']);
        $set = " `student_image` = '$student_image', " . $set;
    }
    

    modifyStudent($set, $_POST['student_id']);

    header("Location: ../../students.php");
    exit;
}

//حذف طالب
if (isset($_GET['confirm_delete']) && !empty($_GET['student_id'])) {
    deleteStudent($_GET['student_id']);
    header("Location: ../../students.php");
    exit;
}

// حذف متعدد
if (isset($_GET['multi_delete'])) {
    
    deleteWhereIn( 'students' , $_POST['checked']);
    header("Location: ../../students.php?del_success");
    exit;
}

header("Location: ../../index.php");
exit;
