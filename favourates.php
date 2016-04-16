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


        $sql0 = "SELECT * FROM favorites WHERE userID = '$userID' AND videoid = '$id'";

        $existedRows = mysqli_query($con, $sql0);
        
        if(mysqli_num_rows($existedRows) == 0) {



            $sql = mysqli_query($con, "INSERT INTO favorites(userID,videoid,title) VALUES ('$userID', '$id', '$title')");

//            $sql = "SELECT * FROM favorites";
//            $result = mysqli_query($con, $sql);

            mysqli_query($con, "UPDATE post SET favorites = favorites + 1 WHERE id = '$id'");


            $sql2 = "SELECT * FROM post WHERE id = '$id'";

            $postResult = $con->query($sql2);

            $row = $postResult->fetch_assoc();

            $videopid = $row["pid"];

//            $parentId = findParentid($videotid, $con);

            changeFavorVal($videopid, 2, $userID, $con);


            //die(onclick="alert('Hello world!')")
            //die('<script type="text/javascript">window.location.href="' . "showAnime.php?id=".$id."" . '";</script>');
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"Successfully add to favorites.\");\r\n";
            echo " history.back();\r\n";
            echo "</script>";
            // echo "<a href=showAnime.php?id=".$id.">Back to anime page</a>";


        }
        else{
        	echo "<script language=\"JavaScript\">\r\n";
            	echo " alert(\"You have already added it to favorites.\");\r\n";
            	echo " history.back();\r\n";
            	echo "</script>";
         }
        	
        
    }





}else{
    echo "Opps Error : you have to login first <br>";
    echo "<a href=http://biliflixx.web.engr.illinois.edu/login.php> loginPage </a>";
    die();
} 


//close connection