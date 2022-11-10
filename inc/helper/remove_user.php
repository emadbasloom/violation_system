<?php

include_once "../functions.php";

redirectNotAuthenticated('login.php');
error403();

if (isset($_GET['confirm_delete']))
{
    deleteFromTable('users', $_GET['id']);
    header("Location: ../../users.php");
    exit;
}
