<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/15/16
 * Time: 4:59 PM
 */

//header('Content-Type: text/html; charset=utf8');
include "connectDB.php";

session_start();




$con = connectDB();
mysqli_set_charset($con, 'utf8');


$username =  $_SESSION["username"];
$password = $_POST["password"];
$re_enteredpassword = $_POST["re_enteredpassword"];


if($password != $re_enteredpassword){
    die('<script type="text/javascript">window.location.href="' . "usrpage.php" . '";</script>');
}
//$sql = "SELECT * FROM post WHERE post.title LIKE '%".$username."%'";
// $sql = mysqli_query($con, "INSERT INTO user(username, password, gender, age, icon_location)
// 	VALUES ('$username', '$password', '$gender', '$age', '$iconaddr')");

mysqli_query($con, "UPDATE user SET password = '$password' WHERE username = '$username'");
header("Location: /usrpage.php?msg=Upadate Password Successfully");
