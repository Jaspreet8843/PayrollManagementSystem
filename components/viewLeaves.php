<title>Leaves</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
require('header.php');

$query = "SELECT * FROM employee,leaves,designation,department WHERE employee.eId = leaves.eId AND employee.eDesig = designation.desigNo AND designation.deptNo = department.dNo ORDER BY startDate DESC";
$leaves = mysqli_query($db, $query);
?>

<div class="p-sm-5">
    <div class="m-md-3 mt-5 p-5 bg-white shadow rounded">
        <div class="row">
            <div class="col-md-2">
                <h2>Leaves</h2>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="form-select" id="catByTime" onchange="filterRows()">
                    <option value=-1 selected>All</option>
                    <option value=0>Absent</option>
                    <option value=1>Past Leaves</option>
                    <option value=2>Future Leaves</option>
                    <option value=3>Granted</option>
                    <option value=4>Denied</option>
                </select>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="selectpicker w-100" id="filter" onchange="hideCols()" multiple placeholder="Nothing hidden">
                    <option value=0>ID</option>
                    <option value=1>Name</option>
                    <option value=2>Designation</option>
                    <option value=3>Department</option>
                    <option value=4>From</option>
                    <option value=5>Till</option>
                    <option value=6>Reason</option>
                    <option value=7>Permission</option>
                    <option value=8>Inserted By</option>
                </select>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="form-select" id="category" onchange="search()">
                    <option value=-1 selected>Search All</option>
                    <option value=0>ID</option>
                    <option value=1>Name</option>
                    <option value=2>Designation</option>
                    <option value=3>Department</option>
                    <option value=4>From</option>
                    <option value=5>Till</option>
                    <option value=6>Reason</option>
                    <option value=7>Permission</option>
                    <option value=8>Inserted By</option>
                </select>
            </div>
            <div class="col-md-4 p-2 p-md-1">
                <div class="input-group">
                    <input class="form-control" type="text" id="search" placeholder="Search" onkeyup="search()" />
                    <div class="input-group-prepend">
                        <div class="input-group-text">&#x1F50E;&#xFE0E;</div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="overflow-auto">
            <table class="mt-2 table table-bordered table-hover" id="leavesTable">

                <thead class="thead-dark align-middle">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>From</th>
                        <th>Till</th>
                        <th>Reason</th>
                        <th>Permission</th>
                        <th>Inserted By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($leaves)) {
                    ?>
                        <tr class="align-middle">
                            <td>
                                <?php echo $row['eId'] ?>
                            </td>
                            <td>
                                <?php echo $row['eName'] ?>
                            </td>
                            <td>
                                <?php echo $row['desigName'] ?>
                            </td>
                            <td>
                                <?php echo $row['dName'] ?>
                            </td>
                            <td>
                                <?php echo $row['startDate'] ?>
                            </td>
                            <td>
                                <?php echo $row['endDate'] ?>
                            </td>
                            <td>
                                <?php echo $row['reason'] ?>
                            </td>
                            <td>
                                <?php echo $row['permission'] ?>
                            </td>
                            <td>
                                <?php echo $row['insertedBy'] ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-8" id="countmsg">
            </div>
            <div class="col-md-4">
                <button onclick="nextRows()" id="nextbtn" class="btn btn-outline-dark float-md-end">Next <i class="fas fa-arrow-circle-right"></i></button>
                <button onclick="prevRows()" id="prevbtn" class="btn btn-outline-dark float-md-end"><i class="fas fa-arrow-circle-left"></i> Previous</button>
            </div>
        </div>
    </div>

</div>

<script src="scripts/leave.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    noOfRows();
</script>

<?php require('footer.php');?>