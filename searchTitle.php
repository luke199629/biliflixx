<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/10/16
 * Time: 4:05 PM
 */
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
        echo "id: " . $row["id"] . " , title: " . $row["title"] . "<br>";
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
