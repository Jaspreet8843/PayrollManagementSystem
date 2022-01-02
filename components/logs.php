<title>Logs</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
require('header.php');

$query = "SELECT * FROM logs ORDER BY id DESC";
$logs = mysqli_query($db, $query);
?>

<div class="p-sm-5">
    <div class="m-md-3 mt-5 p-5 bg-white shadow rounded">
        <div class="row">
            <div class="col-md-4">
                <h2>Activity Logs</h2>
            </div>
            
            <div class="col-md-2 p-2 p-md-1">
                <select class="selectpicker w-100" id="filter" onchange="hideCols()" multiple placeholder="Nothing hidden">
                    <option value=0>ID</option>
                    <option value=1>Table</option>
                    <option value=2>Row ID</option>
                    <option value=3>Action</option>
                    <option value=4>Timestamp</option>
                    <option value=5>User ID</option>
                </select>
            </div>
            <div class="col-md-2 p-2 p-md-1">
                <select class="form-select" id="category" onchange="search()">
                    <option value=-1 selected>Search All</option>
                    <option value=0>ID</option>
                    <option value=1>Table</option>
                    <option value=2>Row ID</option>
                    <option value=3>Action</option>
                    <option value=4>Timestamp</option>
                    <option value=5>User ID</option>
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
            <table class="mt-2 table table-bordered table-hover" id="logstable">

                <thead class="thead-dark align-middle">
                    <tr>
                        <th>ID</th>
                        <th>Table</th>
                        <th>Row ID</th>
                        <th>Action</th>
                        <th>Timestamp</th>
                        <th>User ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($logs)) {
                    ?>
                        <tr class="align-middle">
                            <td>
                                <?php echo $row['id'] ?>
                            </td>
                            <td>
                                <?php echo $row['table_name'] ?>
                            </td>
                            <td>
                                <?php echo $row['row_id'] ?>
                            </td>
                            <td>
                                <?php echo $row['action'] ?>
                            </td>
                            <td>
                                <?php echo $row['timestamp'] ?>
                            </td>
                            <td>
                                <?php echo $row['user_id'] ?>
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

<script src="scripts/logs.js" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php require('footer.php');?>