<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Homework</title>
    <link rel="stylesheet" href="./login.css">
    <link rel="stylesheet" href="navbar.css">
    <script>
    function loginUser(){
        var passwd_reg=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/
        var username=document.getElementById('username').value;
        var password=document.getElementById('password').value;
        var isError=0;

        if (username=="" || username.length<3 || username.length>20) {
        document.getElementById("username-error").style.display="inline-block"
        document.getElementById('username').borderColor="#B0706D"
        isError=1;
        }
        else{
        document.getElementById('username-error').style.display="none"
        document.getElementById('username').borderColor="#C3CDC0"
        }

        if(passwd_reg.test(password)==false){
        document.getElementById("password-error").style.display="inline-block"
        document.getElementById('password-error').innerHTML="Password must contain at least one small letter, large letter, digit and be 8-20 character long"
        document.getElementById('password').borderColor="#B0706D"
        isError=1;
       }
        else{
        document.getElementById("password-error").style.display="none"
        document.getElementById('password').borderColor="#C3CDC0"
      }

        if(isError==0){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
        if(this.responseText=="User doesn't exist"){
            document.getElementById("username-error").style.display="inline-block"
            document.getElementById("password-error").style.display="none"
            document.getElementById("username-error").innerHTML = this.responseText;
        }
        else if(this.responseText=="Wrong Password"){
            document.getElementById("username-error").style.display="none"
            document.getElementById("password-error").style.display="inline-block"
            document.getElementById("password-error").innerHTML = this.responseText;
        }
        else{
            var user={}
            if(this.responseText=="Login successful. Welcome, photographer."){
                user['type']="photographer";
            }
            else{
                user['type']="user";
            }
            user['username']=username;
            localStorage.setItem('user',JSON.stringify(user));
            window.location.href = 'index.php';
            document.getElementById("username-error").style.display="none";
            document.getElementById("password-error").style.display="none";
        }

        console.log(this.responseText);
        }
    };
    xmlhttp.open("GET","loginUser.php?username="+username+"&password="+password,true);
    xmlhttp.send();
    }
 }
        
    </script>
</head>
<body>
<div class="navbar">
        <a href="index.php">Home</a>
</div>
<div class="LoginForm" >

        <h1 class="headers">Login</h1>
        <span class="field-name">User Name</span>
        <input class="field-input" id="username" name="username" type="text"></input>
        <span id="username-error" class="error">Username must contain 3-20 characters</span>
        <span class="field-name">Password</span>
        <input id="password" class="field-input" name="password" type="password"></input>
        <span id="password-error" class="error">Password must contain at least one small letter, large letter, digit and be 8-20 character long</span>
        <button onclick="loginUser()" class="submit-btn" name="submit" value="Submit">Submit</button>
</div>
</body>

</html>