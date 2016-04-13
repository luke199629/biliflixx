<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/12/16
 * Time: 5:44 PM
 */
include "connectDB.php";

session_start();

$con = connectDB();

$sql = "SELECT * FROM GenreType";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload</title>
</head>
<body>

<br>
<form action="uploadfile.php" method="post">
    Title:<br>
    <input name="title" type="text"/><br>
    Cover link:<br>
    <input name="cover" type="text" value="http://i1.hdslb.com/userup/68/124b29128-1222.JPG"/><br>
    Description:<br>
    <input name="Description" type="text"/><br>
    Tags:<br>
    <input name="tags" type="text"/><br>
    Genre:<br>
    <select name="genre">
        <?php
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value=".$row["tid"].">".$row["tname"]."</option>";
                $ctr++;
            }
        }
        ?>
    </select>
    <input type="Submit">
</form>
<br>


<?php
mysqli_close($con);

?>

</body>
</html>
