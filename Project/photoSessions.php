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
        <script>
            window.onload=function getRequests(){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                var res = this.responseText.split(";");
                for(let i = 0; i < res.length-1; i++){
                    var tag=document.createElement("p");
                    var request = JSON.parse(res[i]);
                    console.log(res[i]);
                    tag.innerHTML=`      
            <div class="session-request">
                <div>
                    <div class="tags">
                        <span class="author">From: ${request.requester}</span>
                    </div>
                    <div>
                        <span class="author">Date: ${request.date}</span>
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
                    document.getElementById('inbox').appendChild(tag);
                }
                }
            };
            xmlhttp.open("GET","getPhotoSessions.php",true);
            xmlhttp.send();
            }
        </script>

        
        </div>
</body>

</html>