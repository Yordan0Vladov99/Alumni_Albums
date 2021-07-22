<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Homework</title>
    <link rel="stylesheet" href="./albumForm.css">
    <script>
    function sendAlbum(){
        var albumname=document.getElementById('albumname').value;
        var images = "<?php Print($_GET["str"]) ?>";
        var price=4*(images.split("|").length-1);

        var isError=0;

        if (albumname=="" || albumname.length<5 || albumname.length>45) {
        document.getElementById("albumname-error").style.display="inline-block"
        document.getElementById("albumname-error").innerHTML="Album name must contain 5-45 characters"
        document.getElementById('albumname').borderColor="#B0706D"
        isError=1;
        }
        else{
        document.getElementById('albumname-error').style.display="none"
        document.getElementById('albumname').borderColor="#C3CDC0"
        }

        if(isError==0){
        var user = JSON.parse(localStorage.getItem('user'));

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
        
        if(this.responseText=="Album is logged"){
            window.location.href = 'index.php';
            alert("Album sent to your cart")
        }else{
            document.getElementById("albumname-error").style.display="inline-block"
            document.getElementById("albumname-error").innerHTML="Error. Please Try Again."
        }
        console.log(this.responseText);
        }

        
        }
        xmlhttp.open("GET","logAlbum.php?name="+albumname+"&owner="+user.username+"&images="+images+"&price="+price,true);
        xmlhttp.send();
    };
    
    }
        
    </script>
</head>
<body>
<div class="LoginForm" >
        <h1 class="headers">Your Album</h1>
        <span class="field-name">Album Name</span>
        <input class="field-input" id="albumname" name="albumname" type="text"></input>
        <span id="albumname-error" class="error">Album name must contain 5-45 characters</span>
        <button onclick="sendAlbum()" class="submit-btn" name="submit" value="Submit">Submit</button>
        <span class="field-name">Pictures</span>
        <div id="photos" style>
        <script>
          window.onload = function getItems(){
                var items= "<?php Print($_GET["str"]) ?>"
                var item_arr=items.split("|");
                for (let i = 0; i < item_arr.length - 1; i++) {
                    var tag = document.createElement("div");
                    console.log(item_arr[i]);
                    tag.innerHTML = `<img src="images/${item_arr[i]}"></img></label>`;
                    document.getElementById('photos').appendChild(tag);
                }
          }
        </script>
        
        </div>
        
</div>
</body>

</html>