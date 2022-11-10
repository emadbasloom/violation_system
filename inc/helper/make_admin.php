<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');
error403();

if ( isset($_GET['make_admin']) )
{
    updateTable('users', 'is_admin = ' . $_GET['user_type'] , $_GET['user_id']);

    header("Location: ../../users.php");
    exit;
}