<?php
require "connection.php";

session_start();
$phone = $_SESSION['Phone'];

//update balance
$sql = "SELECT acc_balance FROM account WHERE acc_id ='$phone';";
$result = $link->query($sql) or die($sql);
if($result->num_rows > 0 ){
    $row = $result->fetch_assoc();
    $_SESSION['ACC_Balance'] = $row['acc_balance'];
}

$nik = $_SESSION['NIK'];
$bankaccount = $_SESSION['Bank_Account'];
$bankname = $_SESSION['Bank_Name'];
$accname = $_SESSION['ACC_Name'];
$accdob = $_SESSION['ACC_DOB'];
$address = $_SESSION['ACC_Address'];
$balance = $_SESSION['ACC_Balance'];
$password = $_SESSION['ACC_Password'];

if(!$phone) {
    header('location:../login/');
}