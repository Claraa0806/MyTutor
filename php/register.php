<?php
if (isset($_POST['register'])) {
    include_once("dbconnect.php");
    {
        $id = $_POST['id'];
        $email = $_POST["email"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $password = sha1($_POST["password"]);
        $address = $_POST["address"];

        $sqlregister = "INSERT INTO `registration`( `id`,`email`, `name`, `phone`, `password`, `address`) VALUES('$id','$email', '$name', '$phone', '$password', '$address')";
        try {
            
            $conn->exec($sqlregister);
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('Registration successful')</script>";
            echo "<script>window.location.replace('../php/login.php')</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Registration failed')</script>";
            echo "<script>window.location.replace('../php/register.php')</script>";
        }
    }
}

function uploadImage($filename)
{
    $target_dir = "../mytutor/assets/register/";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MyTutor</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <header class="w3-header w3-teal w3-center w3-padding-16" style="height:80px">
        <h2>Registration</h2>
    </header>
    <form name="registerForm" action="register.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Comfirm Register MyTutor?')">
    <div style="display:flex; float: left; margin-top: 5%;">
        <div class="w3-container w3-padding w3-margin w3-center" style="width:500px;margin:auto;">
        <img class="w3-image w3-margin" src="../assets/images/profile.png" style="width: 50%;">
        <p>Profile Picture</p>
        <input type="file" name="fileToUpload" onchange="previewFile()">
        </div>
    </div>
    <div style="display:flex; justify-content: right; margin-bottom: 5%;">
        <div class="w3-container w3-card w3-padding w3-margin" style="width:1000px;margin:auto;text-align:left;">
                <div class="container">
                    <p>
                        <label><b>Email</b></label>
                        <input class="w3-input w3-round w3-border" type="email" name="email" id="email" placeholder="Your email" required>
                    </p>
                    <p>
                        <label><b>Name</b></label>
                        <input class="w3-input w3-round w3-border" type="name" name="name" id="name" placeholder="Your name" required>
                    </p>
                    <p>
                        <label><b>Phone number </b></label>
                        <input class="w3-input w3-round w3-border" type="phone" name="phone" id="phone" placeholder="Your phone number without - " required>
                    </p>
                    <p>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-round w3-border" type="password" name="password" id="password" placeholder="Your password" required>
                    </p>
                    <p>
                        <input class="w3-check" name="showpass" type="checkbox" id="showpass" onclick="showPass()">
                        <label>Show password</label>
                    </p>
                    <p>
                        <label><b>Home address</b></label>
                        <input class="w3-input w3-round w3-border" type="address" name="address" id="address" placeholder="Your home address" required>
                    </p>
                    </div>
                    <div class="w3-center">
                    <p>
                        <input class="w3-button w3-round-large w3-border w3-border-black w3-teal" type="submit" name="register" id="register" value="Register">
                    </p>
                    <p>Already register the account? <a href="login.php"> Login</a>.</p>
            </form>
        </div>
    </div>
    <footer class="w3-container w3-teal w3-center w3-bottom" style="height:50px">
        <p>MyTutor</p>
    </footer>

</body>
</html>