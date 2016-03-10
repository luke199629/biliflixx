<?php

include 'connectDB.php';
$con = connectDB();

$title =  $_POST["TITLE"];


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
?>