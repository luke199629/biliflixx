<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/15/16
 * Time: 5:27 PM
 */

include "connectDB.php";

$con = connectDB();

session_start();

$username =  $_SESSION["username"];

//$sql = "SELECT * FROM post WHERE post.title LIKE '%".$username."%'";
$sql = mysqli_query($con, "DELETE FROM user WHERE username = '$username'");

$sql = "SELECT * FROM user";
$result = mysqli_query($con, $sql);

//print out the data returned from the database
//$ctr = 0;

mysqli_close($con);

session_destroy();
header("Location: /index.html");

//close connection
