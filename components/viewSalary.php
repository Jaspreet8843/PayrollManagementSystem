<title>Leaves</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
require('header.php');

$query = "SELECT * FROM employee INNER JOIN salary ON employee.eId=salary.eId ORDER BY sDate DESC";
$salary = mysqli_query($db, $query);
?>

<div class="p-sm-5">
    <div class="m-md-3 mt-5 p-5 bg-white shadow rounded">
        <div class="row">
            <div class="col-md-4">
                <h2>Salary</h2>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="selectpicker w-100" id="filter" onchange="filterCols()" multiple placeholder="Nothing hidden">
                    <option value=0>Salary ID</option>
                    <option value=1>Employee ID</option>
                    <option value=2>Name</option>
                    <option value=3>Date From</option>
                    <option value=4>Date Till</option>
                    <option value=5>Basic</option>
                    <option value=6>DA</option>
                    <option value=7>HRA</option>
                    <option value=8>PF</option>
                    <option value=9>Deductions</option>
                    <option value=10>Gross Salary</option>
                    <option value=11>Remarks</option>
                    <option value=12>Salary Date</option>
                </select>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="form-select" id="category" onchange="search()">
                    <option value=-1 selected>Search All</option>
                    <option value=0>Salary ID</option>
                    <option value=1>Employee ID</option>
                    <option value=2>Name</option>
                    <option value=3>Date From</option>
                    <option value=4>Date Till</option>
                    <option value=5>Basic</option>
                    <option value=6>DA</option>
                    <option value=7>HRA</option>
                    <option value=8>PF</option>
                    <option value=9>Deductions</option>
                    <option value=10>Gross Salary</option>
                    <option value=11>Remarks</option>
                    <option value=12>Salary Date</option>
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
            <table class="mt-2 table table-bordered table-hover" id="salaryTable">

                <thead class="thead-dark align-middle">
                    <tr>
                        <th>Salary ID</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Date From</th>
                        <th>Date Till</th>
                        <th>Basic</th>
                        <th>DA</th>
                        <th>HRA</th>
                        <th>PF</th>
                        <th>Deductions</th>
                        <th>Gross Salary</th>
                        <th>Remarks</th>
                        <th>Salary Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($salary)) {
                    ?>
                        <tr class="align-middle">
                            <td>
                                <?php echo $row['sId'] ?>
                            </td>
                            <td>
                                <?php echo $row['eId'] ?>
                            </td>
                            <td>
                                <?php echo $row['eName'] ?>
                            </td>
                            <td>
                                <?php echo $row['dateFrom'] ?>
                            </td>
                            <td>
                                <?php echo $row['dateTill'] ?>
                            </td>
                            <td>
                                <?php echo $row['basic'] ?>
                            </td>
                            <td>
                                <?php echo $row['DA'] ?>
                            </td>
                            <td>
                                <?php echo $row['HRA'] ?>
                            </td>
                            <td>
                                <?php echo $row['PF'] ?>
                            </td>
                            <td>
                                <?php echo $row['deductions'] ?>
                            </td>
                            <td>
                                <?php echo ($row['basic']+ $row['DA'] + $row['HRA'] - $row['PF'] - $row['deductions']) ?>
                            </td>
                            <td>
                                <?php echo $row['remarks'] ?>
                            </td>
                            <td>
                                <?php echo $row['sDate'] ?>
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

<script src="scripts/salary.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>