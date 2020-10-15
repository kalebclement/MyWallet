<?php
$host = "localhost";
$user=  "client";
$pass = "cl123";
$db = "dompet";

$link = mysqli_connect($host, $user, $pass, $db) or die("error : " .mysqli_connect_error());