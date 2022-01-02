<title>Leaves</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
require('header.php');

$query = "SELECT * FROM employee INNER JOIN salary ON employee.eId=salary.eId ORDER BY sDate DESC";
$salary = mysqli_query($db, $query);
?>
<style>
    .print-container {
        visibility: hidden;
        border: 2px solid black;
        padding: 2%;
    }

    @media print {
        body {
            visibility: hidden;
            font-size: 30pt;
        }

        .print-container,
        .print-container * {
            visibility: visible;
        }
    }
</style>

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
                    <option value=13>Inserted By</option>
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
                    <option value=13>Inserted By</option>
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
                        <th></th>
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
                        <th>Net Salary</th>
                        <th>Remarks</th>
                        <th>Salary Date</th>
                        <th>Inserted By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($salary)) {
                    ?>
                        <tr class="align-middle">
                            <td>
                                <button class="btn btn-secondary" onclick="printDiv('print-container<?php echo $row['sId'] ?>');"><i class="fas fa-print"></i></button>
                                <div id="print-container<?php echo $row['sId'] ?>" class="print-container text-center" style="display:none;">
                                    <div class="border p-5">

                                        <h2 style="text-align: center; font-size: 60pt;">Payslip</h2>
                                        <br /><br />
                                        <div class="row">
                                            <div class="col-8">

                                            </div>

                                            <div class="col">
                                                <h2>

                                                    PAYROLL MANAGEMENT SYSTEM
                                                </h2>
                                                <h4>
                                                    Jorhat Engineering College, Jorhat
                                                </h4>
                                            </div>
                                            <div class="col-1">
                                                <img src="static/icon.png" style="width:100%">
                                            </div>
                                        </div>
                                        <table class="table table-borderless" style="font-size:30pt">
                                            <tr>
                                                <td>Name</td>
                                                <td colspan="3"><?php echo $row['eName'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Salary ID</td>
                                                <td><?php echo $row['sId'] ?></td>
                                                <td>Employee ID</td>
                                                <td><?php echo $row['eId'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>From</td>
                                                <td><?php echo $row['dateFrom'] ?></td>
                                                <td>Till</td>
                                                <td><?php echo $row['dateTill'] ?></td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered text-center mt-5" style="font-size:30pt;">
                                            <thead>
                                                <th colspan="2">
                                                    Earnings
                                                </th>
                                                <th colspan="2">
                                                    Deductions
                                                </th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Basic Pay</td>
                                                    <td><?php echo $row['basic'] ?></td>
                                                    <td>Leaves</td>
                                                    <td><?php echo $row['deductions'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>DA</td>
                                                    <td><?php echo $row['DA'] ?></td>
                                                    <td>PF</td>
                                                    <td><?php echo $row['PF'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>HRA</td>
                                                    <td><?php echo $row['HRA'] ?></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <b>
                                                        <th>
                                                            TOTAL EARNINGS:
                                                        </th>
                                                        <th>
                                                            <?php echo $row['basic'] + $row['DA'] + $row['HRA'] ?>
                                                        </th>
                                                        <th>
                                                            TOTAL DEDUCTIONS:
                                                        </th>
                                                        <th>
                                                            <?php echo $row['PF'] + $row['deductions'] ?>
                                                        </th>
                                                    </b>
                                                </tr>
                                                <tr>
                                                    <th colspan="2"></th>
                                                    <th>NET PAY</th>
                                                    <th><?php echo $row['basic'] + $row['DA'] + $row['HRA'] - $row['PF'] - $row['deductions'] ?></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
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
                                <?php echo ($row['basic'] + $row['DA'] + $row['HRA'] - $row['PF'] - $row['deductions']) ?>
                            </td>
                            <td>
                                <?php echo $row['remarks'] ?>
                            </td>
                            <td>
                                <?php echo $row['sDate'] ?>
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
    </div>

</div>

<script src="scripts/salary.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php require('footer.php'); ?>