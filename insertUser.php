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

if($password != $re_enteredpassword || $username == ""){
	die('<script type="text/javascript">window.location.href="' . "insertUser.html" . '";</script>');
}
// echo $username . "##" . $password . "##" . $re_enteredpassword . "##" . $age . "##" . $iconaddr . "##" . $gender . "<br>";
//$sql = "SELECT * FROM post WHERE post.title LIKE '%".$username."%'";
//$password = sha1($password);
$sql = mysqli_query($con, "INSERT INTO user(username, password, gender, age, icon_location)
	VALUES ('$username', '$password', '$gender', '$age', '$iconaddr')");

$sql = "SELECT * FROM user";
$result = mysqli_query($con, $sql);

//echo "<script language=\"JavaScript\">\r\n";
die('<script type="text/javascript">window.location.href="' . "tryout.html" . '";</script>');

            //	echo " alert(\"Successfully registered.\");\r\n";
            	
            //	echo " history.back();\r\n";
            	//echo "</script>";
               

//print out the data returned from the database
//$ctr = 0;

// if(mysqli_num_rows($result) > 0){
//     while($row = mysqli_fetch_assoc($result)){
//         echo "id: " . $row["username"] . "<br>";
// //        $ctr++;
// //        if($ctr >= 200){
// //            break;
// //       }
//     }
// }
// else{
//     echo "no id found";
// }
die('<script type="text/javascript">window.location.href="' . "tryout.html" . '";</script>');


//close connection
mysqli_close($con);