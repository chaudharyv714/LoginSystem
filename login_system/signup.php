
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
    <form action="" method="post" id="userform">
    <h2><u>SignUp</u></h2>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="text" name="name" id="name" placeholder="Your Name" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" required>
        <input type="submit" value="Submit" id="submituserdetails">
    </form>  
    <div>
        <p id="error"></p>
    </div>  
</div>
</body>

<script>
document.getElementById("userform").addEventListener('submit',submitdetails);
function submitdetails(e){
    e.preventDefault();
    var data=new FormData();
    data.append("email",document.getElementById("email").value);
    data.append("name",document.getElementById("name").value);
    data.append("password",document.getElementById("password").value);
    data.append("cpassword",document.getElementById("cpassword").value);
    var xhr=new XMLHttpRequest()
    xhr.open("POST","script/signup.php",true);
    xhr.onload=function (){
        document.getElementById('errorbox').innerHTML=this.responseText;
    }
    xhr.send(data);

}
</script> 
</html>


