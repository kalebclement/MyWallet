<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
require "connection.php";
require "getvar.php";
?>

<body style="background: url(image/deposit.svg);">
    <script type="text/javascript">
        var str, d;
        function parseval() {
            var e = document.getElementById("bank_id");         //ACCESS SELECT OPTION
            str = e.options[e.selectedIndex].value;             //STORE VALUE SELECT TO STR
            document.getElementById("accNo").innerHTML = str;   //WRITE THE VALUE
            console.log("parseval - success");
        }
        function deposit(){
            var p = new XMLHttpRequest();
            p.onreadystatechange = function () {
                if (this.readyState== 4 && this.status == 200) {
                    document.getElementById("message").innerHTML = this.responseText;
                    if(this.responseText == "") {
                        window.open('menu/deposit/deposit-success.html', '_self', '');
                    }
                }
            }
            p.open("POST", 'menu/deposit/deposit.php', false);
            p.setRequestHeader("Content-type", 'application/x-www-form-urlencoded');
            p.send("depositamount="+d);
        }
        function confirm() {
            while(true) {
                d = document.getElementById('depositamount').value;
                var n = window.prompt("Deposit IDR "+d+"? please input Y", "");
                if(n == 'y' || n == 'Y') {
                    deposit();
                    return false;
                }else if(n == ''){
                    return false;
                }else {
                    window.alert("Password Incorect. please try again");
                }
            }
        }
    </script>
    <?php include "navigation.php"; ?>
    <div id="content">
        <div id="deposit">
            <h1 class="h1">Deposit!</h1>
            
            <h2 class="h2">IDR : <span id="balance"><?php echo $balance?></span></h2><br>
            <p>
                please select which Company's bank you prefer to transfer with.<br>
                after short confirmation, we will validate your deposit request in a couple minutes.
            </p>
            <form id="form_bank">
                <p>Please select our bank : 
                    <select name="bank" id="bank_id" required="" onchange="parseval()">
                        <option disabled selected>-- Select Bank --</option>
                        <?php
                        include "connection.php";
                        $sql = "SELECT * FROM bank_dompet";
                        $result = $link->query($sql) or die($sql);
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo (
                                    "<option value='".$row['bank_acc']."'>".$row['bank_name']." - ".$row['bank_acc']."</option>"
                                );
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    Bank account number : <span id="accNo">--</span><br>
                    Input deposit amount : <input type="text" id="depositamount" required="" style="width: 300px; height: 25px;" onkeypress="if(isNaN(this.value + String.fromCharCode(event.keyCode)))return false;"></span>
                </p>
                <input type="button" name="submit" value="Submit" id="submit" class="button" onclick="confirm()"><br>
                <small id="message"></small>
            </form>
        </div>
    </div>
</body>
</html>