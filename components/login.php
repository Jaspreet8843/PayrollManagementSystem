<title>Login</title>
<?php
require('header.php');
if(isset($_SESSION['user_id'])){
    echo '<script type="text/javascript"> window.location="../index.php";</script>';
}

if(isset($_POST['submit']))
{
    $userid = mysqli_escape_string($db,$_POST['user_id']);
    $password = mysqli_escape_string($db,$_POST['password']);
    $query = "SELECT * FROM myusers WHERE user_id = '$userid' AND password= '$password'";
    $result = mysqli_query($db,$query);
    
    if(mysqli_num_rows($result)==1){
        while($row = $result->fetch_assoc()) {
            if($row['status']==='inactive')
            {
                echo "<script type='text/javascript'>alert('Your account is not active! Contact site admin.')</script>";
            }
            else
            {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['type'] = $row['type'];
                $_SESSION['name'] = $row['name'];
            }
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('Failed to Login! Incorrect Email or Password')</script>";
    }

    echo '<script type="text/javascript"> window.location="../index.php";</script>';
}
?>

<div class="pb-5">
    <div class="bg-white shadow rounded col-md-4 col-10 mx-auto mt-5 p-4">
    <h4><i class="fas fa-sign-in-alt"></i> Log In</h4>
    <hr>
    <form class="p-3 pt-2" method="POST" action="login.php">
        <div>
            <label for="user_id" class="form-label">User ID</label>
            <input type="text" name="user_id" id="user_id" class="form-control"/>
        </div>
        <div class="mt-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control"/>
        </div>
        <div class="mt-4 text-muted text-center">
            <h6>Not registered? Sign Up <a href = "register.php">here</a></h6>
        </div>

        <hr>
        <button type="submit" name="submit" class="btn btn-dark btn-lg w-100">LOG IN</button>

    </form>
    </div>
</div>

