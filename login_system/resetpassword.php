<?php
session_start();

$status="Enter OTP to continue";
if($_SERVER["REQUEST_METHOD"]=="POST")
{   if(isset($_SESSION['login'])){
        $mail=$_SESSION['mail'];
        $code=$_SESSION['otp'];
    
        $otp=$_POST['otp'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        if($code!=$otp){
            $status="OTP not matching!";
        }
        else{
            if($password!=$cpassword){
                $status="Mismatching Password";
            }
            else{
                include "shared/connection.php";
                $passwordhash= password_hash($password, PASSWORD_DEFAULT);
                $update="UPDATE user SET password = '$passwordhash' WHERE email = '$mail';";
                $query=mysqli_query($con,$update);
                if(mysqli_error($con)){
                    $status=mysqli_error($con);
                }
                else{
                    $status="Password changed Succesfully.";
                    session_unset();
                    session_destroy();
                }
            }
        }
    }
    else{
        $status="Invalid Attempt";
    }



}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<style>
body{
    margin:0 15px 0 15px 0;
}
form{
    display:flex;
    flex-direction:column;
    width:50%;
    margin:auto;
    padding:20px;
    border:1px solid black;
    border-radius:5px;
    background:#c0c0c0;
    }
form input{
    width:50%;
    text-align:center;
    margin:auto;
    margin-bottom:5px;
   
}  
.form h2{
    display:block;
    text-align:center;
    margin-bottom:10px;
}
form input:last-child{
    display:inline;
}
#errorbox{
    display:block;
    width:100%;
    background: rgba(0,128,0,0.8);
    padding:10px;
    margin-bottom:20px;
}
</style>
<body>
<?php
include 'shared/bootstrap.php';
include 'shared/nav.php';
?>
<div id="errorbox">
<?php echo $status;?>
</div>

<div class="form">
    <form action="resetpassword.php" method="post">
        <input type="number" name="otp" id="otp" placeholder="Enter OTP">
        <input type="password" name="password" id="password" placeholder="Enter New Password">
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
        <input type="submit" value="Submit">
    </form> 
</div>   
</body>
</html>

