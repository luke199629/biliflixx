<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/14/16
 * Time: 2:14 PM
 */
include "connectDB.php";

$con = connectDB();
$sql = "SELECT * FROM GenreType";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf8">
    <title>searchTitle</title>
</head>
<body>
!-- Load fonts -->
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


.test2{    
width:250px;         
height:40px;   
font-size:25px;
border-radius:10px; 
opacity:0.7;   
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

<div class="container" style="padding:20px;margin-top:30px;background:url('../xiaomai5.jpg');background-repeat:no-repeat;background-size:cover;">
<br>


        
<!--请将这一段整合进首页search功能, 样式随意, form action 和method 和第一input name 不能改-->
<div class="row">
                <div class="column col-md-4">
      	            
		   
                  

<form action="searchTitle.php" method="get">

                   <h3>  Title:</h3> 
                     <input type="text" name="TITLE" placeholder="EVA" size = 30  class="test2"><br>
    <select name="genre" class="test2" placeholder = "- -">
        <?php
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value=".$row["tid"].">".$row["tname"]."</option>";
                $ctr++;
            }
        }
        ?>
    </select>
    <select name="rankStandard" class="test2" placeholder = "- -">
        <option value="byHotnessDesc">By Hotness Desc</option>
        <option value="byTimeDesc">By Time Desc</option>
        <option value="byHotnessAsc">By Hotness Asc</option>
        <option value="byTimeAsc">By Time Asc</option>
        <option value="byFavor">By genre you liked</option>
    </select>
    <br>
     <h3>Search by user:</h3> 
    <input name="searchUser" type="radio" value="true" checked="checked" />Yes
    <input name="searchUser" type="radio" value="false" checked="checked"/>No<br>

  
     <h3>Search by genre:</h3> 
      <input name="useGenre" type="radio" value="true"/>Yes
    <input name="useGenre" type="radio" value="false" checked="checked" />No<br>

   <br><br><br>
    <input type="submit" value="SEARCH" class="btn btn-primary">



    <!--    <input name="InFavorites" type="radio" value="1" />Search Favorited Video<br>-->
<br>
</form>
</body>
</div>
</html>