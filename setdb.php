<?php
    session_start();
    $link = mysqli_connect('localhost','root','','q2');
    mysqli_query($link,"set names utf8");
    $nt = strtotime("+7hours");
    $time = date("Y-m-d H:i:s",$nt);
?>
