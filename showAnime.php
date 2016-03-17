<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/17/16
 * Time: 2:39 AM
 */
header('Content-Type: text/html; charset=utf8');

include "connectDB.php";

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

$posttime = $row['posttime'];

$play = $row['play'];

$tags = $row['tag'];

$pic = $row['pic'];

$author = $row['author'];

$dis = $row['description'];

$pic = $row["pic"];


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
echo "Post time:".$posttime."<br><br>";
echo "Total plays:".$play."<br><br>";
echo "tags:".$tags."<br><br>";
echo "author:".$author."<br><br>";
echo "description:".$dis."<br><br>";

?>


</body>
</html>

