<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/15/16
 * Time: 4:01 PM
 */
include 'connectDB.php';
session_start();

$age;
$usrname;
$gender;

if(isset($_SESSION['username']) && isset($_SESSION["login"])){
    $usrname = $_SESSION['username'];
    if($_SESSION["login"] == 1){
        $connect=connectDB();
        $sql = "SELECT * FROM user WHERE username = '$usrname'";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();

        $age = $row["age"];
        $usrname = $row["username"];
        $gender = $row["gender"];
    }
    else{
        echo "opps Error";
        die();
    }
}
else{
    echo "opps Error";
    die();
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    
    
    
    
    
    
    
    
   
    
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
		<div class="mask"></div>
		
		
		</div>
		
		
		<div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
        
        
        	 <h3> 
                    <?php
			if (isset($_GET["msg"])) {
			    echo $_GET["msg"]."<br><br>";
			}
			
			echo "Username: ".$usrname."<br>";

			echo "Gender: ".$gender."<br>";
			echo "Registered Age: ".$age."<br>";
			?>

		   </h3>
            <div class="row">
                <div class="column col-md-4">
      	            
		   
                    <br />
                    <h3> Change your Age</h3> 
                    <form action="updateAge.php" method="post">
		    <input name="age" type="number" class="form-control"><br>
		    <input type="submit" class="btn btn-primary" value="UPDATE"/>
		    </form> 
		  
		   	
                    <a href="upload.php"> <h3>Upload video</h3></a>
                    <br/>
                    <a href="userRecommend.php"><h3>Recommendation</h3></a>
			
		    <br>
	           <a href="prediction.php"><h3>Hot Video Prediction</h3></a>
                   
                </div> 
              
                <div class="form-group col-md-8">
                	
                        <h3>Change Your Password</h3>
                        <form action="updatePassword.php" method="post">
   			 <label>Enter New Password</label>
                        <input name="password" type="password" class="form-control">
                        <label>Confirm New Password</label>
                        <input name="re_enteredpassword"type="password" class="form-control" />
                        
                        <input type="submit" class="btn btn-primary" value="UPDATE"/>
   
                        <br />
                        
                        
                       
                 </div>
                 
		   <a href="showFavorites.php?username=<?php echo $usrname;?>"><h3>Show my favorites</h3></a>
		   <br>
                   <a href="deleteUserFromUser.php"><h3>Delete Account</h3></a>
            
                 
                <!-- /*  <div class="column col-md-4">
      	                 
                   <h3>Change your gender </h3>
		    <form action="updateGender.php" method="post">
    		    <input name="gender" type="radio" value="male" class="form-control"/>Male<br>
    		   <input name="gender" type="radio" value="female" class="form-control" />Female<br>
    		   <input name="gender" type="radio" value="other" class="form-control" />Other<br>
    		   <input type="Submit" class="btn btn-primary"/>
		</form>       
                        
                        
                  </div>*/-->
                    </div >
                 
		
		</div>


</fieldset>
    
</body>
</html>