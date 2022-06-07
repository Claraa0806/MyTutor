<?php
session_start();
$email = $_SESSION['email']; 

if (!isset($_SESSION['sessionid'])){
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script>window.location.replace(login.php')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/scripts.js" defer></script>
</head>

<body>
    <header class="w3-header w3-teal w3-center w3-padding-16" style="height:80px">
        <h2>Profile</h2>
    </header>
<div class="w3-card w3-container w3-padding w3-margin w3-round">
<form>
    <div class="w3-bar w3-light-grey w3-border">
    <a href="main.php" class="w3-bar-item w3-button w3-mobile w3-teal" style="width:23%">Courses</a>
    <a href="tutors.php" class="w3-bar-item w3-button w3-mobile" style="width:23%">Tutors</a>
    <a href="#" class="w3-bar-item w3-button w3-mobile" style="width:23%">Subscription</a>
    <a href="profile.php" class="w3-bar-item w3-button w3-mobile"style="width:23%">Profile</a>
    <a href="main.php" class="w3-bar-item w3-button w3-mobile w3-red">Back</a>
  </div>
  </form>
    </div>
    <div style="display:flex; justify-content: center;">
        <div class="w3-container w3-card w3-padding w3-margin" style="width:1000px;margin:auto;text-align:left;">
            <form name="profileForm" action="profile.php" method="post">
                <div class="container">
                <div style="font-weight:bold">Email : <?php echo $email?> </div>
        </div>
            </form>
        </div>
    </div>
    <footer class="w3-footer w3-center w3-bottom w3-teal">MyTutor</footer>
</body>
</html>