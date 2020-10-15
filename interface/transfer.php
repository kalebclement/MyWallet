<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
require "connection.php";
require "getvar.php";
?>
<body style="background: url(image/transfer.svg);">
    <script>
        var d, transferid, checked_transferid = false;
        function transfer(){
            var p = new XMLHttpRequest();
            p.onreadystatechange = function () {
                if (this.readyState== 4 && this.status == 200) {
                    document.getElementById("message").innerHTML = this.responseText;
                    if(this.responseText == "") {
                        window.open('menu/transfer/transfer-success.html', '_self', '');
                    }
                }
            }
            p.open("POST", 'menu/transfer/transfer.php', false);
            p.setRequestHeader("Content-type", 'application/x-www-form-urlencoded');
            p.send("transferamount="+d+"&transferid="+transferid);
        }
        function confirm() {
            if(checked_transferid === true) {
                while(true) {
                    d = document.getElementById('transferamount').value;
                    transferid = document.getElementById('transferid').value;
                    var n = window.prompt("Transfer IDR "+d+" to "+transferid+"? input y to confirm ", "");
                    if(n == 'y' || n == 'Y') {
                        transfer();
                        return false;
                    }else if(n == ''){
                        return false;
                    }else {
                        window.alert("Wrong.");
                    }
                }
            }
        }
        function livesearch(str){
            if (str.length == 0) {
                document.getElementById("message").innerHTML="";
                checked_transferid = false;
                console.log("check cl :"+ checked_transferid);
                return;
            }else {
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState== 4 && this.status == 200) {
                        document.getElementById("message").innerHTML = this.responseText;
                    }
                    if(this.responseText == "There's no ID available") {
                        checked_transferid = false;
                        console.log('checked cl :' +checked_transferid);
                    }else {
                        checked_transferid = true;
                        console.log('checked cl : ' +checked_transferid);
                    }
                }
                xmlhttp.open("GET", "livesearch.php?q="+str, true);
                xmlhttp.send();   
            }
        }
    </script>
    <?php include "navigation.php"; ?>
    <div id="content">
        <div id="transfer">
            <form id="form">
                <h1 class="h1">Transfer!</h1>
                <h2 class="h2">IDR : <span id="balance"><?php echo $balance ?></span></h2><br>
                <p>Your ID : <span id="phone"><?php echo $phone ?></span></p>
                <p>
                    Recipient ID : <input type="text" id="transferid" onchange="livesearch(this.value);">
                    <small id="message"></small><br>
                    Amount : <input type="text" size="26" id="transferamount">
                </p>
                <input type="button" onclick="confirm()" value="Transfer" class="button">
            </form>
        </div>
    </div>
</body>
</html>