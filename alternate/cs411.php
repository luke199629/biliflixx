<?php
$servername = "engr-cpanel-mysql.engr.illinois.edu";
$username = "biliflix_zoe";
$password = "zoezhou1527";
$dbname = "biliflix_gazeOfIntelligence";

$con = mysqli_connect($servername,$username,$password);

if(mysqli_connect_errno()){
	die("Couls not connect:". mysqli_connect_errno());
}

mysqli_select_db($con,$dbname);

$sql = "SELECT * FROM Student";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
 	while($row = mysqli_fetch_assoc($result)){
 		echo "netid:".$row["netid"].", Age:".$row["age"].", Major".$row["major"]. "<br>";
 	 	}
 }
 else{
 	echo "No students found";
 }

 mysqli_close($con);
 ?>