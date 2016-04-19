<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/17/16
 * Time: 8:12 PM
 */

header('Content-Type: text/html; charset=utf8');

include "connectDB.php";
include "untility.php";

session_start();

echo "<a href='usrpage.php'>User Page</a>";
echo "<br>";
echo "<a href='index.html'>Home page</a>";
echo "<br>";


$pageNum = 1;

$startPage = 0;

$maxPage = 0;

if(isset($_GET["maxPage"])){
    $maxPage = $_GET["maxPage"];
}

if (isset($_GET["pageNum"])){
    $pageNum = $_GET["pageNum"];
    $startPage = $pageNum * 40;
}

$con = connectDB();

$sql = "SELECT * FROM Prediction";

if(!isset($_GET["pageNum"])){
    $temp = $con->query($sql);
    $totalResults = mysqli_num_rows($temp);
    $maxPage = $totalResults / 40;
}

$sql= $sql." LIMIT 40 OFFSET ".$startPage.";";

//echo $sql;

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $linkinfo = "http://biliflixx.web.engr.illinois.edu/showAnime.php?id=" . $row["id"];

        //        echo "id: " . $row["id"] . " , title: " . $row["title"];

        echo "<a href=" . $linkinfo . ">aid:" . $row["aid"] . " , title:" . $row["title"]."</a>";

        echo "<br>";

    }
    $nextPage = $pageNum + 1;
    $previousPage = $pageNum - 1;

    echo "<br><br>";
    if ($previousPage > 0){
        echo "<a href='prediction.php?pageNum=" . $previousPage . "&maxPage=" . $maxPage . "'>previous</a>";
        echo " | ";
    }
    if ($pageNum <= $maxPage - 1) {
        echo "<a href='prediction.php?pageNum=" . $nextPage . "&maxPage=" . $maxPage . "'>next</a>";
    }
} else {
    echo "nothing in prediction";
}


