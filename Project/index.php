<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Project </title>
    <link rel="stylesheet" href="./index.css">
</head>
<body>
<div id="home-menu" class="home_container">
<script>
            function logOut(){
                localStorage.removeItem('user');
                location.reload();
            }
            var user=JSON.parse(localStorage.getItem('user'));
            if(user==null){
                document.getElementById("home-menu").innerHTML=`<div class="home-item">
                <div class="item-description">
                <a class="title" href="login.php">Login</a>
            </div>
            </div>
            <div class="home-item">
                <div class="item-description">
                <a class="title" href="registration.php">Register</a>
            </div>
            </div>`
         }
            else if(user.type=="photographer"){
                document.getElementById("home-menu").innerHTML=`<div class="home-item">
                <div class="item-description">
                <button class="title" onclick='logOut()'>Logout</button>
            </div>
            </div>
            <div class="home-item">
                <div class="item-description">
                <a class="title" href="photoInbox.php">Inbox</a>
            </div>
            </div>
            <div class="home-item">
                <div class="item-description">
                <a class="title" href="photoSessions.php">Photo Sessions</a>
            </div>
            </div>`

            }
            else{
                document.getElementById("home-menu").innerHTML=`<div class="home-item">
                <div class="item-description">
                <button class="title" onclick='logOut()'>Logout</button>
            </div>
            </div>
            <div class="home-item">
                <div class="item-description">
                <a class="title" href="cart.php">Cart</a>
            </div>
            </div>
            <div class="home-item">
                <div class="item-description">
                <a class="title" href="inbox.php">Inbox</a>
            </div>
            </div>
            <div class="home-item">
                <div class="item-description">
                <a class="title" href="photoSessionForm.php">Request Photo Session</a>
            </div>
            </div>
            `
            }
            </script>
            <div class="home-item">
                <div class="item-description">
            
                <a class="title" href="photos.php">Albums</a>
            </div>
        </div>
</body>

</html>