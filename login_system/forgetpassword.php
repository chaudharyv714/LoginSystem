<?php
$status="Enter Email to continue";
$code;
if($_SERVER["REQUEST_METHOD"]=="POST")
{   include "shared/connection.php";
    $mail=$_POST['email'];
    $query="SELECT * FROM `user` WHERE `email`='$mail';";
        $result=mysqli_query($con,$query);

        if($result){
            $num=mysqli_num_rows($result);
            $row=mysqli_fetch_row($result);
            if($num){
                $code=rand(1000,9999);
                session_start();
                $_SESSION['login']=0;
                $_SESSION['otp']=$code;
                $_SESSION['mail']=$mail;
                

                $subject = "Reset Password";
                $body = "Hi $row[1]\nThis is the OTP to reset your password \n".$code."\nRegards\nTeam";
                $headers = "From: Team";

                if (mail($mail, $subject, $body, $headers)) {
                    $status="OTP successfully sent to $mail...";
                    header('location:resetpassword.php');
                } else {
                    
                    $status="OTP sending failed...";
                }
            }
            else{
                $status="This account doesn't exist";
            }
        }
        else{
            $status= mysqli_error($con);
        }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
    <form action="forgetpassword.php" method="post">
        <input type="email" name="email" placeholder="Email">
        <input type="submit" value="Submit">
    </form> 
</div>   
</body>
</html>

