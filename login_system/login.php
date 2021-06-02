
<?php
include "shared/connection.php";
$status="Please Login to continue";
if($_SERVER["REQUEST_METHOD"]=="POST")
        {
        $login=0;    
        $mail=$_POST['email'];
        $password=$_POST['password'];

        //$query="SELECT * FROM `user` WHERE `email`='$mail' AND  `password`='$password';";
        $query="SELECT * FROM `user` WHERE `email`='$mail';";
        $result=mysqli_query($con,$query);

        if($result){
            $num=mysqli_num_rows($result);
            $row=mysqli_fetch_row($result);
            if(password_verify($password, $row[3])){
                if($num==1){
                    $login=1;
                    if($login){
                        session_start();
                        $_SESSION['login']=1;
                        $_SESSION['username']=$row[1];
                        $_SESSION['email']=$row[2];
                        $status="Hello ".$_SESSION['username'];
                        switch($_SESSION['enterpoint']){
                            case "W":header("location:welcome.php");
                            break;
                            case "U":header("location:upload.php");
                            break;
                            default:
                            header("location:welcome.php");
                        }
                    }  
                }
            }
            else{
                $status="Invalid Credentials";
            }
        }
        else{
            $status="Invalid Password";
        }
    }
    else{
        $status= mysqli_error($con);
    }

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
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
    <form action="login.php" method="post">
        <h2><u>Login</u></h2>
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Submit">
        <h6><a href="forgetpassword.php">Forget Password</a>
    </form> 
    
</div>   
</body>
</html>


   