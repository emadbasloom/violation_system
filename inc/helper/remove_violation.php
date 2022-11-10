<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');
error403();

if (isset($_GET['confirm_delete'])) {
    deleteFromTable('violations', $_GET['id']);
    header("Location: ../../violations.php?del_success");
    exit;
}

if (isset($_GET['multi_delete'])) {
    
    deleteWhereIn( 'violations' , $_POST['checked']);
    header("Location: ../../violations.php?del_success");
    exit;
}
