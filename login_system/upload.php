
<?php
include "shared/logincheck.php";
$_SESSION['enterpoint']="U";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
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

</div>
<div class="form">
    <form action="" method="post" enctype="multipart/form-data" id="upbox">
    <h2><u>upload</u></h2>
        <input type="file" name="item" id="item" placeholder="Upload your file" required>
        <input type="submit" id="submit" value="Submit">
    </form>
</div>
<div class="container">
    <button class="btn btn-secondary" id ="remsub">Remove Submission</button>
</div>
</body>
</html>

<script>
document.getElementById("remsub").addEventListener("click",requestfileremoval);
function requestfileremoval(){
    console.log("Removal Started");
    var xhr= new XMLHttpRequest();
    xhr.open("GET","script/remsub.php",true);
    xhr.onload= function fetch_result(){
        document.getElementById("errorbox").innerText=this.responseText;
        console.log("Removal finished");
    }
    xhr.send();
}

document.getElementById("upbox").addEventListener("submit",sendfile);
function sendfile(e){
    e.preventDefault();
    var sel=document.getElementById('item').files[0];
    console.log("Upload started");
    var xhr_=new XMLHttpRequest();
    var data=new FormData();
    data.append("item",sel);
    xhr_.open('POST', 'script/upload.php', true);
    xhr_.onload= function uploaded(){
        document.getElementById("errorbox").innerHTML=this.responseText;
        console.log("Upload done");
    }
    xhr_.send(data);
}
</script>
