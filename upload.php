<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/12/16
 * Time: 5:44 PM
 */
include "connectDB.php";

session_start();

$con = connectDB();

$sql = "SELECT * FROM GenreType";
$result = mysqli_query($con, $sql);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>upload</title>

        <link href="signupcss/style.css" type="text/css" rel="stylesheet" media="screen and (min-width: 1px)"/>
        
        <script src="signupcss/signup.js" type="text/javascript"></script>
        


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
   
    <body background="xiaomai1.gif">

      <form action="uploadfile.php" method="post">
    <h3>Title:</h3>
    <input name="title" type="text"/><br>
    <h3>Cover link:</h3>
    <input name="cover" type="text" placeholder="http://i1.hdslb.com/userup/68/124b29128-1222.JPG"/><br>
    <h3>Description:</h3>
    <input name="Description" type="text"/><br>
    <h3>Tags:</h3>
    <input name="tags" type="text"/><br>
    <h3>Genre:</h3>
    <select name="genre">
        <?php
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value=".$row["tid"].">".$row["tname"]."</option>";
                $ctr++;
            }
        }
        ?>
    </select><br><br><br>
    <input type="Submit" onclick="alert('Upload Successfully')" value = "Upload" class="btn btn-primary">
</form>
      
   

<br>


<?php
mysqli_close($con);

?>

</body>
</html>