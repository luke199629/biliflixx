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

	<!-- Load fonts -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>

	<!-- Load css styles -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<style>
body {margin:0;}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    position: fixed;
    top: 0;
    width: 100%;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}
</style>
</head>
<body>

<ul>
  <li><a href="http://biliflixx.web.engr.illinois.edu/" title="Home">Home</a></li>
                <li><a href="https://wiki.cites.illinois.edu/wiki/display/cs411sp16/Gaze+of+Intelligence" title="About Us">About Us</a></li>
                 <li><a href="javascript:q=(document.location.href);void(open('insertUser.html?url='+escape(q),'_self','resizable,location,menubar,toolbar,scrollbars,status'));" title="Regist">Registration</a></li>
                <li><a href="usrpage.php" title="account">My Account</a></li>
                
</ul>

<div style="padding:20px;margin-top:30px;background:url('../xiaomai3.jpg');background-repeat:no-repeat;background-size:cover;" align="center">
<br>

<?php
echo "<img src=".$pic." alt=\"VideoCover\">";

echo "<h2>".$title."</h2><br>";
//echo "Post time:".$posttime."<br><br>";

echo "<embed height=\"415\" width=\"544\" quality=\"high\" allowfullscreen=\"true\" type=\"application/x-shockwave-flash\" src=\"http://static.hdslb.com/miniloader.swf\" flashvars=\"aid=".$aid."&page=1\" pluginspage=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\"></embed>";
echo "<br>";


echo "<h4>Total plays:".$play."</h4>";
echo "<h4>tags:".$tags."</h4>";
echo "<h4>author:".$author."</h4>";
echo "<h4>Genre:".$tidName."</h4>";
echo "<h4>description:".$dis."</h4>";
echo "<h4>favorites:".$favors."</h4>";
echo "<h4>";
echo gmdate('o - M, d - H:i:s', $postime);
echo "</h4>";
?><h3>
<a href="favourates.php?id=<?php echo $id;?>&title=<?php echo $title;?>">I like it!</a>
<h3>

</div>
</body>
</html>