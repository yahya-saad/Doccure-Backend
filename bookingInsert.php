<?php 
ob_start();
include("conn.php");
session_start();
if(isset($_POST['submit'])){
    $date = $_POST['date'];
    $time = $_POST['time'];
    $patientID=$_SESSION['id'];
    $docID =  $_POST['docID'];
    $insertApp = "INSERT INTO `appointments`( patientID, doctorID, date, time) VALUES ($patientID,$docID,'$date','$time')";
    $insert = $conn->query($insertApp);
    if($insert){
        sleep(1);
        header("Location:booking-success.php");
    }
}
ob_end_flush();
?>