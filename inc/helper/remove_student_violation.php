<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');

if (isset($_GET['confirm_delete']))
{
    deleteFromTable('student_violations', $_GET['id']);
    header("Location: ../../student_violations.php?del_success");
    exit;
}

// حذف متعدد
if (isset($_GET['multi_delete'])) {
    
    deleteWhereIn( 'student_violations' , $_POST['checked']);
    header("Location: ../../student_violations.php?del_success");
    exit;
}



