<title>Departments</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
  referrerpolicy="no-referrer" />
<?php
require('header.php');

$query = "SELECT * FROM employee,designation,department WHERE employee.eDesig = designation.desigNo AND designation.deptNo = department.dNo GROUP BY desigName";
$leaves = mysqli_query($db, $query);
?>