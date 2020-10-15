<?php
require "../connection.php";
$msg = "";
$acc_id="";
if(isset($_POST['user']) && isset($_POST['pass'])) {
    $acc_id = $_POST['user'];
    $acc_pass = $_POST['pass'];
    require "../connection.php";
    $sql = "CALL `account_login`('$acc_id','$acc_pass');";
    $result = $link->query($sql) or die(mysqli_error($link));
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['Phone'] = $row['acc_id'];
        $_SESSION['NIK'] = $row['acc_nik'];
        $_SESSION['Bank_Account'] = $row['acc_bankacc'];
        $_SESSION['Bank_Name'] = $row['acc_bankname'];
        $_SESSION['ACC_Name'] = $row['acc_name'];
        $_SESSION['ACC_DOB'] = $row['acc_dob'];
        $_SESSION['ACC_Address'] = $row['acc_addr'];
        $_SESSION['ACC_Balance'] = $row['acc_balance'];
        $_SESSION['ACC_Password'] = $row['acc_pass'];
        header('location:../interface/');
    }else {
        $msg = "Phone or Password are not existed or incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../icon.png" type="image/x-icon">
    <script>
        function redirectParent(url) {
            window.open(url, "_SELF");
        }
    </script>
</head>
<body>
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
    <div id="login">
        <h1 class="h1">Dompet!</h1>
        <form style="text-align: center;" action="" method="POST">
            <div class="form">
                <label>Input your phone number : </label>
                <input type="text" name="user" id="phone" value="<?php echo $acc_id?>" placeholder="Phone Number" minlength="10" required="" maxlength="15" size="30" pattern="\d*" class="input" >
            </div>
            <div class="form">
                <label>Input your password : </label>
                <input type="password" name="pass" id="password" placeholder="Password" size="30" required="" minlength="8" maxlength="50" class="input">
            </div>
            <div id="message"><small><?php echo "$msg"; ?></small></div>
            <div class="tombol">
                <input type="submit" class="button" value="Login" class="button">
                <input type="button" name="back" value="back" class="button" onclick="redirectParent('../../dompet/')">
            </div>
        </form>
    </div>
</body>
</html>