<?php
session_start();
$msg="";
if(isset($_SESSION['Phone']) && isset($_SESSION['ACC_Password'])){
    $ph = $_SESSION['Phone'];
}else {
    header("location:../register/");
}
?>
<?php
if( isset($_POST['bankname']) && isset($_POST['bankaccount']) && isset($_POST['bankuser']) && isset($_POST['czid']) && isset($_POST['date']) && isset($_POST['address']) ) {
    $bankname = $_POST['bankname'];
    $bankaccount = $_POST['bankaccount'];
    $bankuser = $_POST['bankuser'];
    $czid = $_POST['czid'];
    $date = $_POST['date'];
    $address = $_POST['address'];
    
    $phone = $_SESSION['Phone'];
    $password = $_SESSION['ACC_Password'];
    
    require "connection.php";
    $sql = "CALL regist_account('$phone', '$czid', '$bankaccount', '$bankname', '$bankuser', '$date', '$address', '$password')";
    $result = $link->query($sql) or die(mysqli_error($link));
    if($result) {
        //DESTROY SESSION
        if (ini_get("session.use_cookies")) { 
            $params = session_get_cookie_params(); 
            setcookie(session_name(), '', time() - 42000, 
                $params["path"], $params["domain"], 
                $params["secure"], $params["httponly"] 
            ); 
        }
        session_destroy();
        header("location:success.html");
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="../icon.png" type="image/x-icon">
    <script src="js/jquery.js"></script>
    <title>Register - 2</title>
    <script>
        var checked_ba = false;
        function myfunc() {
            var cl = "<?php echo "$ph" ?>";
            document.getElementById('phone').innerHTML = cl;
            var myVar = setTimeout(animate, 100);
        }
        function animate() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("regist").style.display = "block";
        }
    </script>
</head>
<body onload="myfunc();">
    <div class="wrapper">
        <nav>
            <div class="logo">Dompet</div>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../about.html">About</a></li>
                <li class="regist"><a href="../register/">Register</a></li>
                <li class="login"><a href="../login/">Login</a></li>
            </ul>
        </nav>
    </div> 
    <div id="loader"></div>

    <div id="regist" class="animate-bottom">
        <h1 class="h1">Registration!</h1>
        <form id="form" method="POST" action="">
            <div class="form">
                    <small >Phone : <span id="phone"></span></small>
            </div>
            
            <div class="form">
                <label for="bankname">Select your bank : </label>
                <select id="bankname" name="bankname" class="input" required>
                    <option disabled selected>-- Select Bank --</option>
                    <?php
                    require "connection.php";
                    $sql = "SELECT * FROM bank_dompet";
                    $result = $link->query($sql) or die($sql);
                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo (
                                "<option value='".$row['bank_name']."'>".$row['bank_name']."</option>"
                            );
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form">
                <label>Bank Account : </label>
                <input type="text" name="bankaccount" id="bankaccount" class="input" minlength="5" maxlength="10" pattern="\d*" required>
            </div>
            <div class="form">
                <label>Bank User's Name : </label>
                <input type="text" name="bankuser" id="bankuser" class="input" required  minlength="8" maxlength="50">
            </div>
            <div class="form">
                <label>Citizenship ID : </label>
                <input type="text" name="czid" id="czid" class="input" minlength="5" maxlength="10" pattern="\d*" required>
            </div>
            <div class="form">
                <label>Date Of Birth : </label>
                <input type="date" name="date" id="date" class="input" required="">
            </div>
            <div class="form">
                <label>Address : </label>
                <textarea name="address" id="address" cols="27" rows="3" required="" placeholder="Address"></textarea>
            </div>
            
            <div id="map" class="form"></div>
            <div id="out" class="form" style="display: none;"></div>
            <div class="tombol">
                <small id="message"><?php echo $msg?></small>
                <button type="submit" id="regbtn" class="button">REGISTER</button>
            </div>
        </form>
    </div>
    
    <script src="js/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=createMap&key=AIzaSyBV3BWeEqM5gPF36OvpHbEfRC6fgWkqv6I&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<footer style="height: 10vh;"></footer>
</html>