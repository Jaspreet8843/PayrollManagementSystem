<title>Employee</title>

<?php
require('header.php');
if (isset($_POST['submit'])) {
  $name = $_POST['eName'];
  $add = $_POST['eAddress'];
  $dob = $_POST['eDOB'];
  $email = $_POST['eEmail'];
  $sex = $_POST['eSex'];
  $desig = $_POST['designation'];
  $date = $_POST['joinDate'];
  $basic = $_POST['basicSalary'];
  $user_id = $_SESSION['user_id'];

  $row_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT `AUTO_INCREMENT`
    FROM  INFORMATION_SCHEMA.TABLES
    WHERE TABLE_SCHEMA = 'payrollmanagement'
    AND   TABLE_NAME   = 'employee'"))['AUTO_INCREMENT'];


  $query = "INSERT INTO employee(eName,eAddress,eDOB,eEmail,eSex,eDesig,joiningDate,currentBasic,insertedBy) VALUES('$name','$add','$dob','$email','$sex',$desig,'$date',$basic,'$user_id')";

  if (!$db->query($query)) {
    mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Employee',$row_id,'Insertion Error','$user_id')");
    print("ERROR WHILE INSERTING EMPLOYEE!");
    print(mysqli_error($db));
  }
  else
  {
      mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('employee',$row_id,'insert','$user_id')");
          print(mysqli_error($db));
      echo '<script>alert("Success!")</script>';
  }
}
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
?>

<div class="p-sm-5">
  <form class="container shadow rounded col-lg-8 p-5 bg-white" action="addEmployee.php" method="post">
    <h2 class="mb-4">Add Employee</h2>

    <hr>

    <div class="row">
      <div class="mb-3 col-sm">
        <label for="eName" class="form-label">Name</label>
        <input type="text" class="form-control" id="eName" name="eName">
      </div>
      <div class="mb-3 col-sm">
        <label for="eDOB" class="form-label">Date of Birth</label>
        <input type="date" max="<?php echo date("Y-m-d"); ?>" class="form-control" name="eDOB" id="eDOB">
      </div>
    </div>

    <div class="row">
      <div class="mb-3 col-sm">
        <label for="eEmail" class="form-label">Email</label>
        <input type="text" class="form-control" name="eEmail" id="eEmail">
      </div>
      <div class="mb-3 col-sm">
        <label class="form-check-label" for="eSex">Sex</label>
        <select id="eSex" name="eSex" class="form-select mt-2" aria-label="Default select example">
          <option disabled selected>- select -</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Others">Others</option>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label for="eAddress" class="form-label">Address</label>
      <textarea class="form-control" name="eAddress" id="eAddress"></textarea>
    </div>

    <div class="row">
      <div class="mb-3 col-sm">
        <label class="form-check-label" for="department">Department</label>
        <select id="department" name="department" class="form-select mt-2" onchange="setDesignation()">
          <option disabled selected>- select -</option>
        </select>
      </div>
      <div class="mb-3 col-sm">
        <label class="form-check-label" for="designation">Designation</label>
        <select id="designation" name="designation" class="form-select mt-2" onchange="setSalary()">
          <option disabled selected>- select -</option>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="mb-3 col-sm">
        <label for="basicSalary" class="form-label">Basic Salary</label>
        <input type="number" class="form-control" name="basicSalary" id="basicSalary">
      </div>
      <div class="mb-3 col-sm">
        <label for="joinDate" class="form-label">Joining Date</label>
        <input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="joinDate" id="joinDate">
      </div>
    </div>

    <div class="d-grid gap-2">
      <button name="submit" type="submit" class="btn btn-dark btn-lg rounded shadow bg-gradient">Submit</button>
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