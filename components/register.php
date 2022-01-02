<title>Register</title>
<?php
require('header.php');
if(isset($_SESSION['user_id'])){
    echo '<script type="text/javascript"> window.location="../index.php";</script>';
}

if(isset($_POST['submit']))
{
    $userid = mysqli_escape_string($db,$_POST['user_id']);
    $name = mysqli_escape_string($db,$_POST['name']);
    $password = mysqli_escape_string($db,$_POST['password']);
    $phone = mysqli_escape_string($db,$_POST['phone']);
    $query = "SELECT * FROM myusers WHERE user_id = '$userid' ";
    $result = mysqli_query($db,$query);
    
    if(mysqli_num_rows($result)>0){
        echo "<script type='text/javascript'>alert('ERROR! User ID already exists!')</script>";
    }
    else
    {
        $query = "INSERT INTO myusers(user_id,name,phone,type,password,status) VALUES('$userid','$name','$phone','new','$password','inactive')";
        if (!$db->query($query))
        {
            echo "<script type='text/javascript'>alert('ERROR! Failed to Register.')</script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('Registration Successful! Contact site admin to activate your account.')</script>";
        }
    }

}
?>

<div class="pb-5">
    <div class="bg-white shadow rounded col-md-5 col-10 mx-auto mt-5 p-4">
    <h4><i class="fas fa-user-plus"></i> Register </h4>
    <hr>
    <form  class="p-3 pt-2" method="POST" action="register.php">
        <div>
            <label for="user_id" class="form-label">User ID</label>
            <input type="text" name="user_id" id="user_id" class="form-control" required/>
        </div>
        <div class="mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required/>
        </div>
        <div class="mt-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="phone" name="phone" id="phone" class="form-control" required/>
        </div>
        <div class="mt-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" onkeyup="validate()" class="form-control" autocomplete="new-password" required/>
        </div>
        <div class="mt-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" id="cpassword" class="form-control" onkeyup="validate()" required/>
        </div>
        <h6 class="my-3 text-danger" id="errormsg" style="display: none;">Passwords do not match!</h6>
        <div class="mt-4 text-muted text-center">
            <h6>Already registered? Log In <a href = "login.php">here</a></h6>
        </div>

        <hr>
        <button type="submit" name="submit" id="submit" class="btn btn-dark btn-lg w-100" disabled>REGISTER</button>

    </form>
    </div>
</div>

<script src="scripts/register.js" type="text/javascript"></script>