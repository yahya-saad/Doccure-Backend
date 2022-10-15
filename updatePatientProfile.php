<?php
ob_start();
session_start();
include("conn.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id=$_SESSION['id'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $bloodGroup = $_POST['bloodGroup'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode'];
    $country = $_POST['country'];

    // Upload Image  
$sizesupport = 2 * 1024 * 1024; // 2 MB
if(empty($_FILES['pimg']['tmp_name']) || !is_uploaded_file($_FILES['pimg']['tmp_name']))
{
    $_SESSION['errmsg'] = "You must upload image";

}elseif(empty($fName) ||empty($lName) ||empty($dateOfBirth) ||empty($bloodGroup) ||empty($phone) ){
    $_SESSION['errmsg'] = "You must fill all required fields";

}else if ($_FILES['pimg']['type'] != "image/jpeg" && $_FILES['pimg']['type'] != "image/png" ){
    $_SESSION['errmsg'] = "Please upload sutiable image format ";

}
elseif ($_FILES['pimg']['size'] > $sizesupport){
    $_SESSION['errmsg'] = "Image size is larger than 2 MB";
}else{
    
$imgname = $_FILES['pimg']['name'];
$imgLoc = $_FILES['pimg']['tmp_name'];

$r = rand();
$t = time();

$finalName = "$r$t$imgname";


$newLocation = "imgs/$finalName";
move_uploaded_file($imgLoc,$newLocation );
print_r($_POST);
print_r($_FILES);
$updatePatient = "UPDATE `patients` SET `fName`='$fName',`lName`='$lName',`image`='$newLocation',`dateOfBirth`= '$dateOfBirth',`phone`='$phone',`bloodGroup`='$bloodGroup',`address`='$address',`city`='$city',`state`='$state',`country`='$country',`zipCode`='$zipCode' WHERE id=$id";
$update = $conn->query($updatePatient);
if($update){
    $_SESSION['succmsg'] = "Profile Updated Successfully";
}
}
}
header("Location:profile-settings.php");

ob_end_flush();
?>