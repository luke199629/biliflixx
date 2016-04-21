<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/12/16
 * Time: 4:33 PM
 */

include 'connectDB.php';
session_start();

/**
 * @param $currentAid
 * @param $gen
 * @param $con
 */
//function inserNewtidpid($currentAid, $gen, $con)
//{
//    $sql6 = "INSERT INTO aid_tid_duration(aid, tid) VALUE ('$currentAid', '$gen')";
//
//    if ($con->query($sql6) === TRUE) {
//    } else {
//        echo "Error: " . $sql6 . "<br>" . $con->error;
//    }
//}

if(isset($_SESSION['username']) && isset($_SESSION["login"]) && $_SESSION['login'] == 1) {
    $title = $_POST["title"];
    $cover = $_POST["cover"];
    $dis = $_POST["Description"];
    $tags = $_POST["tags"];
    $gen = $_POST["genre"];
    $auth = $_SESSION['username'];
    $currentime = time();

    $con = connectDB();

    $sql1 = "SELECT * FROM post WHERE post.id = 117340";

    $result1 = $con->query($sql1);

    $row = $result1->fetch_assoc();

    $currentAid = $row["cid"] + 1;

//    $sql2 = mysqli_query($con, "INSERT INTO user(username, password, gender, age, icon_location)
//	VALUES ('$username', '$password', '$gender', '$age', '$iconaddr')");



    $sql3 = "UPDATE post SET cid = '$currentAid' WHERE id = 117340";

    if ($con->query($sql3) === TRUE) {
    } else {
        echo "Error: " . $sql3 . "<br>" . $con->error;
    }

    $sql4 = "SELECT * FROM GenreType WHERE tid = '$gen'";

    echo $sql4;

    echo "<br>";

    $typeinfo = $con->query($sql4);

    if($typeinfo === FALSE){
        echo "Error: " . $sql4 . "<br>" . $con->error;
    }

    $typerrow = $typeinfo->fetch_assoc();

    $parentID = $typerrow["pid"];

    echo $parentID;

    echo "<br>";

    if ($parentID == 0){
        $parentID = $gen;
    }

    $sql5 = "UPDATE user SET `$parentID` = `$parentID` + 3 WHERE username = '$auth'";
    
    
    if ($con->query($sql5) === TRUE) {
    } else {
        echo "Error: user" . $sql5 . "<br>" . $con->error;
    }


    $sql2 = "INSERT INTO post(aid, title, website, tag, pic, description, author, posttime, tid, pid) 
    VALUE ('$currentAid', '$title', ' ', '$tags', '$cover', '$dis', '$auth', '$currentime', '$gen','$parentID')";

    if ($con->query($sql2) === TRUE) {
        echo "New record created successfully <br>";
        echo "<a href=http://biliflixx.web.engr.illinois.edu/usrpage.php> UserPage </a>";

    } else {
        echo "Error: " . $sql2 . "<br>" . $con->error;
    }


}

else{
    echo "Opps Error : you have to login first <br>";
    echo "<a href=http://biliflixx.web.engr.illinois.edu/login.php> loginPage </a>";
    die();
}

mysqli_close($con);
