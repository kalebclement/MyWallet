<?php
$msg = "";
if(isset($_POST['ph']) && isset($_POST['ps'])) {
    $phone = $_POST['ph'];
    $pass = $_POST['ps'];
    // require "connection.php";
    if($phone != "" && $pass != "") {
        session_start();
        $_SESSION['Phone'] = $phone;
        $_SESSION['ACC_Password'] = $pass;
        header("location:register.php");
    }else {
        $msg = "Failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register - 1</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        var checked_phone=false;
        
        var password = document.getElementById("password"), confirm_password = document.getElementById("password_repeat");
        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

        function livesearch(str) {
            if (str.length == 0) {
                document.getElementById("message").innerHTML="";
                checked_phone = false;
                console.log("phone :"+ checked_phone);
                return;
            }else {
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState== 4 && this.status == 200) {
                        document.getElementById("message").innerHTML = this.responseText;
                    }
                    if(this.responseText == "Phone already Registered.") {
                        document.getElementById("regbtn").disabled = true; 
                        checked_phone = false;
                        console.log('checked p :' +checked_phone);
                    }else {
                        document.getElementById("regbtn").disabled = false; 
                        checked_phone = true;
                        console.log('checked p : ' +checked_phone);
                    }
                }
                xmlhttp.open("GET", "livesearch.php?q="+str, true);
                xmlhttp.send();   
            }
        }
        function myfunc() {
            var myVar = setTimeout(animate, 1000);
        }
        function animate() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("register").style.display = "block";
        }
    </script>
</head>
<body onload="myfunc();">
    <!-- NAVIGATION BAR -->
    <div class="wrapper">
        <nav>
            <div class="logo">Dompet</div>
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../about.html">About</a></li>
                <li class="regist"><a href="../register/">Register</a></li>
                <li class="login"><a href="../login/">Login</a></li>
            </ul>
        </nav>
    </div>
    <div id="loader"></div>
    <!-- FORM REGIST -->
    <div id="register" class="animate-bottom">
        <h1 class="h1">Register!</h1>
        <form id="form" method="POST" action="">
            <div style="text-align: center;">Enter your phone number and password</div>
            <div class="form">
                <label>Phone : </label>
                <input type="text" id="phone" name="ph" class="input" minlength="10" maxlength="15" size="40" required pattern="\d*" onchange="livesearch(this.value)">
            </div>
            <div class="form">
                <label for="password">Password : </label>
                <input type="password" name="ps" id="password" class="input" minlength="8" maxlength="50" size="40" required>
            </div>
            <div class="form">
                <label for="password_repeat">Confirm Password : </label>
                <input type="password" id="password_repeat" class="input" size="40" minlength="8" maxlength="50" required>
            </div>
            <div class="tombol">
                <small id="message"><?php echo $msg;?></small>
                <button id="regbtn" type="submit" class="button">Register</button>
            </div>
        </form>
    </div>
</body>
</html>