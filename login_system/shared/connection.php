<?php
$con=mysqli_connect("localhost","root","","database");
if(mysqli_connect_errno()){
    echo "Some unexpected error has occurred.<br>";
    echo "Error Details: ".mysqli_error();
}
?>