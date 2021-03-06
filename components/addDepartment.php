<title>Department</title>

<?php
require('header.php');

if(isset($_POST['submit']))
{
  $deptName = mysqli_escape_string($db,$_POST['dName']);
  $deptLocation = mysqli_escape_string($db,$_POST['dLocation']);
  $user_id = $_SESSION['user_id'];
  $row_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT `AUTO_INCREMENT`
                                            FROM  INFORMATION_SCHEMA.TABLES
                                            WHERE TABLE_SCHEMA = 'payrollmanagement'
                                            AND   TABLE_NAME   = 'department'"))['AUTO_INCREMENT'];

  $query = "INSERT INTO department(dName,dLocation) VALUES ('$deptName','$deptLocation')";
  mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Department',$row_id,'Insert','$user_id')");
  if(!$db -> query($query))
  {
    mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Department',$row_id,'Insertion Error','$user_id')");
    print("TRANSACTION FAILED!");
    print(mysqli_error($db));
  }
  else
  {
    $row_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT `AUTO_INCREMENT`
                                            FROM  INFORMATION_SCHEMA.TABLES
                                            WHERE TABLE_SCHEMA = 'payrollmanagement'
                                            AND   TABLE_NAME   = 'department'"))['AUTO_INCREMENT'];

    $query = "SELECT dno from department WHERE dname='$deptName'";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result)==0){
      mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Department',$row_id,'Fetch Error','$user_id')");
      print("FAILED TO RETRIEVE DEPARTMENT!");
      print(mysqli_error($db));
    }
    else
    {
      
      $deptNo = mysqli_fetch_row($result)[0];

      $desigArray = array();
      $salArray = array();

      foreach ($_POST as $key => $value) {
        if(substr($key,0,11)==="Designation" && $value!=="")
        {
          $desigArray[] = $value;
        }
        elseif(substr($key,0,6)==="Salary" && $value!=="")
        {
          $salArray[] = $value;
        }
      }
      
      for($i=0; $i<count($desigArray);$i++) {
        $x = $desigArray[$i];
        $y = $salArray[$i];
        $row_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT `AUTO_INCREMENT`
                                            FROM  INFORMATION_SCHEMA.TABLES
                                            WHERE TABLE_SCHEMA = 'payrollmanagement'
                                            AND   TABLE_NAME   = 'designation'"))['AUTO_INCREMENT'];
        mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Designation',$row_id,'Insert','$user_id')");
        $query = "INSERT INTO designation(deptNo,desigName,basicSalary) VALUES($deptNo,'$x',$y)";
        if(!$db -> query($query))
        {
          mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Designation',$row_id,'Insertion Error','$user_id')");
          print("ERROR WHILE INSERTING DESIGNATION!");
          print(mysqli_error($db));
        }
      }
    }
  }
}
?>

<script src="scripts/department.js" type="text/javascript"></script>

<div class="p-sm-5">
  <form class="container p-5 col col-md-7 mx-auto bg-white rounded shadow" action="addDepartment.php" method="post"> 
    <div id="page1">
      <h2 class="mb-4">Add Department</h2>
      <hr>
      <div class="mb-3">
        <label for="dName" class="form-label">Name</label>
        <input type="text" class="form-control" id="dName" name="dName" required>
      </div>

      <div class="mb-3">
        <label for="dLocation" class="form-label">Location</label>
        <input type="text" class="form-control" id="dLocation" name="dLocation" required>
      </div>
      <div class="d-grid gap-2">
        <button onclick="showNextPage();" class="btn btn-dark rounded shadow bg-gradient">Next</button>
      </div>
    </div>
    <div id="page2" style="display:none"> 
      <h2 class="mb-4" id="dPrint">Add Designation(s) for </h2>
      <hr>
      <div class="mb-3 row" id="designationForm">
        <div class="row">
          <input type="text" class="form-control col-sm m-2" name="Designation_0" placeholder="Designation 1" required>
          <input type="number" class="form-control col-sm m-2" name="Salary_0" placeholder="Salary 1" onkeydown="textBoxCreate(); this.onkeydown=null;" required>
        </div>
      </div>
      <div class="d-grid gap-2">
        <button name="submit" type="submit" class="btn btn-dark btn-lg rounded shadow bg-gradient">Submit</button>
      </div>
    </div>
  </form>
</div>
<?php require('footer.php');?>