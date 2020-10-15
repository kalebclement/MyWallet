<?php
if(isset($_POST['withdrawamount'])) {
    $withdrawamount = $_POST['withdrawamount'];
    $type = "WDR";

    require "../../connection.php";
    require "../../getvar.php";

    $total_balance = $balance - $withdrawamount; //COUNT BALANCE
    $sql = "CALL `withdraw`('$phone',$withdrawamount, $total_balance)";
    $result = $link->query($sql) or die(mysqli_error($link));
    if($result) $_SESSION['ACC_Balance'] = $total_balance;
}
?>