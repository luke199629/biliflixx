<!--/**-->
<!--* Created by PhpStorm.-->
<!--* User: zhangyuanshan-->
<!--* Date: 3/14/16-->
<!--* Time: 11:17 PM-->
<!--*/-->
<!---->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>



</body>
</html>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Biliflixx - by Gaze of Intelligence</title>

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

      <form action="logincheck.php" method="post">
      
        <h1>Login</h1>
        <span class="error">* 
    <?php echo $nameErr;?></span>
     Name: <input type="text" name="username">
    <span class="error">*  
	<?php echo $passwordErr;?></span>
   PassWord: <input type="text" name = "password">
    

    <br><br>

    <?php
    if (isset($_GET["msg"])) {
        echo $_GET["msg"]."<br><br>";
    }
    ?>
    <input type="submit" name="submit" value="Submit" class = "btn btn-primary">
      </form>
      
    </body>
</html>