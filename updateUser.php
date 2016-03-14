<?php
/**
 * Used to insert new user and user information into
 * the database. 
 *
 * 
 */
header('Content-Type: text/html; charset=utf8');
include "connectDB.php";

$con = connectDB();
mysqli_set_charset($con, 'utf8');


$username =  $_POST["username"];
$password = $_POST["password"];
$re_enteredpassword = $_POST["re_enteredpassword"];
$age = $_POST["age"];
$iconaddr = $_POST["iconAddr"];
$gender = $_POST["gender"];

if($password != $re_enteredpassword){
	die('<script type="text/javascript">window.location.href="' . "updateUser.html" . '";</script>');
}
echo $username . "##" . $password . "##" . $re_enteredpassword . "##" . $age . "##" . $iconaddr . "##" . $gender . "<br>";
//$sql = "SELECT * FROM post WHERE post.title LIKE '%".$username."%'";
// $sql = mysqli_query($con, "INSERT INTO user(username, password, gender, age, icon_location)
// 	VALUES ('$username', '$password', '$gender', '$age', '$iconaddr')");
$sql = mysqli_query($con, "UPDATE user SET password = '$password', gender = '$gender', age = '$age', icon_location = '$iconAddr' WHERE username = '$username'");

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


//close connection
mysqli_close($con);