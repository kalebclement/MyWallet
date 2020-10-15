<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "connection.php";
include "getvar.php";
?>

<body style="background: url(image/withdraw.svg);">
    <script>
        var d;
        function withdraw(){
            var p = new XMLHttpRequest();
            p.onreadystatechange = function () {
                if (this.readyState== 4 && this.status == 200) {
                    document.getElementById("message").innerHTML = this.responseText;
                    if(this.responseText == "") {
                        window.open('menu/withdraw/withdrawal-success.html', '_self', '');
                    }
                }
            }
            p.open("POST", 'menu/withdraw/withdrawal.php', false);
            p.setRequestHeader("Content-type", 'application/x-www-form-urlencoded');
            p.send("withdrawamount="+d);
        }
        function confirm() {
            while(true) {
                d = document.getElementById('withdrawamount').value;
                var n = window.prompt("Withdraw IDR "+d+"? please input Y ", "");
                if(n == 'y' || n == 'Y') {
                    withdraw();
                    return false;
                }else if(n == ''){
                    return false;
                }else {
                    window.alert("Password Incorect. please try again");
                }
            }
        }
    </script>
    <?php include "navigation.php" ?>
    <div id="content">
        <form id="form">
            <h1 class="h1">Withdraw!</h1>
            <h2 class="h2">IDR : <span id="balance"><?php echo $balance ?></span></h2><br>
            <p>
                Bank Account : <span id="bankaccount"><?php echo $bankaccount ?></span><br>
                Withdraw Amount : <input type="text" id="withdrawamount"><br>
            </p>
            <input type="button" onclick="confirm()" value="withdraw" class="button">
            <small id="message"></small>
        </form>
    </div>
</body>
</html>