<title>Edit</title>

<?php
require('header.php');
$user_id = $_SESSION['user_id'];
if (isset($_POST['employeeId'])) {
    $eId = $_POST['employeeId'];
    $query = "SELECT * FROM employee WHERE eId = '$eId'";
    $row = mysqli_fetch_assoc(mysqli_query($db,$query));
    $name = $row['eName'];
    $desig = $row['eDesig'];
    $basic = $row['currentBasic'];
  

//   $query = "INSERT INTO employee(eName,eAddress,eDOB,eEmail,eSex,eDesig,joiningDate,currentBasic,insertedBy) VALUES('$name','$add','$dob','$email','$sex',$desig,'$date',$basic,'$user_id')";

//   if (!$db->query($query)) {
//     mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('employee',$row_id,'insertion error','$user_id')");
//     print("ERROR WHILE INSERTING EMPLOYEE!");
//     print(mysqli_error($db));
//   }
//   else
//   {
//       mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('employee',$row_id,'insert','$user_id')");
//           print(mysqli_error($db));
//       echo '<script>alert("Success!")</script>';
//   }


$query = "SELECT eDesig,dName,desigName, currentBasic from department,designation, employee WHERE department.dno=designation.deptno AND employee.eDesig=designation.desigNo AND employee.eId=$eId";
$data = mysqli_fetch_assoc(mysqli_query($db,$query));

$query = "SELECT dNo, dName,desigName, desigNo, basicSalary from department,designation WHERE department.dno=designation.deptno";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) == 0) {
  print($query);
  print("FAILED TO RETRIEVE DEPARTMENT!");
  print(mysqli_error($db));
} else {
  $dropDownList = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $dropDownList[] = $row;
  }
}
}
else
{
    // REDIRECT 
}

$row_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT `AUTO_INCREMENT`
        FROM  INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = 'payrollmanagement'
        AND   TABLE_NAME   = 'employeehistory'"))['AUTO_INCREMENT'];


if(isset($_POST["save"]))
{
    $eDesig = $_POST['designation'];
    $basic = $_POST['basicSalary'];
    $eId = $_POST['eId'];
    $eName = $_POST['eName'];

    $query = "INSERT INTO employeehistory(eId,eName,eDesig,basicSalary,action,actionBy) VALUES('$eId','$eName','$eDesig','$basic','Update','$user_id')";
    if ($db->query($query)) {
        mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('EmployeeHistory',$row_id,'Insert','$user_id')");
        $query = "UPDATE employee SET eDesig = '$eDesig', currentBasic = '$basic', insertedBy = '$user_id' WHERE eId = '$eId'";
        if($db->query($query))
        {
            echo '<script>alert("Success!")</script>';
            mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Employee','$eId','Update','$user_id')");
            echo '<script type="text/javascript"> window.location="../components/viewEmployee.php";</script>';
        }
    }
    else
    {
        mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('EmployeeHistory',$row_id,'Insertion Error','$user_id')");
        echo '<script>alert("ERROR! Contact site Admin.")</script>';
    }

}

if(isset($_POST["delete"]))
{
    $eDesig = $_POST['designation'];
    $basic = $_POST['basicSalary'];
    $eId = $_POST['eId'];
    $eName = $_POST['eName'];

    $query = "INSERT INTO employeehistory(eId,eName,eDesig,basicSalary,action,actionBy) VALUES('$eId','$eName','$eDesig','$basic','Delete','$user_id')";
    if ($db->query($query)) {
        mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('EmployeeHistory',$row_id,'Insert','$user_id')");
        $query = "DELETE FROM employee WHERE eId = '$eId'";
        if($db->query($query))
        {
            echo '<script>alert("Success!")</script>';
            mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Employee','$eId','Delete','$user_id')");
            echo '<script type="text/javascript"> window.location="../components/viewEmployee.php";</script>';
        }
    }
    else
    {
        mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('EmployeeHistory',$row_id,'Insertion Error','$user_id')");
        echo '<script>alert("ERROR! Contact site Admin.")</script>';
    }
}


?>

<div class="p-sm-5">
  <form class="container shadow rounded col-lg-8 p-5 bg-white" action="editEmployee.php" method="post">
    <h2 class="mb-4">Edit</h2>

    <hr>

    <div class="row">
      <div class="mb-3 col-sm">
        <label for="eName" class="form-label">Name</label>
        <input type="text" class="form-control" id="eName" value="<?php echo $name?>" disabled>
        <input type="text" name="eName" value="<?php echo $name?>" hidden>
      </div>
    </div>

    <input type="text" value="<?php echo $eId?>" name="eId" hidden/>
    <div class="row">
      <div class="mb-3 col-sm">
        <label class="form-check-label" for="department">Department</label>
        <select id="department" name="department" class="form-select mt-2" onchange="setDesignation()">
          <option disabled selected hidden><?php echo $data['dName']?></option>
        </select>
      </div>
      <div class="mb-3 col-sm">
        <label class="form-check-label" for="designation">Designation</label>
        <select id="designation" name="designation" class="form-select mt-2" onchange="setSalary()" >
        <option value="<?php echo $data['eDesig']?>" selected hidden><?php echo $data['desigName']?></option>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="mb-3 col-sm">
        <label for="basicSalary" class="form-label">Basic Salary</label>
        <input type="number" class="form-control" name="basicSalary" id="basicSalary" value="<?php echo $data['currentBasic']?>">
      </div>
    </div>

    <div class="gap-2 row">
        <div class="col">
            <button name="save" type="submit" class="btn btn-dark w-100 btn-lg rounded shadow bg-gradient">UPDATE</button>
        </div>
        <div class="col">
            <button name="delete" type="submit" class="btn btn-danger w-100 btn-lg rounded shadow bg-gradient" onclick="return confirm('Are you sure?');">DELETE</button>
        </div>
    </div>
  </form>
</div>

<script type="text/javascript">
  var dropDownList = <?php echo json_encode($dropDownList); ?>;
</script>
<script src="scripts/employee.js" type="text/javascript"></script>
<script>
  fillDropDown();
</script>

<?php require('footer.php');?>