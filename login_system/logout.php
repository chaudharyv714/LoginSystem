
<?php
$status="";
session_start();
if(!isset($_SESSION['login'])){
    $status="You aren't logged in. Please LogIN to continue.";
}
else{
    session_unset();
    session_destroy();
    $status="You have been logged out succesfully!";
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
   
</body>
</html>


   