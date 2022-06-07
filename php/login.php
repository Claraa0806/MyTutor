<?php
if (isset($_POST['login'])) {
    include 'dbconnect.php';
    $email = $_POST['email'];
    $pass = sha1($_POST['password']);
    $sqllogin = "SELECT * FROM registration WHERE email = '$email' AND password = '$pass'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();

    if ($number_of_rows  > 0) {
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email;
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('main.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script> window.location.replace('login.php')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <header class="w3-header w3-teal w3-center w3-padding-16" style="height:80px">
        <h2>Login</h2>
    </header>
    <div style="display:flex; float: left; margin-top: 5%;">
        <div class="w3-container w3-padding w3-margin w3-center" style="width:500px;margin:auto;">
        <img class="w3-image w3-margin" src="../assets/images/login.png" style="width: 50%;">
        <h2>Login Page</h2>
        </div>
    </div>
    <div style="display:flex; justify-content: right; margin-top: 5%;">
        <div class="w3-container w3-card w3-padding w3-margin" style="width:1000px;margin:auto;text-align:left;">
            <form name="loginForm" action="login.php" method="post">
                <div class="container">
                    <p>
                        <label><b>Email</b></label>
                        <input class="w3-input w3-round w3-border" type="email" name="email" id="email" placeholder="Your email" required>
                    </p>
                    <p>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-round w3-border" type="password" name="password" id="password" placeholder="Your password" required>
                    </p>
                    <p>
                        <input class="w3-check" name="showpass" type="checkbox" id="show" onclick="showPass()">
                        <label>Show password</label>
                    </p>
                    <p>
                        <input class="w3-check" name="rememberme" type="checkbox" id="remember" onclick="rememberMe()">
                        <label>Remember Me</label>
                    </p>
                    </div>
                    <div class="w3-center">
                    <p>
                        <input class="w3-button w3-round-large w3-border w3-border-black w3-teal" type="submit" name="login" id="login" value="Login">
                    </p>
                    <p>Not a member? <a href="register.php"> Register</a>.</p>
            </form>
        </div>
    </div>
    <footer class="w3-container w3-teal w3-center w3-bottom" style="height:50px">
        <p>MyTutor</p>
    </footer>

</body>
</html>