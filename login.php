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


<form method="post" action="logincheck.php">

    Name: <input type="text" name="username">
    <span class="error">* 
     
    
    <?php echo $nameErr;?></span>
    <br><br>

    PassWord: <input type="text" name = "password">
    <span class="error">* 
    
    
    <?php echo $passwordErr;?></span>

    <br><br>

    <?php
    if (isset($_GET["msg"])) {
        echo $_GET["msg"]."<br><br>";
    }
    ?>


    <input type="submit" name="submit" value="Submit">

</form>
</body>
</html>
