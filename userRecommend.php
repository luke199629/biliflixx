<?php
header('Content-Type: text/html; charset=utf8');



/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/16/16
 * Time: 4:41 PM
 */
include "connectDB.php";
include "untility.php";

session_start();

echo "<a href='usrpage.php'>User Page</a>";
echo "<br>";
echo "<a href='index.html'>Home page</a>";
echo "<br>";


if(isset($_SESSION['username']) && isset($_SESSION["login"]) && $_SESSION['login'] == 1) {
    $con = connectDB();
    mysqli_set_charset($con, 'utf8');


    $userName = $_SESSION["username"];
    
    $sql = "SELECT * FROM updatePercent WHERE username = '$userName';";

    echo $sql;

    $rows = mysqli_query($con, $sql);


    $row = mysqli_fetch_assoc($rows);

    $userInfo = array("percent1" => $row["percent1"], "percent3" => $row["percent3"], "percent4" => $row["percent4"], "percent5" => $row["percent5"],
        "percent11" => $row["percent11"], "percent12" => $row["percent12"], "percent13" => $row["percent13"], "percent20" => $row["percent20"],"percent23" => $row["percent23"],
        "percent36" => $row["percent36"],"percent37" => $row["percent37"], "percent60" => $row["percent60"], "percent75" => $row["percent75"], "percent999" => $row["percent999"]);

    arsort($userInfo);

    $ctr = 0;

    $top1Name = "";
    $top1Value = 0;

    $top2Name = "";
    $top2Value = 0;

    $top1Name = "";
    $top1Value = 0;


    foreach ($userInfo as $typeName => $typeValue) {
        if($ctr > 2){
            break;
        }

        if($ctr == 0){
            $top1Name = $typeName;
            $top1Value = $typeValue;

            echo "1 ".$top1Name." ".$top1Value;
            echo "<br>";

        }
        if($ctr == 1){
            $top2Name = $typeName;
            $top2Value = $typeValue;

            echo "2 ".$top2Name." ".$top2Value;
            echo "<br>";

        }
        if($ctr == 2){
            $top3Name = $typeName;
            $top3Value = $typeValue;


            echo "3 ".$top3Name." ".$top3Value;
            echo "<br>";

        }
        $ctr += 1;
    }


    $user1Name = $user1["username"];

    $typeId1 = substr($top1Name, 7, 12);

    echo $typeId1;
    echo "<br>";

    $typeId2 = substr($top2Name, 7, 12);

    echo $typeId2;
    echo "<br>";

    $typeId3 = substr($top3Name, 7, 12);

    echo $typeId3;
    echo "<br>";



    $sql2 = "SELECT * FROM updatePercent WHERE username != '$userName' AND ((".$top1Name." >= (".$top1Value." - 0.05)) AND (".$top1Name." <= (".$top1Value." + 0.05))) 
             AND ((".$top2Name." >= (".$top2Value." - 0.07)) AND (".$top2Name." <= (".$top2Value." + 0.07))) 
             AND ((".$top3Name." >= (".$top3Value." - 0.09)) AND (".$top3Name." <= (".$top3Value." + 0.09))) AND (SELECT COUNT(*) FROM favorites WHERE updatePercent.username = favorites.userID AND (tid = ".$typeId1." OR pid = ".$typeId1." OR tid = ".$typeId2." OR pid = ".$typeId2." OR tid = ".$typeId3." OR pid = ".$typeId3.")) > 0";

    echo $sql2;

    $familiarUsers = $con -> query($sql2);

    if(mysqli_num_rows($familiarUsers) <= 0){
        echo mysqli_num_rows($familiarUsers);
        echo "not enough users";
        
        //TODO ADD RECOMMEND
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }else {

        if ($familiarUsers === FALSE) {
            echo "Error: FETCH USERS" . $sql2 . "<br>" . $con->error;
        }

        $user1 = mysqli_fetch_assoc($familiarUsers);

        echo "user name is :" . $user1["username"] . "<br>";

        $familiarUserName = $user1["username"];

        $sql3 = "SELECT * FROM favorites WHERE userID = '$familiarUserName' AND (tid = " . $typeId1 . " OR pid = " . $typeId1 . " OR tid = " . $typeId2 . " OR pid = " . $typeId2 . " OR tid = " . $typeId3 . " OR pid = " . $typeId3 . ")";


        echo $sql3;


        echo "<br>";


        $pageNum = 1;

        $startPage = 0;

        $maxPage = 0;

        if (isset($_GET["maxPage"])) {
            $maxPage = $_GET["maxPage"];
        }

        if (isset($_GET["pageNum"])) {
            $pageNum = $_GET["pageNum"];
            $startPage = $pageNum * 40;
        }

        if ($pageNum == 1) {
            $temp = $con->query($sql3);
            $totalResults = mysqli_num_rows($temp);
            $maxPage = $totalResults / 40;
        }

        $sql3 = $sql3 . " LIMIT 40 OFFSET " . $startPage . ";";

        $recommandedVideos = $con->query($sql3);


        if (mysqli_num_rows($recommandedVideos) > 0) {
            while ($row = mysqli_fetch_assoc($recommandedVideos)) {
                $linkinfo = "http://biliflixx.web.engr.illinois.edu/showAnime.php?id=" . $row["videoid"];

                //        echo "id: " . $row["id"] . " , title: " . $row["title"];

                echo "<a href=" . $linkinfo . ">title:" . $row["title"] . "PID" . $row["pid"] . "</a>";

                echo "<br>";
            }
            echo "<br><br>";

            $nextPage = $pageNum + 1;
            $previousPage = $pageNum - 1;

            if ($previousPage > 0) {
                echo "<a href='userRecommend.php?pageNum=" . $previousPage . "&maxPage=" . $maxPage . "'>previous</a>";
                echo " | ";
            }
            if ($pageNum <= $maxPage - 1) {
                echo "<a href='userRecommend.php?pageNum=" . $nextPage . "&maxPage=" . $maxPage . "'>next</a>";
            }
        } else {
            echo "fucking error";
        }
    }


}