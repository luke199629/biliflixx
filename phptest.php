<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 4/13/16
 * Time: 2:20 AM
 */

$parentID = 1;

$sql5 = "UPDATE user SET t"."$parentID"."= t"."$parentID"." + 1";

echo $sql5;