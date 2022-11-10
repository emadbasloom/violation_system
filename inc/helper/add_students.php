<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');

// رفع ملف CSV
if (isset($_POST['SubmitCSV'])) {

    include 'csv_helper.php';

    if ($file = $_FILES['file']['name']) {
        $path = pathinfo($file);
        $ext = $path['extension'];

        if ($ext != 'csv') die('يجب رفع ملف csv');

        $NewFileName = rand(1, 1000) . 'csv-file.csv';
        $temp_name = $_FILES['file']['tmp_name'];

        if (move_uploaded_file($temp_name, $NewFileName)) {
            $csvFile = new ReadCSV($NewFileName);
            $csvFile->saveToDatabase();
            unlink($NewFileName);
            header("Location: ../../students.php");
            exit;
        }
    }
}

// اضافة طالب
if (isset($_POST['create_student'])) {

    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $student_father_name = $_POST['student_father_name'];
    $student_grade = $_POST['student_grade'];
    $student_image = '';
    $student_birth = $_POST['student_birth'];
    $student_email = $_POST['student_email'];
    $student_number = $_POST['student_number'];
    $student_parent_number = $_POST['student_parent_number'];
    $student_address = $_POST['student_address'];

    if ($student_image = $_FILES['student_image']['name']) {
        $student_image = uploadPhoto($_FILES['student_image']);
    }


    // الحقول التي يجب ادخالها في الجدول
    $columns = "`student_id`, `student_name`, `student_father_name`,
                `student_grade`, `student_image`, `student_birth`, `student_email`,
                `student_number`, `student_parent_number`, `student_address`";
    // البيانات
    $data    = "(
        $student_id,
        '$student_name',
        '$student_father_name',
        $student_grade,
        '$student_image',
        '$student_birth',
        '$student_email',
        $student_number,
        $student_parent_number,
        '$student_address'
    )";

    insertIntoDatabase('students', $columns, $data);

    header("Location: ../../students.php");
    exit;
}

header("Location: ../../index.php");
exit;
