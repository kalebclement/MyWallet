<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
require "connection.php";
require "getvar.php";
// $sqll = "SELECT * FROM bank WHERE Bank_Account = $bankaccount;";
// $res = $link->query($sqll) or die($sqll);
// if($res->num_rows > 0) {
//     $row = $res->fetch_assoc();
//     $bankname = $row['Bank_Name'];
// }
?>
<body onload="" style="background: url(image/bank.svg);">
    <?php include "navigation.php"?>
    <!-- Content is here -->
    <div id="content">
    <h1 class="h1">Bank Account!</h1>
    <h2 class="h2">IDR : <span id="balance"><?php echo $balance ?></span></h2><br>
    <p>
        Bank Account : <span id="bankaccount"><?php echo $bankaccount ?></span><br>
        Bank Name : <span id="name"><?php echo $bankname ?></span><br>
        Bank User : <span id="bankuser"><?php echo $accname?></span>
    </p>
    </div>
</body>
</html>