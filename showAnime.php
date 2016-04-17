<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/17/16
 * Time: 2:39 AM
 */
header('Content-Type: text/html; charset=utf8');

include "connectDB.php";
include "untility.php";

header('Content-Type: text/html; charset=utf8');

$id;
if (isset($_GET["id"])) {

    $id = $_GET["id"];
}
else{
    echo "error";
    die();
}

//echo "id is".$id;

$con = connectDB();

mysqli_set_charset($con, 'utf8');


$sql = "SELECT * FROM post WHERE post.id = $id";

$result = $con->query($sql);

$numrows = $result->num_rows;

if($numrows == 0){
    echo "No ID";
    die();
}

$row = $result->fetch_assoc();

$title = $row["title"];

//$posttime = $row['posttime'];
$pid = $row['pid'];

$play = $row['play'];

$tags = $row['tag'];

$pic = $row['pic'];

$author = $row['author'];

$dis = $row['description'];

$pic = $row["pic"];

$aid = $row["aid"];

$tid = $row["tid"];

$favors = $row["favorites"];

$postime = $row["posttime"];


$sql2 = "SELECT * FROM GenreType WHERE tid = '$tid'";

$rows = $con->query($sql2);

$row = $rows->fetch_assoc();

$tidName = $row["tname"];


session_start();

if(isset($_SESSION['username']) && isset($_SESSION["login"]) && $_SESSION['login'] == 1) {

    $user = $_SESSION['username'];
    
    changeFavorVal($pid, 1, $user, $con);

}


$sql3 = "UPDATE post SET play = play + 1 where id = '$id'";

$con->query($sql3);

mysqli_close($con);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Anime</title>
</head>
<body>

<br>
Anime info:
<br>
<br>

<?php
echo "<img src=".$pic." alt=\"VideoCover\">";
echo "<br>";
echo "ANIME TITLE:".$title."<br><br>";
//echo "Post time:".$posttime."<br><br>";
echo "Total plays:".$play."<br><br>";
echo "tags:".$tags."<br><br>";
echo "author:".$author."<br><br>";
echo "Genre:".$tidName."<br><br>";
echo "description:".$dis."<br><br>";
echo "favorites:".$favors."<br><br>";
echo gmdate('o - M, d - H:i:s', $postime);
?>

<a href="favourates.php?id=<?php echo $id;?>&title=<?php echo $title;?>">I like it!
</a>
<br>

