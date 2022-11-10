<?php

/**
 * دالة الاتصال بقاعدة البيانات
 */
function databaseConnect()
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "schooldb";

    // Create connection
    if ($conn = new mysqli($hostname, $username, $password, $database)) {
        return $conn;
    }
}


/**
 * هذه الدالة من أجل التحقق اذا كان المستخدم غير مسجل دخول
 * ويعيد توجيهه إلى صفحة محددة
 * @param $to string
 */
function redirectNotAuthenticated($to)
{
    session_start();
    if (!isset($_SESSION['user_authenticated'])) {
        header("Location: $to");
        exit();
    }
}

/**
 * دالة من اجل الاستعلام من قاعدة البيانات
 * مع شرط where
 * @param $table string
 */
function select($table)
{
    $conn  = databaseConnect();
    $sql   = "SELECT * FROM $table";
    $query = $conn->query($sql); // تنفيذ الكويري
    // في حال الكويري جاب نتيجة بيعطيني اياها على شكل مصفوفة وإلا بيرجعلي فولس
    return $query->num_rows ? (object) mysqli_fetch_all($query, 1) : false;
}

/**
 * دالة من اجل الاستعلام من قاعدة البيانات
 * مع شرط where
 * @param $table string
 * @param $where string
 * @param $all optional
 */
function selectWhere($table, $where, $all = false)
{
    $conn  = databaseConnect();
    $sql   = "SELECT * FROM $table WHERE $where";
    $query = $conn->query($sql); // تنفيذ الكويري

    if ($all === true) return $query->num_rows ? mysqli_fetch_all($query) : false;

    // في حال الكويري جاب نتيجة بيعطيني اياها على شكل مصفوفة وإلا بيرجعلي فولس
    return $query->num_rows ? (object) mysqli_fetch_assoc($query) : false;
}

function Get_details_violation($table, $where, $all = false)
{
    $conn  = databaseConnect();
    $sql   = "SELECT * FROM $table where id  = $where ";
    $query = $conn->query($sql); // تنفيذ الكويري

    if ($all === true) return $query->num_rows ? mysqli_fetch_all($query) : false;

    // في حال الكويري جاب نتيجة بيعطيني اياها على شكل مصفوفة وإلا بيرجعلي فولس
    return $query->num_rows ? (object) mysqli_fetch_assoc($query) : false;
}



function selectWherefooter($table, $where, $all = false)
{
    $conn  = databaseConnect();
    $sql   = "SELECT * FROM $table where id  = $where ";
    $query = $conn->query($sql); // تنفيذ الكويري

    if ($all === true) return $query->num_rows ? mysqli_fetch_all($query) : false;

    // في حال الكويري جاب نتيجة بيعطيني اياها على شكل مصفوفة وإلا بيرجعلي فولس
    return $query->num_rows ? (object) mysqli_fetch_assoc($query) : false;
}

/**
 * دالة التحقق من المستخدم اذا كان ادمن
 */
function is_admin($email)
{
    $conn  = databaseConnect();
    $sql   = "SELECT * FROM users WHERE email = '$email'";
    $query = (object) mysqli_fetch_assoc($conn->query($sql)); // تنفيذ الكويري
    return $query->is_admin == 1 ? true : false;
}

/**
 * تسجيل الخروج من النظام
 */
function logout()
{
    session_start();
    session_destroy();
    header("Location: login.php");
    exit;
}

/**
 *  دخول غير مصرح به اذا دخل يوزر على صفحات ليس مصرح له الدخول عليها
 */
function error403()
{
    if (!is_admin($_SESSION['user_email'])) include "template/403.php";
}


/**
 * دالة ادخل بيانات
 * @param $table
 * @param $columns
 * @param $data
 */
function insertIntoDatabase($table, $columns, $data)
{
    $conn  = databaseConnect();
    $sql = "INSERT INTO $table ($columns) VALUES $data ";
    return ($conn->query($sql) === TRUE) ? true : false;
}

/**
 * دالة جذف بيانات من جدول
 * @param $table
 * @param $id
 */
function deleteFromTable($table, $id)
{
    $conn  = databaseConnect();
    $sql = "DELETE FROM $table WHERE id=$id";
    return ($conn->query($sql) === TRUE) ? true : false;
}

/**
 * تحديث بيانات جدول
 * @param $table
 * @param $set
 * @param $id
 */
function updateTable($table, $set, $id)
{
    $conn  = databaseConnect();
    $sql = "UPDATE $table SET $set WHERE id=$id";
    return ($conn->query($sql) === TRUE) ? true : false;
}

/**
 * دالة رفع الصورة
 */
function uploadPhoto($file)
{
    $path = pathinfo($file['name']);
    $NewFileName = 'student-image-' . rand(1, 1000) . '.' . $path['extension'];
    $temp_name = $file['tmp_name'];
    $upload_dir = dirname(__DIR__) . '/assets/images/' . $NewFileName;
    if (move_uploaded_file($temp_name, $upload_dir)) {
        return $NewFileName;
    }
    return '';
}

/**
 * دالة الاستعلام عن المخالفات
 */
function getStudentsViolations()
{
    $conn  = databaseConnect();
    $sql = "SELECT * FROM `student_violations`
    INNER JOIN `students` ON `students`.`student_id` = `student_violations`.`student_id`
    INNER JOIN `violations` ON `violations`.`id` = `student_violations`.`violation_id`;";
    $query = $conn->query($sql);
    return $query->num_rows ? mysqli_fetch_all($query) : false;
}

/**
 * دالة الاستعلام عن مخالفات طالب واحد
 * @param $student_id
 */
function getStudentViolations($student_id)
{
    $conn  = databaseConnect();
    $sql = "SELECT * FROM `student_violations`
    INNER JOIN `students` ON `students`.`student_id` = `student_violations`.`student_id`
    INNER JOIN `violations` ON `violations`.`id` = `student_violations`.`violation_id`
    WHERE `student_violations`.`student_id` = $student_id;";
    $query = $conn->query($sql);
    return $query->num_rows ? mysqli_fetch_all($query) : false;
}





function getmored($violation_id)
{
    $conn  = databaseConnect();
    $sql = "SELECT * FROM `violations`
    
    WHERE `id` = $violation_id;";
    $query = $conn->query($sql);
    return $query->num_rows ? mysqli_fetch_all($query) : false;
}



/**
 * دالة رفع pdf
 */
function uploadPDF($file)
{
    $path = pathinfo($file['name']);
    $NewFileName = 'pdf-file-' . rand(1, 1000) . '.' . $path['extension'];
    $temp_name = $file['tmp_name'];
    $upload_dir = dirname(__DIR__) . '/assets/pdf/' . $NewFileName;
    if (move_uploaded_file($temp_name, $upload_dir)) {
        return $NewFileName;
    }
    return '';
}

/**
 * دالة جذف طالب
 * @param $student_id
 */
function deleteStudent($student_id)
{
    $conn  = databaseConnect();
    $sql = "DELETE FROM `students` WHERE student_id=$student_id";
    return ($conn->query($sql) === TRUE) ? true : false;
}

/**
 * دالة تعديل بيانات طالب
 * @param $student_id
 * @param $set
 */
function modifyStudent($set, $student_id)
{
    $conn  = databaseConnect();
    $sql = "UPDATE `students` SET $set WHERE student_id=$student_id";
    return ($conn->query($sql) === TRUE) ? true : false;
}

/**
 * جالة الحذف المتعدد من خلال الـ id
 * @param $ids
 */
function deleteWhereIn($table, $ids)
{
    $conn  = databaseConnect();
    $sql = "DELETE from `$table` WHERE `id` IN ($ids);";
    return ($conn->query($sql) === TRUE) ? true : false;
}

/**
 * دالة الاستعلام عن طلاب من خلال الاسم
 * @param $string
 */

function searchStudent($string)
{
    $conn  = databaseConnect();
    $sql = "SELECT `student_id`, `student_name` FROM `students` WHERE student_name LIKE '%$string%'; ";
    $query = $conn->query($sql);
    return $query->num_rows ? mysqli_fetch_all($query) : false;
}
