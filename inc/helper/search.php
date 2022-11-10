<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');

/**
 * يتم البحث في قاعدة البيانات عن اسم الطالب
 * و حفظ النتائج في متحول
 * و طباعة نص جيسون
 * لاستخدامه في الفرونت اند
 */


$result = [];

foreach ( searchStudent($_GET['term']) as $data )
{
    array_push(
        $result,
        [
            'id'    =>  $data[0],
            'label'    =>  $data[1],
            'value'    =>  $data[1],
        ]
    );
}

echo json_encode($result);

exit;