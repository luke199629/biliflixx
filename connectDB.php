<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/10/16
 * Time: 11:46 AM
 *
 * */

//remember to include this file when call connectDB
function connectDB(){
    $servername = "engr-cpanel-mysql.engr.illinois.edu";
    $username = "biliflix_luke_ad";
    $password = "biliflix_luke";
    $dbname = "biliflix_gazeOfIntelligence";
    $connect=new mysqli($servername,$username,$password,$dbname);
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
    return $connect;
    }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

