<title>Generate Salary</title>

<?php
require('header.php');

$eName = "";
$noOfLeaves = 0;
$deductions = 0;
$HRA = 0;
$DA = 0;
$EPF = 0;
$basicSalary = 0;
$netSalary = 0;
$today = date("Y-m-d", strtotime("now"));


$query = "SELECT eId, eName from employee";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) == 0) {
    print($query);
    print("FAILED TO RETRIEVE EMPLOYEE DETAILS!");
    print(mysqli_error($db));
} else {
    $idArray = array();
    $nameArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $idArray[] = $row['eId'];
        $nameArray[] = $row['eName'];
    }
}

if(isset($_POST['generate']))
{
    $eId = $_POST['eId'];
    $sDate = $_POST['startDate'];
    $eDate = $_POST['endDate'];
    $query = "SELECT * FROM leaves WHERE eId=$eId AND permission='Denied' AND (startDate>='$sDate' OR endDate<='$eDate')";
    $result = mysqli_query($db, $query);
    print(mysqli_error($db));
    while ($row = mysqli_fetch_assoc($result)) {
        $from = strtotime($row['startDate']);
        $to = strtotime($row['endDate']);
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("m",$from), date("Y",$from));
        $format = "%d-%d-%d";

        $st=sprintf($format,1,date('m',$from),date('Y',$from));
        $firstDateOfMonth = strtotime($st);
        $st=sprintf($format,$daysInMonth,date('m',$from),date('Y',$from));
        $lastDateOfMonth = strtotime($st);

        if((date('m',strtotime($sDate)) === date('m',$from)) && (date('m',$from) !== date('m',$to)))
        {
            //leave starts in current month but ends in next month
            $noOfLeaves += (round(abs($lastDateOfMonth-$from))/86400)+1;
        }
        else if((date('m',$from) !== date('m',$to)))
        {
            //leave started in previous month but ends in current month
            $st=sprintf($format,1,date('m',$to),date('Y',$to));
            $firstDateOfMonth = strtotime($st);
            $noOfLeaves += (round(abs($to-$firstDateOfMonth))/86400)+1;
        }
        else if((date('m',$from) === date('m',$to)) && (date('m',$to) === date('m',strtotime($sDate))))
        {
            //leave starts and ends in current month
            $noOfLeaves += (round(abs($to-$from))/86400)+1;

        }
       
    }

    $query = "SELECT * FROM employee WHERE eId=$eId";
    $result = mysqli_query($db, $query);
    print(mysqli_error($db));
    while ($row = mysqli_fetch_assoc($result)) {
        $eName = $row['eName'];
        $basicSalary = $row['currentBasic'];
        $deductions = ($basicSalary/30) * $noOfLeaves;
        $DA = $basicSalary * 0.31;
        $HRA = $basicSalary * 0.27;
        $EPF = $basicSalary * 0.12;

        $netSalary = $basicSalary+$DA+$HRA-$deductions-$EPF;

    }
}

if(isset($_POST['submit'])){
    $eId = $_POST['eId'];
    $dfrom = $_POST['dfrom'];
    $dtill = $_POST['dtill'];
    $basic = $_POST['basic'];
    $DA = $_POST['DA'];
    $HRA = $_POST['HRA'];
    $PF = $_POST['EPF'];
    $deductions = $_POST['deductions'];
    $remarks = $_POST['remarks'];   
    $sDate = date("Y-m-d");
    $user_id = $_SESSION['user_id'];
    $row_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT `AUTO_INCREMENT`
                                            FROM  INFORMATION_SCHEMA.TABLES
                                            WHERE TABLE_SCHEMA = 'payrollmanagement'
                                            AND   TABLE_NAME   = 'salary'"))['AUTO_INCREMENT'];
    $query = "SELECT dateFrom,dateTill from salary WHERE ((dateFrom BETWEEN '$dfrom' AND '$dtill') OR (dateTill BETWEEN '$dfrom' AND '$dtill')) AND eId=$eId";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result)==0)
    {
        $query = "INSERT INTO salary(eId,dateFrom,dateTill,basic,DA,HRA,PF,deductions,remarks,sDate,insertedBy) VALUES($eId,'$dfrom','$dtill',$basic,$DA,$HRA,$PF,$deductions,'$remarks','$sDate','$user_id')";
        if (!$db->query($query)) {
            mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Salary',$row_id,'Insertion Error','$user_id')");
            print("ERROR WHILE PAYING SALARY!");
            print(mysqli_error($db));
        }
        else
        {
            mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Salary',$row_id,'Insert','$user_id')");
            echo '<script>alert("Success!")</script>';
        }
    }
    else
    {
        mysqli_query($db,"INSERT INTO logs(table_name,row_id,action,user_id) VALUES('Salary',$row_id,'Error! Already Paid','$user_id')");
        echo '<script>alert("Salary already paid!")</script>';
    }
}

?>

<div class="p-sm-5 bg-gradient">

    <div class = "container shadow rounded p-5 bg-white col-lg-7 mx-auto">
        <form action="paySalary.php" method="post">
            
            <h2 class="mb-4">Generate Salary</h2>
            <hr>

            <div class="row">
                <div class="mb-3 col-sm">
                    <label for="eId" class="form-label">Employee ID</label>
                    <input type="text" class="form-control" list="employees" id="eId" name="eId" autocomplete="off" required>
                    <datalist id="employees">
                    </datalist>
                </div>

                <div class="mb-3 col-sm">
                    <label class="form-check-label" for="month">Month</label>
                    <select id="month" name="month" class="form-select mt-2" onchange="setDates()" required>
                    <option disabled selected>- select -</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-sm">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" onchange="validate()" class="form-control" id="startDate" name="startDate" required>
                </div>

                <div class="mb-3 col-sm">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" onchange="validate()" class="form-control" id="endDate" name="endDate" required>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" name="generate" class="btn btn-dark bg-gradient rounded">Generate</button>
            </div>

            <hr>
        </form>

        <?php if(isset($_POST['generate'])){?>
        <form action="paySalary.php" method="post">
            <div class="row mt-4">
                <div class="col">
                    <h6><label> Employee Name:</label></h6>
                </div>
                <div class="col">
                    <h6><b><?php print( $eName); ?></b></h6>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6><label> Leaves taken:</label></h6>
                </div>
                <div class="col">
                    <h6><?php print( $noOfLeaves); ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6><label> Basic Salary:</label></h6>
                </div>
                <div class="col">
                    <h6><?php print( $basicSalary); ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6><label> DA @31%:</label></h6>
                </div>
                <div class="col">
                    <h6><?php print(round($DA)); ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6><label> HRA @27%:</label></h6>
                </div>
                <div class="col">
                    <h6><?php print(round($HRA)); ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6><label> EPF contribution:</label></h6>
                </div>
                <div class="col">
                    <h6><?php print(round($EPF)); ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6><label> Deductions:</label></h6>
                </div>
                <div class="col">
                    <h6><?php print(round($deductions)); ?></h6>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    NET SALARY:
                </div>
                <div class="col">
                    <?php print(round($netSalary));?>
                </div>
            </div>
            <div class="row">
            <div class="col">
                <label for="remarks">Remarks:</label>
            </div>
            <div class="col">
                <textarea class="form-control mt-3 mb-3" placeholder="(optional)" id="remarks" name="remarks"></textarea>
            </div>
            <div hidden>
                <input type="text" value="<?php print(round($basicSalary));?>" name="basic" hidden/>
                <input type="text" value="<?php print(round($DA));?>" name="DA" hidden/>
                <input type="text" value="<?php print(round($HRA));?>" name="HRA" hidden/>
                <input type="text" value="<?php print(round($deductions));?>" name="deductions" hidden/>
                <input type="text" value="<?php print(round($EPF));?>" name="EPF" hidden/>
                <input type="date" value="<?php print($sDate);?>" name="dfrom" hidden/>
                <input type="date" value="<?php print($eDate);?>" name="dtill" hidden/>
                <input type="text" value="<?php print($eId);?>" name="eId" hidden/>
            </div>
            </div>
            <div class="mt-2 d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-dark btn-lg bg-gradient rounded">Pay</button>
            </div>
        </form>
        <?php } ?>
    </div>

</div>


<script type="text/javascript">
    var idArray = <?php echo json_encode($idArray); ?>;
    var nameArray = <?php echo json_encode($nameArray); ?>;
</script>

<script src="scripts/salary.js" type="text/javascript"></script>

<?php require('footer.php');?>