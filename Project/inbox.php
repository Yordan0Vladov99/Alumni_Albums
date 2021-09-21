<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Project </title>
    <link rel="stylesheet" type="text/css" href="navbar.css" />
    <link rel="stylesheet" href="./inbox.css"/>
</head>
<body>
<div class="navbar">
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="inbox.php">Inbox</a>
        <a href="photoSessionForm.php">Request Photo Session</a>
        <a href="photos.php">Albums</a>
    </div>
    
<div id="inbox" class="request-container">
        <div id="items" class="request-container">
        <h1 class="header">Item Requests</h1>
        
        </div>

        <div id="sessions" class="request-container">
        <h1 class="header">Session Requests</h1>
        
        </div>
        <script>
        window.addEventListener("load", myInit, true);
            function myInit(){
                getItemRequests();
                getSessionRequests();
            }
            
            
            
            function getItemRequests(){
                var user=JSON.parse(localStorage.getItem('user'));
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                var res = this.responseText.split(";");
                for(let i = 0; i < res.length-1; i++){
                    var tag=document.createElement("div");
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
            </div>
            `;
                    }
                    else{
                        tag.innerHTML=`      
            <div class="request">
                <div>
                    <div class="tags">
                        <span class="author">By: ${request.from};  Status:${request.status}</span>
                        <span class="author">On: ${request.publication_date}</span>

                    </div>
                    <div class="description">
                        <a href="album.php?id=${request.link}">${request.description}</p>
                    </div>  
                </div>
            </div>
            `; 
                    }
                    
                    document.getElementById('items').appendChild(tag);
                }
                }
            };
            xmlhttp.open("GET","getRequests.php?username="+user.username,true);
            xmlhttp.send();
            }


            function getSessionRequests(){
                var user=JSON.parse(localStorage.getItem('user'));
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
                    var tag=document.createElement("div");
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
            </div>
            `;
                    document.getElementById('sessions').appendChild(tag);
                }
            }
                }
            };
            xmlhttp.open("GET","getUserSessions.php?username="+user.username,true);
            xmlhttp.send();
            }

        </script>

        
        </div>
</body>

</html>
