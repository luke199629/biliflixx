<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/10/16
 * Time: 5:17 PM
 */

session_start();
$username = $_POST['username'];
$password = $_POST['password'];
include 'connectDB.php';



if($username && $password){
    $connect=connectDB();
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $connect->query($sql);
    $numrows = $result->num_rows;

    if($numrows > 0){
        $row = $result->fetch_assoc();
        $dbusername = $row['username'];
        $dbpassword = $row['password'];


        if($username == $dbusername && $password == $dbpassword){
            $_SESSION['username'] = $username;
            $_SESSION['login'] = 1;
            //TODO INSET HEADER HERE
            echo "login success";

        }
        else{
            $_SESSION['login'] = 0;
            //TODO INSERT HEADER HERE


        }
    }
    else{
        //TODO INSERT HEADER HERE
        $_SESSION['login'] = 2;

    }
    $connect->close();
}
else{
    $_SESSION['login'] = 3;


}


