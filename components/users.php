<title>Employees</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
require('header.php');

if(isset($_POST['del']))
{
    $id = $_POST['del'];
    $query = "DELETE FROM myusers WHERE id = '$id'";
    mysqli_query($db, $query);
}
if(isset($_POST['act']))
{
    $id = $_POST['act'];
    $query = "UPDATE myusers SET status='active', type='employee' WHERE id = '$id'";
    mysqli_query($db, $query);
}

if(isset($_POST['deact']))
{
    $id = $_POST['deact'];
    $query = "UPDATE myusers SET status='inactive' WHERE id = '$id'";
    mysqli_query($db, $query);
}

$query = "SELECT * FROM myusers WHERE type <> 'admin'";
$employees = mysqli_query($db, $query);
?>

<div class="p-sm-5">
    <div class="m-md-3 mt-md-1 p-5 bg-white shadow rounded">
        <div class="row">
            <div class="col-md-2">
                <h2>Users</h2>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="form-select" id="catByTime" onchange="filterRows()">
                    <option value=-1 selected>All</option>
                    <option value=0>New</option>
                </select>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="selectpicker w-100" id="filter" onchange="filterCols()" multiple placeholder="Nothing Hidden">
                    <option value=1>ID</option>
                    <option value=2>Name</option>
                    <option value=3>User ID</option>>
                    <option value=4>Phone</option>
                    <option value=5>Password</option>
                    <option value=6>Timestamp</option>
                    <option value=7>Status</option>
                    <option value=8>Type</option>
                </select>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="form-select" id="category" onchange="search()">
                    <option value=-1 selected>Search All</option>
                    <option value=1>ID</option>
                    <option value=2>Name</option>
                    <option value=3>User ID</option>
                    <option value=4>Phone</option>
                    <option value=5>Password</option>
                    <option value=6>Timestamp</option>
                    <option value=7>Status</option>
                    <option value=8>Type</option>
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
            <table class="mt-2 table table-bordered table-hover" id="usersTable">

                <thead class="thead-dark align-middle">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>User ID</th>
                        <th>Phone</th>
                        <th>Password</th>
                        <th>Timestamp</th>
                        <th>Status</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($employees)) {
                    ?>
                        <tr class="align-middle">
                            <form method="POST">    
                                <td class="text-center">
                                    <?php if($row['status']=='active'){ ?>
                                        <button name="deact" value="<?php echo $row['id'] ?>" class="btn btn-outline-warning w-100">deactivate</button> 
                                        <?php } else{ ?>
                                            <button name="act" value="<?php echo $row['id'] ?>" class="btn btn-outline-success w-100">activate</button> 
                                            <?php } ?>
                                            <br>
                                            <button name="del" value="<?php echo $row['id'] ?>"  class="btn btn-outline-danger w-100 mt-1" onclick="return confirm('Are you sure?');">delete</button> 
                                        </td>
                            </form>
                            <td>
                                <?php echo $row['id'] ?>
                            </td>
                            <td>
                                <?php echo $row['name'] ?>
                            </td>
                            <td>
                                <?php echo $row['user_id'] ?>
                            </td>
                            <td>
                                <?php echo $row['phone'] ?>
                            </td>
                            <td>
                                <?php echo $row['password'] ?>
                            </td>
                            <td>
                                <?php echo $row['timestamp'] ?>
                            </td>
                            <td>
                                <?php echo $row['status'] ?>
                            </td>
                            <td>
                                <?php echo $row['type'] ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
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

<script src="scripts/users.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    noOfRows();
</script>
<?php require('footer.php'); ?>