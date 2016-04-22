<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/17/16
 * Time: 11:29 PM
 */

include "connectDB.php";

$con = connectDB();

$sql = "UPDATE post SET `dplaydt` = (`play` - `lastPlay`) / 24, `dfavoritesdt` = (`favorites` - `lastFavorites`) / 24";

echo "<br>";

if($con->query($sql) === TRUE ){
    echo "update delta success";
}
else{
    echo "update delta fail";

}

usleep(30);

echo "<br>";


$sql = "UPDATE `post` SET `lastPlay` = `play`,`lastFavorites` = `favorites`";

if($con->query($sql) === TRUE ){
    echo "update play success";
}
else{
    echo "update play fail";

}

usleep(10);

echo "<br>";

$currtime = time();

$timeInFormat = gmdate('o-n-d', $currtime);

//$sql = "INSERT INTO hotIndex(aid, tid, dur, pid, dplaydt, dfavoritesdt,play, fav)
//        (SELECT post.aid, post.tid, post.dur, post.pid, post.dplaydt, post.dfavoritesdt, post.play, post.favorites FROM post
//        WHERE post.aid NOT IN (SELECT aid FROM hotIndex) AND (post.play >= 70000 OR post.favorites >= 40000));";
//
//
//$sql = "INSERT INTO hotIndex(aid, tid, dur, pid, dplaydt, dfavoritesdt,play, fav)
//        (SELECT DISTINCT post.aid, post.tid, post.dur, post.pid, post.dplaydt, post.dfavoritesdt, post.play, post.favorites FROM post
//        WHERE ((post.aid NOT IN (SELECT hotIndex.aid FROM hotIndex)) AND (post.play > ANY (SELECT (avg(post.play) + 2.3 * STD(post.play)) FROM post) OR post.favorites > ANY (SELECT (avg(post.favorites) + 2.3 * STD(post.favorites)) FROM post)) ));";

//echo $sql;



$sql = "INSERT INTO hotIndex(aid, tid, dur, pid, dplaydt, dfavoritesdt,play, fav)
        (SELECT DISTINCT post.aid, post.tid, post.dur, post.pid, post.dplaydt, post.dfavoritesdt, post.play, post.favorites FROM post
        WHERE ((post.aid NOT IN (SELECT hotIndex.aid FROM hotIndex)) AND (post.play > ANY (SELECT (avg(post.play) + 3 * STD(post.play))) OR (post.favorites > ANY (SELECT (avg(post.favorites) + 3 * STD(post.favorites)))))));";


echo "<br>";


//TODO MAY CHANGE TO ORDER BY PLAY 

if($con->query($sql) === TRUE ){
    echo "update hot success";
}
else{
    echo "update hot fail";
    echo "Error: hot fail" . $sql . "<br>" . $con->error;
}

echo "<br>";
echo "here";

$sql = "UPDATE `hotIndex` SET `hdate`= DATE_SUB(curdate(), INTERVAL 1 DAY ) WHERE `hdate` = 0000-00-00";


if($con->query($sql) === TRUE ){
    echo "update hot success";
}
else{
    echo "update hot fail";
    echo "Error: temp table" . $sql . "<br>" . $con->error;
}

echo "<br>";


$sql = "UPDATE gt SET day1 = 0, day2 = 0, day3 = 0, day4 = 0, day5 = 0;";

if($con->query($sql) === TRUE ){
    echo "delete gt success";
}
else{
    echo "update gt fail";
    echo "Error: gt table" . $sql . "<br>" . $con->error;
}

echo "<br>";


////////////////////1

$sql = "CREATE TEMPORARY TABLE tempValue1 (pid INT(4), hdate DATE, counting INT(8));";

if ($con->query($sql) === TRUE) {
} else {
    echo "Error: create temp table" . $sql . "<br>" . $con->error;
}



$sql = "INSERT INTO tempValue1
        SELECT pid, hdate, COUNT( pid )
         FROM hotIndex
         GROUP BY pid, hdate
         HAVING hdate > CURDATE( ) - INTERVAL 5 DAY ";


if ($con->query($sql) === TRUE) {
} else {
    echo "Error: insert into temp fail" . $sql . "<br>" . $con->error;
}

///////////////////////////////////////////////////////////


$sql = "update gt, tempValue1
	set day1 = tempValue1.counting
	where  tempValue1.pid = gt.pid AND tempValue1.hdate = CURDATE()- INTERVAL 4 DAY; ";

if ($con->query($sql) === TRUE) {
} else {
    echo "Error: update gt1" . $sql . "<br>" . $con->error;
}

$sql = "update gt, tempValue1
	set day2 = tempValue1.counting
	where  tempValue1.pid = gt.pid AND tempValue1.hdate = CURDATE()- INTERVAL 3 DAY; ";

if ($con->query($sql) === TRUE) {
} else {
    echo "Error: update gt2" . $sql . "<br>" . $con->error;
}

$sql = "update gt, tempValue1
	set day3 = tempValue1.counting
	where  tempValue1.pid = gt.pid AND tempValue1.hdate = CURDATE()- INTERVAL 2 DAY; ";

if ($con->query($sql) === TRUE) {
} else {
    echo "Error: update gt3" . $sql . "<br>" . $con->error;
}

$sql = "update gt, tempValue1
	set day4 = tempValue1.counting
	where  tempValue1.pid = gt.pid AND tempValue1.hdate = CURDATE()- INTERVAL 1 DAY; ";

if ($con->query($sql) === TRUE) {
} else {
    echo "Error: update gt4" . $sql . "<br>" . $con->error;
}

$sql = "update gt, tempValue1
	set day5 = tempValue1.counting
	where  tempValue1.pid = gt.pid AND tempValue1.hdate = CURDATE(); ";

if ($con->query($sql) === TRUE) {
} else {
    echo "Error: update gt5" . $sql . "<br>" . $con->error;
}

/////////////////////////

$sql = "UPDATE dgdt SET day1 = 0, day2 = 0, day3 = 0, day4 = 0;";

if($con->query($sql) === TRUE ){
    echo "delete dggt success";
}
else{
    echo "delete dgdt fail";
    echo "Error: dgdt table" . $sql . "<br>" . $con->error;
}

echo "<br>";



$sql = "UPDATE dgdt, gt SET dgdt.day4 = gt.day5 - gt.day4, dgdt.day3 = gt.day4 - gt.day3, dgdt.day2 = gt.day3 - gt.day2, dgdt.day1 = gt.day2 - gt.day1 WHERE dgdt.pid = gt.pid";

if($con->query($sql) === TRUE ){
    echo "update dggt success";
}
else{
    echo "update dgdt fail";
    echo "Error: dgdt table" . $sql . "<br>" . $con->error;
}

echo "<br>";

$sql = "UPDATE d2gdt2 SET day1 = 0, day2 = 0, day3 = 0;";

if($con->query($sql) === TRUE ){
    echo "delete d2ggt2 success";
}
else{
    echo "delete d2gdt2 fail";
    echo "Error: d2gdt2 table" . $sql . "<br>" . $con->error;
}

echo "<br>";

$sql = "UPDATE d2gdt2, dgdt SET d2gdt2.day3 = dgdt.day4 - dgdt.day3, d2gdt2.day2 = dgdt.day3 - dgdt.day2, d2gdt2.day1 = dgdt.day2 - dgdt.day1 WHERE d2gdt2.pid = dgdt.pid";

if($con->query($sql) === TRUE ){
    echo "update d2ggt2 success";
}
else {
    echo "update d2gdt2 fail";
    echo "Error: d2gdt2 table" . $sql . "<br>" . $con->error;
}

///////////////////////////below allocates weights
$sql = "UPDATE weights, dgdt, d2gdt2 
              SET weights.day1 = CASE 
                WHEN (dgdt.day2 >= 0 AND d2gdt2.day1 >= 0) THEN 0.8
                WHEN (dgdt.day2 >= 0 AND d2gdt2.day1 < 0) THEN 0.9
                WHEN (dgdt.day2 < 0 AND d2gdt2.day1 >= 0) THEN 1.2
                WHEN (dgdt.day2 < 0 AND d2gdt2.day1 < 0) THEN 1.1
                END,
                weights.day2 = CASE 
                WHEN (dgdt.day3 >= 0 AND d2gdt2.day2 >= 0) THEN 0.8
                WHEN (dgdt.day3 >= 0 AND d2gdt2.day2 < 0) THEN 0.9
                WHEN (dgdt.day3 < 0 AND d2gdt2.day2 >= 0) THEN 1.2
                WHEN (dgdt.day3 < 0 AND d2gdt2.day2 < 0) THEN 1.1
                END,
                weights.day3 = CASE 
                WHEN (dgdt.day4 >= 0 AND d2gdt2.day3 >= 0) THEN 0.8
                WHEN (dgdt.day4 >= 0 AND d2gdt2.day3 < 0) THEN 0.9
                WHEN (dgdt.day4 < 0 AND d2gdt2.day3 >= 0) THEN 1.2
                WHEN (dgdt.day4 < 0 AND d2gdt2.day3 < 0) THEN 1.1
                END
                WHERE weights.pid = dgdt.pid AND d2gdt2.pid = weights.pid";

if($con->query($sql) === TRUE ){
    echo "update weights success";
}
else {
    echo "update weights fail";
    echo "Error: weights table" . $sql . "<br>" . $con->error;
}

echo "<br>";



////////////


$sql = "DELETE FROM Prediction";

if($con->query($sql) === TRUE ){
    echo "delete pre success";
}
else{
    echo "update pre fail";
    echo "Error: pre table" . $sql . "<br>" . $con->error;
}

echo "<br>";

$sql = "SELECT AVG(hotIndex.dplaydt) AS avgDplay, AVG(hotIndex.dfavoritesdt) AS avgDfav FROM hotIndex";

$averages = $con->query($sql);

$rowAverage = mysqli_fetch_assoc($averages);

$aplay = $rowAverage["avgDplay"];

$afav = $rowAverage["avgDfav"];

echo $aplay;

echo "<br>";



echo $afav;
echo "<br>";


$sql = "INSERT INTO Prediction(aid, id, title) (SELECT post.aid, post.id, post.title FROM post, weights
        WHERE (((post.dplaydt >= 0.7 * ".$aplay." * weights.day1 * weights.day2 * weights.day3 * (1 - weights.percentage)) 
        OR (post.dfavoritesdt >= 0.7 * ".$afav." * weights.day1 * weights.day2 * weights.day3 * (1 - weights.percentage)))
        AND weights.pid = post.pid) Order by post.play)";

echo $sql;

echo "<br>";


if($con->query($sql) === TRUE ){
    echo "insert pre success";
}
else{
    echo "insert pre fail";
    echo "Error: pre table" . $sql . "<br>" . $con->error;
}

















//$sql = "SELECT AVG(dplaydt) AS dplay, AVG(dfavoritesdt) AS dfav FROM hotIndex";
//
//$avgresults = $con->query($sql);
//
//if($avgresults === TRUE ){
//    echo "update play success";
//}
//else{
//    echo "update play fail";
//
//}
//
//
//$row = mysqli_fetch_assoc($avgresults);
//
//$avgplay = $row["dplay"];
//
//$avgfavor = $row["dfav"];
//
//
//
//
//$sql = "INSERT INTO hotIndex(aid, tid, dur, pid, dplaydt, dfavoritesdt)
//        VALUES (SELECT post.aid, post.tid, post.dur, post.pid, post.dplaydt, post.dfavoritesdt FROM post
//                WHERE (post.aid NOT IN (SELECT aid FROM hotIndex)) AND (post.dplaydt >= ".$avgplay." OR post.dfavoritesdt >= ".$avgfavor."));";