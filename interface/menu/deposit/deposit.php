<?php
if(isset($_POST['depositamount'])){
    $depositamount = $_POST['depositamount'];

    require "../../connection.php";
    require "../../getvar.php";

    $total_balance = $balance + $depositamount; //COUNT BALANCE
    $query = "CALL `deposit`('$phone', $depositamount, $total_balance);";
    
    $result = $link->query($query) or die(mysqli_error($link));
    if($result) {
        $_SESSION['ACC_Balance'] = $total_balance;
    }

    // $result = $link->query($sql1) or die(mysqli_error($link));
    // if($result) {
    //     $res = $link->query($sql2) or die(mysqli_error($link));
    //     if($res) {
    //         $_SESSION['ACC_Balance'] = $total_balance;
    //     }
    // }
}else {
    echo "error";
}
?>