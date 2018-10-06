<?php
    session_start();
    session_unset();
    session_destroy();
    ob_start();
    header("location:supervisor_login.php");
    ob_end_flush();
?>