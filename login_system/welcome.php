<?php
include "shared/logincheck.php";
$_SESSION['enterpoint']="W";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>
<style>
form{
    display:flex;
    flex-direction:column;
    width:50%;
    margin:auto;
    padding:20px;
    border:1px solid black;
    border-radius:5px;
    background:#c0c0c0;
    border-radius:10px;
    }
form input,#box{
    width:50%;
    margin:auto;
    margin-bottom:10px;
    padding-left:10px;
    border:0;
    border-radius:5px;
   
}  
#box{
    padding:0;
}

#box select{
    width:100%;
    margin:auto;
    border:0;
    border-radius:5px;
   
} 
.form h2,h4{
    display:block;
    text-align:center;
    margin-bottom:10px;
}
form input:last-child{
    display:inline;
}
.form span{
    margin-top:10px;
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
<?php
if(!isset($_SESSION['login'])){
    echo $status;
}
else{
    echo "Hi ".$_SESSION['username']; 
}
?>
</div>

</body>
</html>


