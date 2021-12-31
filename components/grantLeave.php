<title>Grant Leave</title>

<?php
require('header.php');

if (isset($_POST['submit'])) {
    $eid = $_POST['eId'];
    $sdate = $_POST['startDate'];
    $edate = $_POST['endDate'];
    $reason = $_POST['reason'];
    $permission = $_POST['permission'];

    $query = "INSERT INTO leaves(eId,startDate,endDate,reason,permission) VALUES($eid,'$sdate','$edate','$reason','$permission')";
    if (!$db->query($query)) {
        print("ERROR WHILE INSERTING EMPLOYEE!");
        print(mysqli_error($db));
    } else {
        echo '<script>alert("Success!")</script>';
    }
}

$query = "SELECT eId, eName from employee";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) == 0) {
    print($query);
    print("FAILED TO RETRIEVE EMPLOYEE DETAILS!");
    print(mysqli_error($db));
} else {
    $idArray = array();
    $nameArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $idArray[] = $row['eId'];
        $nameArray[] = $row['eName'];
    }
}
?>

<div class="p-sm-5 bg-gradient">

    <form class="container col-lg-7 shadow rounded p-5 bg-white" action="grantLeave.php" method="post">

        <h2 class="mb-4">Grant Leave</h2>
        <hr>

        <div class="row">
            <div class="mb-3 col-sm">
                <label for="eId" class="form-label">Employee ID</label>
                <input type="text" class="form-control" list="employees" id="eId" name="eId" autocomplete="off" required>
                <datalist id="employees">
                </datalist>
            </div>

            <div class="mb-3 col-sm">
                <label class="form-check-label" for="permission">Permission</label>
                <select id="permission" name="permission" class="form-select mt-2" aria-label="Default select example">
                    <option disabled selected>- select -</option>
                    <option value="Granted">Granted</option>
                    <option value="Denied">Denied</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-sm">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" onchange="validate()" class="form-control" id="startDate" name="startDate" required>
            </div>

            <div class="mb-3 col-sm">
                <label for="endDate" class="form-label">End Date</label>
                <input type="date" onchange="validate()" class="form-control" id="endDate" name="endDate" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea class="form-control" id="reason" name="reason" required></textarea>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" name="submit" class="btn btn-dark bg-gradient btn-lg rounded">Submit</button>
        </div>
    </form>

</div>



<script type="text/javascript">
    var idArray = <?php echo json_encode($idArray); ?>;
    var nameArray = <?php echo json_encode($nameArray); ?>;
</script>

<script src="scripts/leave.js" type="text/javascript"></script>
<script>
    fillDropDown();
</script>