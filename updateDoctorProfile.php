<?php
ob_start();
session_start();
include("conn.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_SESSION['id'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $bio = $_POST['bio'];
    $specialization = $_POST['specialization'];
    $price = $_POST['price'];
    
    
    // Upload Image 

    
$sizesupport = 2 * 1024 * 1024; // 2 MB


if(empty($_FILES['dimg']['tmp_name']) || !is_uploaded_file($_FILES['dimg']['tmp_name']))
{
    $_SESSION['errmsg'] = "You must upload image";

}elseif(empty($fName) ||empty($lName) || empty($phone) || empty($specialization) || empty($price)){
    $_SESSION['errmsg'] = "You must fill all required fields";

}else if ($_FILES['dimg']['type'] != "image/jpeg" && $_FILES['dimg']['type'] != "image/png" ){
    $_SESSION['errmsg'] = "Please upload sutiable image format ";

}
elseif ($_FILES['dimg']['size'] > $sizesupport){
    $_SESSION['errmsg'] = "Image size is larger than 2 MB";
}else{
    
$imgname = $_FILES['dimg']['name'];
$imgLoc = $_FILES['dimg']['tmp_name'];

$r = rand();
$t = time();

$finalName = "$r$t$imgname";


$newLocation = "imgs/$finalName";
move_uploaded_file($imgLoc,$newLocation );
print_r($_POST);
print_r($_FILES);
$updateDoctor = "UPDATE `doctors` SET fName='$fName',lName='$lName',image='$newLocation',country='$country', state='$state',biography='$bio',specialization='$specialization',price='$price' WHERE id=$id ";
$update = $conn->query($updateDoctor);
if($update){
    $_SESSION['succmsg'] = "Profile Updated Successfully";
}
}
}
header("Location:doctor-profile-settings.php");

ob_end_flush();
?>



