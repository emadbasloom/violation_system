<?php

include_once "../functions.php";
require_once 'mail.php';

redirectNotAuthenticated('login.php');

// هنا يتم الدخول في الحلقة من اجل ضبط مخالفة لطالب او اكثر

if (isset($_POST['create_violation'])) {
        $student_ids     = $_POST['student_id']; // يتم اسناد المصفوفة إلى متحول
        foreach (json_decode($student_ids) as $student_id) { // حلقة من اجل كل رقم طالب
                $student_id = (int)$student_id;
                $violation_id   = (int)$_POST['violation_id'];
                $note   = isset($_POST['note']) ? $_POST['note'] : '';
                $pdf_file = empty($_FILES['pdf_file']['name']) ? '' : uploadPDF($_FILES['pdf_file']);

                $columns = "student_id, violation_id, note, pdf_file"; // الحقول التي يجب ادخالها في الجدول
                $data    = "( $student_id , $violation_id , '$note', '$pdf_file' )"; // البيانات
                $student = selectWhere("students", "student_id = $student_id");

                $getdatel1 = Get_details_violation('violations', "$violation_id");

                $datetoday = date("d/m/y");

                if ($student && insertIntoDatabase('student_violations', $columns, $data)) {

                        // ارسال إلى ولي الامر
                        if (isset($_POST['send_email'])) {
                                $student = selectWhere("students", "student_id = $student_id");

                                // ->violation_level_number.

                                require_once 'mail.php';

                                $mail->setFrom('behavior.school1@gmail.com', 'schol');

                                $mail->addAddress("$student->student_email");

                                $mail->Body    =
                                        '<div style=" background-color: cornsilk; padding: 10px;direction: rtl;">' .
                                        '<h2 style=" text-align: center; color: red;">' . 'تم قيد مخالفة سلوك' . '</h2>' .

                                        '<h4>' . 'اسم الطالب:' . '</h4>' .
                                        $student->student_name .

                                        '<h4>' . 'رقم الطالب:' . '</h4>' .
                                        $student->student_id .

                                        '<h4>' . 'درجة المخالفة:' . '</h4>' .
                                        $getdatel1->violation_level_number .

                                        '<h4>' . 'اسم المخالفة:' . '</h4>' .
                                        $getdatel1->violation_name .

                                        '<h4>' . 'ملاحظة المخالفة:' . '</h4>' .
                                        $note .
                                        '<h4>' . 'التاريخ' . '</h4>' .
                                        $datetoday .
                                        '</div>';
                                $mail->send();
                        }
                } else {
                        // في حال حدوث مشكلة في احدى ادخالات الطلاب يتوقف البرنامج عن العمل
                        header("Location: ../../create_violation.php?error");
                }
        }
        // عند اضافة طالب او اكثر بنجاح
        header("Location: ../../create_violation.php?success");
        exit;
}


header("Location: ../../index.php");
exit;


// function send_email($data)
// {

       
//         require_once 'mail.php';
        
// $mail->setFrom('behavior.school1@gmail.com', 'schol');

// $mail->addAddress("$data->student_email");               //Name is optional

// $mail->Body    = $student;
// $mail->send();

        // // المرسل إليه
        // $recipient = "$data->student_email";

        // عنوان الرسالة
        // $subject = "ضبط مخالفة";

        // الرسالة
        // $email_content = " تم ضبط مخالفة بحق الطالب";

        // البريد الصادر
        // $email_headers = "From: emad@admin.com";

        // Send the email.
        // if (mail(setFrom, $subject, $email_content, $email_headers)) {
                // Set a 200 (okay) response code.
        //         http_response_code(200);
        //         echo "Thank You! Your message has been sent.";
        //         echo '<script type="text/javascript">window.location.href = "https://goldenmask-ae.com/";</script>';
        // } else {
                // Set a 500 (internal server error) response code.
        //         http_response_code(500);
        //         echo "Oops! Something went wrong and we couldn't send your message.";
        //         echo '<script type="text/javascript">window.location.href = "https://goldenmask-ae.com/";</script>';
        // }
// }
