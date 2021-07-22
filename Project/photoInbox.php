<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Project </title>
    <link rel="stylesheet" href="./inbox.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="navbar">
        <a href="index.php">Home</a>
        <a href="photoInbox.php">Inbox</a>
        <a href="photoSessions.php">Photo Sessions</a>
        <a href="p_photos.php">Albums</a>
    </div>
<div id="inbox" class="request-container">


        <div id="items" class="request-container">
        <h1 class="header">Item Requests</h1>
        
        </div>

        <div id="sessions" class="request-container">
        <h1 class="header">Session Requests</h1>
        
        </div>
        <script>
            function acceptRequest(id){
                console.log(`${id} is accepted`);
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    location.reload();
            };
        }
            xmlhttp.open("GET","acceptRequest.php?id="+id,true);
            xmlhttp.send();
            }
            function denyRequest(id){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    location.reload();
            };
        }
            xmlhttp.open("GET","denyRequest.php?id="+id,true);
            xmlhttp.send();
            
        }


        function acceptSession(id){
                console.log(`${id} is accepted`);
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    location.reload();
            };
        }
            xmlhttp.open("GET","acceptSession.php?id="+id,true);
            xmlhttp.send();
            }
            function denySession(id){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    location.reload();
            };
        }
            xmlhttp.open("GET","denySession.php?id="+id,true);
            xmlhttp.send();
            
        }

            window.addEventListener("load", myInit, true);
            function myInit(){
                getItemRequests();
                getSessionRequests();
            }
            function getItemRequests(){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                if(this.responseText == "No requests available"){
                    var tag=document.createElement("p");
                    tag.innerHTML = "There are currently no requests available."
                    document.getElementById('items').appendChild(tag);
                }
                else{
                var res = this.responseText.split(";");

                for(let i = 0; i < res.length-1; i++){
                    var tag=document.createElement("p");
                    var request = JSON.parse(res[i]);
                    console.log(res[i]);
                    if(request.link==0){
                        tag.innerHTML=`      
            <div class="request">
                <div>
                    <div class="tags">
                        <span class="author">By: ${request.from};  Status:${request.status}</span>
                        <span class="author">On: ${request.publication_date}</span>

                    </div>
                    <div class="description">
                        <p>${request.description}</p>
                    </div>
                </div>
                <img src= ./images/${request.image} >
                <button onclick='acceptRequest(${request.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;height:30px;"><i class="fa fa-check"></i></button>
                <button onclick='denyRequest(${request.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;height:30px;"><i class="fa fa-times"></i></button>
            </div>
            `;

                    }
                    else{
                        tag.innerHTML=`      
            <div class="request">
                <div>
                    <div class="tags">
                        <span class="author">By: ${request.from};  Status:${request.status}</span>
                        <span class="author">On: ${request.publication_date}</span>                    </div>
                    <div class="description">
                        <a href="album.php?id=${request.link}">${request.description}</a>
                    </div>  

                <button onclick='acceptRequest(${request.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;height:30px;"><i class="fa fa-check"></i></button>
                <button onclick='denyRequest(${request.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;height:30px;"><i class="fa fa-times"></i></button>
                </div>
                
            </div>
            `
                        
                    }
                    
                    document.getElementById('items').appendChild(tag);
                }
            }
                }
            };
            xmlhttp.open("GET","getPhotoRequests.php",true);
            xmlhttp.send();
            }
            function getSessionRequests(){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                if(this.responseText == "No requests available"){
                    var tag=document.createElement("p");
                    tag.innerHTML = "There are currently no requests available."
                    document.getElementById('sessions').appendChild(tag);
                }
                else{
                var res = this.responseText.split(";");

                for(let i = 0; i < res.length-1; i++){
                    var tag=document.createElement("p");
                    var request = JSON.parse(res[i]);
                    console.log(res[i]);
                    tag.innerHTML=`      
                    <div class="request">
                <div>
                    <div class="tags">
                        <span class="author">From: ${request.requester}</span>
                    </div>
                    <div>
                        <span class="author">Date: ${request.date} at ${request.time}</span>
                    </div>
                    <div>
                        <span class="author">People: ${request.people}</span>
                    </div>
                    <div class="description">
                        <p>${request.description}</p>
                    </div>
                </div>
                <button onclick='acceptSession(${request.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;"><i class="fa fa-check"></i></button>
                <button onclick='denySession(${request.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;"><i class="fa fa-times"></i></button>
            </div>
            `;
                    document.getElementById('sessions').appendChild(tag);
                }
            }
                }
            };
            xmlhttp.open("GET","getSessionRequests.php",true);
            xmlhttp.send();
            }
        </script>

        
        </div>
</body>

</html>