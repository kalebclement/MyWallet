<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "connection.php";
include "getvar.php";
?>
<body onload="" style="background: url(image/background.svg);">
    <?php include "navigation.php"?>
    <!-- Content is here -->
    <div id="content">
    <h1 class="h1">Details!</h1>
    <h2 class="h2">IDR : <span id="balance"><?php echo $balance ?></span></h2><br>
    <p>
        Phone : <span id="phone"><?php echo $phone ?></span><br>
        Name : <span id="name"><?php echo $accname ?></span><br>
        C. ID : <span id="czid"><?php echo $nik ?></span><br>
        BOD : <span id="bod"><?php echo $accdob ?></span><br>
        Address : <span id="addr"><?php echo $address ?></span><br>
        Bank Account : <span id="bankaccount"><?php echo $bankaccount ?></span><br>
    </p>
    </div>
</body>
</html>