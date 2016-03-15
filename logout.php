<?php
/**
 * Created by PhpStorm.
 * User: zhangyuanshan
 * Date: 3/15/16
 * Time: 4:04 PM
 */
session_start();
session_destroy();
header('Location: /index.php');

?>

