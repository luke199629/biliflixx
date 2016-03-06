<?php
$servername = "engr-cpanel-mysql.engr.illinois.edu";
$username = "biliflix_luke_ad";
$password="biliflix_luke";
$dbname = "biliflix_gazeOfIntelligence";

// Start connection

$con = mysqli_connect($servername, $username, $password);
if(mysqli_connect_errno()){
	die("could not connect: " . mysqli_connect_error());
}

// connect to database
mysqli_select_db($con, $dbname);

//select data from the database
$sql = "SELECT * FROM user";
$result = mysqli_query($con, $sql);

//print out the data returned from the database
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		echo "Username: " . $row["username"] . ", Age: " . $row["age"] . ", Gender: " . $row["gender"] . ", Password: " . $row["password"] . "<br>";
	}
}
else{
	echo "no user found";
}

//close connection
mysqli_close($con);
?>