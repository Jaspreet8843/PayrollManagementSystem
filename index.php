<title>HOME</title>


<?php
require('components/header.php');

$userid = $_SESSION['user_id'];
$query = "SELECT count(*) FROM logs WHERE user_id = '$userid' AND DATE(timestamp) > (NOW() - INTERVAL 1 DAY)";
$pastday = mysqli_fetch_assoc(mysqli_query($db, $query))['count(*)'];
$query = "SELECT count(*) FROM logs WHERE user_id = '$userid' AND DATE(timestamp) > (NOW() - INTERVAL 7 DAY)";
$pastweek = mysqli_fetch_assoc(mysqli_query($db, $query))['count(*)'];
$query = "SELECT count(*) FROM logs WHERE user_id = '$userid' AND DATE(timestamp) > (NOW() - INTERVAL 30 DAY)";
$pastmonth = mysqli_fetch_assoc(mysqli_query($db, $query))['count(*)'];
$query = "SELECT count(*) FROM logs WHERE user_id = '$userid' AND DATE(timestamp) > (NOW() - INTERVAL 365 DAY)";
$pastyear = mysqli_fetch_assoc(mysqli_query($db, $query))['count(*)'];


?>
<!-- <img src="components/static/homebg.jpg" style="width: 100vw; position:fixed; z-index:-1;"> -->
<div class="p-5 background">
    <div class="m-5 p-5 col-5 " style="transform: rotate(-12deg);">
        <h3 class="">Welcome, <b> <?php echo $_SESSION['name']?></b></h3>
        <h4>You've made </h4>
        <h6 class="mx-5"><?php echo $pastday?> changes in past 1 day<br>
        <?php echo $pastweek?> changes in past 7 days<br>
        <?php echo $pastmonth?> changes in past 30 days<br>
        <?php echo $pastyear?> changes in past 365 days<br></h6>
    </div>
</div>



<script>
    document.getElementById("homelink").classList.add("active");
</script>
