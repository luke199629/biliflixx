<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/14/16
 * Time: 2:14 PM
 */
include "connectDB.php";

$con = connectDB();
$sql = "SELECT * FROM GenreType";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf8">
    <title>searchTitle</title>
</head>
<body>



<!--请将这一段整合进首页search功能, 样式随意, form action 和method 和第一input name 不能改-->

<form action="searchTitle.php" method="post">
    Title:<br>
    <input type="text" name="TITLE" value="EVA"><br>
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
    <select name="rankStandard">
        <option value="byHotnessDesc">by Hotness Desc</option>
        <option value="byTimeDesc">by Time Desc</option>
        <option value="byHotnessAsc">by Hotness Asc</option>
        <option value="byTimeAsc">by Time Asc</option>
        <option value="byFavor">by genre you liked</option>
    </select>
    <br>
    SearchUser:<br>
    <input name="searchUser" type="radio" value="true" />yes
    <input name="searchUser" type="radio" value="false" checked="checked"/>no<br>

    <br>

    useGenre:<br>
    <input name="useGenre" type="radio" value="true" />yes
    <input name="useGenre" type="radio" value="false" checked="checked"/>no<br>

    <br>
    <input type="submit" value="SEARCH">



    <!--    <input name="InFavorites" type="radio" value="1" />Search Favorited Video<br>-->

</form>
