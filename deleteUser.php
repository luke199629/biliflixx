<?php
/**
 * Used to delete existing user and user information into
 * the database. 
 *
 * 
 */
header('Content-Type: text/html; charset=utf8');
include "connectDB.php";

$con = connectDB();
mysqli_set_charset($con, 'utf8');


$username =  $_POST["username"];

//$sql = "SELECT * FROM post WHERE post.title LIKE '%".$username."%'";
$sql = mysqli_query($con, "DELETE FROM user WHERE username = '$username'");

$sql = "SELECT * FROM user";
$result = mysqli_query($con, $sql);

//print out the data returned from the database
//$ctr = 0;

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "id: " . $row["username"] . "<br>";
//        $ctr++;
//        if($ctr >= 200){
//            break;
//       }
    }
}
else{
    echo "no id found";
}
echo '<FORM METHOD="LINK" ACTION="deleteUser.html">';
echo '<INPUT TYPE="submit" VALUE="Back">';
echo '</FORM>';

//close connection
mysqli_close($con);
?>