<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');
error403();

if (isset($_POST['update_violation'])) {

        $id  = $_POST['violation_id'];
        $violation_name  = $_POST['violation_name'];
        $violation_level = $_POST['violation_level'];

        $set = " `violation_name` = '$violation_name',
                `violation_level_number` = $violation_level";

        updateTable('violations', $set, $id);
        
        header("Location: ../../violations.php");
        exit;
}
