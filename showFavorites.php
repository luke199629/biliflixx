<?php
header('Content-Type: text/html; charset=utf8');
?>





<?php


include "connectDB.php";


$con = connectDB();
mysqli_set_charset($con, 'utf8');


$userID = $_GET["username"];






?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title
    
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Biliflixx - by Gaze of Intelligence</title>

	<!-- Load fonts -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>

	<!-- Load css styles -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<style>
body {margin:0;}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    position: fixed;
    top: 0;
    width: 100%;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}
</style>
    
</head>

<body>
<ul>
  <li><a href="http://biliflixx.web.engr.illinois.edu/" title="Home">Home</a></li>
                <li><a href="https://wiki.cites.illinois.edu/wiki/display/cs411sp16/Gaze+of+Intelligence" title="About Us">About Us</a></li>
                 <li><a href="javascript:q=(document.location.href);void(open('insertUser.html?url='+escape(q),'_self','resizable,location,menubar,toolbar,scrollbars,status'));" title="Regist">Registration</a></li>
                <li><a href="usrpage.php" title="account">My Account</a></li>
                
</ul>
<div class="jumbotron home home-fullscreen" id="home">
		
		
		
			
		</div>
<div class align = "center" 

			<div class="container"><form action="searchTitle.php" method="get">
   				<input type="text" name="TITLE" value="Want to explore more? Just search it!" onfocus="if(value=='Want to explore more? Just search it!') {value=''}" onblur="if (value=='') {value='Want to explore more? Just search it!'}" name="keyword" size="30" style="color:#A9A9A9;" class = "test">
	                   
		  		<input type= "submit" value="Search" class = "btn btn-primary"></form>
        <section style="padding-bottom: 0px; padding-top: 0px;">
         <h3>Here are your favorites:</h3> <br><br>
		<?php
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


?>

		
	
		
		</div>
		
		<br><br><br><br>
<div align="center">	
<a href="usrpage.php">Back to my account</a>
<br>
<a href="index.html">Back to home page</a>
<br>
<br>
</div>


		
		
		
	</body>












