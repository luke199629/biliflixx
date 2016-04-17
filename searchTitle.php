<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/10/16
 * Time: 4:05 PM
 */
session_start();

header('Content-Type: text/html; charset=utf8');
?>



<html>
<a href="searchPage.php">Back to search page</a>
<br>
<a href="index.html">Back to home page</a>
<br>
<br>
</html>


<?php

include "connectDB.php";

$con = connectDB();
mysqli_set_charset($con, 'utf8');


$title =  $_GET["TITLE"];

$pageNum = 1;

$startPage = 0;

$ranks = "default";

$sGenre = "default";

$useGen = "false";

$maxPage = 0;

$ssuser = "false";

if(isset($_GET["searchUser"])){
    $ssuser = $_GET["searchUser"];
}


if(isset($_GET["maxPage"])){
    $maxPage = $_GET["maxPage"];
}

if (isset($_GET["rankStandard"])){
    $ranks = $_GET["rankStandard"];
}

if(isset($_GET["useGenre"])){
    $useGen = $_GET["useGenre"];
}

if(isset($_GET["genre"])){
    $sGenre = $_GET["genre"];
}

if (isset($_GET["pageNum"])){
    $pageNum = $_GET["pageNum"];
    $startPage = $pageNum * 40;
}

if(empty($title)){
    die("please enter something");
}
else{
    $title = test_input($title);
}


$sql = "";

if(isset($_GET["searchUser"]) && $_GET["searchUser"] == "true"){
    $sql = "SELECT * FROM post WHERE post.author LIKE '%" . $title . "%'";

}
else {

    if(isset($_GET["rankStandard"])){
        if($_GET["rankStandard"] == "byHotnessDesc"){
            if(isset($_GET["genre"]) && isset($_GET["useGenre"]) && $_GET["useGenre"] == "true"){

                $genre = $_GET["genre"];
                $sql = "SELECT * FROM post WHERE (post.tid = '$genre' OR post.pid = '$genre') AND (post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%' )
            ORDER BY favorites DESC, play DESC";
            }
            else{
                $sql = "SELECT * FROM post WHERE post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%' 
            ORDER BY favorites DESC, play DESC";
            }
        }
        else if ($_GET["rankStandard"] == "byTimeDesc"){
            if(isset($_GET["genre"]) && isset($_GET["useGenre"]) && $_GET["useGenre"] == "true"){
                $genre = $_GET["genre"];
                $sql = "SELECT * FROM post WHERE (post.tid = '$genre' OR post.pid = '$genre') AND ( AND '%'post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%') 
            ORDER BY posttime DESC";
            }
            else {
                $sql = "SELECT * FROM post WHERE post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%' 
            ORDER BY posttime DESC";
            }
        }
        else if($_GET["rankStandard"] == "byHotnessAsc"){
            if(isset($_GET["genre"]) && isset($_GET["useGenre"]) && $_GET["useGenre"] == "true"){
                $genre = $_GET["genre"];
                $sql = "SELECT * FROM post WHERE (post.tid = '$genre' OR post.pid = '$genre') AND (post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%' )
            ORDER BY favorites ASC, play ASC";
            }
            else {
                $sql = "SELECT * FROM post WHERE post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%' 
            ORDER BY favorites ASC, play ASC";
            }
        }
        else if ($_GET["rankStandard"] == "byTimeAsc"){
            if(isset($_GET["genre"]) && isset($_GET["useGenre"]) && $_GET["useGenre"] == "true"){
                $genre = $_GET["genre"];
                $sql = "SELECT * FROM post WHERE (post.tid = '$genre' OR post.pid = '$genre') AND ( AND '%'post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%') 
            ORDER BY posttime ASC";
            }
            else {
                $sql = "SELECT * FROM post WHERE post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%' 
            ORDER BY posttime ASC";
            }
        }
        else if ($_GET["rankStandard"] == "byFavor" && isset($_SESSION['username']) && isset($_SESSION["login"]) && $_SESSION['login'] == 1){
            $username = $_SESSION['username'];
            $sql0 = "SELECT * FROM user WHERE username = '$username'";

            $tempVlaue = $con->query($sql0);

            $userInfo = $tempVlaue->fetch_assoc();

            $t1 = $userInfo['1'];

            $t3 = $userInfo['3'];

            $t4 = $userInfo['4'];

            $t5 = $userInfo['5'];

            $t11 = $userInfo['11'];

            $t12 = $userInfo['12'];

            $t13 = $userInfo['13'];

            $t20 = $userInfo['20'];

            $t23 = $userInfo['23'];

            $t36 = $userInfo['36'];

            $t37 = $userInfo['37'];

            $t60 = $userInfo['60'];

            $t75 = $userInfo['75'];


            $sql = "CREATE TEMPORARY TABLE t1 (genre INT(10), value INT(10));";

            if ($con->query($sql) === TRUE) {
            } else {
                echo "Error: temp table" . $sql . "<br>" . $con->error;
            }

            echo $sql;

            $sqltemp = " INSERT INTO t1 VALUES (1, '$t1');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (3, '$t3');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (4, '$t4');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (5, '$t5');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (11, '$t11');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (12, '$t12');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (13, '$t13');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (20, '$t20');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (23, '$t23');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (36, '$t36');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (37, '$t37');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (60, '$t60');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }
            $sqltemp = "INSERT INTO t1 VALUES (75, '$t75');";
            if ($con->query($sqltemp) === TRUE) {
            } else {
                echo "Error: temp table" . $sqltemp . "<br>" . $con->error;
            }


            $sql = "SELECT post.pid, post.aid, post.id, post.title, t1.genre FROM post, t1 WHERE post.pid = t1.genre AND (post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%') ORDER BY t1.value DESC";

            
        }
        else{

            $sql = "SELECT * FROM post WHERE post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%'";


        }

    }
    else {
        $sql = "SELECT * FROM post WHERE post.title LIKE '%" . $title . "%' OR tag LIKE '%" . $title . "%' OR description LIKE '%" . $title . "%'";

    }
}

if($pageNum == 1){
    $temp = $con->query($sql);
    $totalResults = mysqli_num_rows($temp);
    $maxPage = $totalResults / 40;
}

$sql= $sql." LIMIT 40 OFFSET ".$startPage.";";

//echo $sql;

$result = mysqli_query($con, $sql);


//print out the data returned from the database
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $linkinfo = "http://biliflixx.web.engr.illinois.edu/showAnime.php?id=" . $row["id"];

        //        echo "id: " . $row["id"] . " , title: " . $row["title"];

        echo "<a href=" . $linkinfo . ">aid:" . $row["aid"] . " , title:" . $row["title"] . "PID".$row["pid"].", tid: ". $row["tid"]."</a>";

        echo "<br>";
        
    }
    $nextPage = $pageNum + 1;
    $previousPage = $pageNum - 1;

    echo "<br><br>";
    if ($previousPage > 0){
        echo "<a href='searchTitle.php?pageNum=".$previousPage."&rankStandard=".$ranks."&genre=".$sGenre."&TITLE=".$title."&useGenre=".$useGen."&maxPage=".$maxPage."&searchUser=".$ssuser."'>previous</a>";
        echo " | ";
    }
    if ($pageNum <= $maxPage - 1) {
        echo "<a href='searchTitle.php?pageNum=" . $nextPage . "&rankStandard=" . $ranks . "&genre=" . $sGenre . "&TITLE=" . $title . "&useGenre=" . $useGen . "&maxPage=".$maxPage."&searchUser=".$ssuser."'>next</a>";
    }
} else {
    echo "no id found";
}


//close connection
mysqli_close($con);