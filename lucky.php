<?php
header('Content-Type: text/html; charset=utf8');
?>

<?php


include "connectDB.php";


$con = connectDB();
mysqli_set_charset($con, 'utf8');



$sql = "SELECT * FROM post ORDER BY RAND() LIMIT 10";


$result = mysqli_query($con, $sql);

//print out the data returned from the database
$ctr = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row3 = mysqli_fetch_assoc($result)) {
        $linkinfo = "http://biliflixx.web.engr.illinois.edu/showAnime.php?id=" . $row3["id"];

        //        echo "id: " . $row["id"] . " , title: " . $row["title"];

        echo "<a href=" . $linkinfo . ">id:" . $row3["aid"] . " , title:" . $row3["title"] . "</a>";

        echo "<br>";
        $ctr++;
        if ($ctr >= 200) {
            break;
        }
    }
} else {
 
  	 echo "<script language=\"JavaScript\">\r\n";
            	echo " alert(\"Bad luck :(\");\r\n";
            	echo " history.back();\r\n";
            	echo "</script>";
}




//close connection
mysqli_close($con);