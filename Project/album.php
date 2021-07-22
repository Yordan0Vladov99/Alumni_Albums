<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Project</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" type="text/css" href="navbar.css" />
</head>
<body>
<div class="navbar">
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="inbox.php">Inbox</a>
        <a href="photoSessionForm.php">Request Photo Session</a>
        <a href="photos.php">Albums</a>
    </div>
<div id='album' >
        <script>
          window.onload = function getItems(){
                var id= "<?php Print($_GET["id"]) ?>"
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        console.log(this.responseText);
                        if (this.responseText == "User cart is empty") {

                            var tag = document.createElement("p");
                            tag.innerHTML = "User cart is empty."
                            document.getElementById('album').appendChild(tag);

                        } else {
                            var res = this.responseText.split(";");
                            for (let i = 0; i < res.length - 1; i++) {
                                var tag = document.createElement("div");
                                var item = JSON.parse(res[i]);
                                console.log(res[i]);
                                tag.innerHTML = `<h1>${item.name}</h1>`
                                document.getElementById('album').appendChild(tag);
                                var item_arr=item.pictures.split("|");
                                for (let j = 0; j < item_arr.length - 1; j++) {
                                 var pic = document.createElement("div");
                                 console.log(item_arr[j]);
                                 pic.innerHTML = `<img src="images/${item_arr[j]}" style="width:20%;"></img></label>`;
                                 document.getElementById('album').appendChild(pic);
                                }
                            }

                        }
                    }
                }
                xmlhttp.open("GET", "getAlbum.php?id=" + id, true);
                xmlhttp.send();
          }

        </script>
        
</div>
</body>

</html>