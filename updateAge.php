<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/15/16
 * Time: 5:00 PM
 */
include "connectDB.php";

session_start();

$con = connectDB();
mysqli_set_charset($con, 'utf8');


$username =  $_SESSION["username"];
$age = $_POST["age"];

//$sql = "SELECT * FROM post WHERE post.title LIKE '%".$username."%'";
// $sql = mysqli_query($con, "INSERT INTO user(username, password, gender, age, icon_location)
// 	VALUES ('$username', '$password', '$gender', '$age', '$iconaddr')");

mysqli_query($con, "UPDATE user SET age = '$age' WHERE username = '$username'");
header("Location: /usrpage.php?msg=Upadate Age Successfully");
