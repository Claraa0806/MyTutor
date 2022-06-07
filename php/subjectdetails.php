<?php
include_once("dbconnect.php");
if (isset($_GET['cust_email'])) {
    $cust_email = $_GET['cust_email'];
}else{
    $cust_email = "guest";
}
if (isset($_POST['submit'])){
    $prid = $_POST['prid'];
    if ($cust_email == "guest"){
        echo "<script>alert('Please register an account first.');</script>";
        echo "<script> window.location.replace('register.php')</script>";
    }else{
       echo "<script> window.location.replace('subjectdetails.php?prid=$prid')</script>";
        echo "<script>alert('OK.');</script>";
    }
}
if (isset($_GET['subid'])) {
    $subid = $_GET['subid'];
    $sqlsubject = "SELECT * FROM tbl_subjects WHERE subject_id = '$subid'";
    $stmt = $conn->prepare($sqlsubject);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('Product not found.');</script>";
        echo "<script> window.location.replace('main.php')</script>";
    }
} else {
    echo "<script>alert('Page Error.');</script>";
    echo "<script> window.location.replace('main.php')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Details</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/scripts.js" defer></script>
</head>

<body>
    <header class="w3-header w3-teal w3-center w3-padding-16" style="height:80px">
        <h2>Subject Details</h2>
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
    <div>
    <?php
        foreach ($rows as $subjects) {
            $subid = $subjects['subject_id'];
            $subname = $subjects['subject_name'];
            $subdesc = $subjects['subject_description'];
            $subprice = number_format((float)$subjects['subject_price'], 2, '.', '');
            $subsession = $subjects['subject_sessions'];
            $subrating = $subjects['subject_rating'];
        }
        echo "<div class='w3-center'><img class='w3-image resimg' src=../../mytutor/assets/courses/$subid.png" .
        " onerror=this.onerror=null;this.src='../../assets/images/error.png'"
        . " ><hr></div>";
        echo "<div class='w3-container w3-padding-large'><h4><b>$subname</b></h4>";
        echo " <div><p><b>Description:</b> $subdesc</p><p><b>Price:</b> $subprice</p><p><b>Subject Sessions:</b> $subsession</p><p><b>Rating:</b> $subrating</p>
        </div></div>";

    ?>
    </div>
    <footer class="w3-footer w3-center w3-bottom w3-teal">MyTutor</footer>
</body>

</html>