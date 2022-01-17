<title>Employees</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
require('header.php');

$query = "SELECT * FROM employee,designation,department WHERE employee.eDesig = designation.desigNo AND designation.deptNo = department.dNo";
$employees = mysqli_query($db, $query);
?>

<div class="p-sm-5">
    <div class="m-md-3 mt-md-1 p-5 bg-white shadow rounded">
        <div class="row">
            <div class="col-md-4">
                <h2>Employees</h2>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="selectpicker w-100" id="filter" onchange="filterCols()" multiple placeholder="Nothing Hidden">
                    <option value=1>ID</option>
                    <option value=2>Name</option>
                    <option value=3>Address</option>
                    <option value=4>DOB</option>
                    <option value=5>Email</option>
                    <option value=6>Sex</option>
                    <option value=7>Designation</option>
                    <option value=8>Department</option>
                    <option value=9>Basic Salary</option>
                    <option value=10>Joining Date</option>
                    <option value=11>Inserted By</option>
                </select>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="form-select" id="category" onchange="search()">
                    <option value=-1 selected>Search All</option>
                    <option value=1>ID</option>
                    <option value=2>Name</option>
                    <option value=3>Address</option>
                    <option value=4>DOB</option>
                    <option value=5>Email</option>
                    <option value=6>Sex</option>
                    <option value=7>Designation</option>
                    <option value=8>Department</option>
                    <option value=9>Basic Salary</option>
                    <option value=10>Joining Date</option>
                    <option value=11>Inserted By</option>
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
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>DOB</th>
                        <th>Email</th>
                        <th>Sex</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Basic Salary</th>
                        <th>Joining Date</th>
                        <th>Inserted By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($employees)) {
                    ?>
                        <tr class="align-middle">
                            <form action="editEmployee.php" method="POST">        
                                <td class="text-center">
                                    <button class="btn btn-warning" value="<?php echo $row['eId'] ?>" name="employeeId">📝</button>
                                </td>
                            </form>
                            <td>
                                <?php echo $row['eId'] ?>
                            </td>
                            <td>
                                <?php echo $row['eName'] ?>
                            </td>
                            <td>
                                <?php echo $row['eAddress'] ?>
                            </td>
                            <td>
                                <?php echo $row['eDOB'] ?>
                            </td>
                            <td>
                                <?php echo $row['eEmail'] ?>
                            </td>
                            <td>
                                <?php echo $row['eSex'] ?>
                            </td>
                            <td>
                                <?php echo $row['desigName'] ?>
                            </td>
                            <td>
                                <?php echo $row['dName'] ?>
                            </td>
                            <td>
                                <?php echo $row['currentBasic'] ?>
                            </td>
                            <td>
                                <?php echo $row['joiningDate'] ?>
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

<script src="scripts/employee.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    noOfRows();
</script>
<?php require('footer.php'); ?>