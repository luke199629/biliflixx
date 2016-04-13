<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/10/16
 * Time: 5:17 PM
 */


include "untility.php";
session_start();
include 'connectDB.php';
$con = connectDB();
mysqli_set_charset($con, 'utf8');
$username = $_POST['username'];
$password = $_POST['password']; 
$id = $_GET["id"];
$title = $_GET["title"];

if(isset($_SESSION["login"])) {
    if ($_SESSION['login'] != 1) {
        echo '<form action="logincheck.php" method="post"> 
        <p> 
            Username:<br> 
            <input type="text" name="username"> 
        </p> 
        <p> 
            Password:<br> 
            <input type="password" name="username"> 
        </p> 
        <p> 
            <input type="submit" name="submit" value="Log In"> 
        </p> 
        </form>';
    } else {
        //echo 'Welcome, '.$_SESSION['username']; 
        $userID = $_SESSION['username'];
        $sql = mysqli_query($con, "INSERT INTO favorites(userID,videoid,title)
	VALUES ('$userID', '$id', '$title')");

        $sql = "SELECT * FROM favorites";
        $result = mysqli_query($con, $sql);
//        die('<script type="text/javascript">window.location.href="' . "index.html" . '";</script>');

        echo "<a href=showAnime.php?id=".$id.">Back to anime page</a>";

//        TODO ADD JUMP BACK TO ANIME PAGE AND CHECK IF FAVORED BEOFORE
    }





}else{
    echo "Opps Error : you have to login first <br>";
    echo "<a href=http://biliflixx.web.engr.illinois.edu/login.php> loginPage </a>";
    die();
} 



//close connection