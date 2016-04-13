<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/10/16
 * Time: 4:05 PM
 */
header('Content-Type: text/html; charset=utf8');
include "connectDB.php";

$con = connectDB();
mysqli_set_charset($con, 'utf8');


$title =  $_POST["TITLE"];


if(empty($title)){
    die("please enter something");
}
else{
    $title = test_input($title);
}



$sql = "SELECT * FROM post WHERE post.title LIKE '%".$title."%'";
$result = mysqli_query($con, $sql);

//print out the data returned from the database
$ctr = 0;
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $linkinfo = "http://biliflixx.web.engr.illinois.edu/showAnime.php?id=".$row["id"];

//        echo "id: " . $row["id"] . " , title: " . $row["title"];

        echo "<a href=".$linkinfo.">id:".$row["aid"]." , title:".$row["title"]."</a>";

        echo "<br>";
        $ctr++;
        if($ctr >= 200){
            break;
        }
    }
}
else{
    echo "no id found";
}

//close connection
mysqli_close($con);