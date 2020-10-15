<?php
    require "connection.php";
    if(isset($_REQUEST["q"])){
        $set = $_REQUEST["q"];
        $sql = "SELECT acc_id FROM account WHERE acc_id ="."'$set'";
        $result = $link->query($sql) or die($sql);
        if($result->num_rows > 0) {
            echo "";
        }else {
            echo "There's no ID available";
        }
    }
    mysqli_close($link);
?>