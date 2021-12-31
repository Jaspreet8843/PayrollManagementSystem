<title>Departments</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
  referrerpolicy="no-referrer" />
<?php
require('header.php');

$query = "SELECT count(eId) 'employees',department.*,designation.* FROM employee RIGHT OUTER JOIN designation ON employee.eDesig = designation.desigNo INNER JOIN department ON designation.deptNo = department.dNo GROUP BY desigNo";
$leaves = mysqli_query($db, $query);
?>

<div class="p-sm-5">
    <div class="m-md-3 mt-5 p-5 bg-white shadow rounded">
        <div class="row">
            <div class="col-md-4">
                <h2>Departments</h2>
            </div>
            
            <div class="col-md-2 p-2 p-md-1">
                <select class="selectpicker w-100" id="filter" onchange="filterCols()" multiple placeholder="Nothing hidden">
                    <!-- <option value=0>Department</option>
                    <option value=1>Location</option> -->
                    <option value=2>Designation</option>
                    <option value=3>Basic Salary</option>
                    <option value=4>Total Employees</option>
                </select>
            </div>
            <div class="col-md-2 p-2 p-md-1"> 
                <select class="form-select" id="category" onchange="search()">
                    <option value=-1 selected>Search All</option>
                    <option value=0>Department</option>
                    <option value=1>Location</option>
                    <option value=2>Designation</option>
                    <option value=3>Basic Salary</option>
                    <option value=4>Total Employees</option>
                </select>
            </div>
            <div class="col-md-4 p-2 p-md-1">
                <div class="input-group">
                <input class="form-control" type="text" id="search" placeholder="Search" onkeyup="search()"/>
                <div class="input-group-prepend">
                    <div class="input-group-text">&#x1F50E;&#xFE0E;</div>
                </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="overflow-auto">
            <table class="mt-2 table table-bordered table-hover" id="deptTable">
            
                <thead class="thead-dark align-middle">
                    <tr>
                        <th>Department</th>
                        <th>Location</th>
                        <th>Designation</th>
                        <th>Basic Salary</th>
                        <th>Total Employees</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($leaves)) {      
                    ?>
                    <tr class="align-middle">
                        <td>
                            <?php echo $row['dName']?>
                        </td>
                        <td>
                            <?php echo $row['dLocation']?>
                        </td>
                        <td>
                            <?php echo $row['desigName']?>
                        </td>
                        <td>
                            <?php echo $row['basicSalary']?>
                        </td>
                        <td>
                            <?php echo $row['employees']?>
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

<script src="scripts/department.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    setTable();
  mergeCells();
</script>