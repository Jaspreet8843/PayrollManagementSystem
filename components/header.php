<?php

session_start();
if(!isset($_SESSION['user_id']) && basename($_SERVER['PHP_SELF'])!= 'login.php' && basename($_SERVER['PHP_SELF'])!= 'register.php')
{
  header('location:../components/login.php');
}
require('inc/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link href="../../components/scripts/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="icon" type="image/x-icon" href="../../components/static/icon2.png">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-gradient bg-dark shadow p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img class="me-3" src="../../components/static/icon.png" style="width:30px"/>Payroll Management System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../index.php" id="homelink">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="leaveslink">
              Leaves
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="/components/grantLeave.php"><i class="far fa-file-certificate"></i>
                  Grant</a></li>
              <li><a class="dropdown-item" href="/components/viewLeaves.php"><i class="far fa-eye"></i> View</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="employeeslink">
              Employees
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="/components/addEmployee.php"><i class="fas fa-plus-square"></i> Add</a></li>
              <li><a class="dropdown-item" href="/components/viewEmployee.php"><i class="fas fa-exclamation-triangle"></i> View/Edit</a></li>
              <li><a class="dropdown-item" href="/components/viewEmployeeHistory.php"><i class="fas fa-history"></i> History</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="salarylink">
              Salary
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="/components/paySalary.php"><i class="fas fa-credit-card"></i> Pay</a></li>
              <li><a class="dropdown-item" href="/components/viewSalary.php"><i class="far fa-eye"></i> View</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="departmentlink">
              Departments
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="/components/addDepartment.php"><i class="fas fa-plus-square"></i> Add</a></li>
              <li><a class="dropdown-item" href="/components/viewDepartments.php"><i class="far fa-eye"></i> View</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="/components/logs.php" role="button" id="activitylink">
              Activity
            </a>
          </li>

          <?php if( isset($_SESSION['type']) &&  $_SESSION['type']== 'admin')
          { ?>
          <li class="nav-item dropdown">
            <a class="nav-link" href="/components/users.php" role="button" id="userslink">
              Users
            </a>
          </li>
            <?php } ?>

          <li class="nav-item dropdown">
            <?php
            if(isset($_SESSION['user_id']))
            {
              ?>
            <a href="/components/logout.php" class="btn btn-outline-warning mx-md-2" ><i class="fas fa-sign-out-alt"></i> Log Out</a>
            <?php
            }
            else
            {
            ?>
            <a href="/components/login.php" class="btn btn-outline-warning mx-md-2" ><i class="fas fa-sign-in-alt"></i> Log In</a>
            <?php } ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="background-tint"></div>
</body>

</html>