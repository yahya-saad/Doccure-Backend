<?php
ob_start();
session_start();

if($_SESSION['patientLogin']){
    session_destroy();
    header("Location:login.php");
}
else if($_SESSION['doctorLogin']){
    session_destroy();
    header("Location:doctorlogin.php");
}
ob_end_flush();
?>