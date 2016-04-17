<?php
header('Content-Type: text/html; charset=utf8');
?>





<?php


include "connectDB.php";


$con = connectDB();
mysqli_set_charset($con, 'utf8');


$userID = $_GET["username"];



$sql = "SELECT * FROM favorites WHERE favorites.userID = '$userID'";
$result = mysqli_query($con, $sql);

//print out the data returned from the database

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
    	$id = $row["videoid"];
    	$sql0 = "SELECT * FROM post WHERE post.id = '$id'";
    	$result2 = mysqli_query($con, $sql0);
    	$ctr = 0;
    	if(mysqli_num_rows($result2) > 0){
    		 while($row2 = mysqli_fetch_assoc($result2)){
        		$linkinfo = "http://biliflixx.web.engr.illinois.edu/showAnime.php?id=".$row2["id"];

			echo "<a href=".$linkinfo.">id:".$row2["aid"]." , title:".$row2["title"]."</a>";

        		echo "<br>";
       			$ctr++;
        		if($ctr >= 200){
            			break;
        		}
   		 }	
  	}		
  }
  
  
}
else{
	

  	 	echo "<script language=\"JavaScript\">\r\n";
            	echo " alert(\"You don't have anything in your favorites.\");\r\n";
            	echo " history.back();\r\n";
            	echo "</script>";
}





//close connection
mysqli_close($con);