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
    $username = test_input($username);
    $password = test_input($password);


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
            //echo "login success";

        }
        else{//wrong pass
            $_SESSION['login'] = 0;
            header("Location: /logininter.php?msg=Wrong Password/UserName combination");
        }
    }
    else{//no username
        //TODO INSERT HEADER HERE
        $_SESSION['login'] = 2;
        header("Location: /logininter.php?msg=No User Name");

    }
    $connect->close();
}
else{//not entered
    $_SESSION['login'] = 3;
    //TODO INSET HEADER HERE
    header("Location: /logininter.php?msg=Please User Name/Password");
}


