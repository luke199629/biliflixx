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
//    $username = test_input($username);
    //$password = sha1($password);


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
//            //TODO INSET HEADER HERE
//            echo "login success";
            header("Location: /usrpage.php");

        }
        else{//wrong pass
            $_SESSION['login'] = 0;
            header("Location: /login.php?msg=Wrong Password/UserName combination");
        }
    }
    else{//no username
        $_SESSION['login'] = 2;
        header("Location: /login.php?msg=No User Name");
    }
    $connect->close();
}
else{//not entered
    $_SESSION['login'] = 3;
    header("Location: /login.php?msg=Please User Name/Password");
}


