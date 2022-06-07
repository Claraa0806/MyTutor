
<?php
error_reporting(0);
include_once("dbconnect.php");
if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'search') {
        $search = $_GET['search'];
        $sqlsubject = "SELECT * FROM tbl_subjects WHERE subject_name LIKE '%$search%'";
    }
} else {
    $sqlsubject = "SELECT * FROM tbl_subjects";
}

$results_per_page = 10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}


$stmt = $conn->prepare($sqlsubject);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlsubject = $sqlsubject . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlsubject);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$conn= null;


function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <header class="w3-header w3-teal w3-center w3-padding-16" style="height:80px">
        <h2>Subject List</h2>
    </header>
<div class="w3-card w3-container w3-padding w3-margin w3-round">
<form>
    <div class="w3-bar w3-light-grey w3-border">
    <a href="main.php" class="w3-bar-item w3-button w3-mobile w3-teal" style="width:15%">Courses</a>
    <a href="tutors.php" class="w3-bar-item w3-button w3-mobile" style="width:15%">Tutors</a>
    <a href="#" class="w3-bar-item w3-button w3-mobile" style="width:15%">Subscription</a>
    <a href="profile.php" class="w3-bar-item w3-button w3-mobile"style="width:15%">Profile</a>
    <input type="search" name="search" class="w3-bar-item w3-input w3-white w3-mobile" style="width:25%" placeholder="Search..">
    <button class="w3-bar-item w3-button w3-green w3-mobile" type="submit" name="submit" value="search">Search</button>
    <a href="login.php" class="w3-bar-item w3-button w3-mobile w3-red">Logout</a>
  </div>
  </form>
</div>

<div class="w3-grid-template" style="font-size:12px">
        <?php
        $i = 0;
        foreach ($rows as $subjects) {
            $i++;
            $subid = $subjects['subject_id'];
            $subname = truncate($subjects['subject_name'],15);
            $subrating = $subjects['subject_rating'];
            $subprice = number_format((float)$subjects['subject_price'], 2, '.', '');
            echo "<a href='subjectdetails.php?subid=$subid' style='text-decoration: none;'> <div class='w3-card-4 w3-round' style='margin:4px'>
            <header class='w3-container w3-yellow'><h4><b>$subname</b></h4></header>";
            echo "<img class='w3-image' src=../../mytutor/assets/courses/$subid.png"
                . " style='width:100%;height:250px'><hr>";
            echo "<div class='w3-container'><p>Subject Name: $subname <br>Subject Price: RM $subprice<br>Rating: $subrating</p></div>
            </div></a>";
        }
        ?>
    </div>
    <br>
    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + 10;
    } else {
        $num = $pageno * 10 - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "main.php?pageno=' . $page . '" style=
            "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    <br>
    <footer class="w3-footer w3-center w3-bottom w3-teal">MyTutor</footer>
</body>
</html>