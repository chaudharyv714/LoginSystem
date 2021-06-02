<?php
include "../shared/connection.php";
$status="Please SignUP to continue";
if($_SERVER["REQUEST_METHOD"]=="POST")
        {
        $name=$_POST['name'];
        $mail=$_POST['email'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        if($password!=$cpassword){
            $status="Passwords are not Matching.";
        }
        else{
            $check_user=mysqli_query($con,"SELECT * FROM `user` WHERE `email`='$mail';");
            if(mysqli_num_rows($check_user)!=0){
                $status="Username already exists! Choose a different Email account.";
            }
            else
            {   $passwordhash= password_hash($password, PASSWORD_DEFAULT);
                $insert="INSERT INTO `user` (`name`, `email`, `password`) VALUES ('$name', '$mail', '$passwordhash');";
                $query=mysqli_query($con,$insert);

                if(mysqli_error($con))
                    {$status= mysqli_error($con);
                    }
                else
                {   $insert_="INSERT INTO `submission` (`name`) VALUES ('$name');";
                    $query_=mysqli_query($con,$insert_);
                    $status="You Signed up Succesfully. Please Login to Continue.";
                }
            }    
        }    
    }
echo $status;       
?>