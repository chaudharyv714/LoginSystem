<?php
session_start();
$status="";
include "../shared/connection.php";
$var=$_SESSION['username'];
$query="select * from submission where name='$var';";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_row($result);
if(mysqli_error($con)){
    $status=mysqli_error($con);
}
else{
        if(isset($row[2])&&$row[2]){
                $path="../files/$var/$row[2]";
                if(unlink($path)){
                    if(!rmdir("../files/".$var)){
                        $status="Could not remove submission";
                    }
                    else{
                    $status="Your submission has been removed";
                    $query_="update submission set file='' where name='$var';";
                    $result_=mysqli_query($con,$query_);
                    }
                }
                else{
                    $status="Couldn't remove file";
                }    
        }       
        else{
        $status="No Submission found for user: $var";
        }
}
echo $status;
?>