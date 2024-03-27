<?php

    //the details of database
    $hostname="localhost";
    $username="Test-1";
    $password="24ifr/tZvmLL5h6v";
    $dbname="Test-1";

    //to connect database
    $link = mysqli_connect($hostname,$username,$password,$dbname) or die (mysqli_error($link));
?>