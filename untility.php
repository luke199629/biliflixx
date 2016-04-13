<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/13/16
 * Time: 3:59 AM
 */


/**
 * @param $tid
 * @param $con
 */
function findParentid($tid, $con)
{
    $sql4 = "SELECT * FROM GenreType WHERE tid = '$tid'";

    $typeinfo = $con->query($sql4);

    if ($typeinfo === FALSE) {
        echo "Error: " . $sql4 . "<br>" . $con->error;
    }

    $typerrow = $typeinfo->fetch_assoc();

    $parentID = $typerrow["parentId"];

    if ($parentID == 0) {
        $parentID = $tid;
    }

    return $parentID;
}


/**
 * @param $parentID
 * @param $increment
 * @param $user
 * @param $con
 */
function changeFavorVal($parentID, $increment, $user, $con)
{
    $sql5 = "UPDATE user SET `$parentID` = `$parentID` + 1 WHERE username = '$user'";

    if ($con->query($sql5) === TRUE) {
    } else {
        echo "Error: user" . $sql5 . "<br>" . $con->error;
    }
}



