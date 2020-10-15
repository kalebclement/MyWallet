<?php 
$transferamount = $_POST['transferamount'];
$recipient_id = $_POST['transferid'];

require "../../connection.php";
require "../../getvar.php";

//GET recipient_id BALANCE
$sql = "SELECT * FROM account WHERE acc_id='$recipient_id';";
$result = $link->query($sql) or die($sql);
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $transferbalance = $row['acc_balance'];
}

$balance_sender = $balance - $transferamount;
$balance_recipient = $transferbalance + $transferamount;

$sql = "CALL `transfer`('$phone', '$recipient_id', $balance_sender, $balance_recipient, $transferamount);";
$result = $link->query($sql) or die(mysqli_error($link));
if($result) $_SESSION['ACC_Balance'] = $balance_sender;
?>