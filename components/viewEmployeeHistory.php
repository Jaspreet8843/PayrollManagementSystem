<title>Employees</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
require('header.php');

$query = "SELECT * FROM employeehistory,designation,department WHERE employeehistory.eDesig = designation.desigNo AND designation.deptNo = department.dNo ORDER BY serialNo DESC";
$employees = mysqli_query($db, $query);
?>

<div class="p-sm-5">
    <div class="m-md-3 mt-5 p-5 bg-white shadow rounded">
        <div class="row">
            <div class="col-md-4">
                <h2>Employee History</h2>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="selectpicker w-100" id="filter" onchange="hideCols()" multiple placeholder="Nothing Hidden">
                <option value=0>Sl No.</option>
                    <option value=1>eID</option>
                    <option value=2>eName</option>
                    <option value=3>Designation</option>
                    <option value=4>Department</option>
                    <option value=5>Basic Salary</option>
                    <option value=6>Update Date</option>
                    <option value=7>Action</option>
                    <option value=8>Action By</option>
                </select>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="form-select" id="category" onchange="search()">
                    <option value=0>Sl No.</option>
                    <option value=1>eID</option>
                    <option value=2>eName</option>
                    <option value=3>Designation</option>
                    <option value=4>Department</option>
                    <option value=5>Basic Salary</option>
                    <option value=6>Update Date</option>
                    <option value=7>Action</option>
                    <option value=8>Action By</option>
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
            <table class="mt-2 table table-bordered table-hover" id="employeeTable">

                <thead class="thead-dark align-middle">
                    <tr>
                        <th>Sl No.</th>
                        <th>eID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Basic Salary</th>
                        <th>Update Date</th>
                        <th>Action</th>
                        <th>Action By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($employees)) {
                    ?>
                        <tr class="align-middle">
                            <td>
                                <?php echo $row['serialNo'] ?>
                            </td>
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
                                <?php echo $row['basicSalary'] ?>
                            </td>
                            <td>
                                <?php echo $row['updateDate'] ?>
                            </td>
                            <td>
                                <?php echo $row['action'] ?>
                            </td>
                            <td>
                                <?php echo $row['actionby'] ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="scripts/employee.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php require('footer.php'); ?>