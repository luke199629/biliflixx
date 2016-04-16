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
</head>
<body>

<?php
if (isset($_GET["msg"])) {
    echo $_GET["msg"]."<br><br>";
}

echo "username: ".$usrname."<br>";
echo "age: ".$age."<br>";
echo "gender: ".$gender."<br>";

?>


<br>
Upload video
<br>
<a href="upload.php">UploadPage</a>


<br>
<br>
<br>
Update info:
<br>
<br>


<br>
<form action="updatePassword.php" method="post">
    Password:<br>
    <input name="password" type="password"/><br>
    Re-enter password:<br>
    <input name="re_enteredpassword" type="password"/><br>
    <input type="Submit">
</form>
<br>

<form action="updateAge.php" method="post">
    Age:<br>
    <input name="age" type="number"><br>
    <input type="Submit">
</form>
<br>

<form action="updateGender.php" method="post">
    Gender:<br>
    <input name="gender" type="radio" value="male" />Male<br>
    <input name="gender" type="radio" value="female" />Female<br>
    <input name="gender" type="radio" value="other" />Other<br>
    <input type="Submit">
</form>
<br>

<form action="deleteUserFromUser.php" method="post">
    Delete Account:<br>
    <input type="Submit">
</form>

    
<br>
<a href="index.html">Back to homepage
</a>

<br>
<a href="showFavorites.php?username=<?php echo $usrname;?>">Show my favorites
</a>


</body>
</html>