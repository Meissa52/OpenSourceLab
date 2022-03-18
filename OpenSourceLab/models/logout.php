<?php
    session_start();
    unset($_SESSION['email']);
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    unset($_SESSION['userid']);
    header("Location: ../index.php");
?>