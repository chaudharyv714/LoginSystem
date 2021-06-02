<?php 
session_start();
include "../shared/connection.php";
$status="";
    if($_SERVER["REQUEST_METHOD"]=="POST")
            {
            $name=$_FILES["item"]["name"];
            $type=$_FILES["item"]["type"];
            $temp=$_FILES["item"]["tmp_name"];
            $size=$_FILES["item"]["size"];
            $error=$_FILES["item"]["error"];
            $target_dir = "../files/".$_SESSION['username']."/";
            $target_file = $target_dir . basename($_FILES["item"]["name"]);
            $uploadOk = 1;
            if($error==0) {
                if($type=="application/pdf"||$type=="image/jpeg"){
                    if($size){
                        if(!is_dir($target_dir)){
                                mkdir($target_dir);
                                if (file_exists($target_file)) {
                                    $status= "Sorry, file already exists.";
                                    $uploadOk = 0;
                                }
                                else{
                                    // Check if $uploadOk is set to 0 by an error
                                        if ($uploadOk == 0) {
                                            $status= "Sorry, your file was not uploaded.";
                                        // if everything is ok, try to upload file
                                        } else {
                                            if (move_uploaded_file($_FILES["item"]["tmp_name"], $target_file)) {
                                                    include "../shared/connection.php";
                                                    $var=$_SESSION['username'];
                                                    $var_=basename($_FILES["item"]["name"]);
                                                    $insert="UPDATE `submission` SET `file`='$var_' WHERE `name`='$var';";
                                                    $query=mysqli_query($con,$insert);
                                                    $status="The file ". htmlspecialchars( basename( $_FILES["item"]["name"])). " has been uploaded.<br>";
                                            } else {
                                                   $status="Sorry, there was an error uploading your file.";
                                            }
                                        }
                                }
                        }else{
                            $status= "Multiple submissions not allowed";
                        }            
                    }
                    else{
                        $status="file too large";
                    }
                }
                else{
                    $status="Unsupported File Type";
                }                    
            }
            else{
                $ststus="Error In Uploading!";
            }
        }
echo $status;
?>