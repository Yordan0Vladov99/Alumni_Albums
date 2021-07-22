<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="cart.css" />
    <link rel="stylesheet" type="text/css" href="photos.css" />
</head>

<body>
<div id="nav" class="navbar">
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="inbox.php">Inbox</a>
        <a href="photoSessionForm.php">Request Photo Session</a>
        <a href="photos.php">Albums</a>
    </div>
    
    <div class="top-container">
        <span class="extra-large">Photos</span>
        <button class="order-sender" onclick="downloadImages()">Download Images</button>
        <button class="order-sender" onclick='sendToCart()'>Send to Cart</button>

        <select name="types" id="types">
            <option value="cup">Cup</option>
            <option value="t-shirt">T-Shirt</option>
            <option value="deck">Deck</option>
            <option value="small picture">Picture(small)</option>
            <option value="medium picture">Picture(medium)</option>
            <option value="large picture">Picture(large)</option>
            <option value="framed small picture">Framed Picture(small)</option>
            <option value="framed medium picture">Framed Picture(medium)</option>
            <option value="framed large picture">Framed Picture(large)</option>
            <option value="album">Album</option>
            <option value="poster">Poster</option>
        </select>
        <input class="orders" type="file" name="file" id="file">
        <input class="orders" type="button" id="btn_uploadfile" value="Upload" onclick="uploadFile();">
    </div>
    <div id="photos" class="photos">
        <script>
            var indexes = [],
                cnt = 0;
            window.onload = function init(){
                getNavbar();
                getItems();
            }
            
            
            
            function getItems() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        console.log(this.responseText);
                        if (this.responseText == "User cart is empty") {

                            var tag = document.createElement("p");
                            tag.innerHTML = "There are currently no requests available."
                            document.getElementById('cart').appendChild(tag);

                        } else {
                            var res = this.responseText.split(";");
                            for (let i = 0; i < res.length - 1; i++) {
                                var tag = document.createElement("div");
                                var item = JSON.parse(res[i]);
                                indexes[cnt++] = item.id;
                                console.log(res[i]);
                                tag.innerHTML = `
                    <input type="checkbox" id=${item.id}-button name="vehicle1" value="Bike">
                    <label for=${item.id}-button> <img id=${item.id}-pic src="images/${item.filename}"></img></label>`;
                                document.getElementById('photos').appendChild(tag);
                            }

                        }
                    }
                }
                xmlhttp.open("GET", "getPhotos.php", true);
                xmlhttp.send();
            }

            function getNavbar() {
                var user = localStorage.getItem('user');
                console.log(user);
                if(user==null){
                    document.getElementById('nav').innerHTML=` <a href="index.php">Home</a>`
                }
                else{
                    document.getElementById('nav').innerHTML=`
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="inbox.php">Inbox</a>
        <a href="photoSessionForm.php">Request Photo Session</a>
        <a href="photos.php">Albums</a> `
                }
            }


            function sendToCart() {

                var isChecked=0;
                for (i = 0; i < indexes.length; ++i) {
                    index = indexes[i];
                    if (document.getElementById(`${index}-button`).checked) {
                        isChecked=1;
                        break;

                    }
                }
                if(isChecked == 0){
                    alert("No pictures are selected");
                    return;
                }
                var type = document.getElementById('types').value;
                var user = JSON.parse(localStorage.getItem('user'));
                if(user==null){
                    window.location.href = 'login.php';
                    return;
                }
                var price = 0;
                if (type == "deck") {
                    price = 3
                } else if (type == "cup") {
                    price = 5;
                } else if (type == "small picture") {
                    price = 1;
                } else if (type == "medium picture") {
                    price = 2;
                } else if (type == "large picture") {
                    price = 3;
                } else if (type == "framed small picture") {
                    price = 2;
                } else if (type == "framed medium picture") {
                    price = 3;
                } else if (type == "framed large picture") {
                    price = 4;
                } else if (type == "poster") {
                    price = 3;
                } else if (type == "framed picture") {
                    price = 6;
                } else if (type == "t-shirt") {
                    price = 15;
                }
                 else if (type == "album") {
                var str=""
                document.getElementById('')
                for (i = 0; i < indexes.length; ++i) {
                    index = indexes[i];

                    if (document.getElementById(`${index}-button`).checked) {
                        image = document.getElementById(`${index}-pic`).src;
                        var img_name = image.replace(/^.*[\\\/]/, ''); 
                        str+=img_name+"|";
                        document.getElementById(`${index}-button`).checked = false;

                    }
                }
                window.location.href = 'albumForm.php?str='+str;
                return;
                }

                for (i = 0; i < indexes.length; ++i) {
                    index = indexes[i];

                    if (document.getElementById(`${index}-button`).checked) {
                        console.log(`id:${index},type${type}`);
                        image = document.getElementById(`${index}-pic`).src;
                        var img_name = image.replace(/^.*[\\\/]/, ''); 
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "sendToCart.php?owner=" + user.username + "&image=" + img_name + "&type=" + type + "&price=" + price, true);
                        xmlhttp.send();
                        document.getElementById(`${index}-button`).checked = false;
                    }
                }
                alert("Items are sent to your cart.")


            }

            function downloadImages() {
                var user = JSON.parse(localStorage.getItem('user'));
                if(user==null){
                    window.location.href = 'login.php';
                    return;
                }
                for (i = 0; i < indexes.length; ++i) {
                    index = indexes[i];

                    if (document.getElementById(`${index}-button`).checked) {
                        var link = document.createElement("a");
                        link.download = `${index}-pic`;
                        link.href = document.getElementById(`${index}-pic`).src;
                        link.click();
                    }
                }
            }

            function uploadFile() {
                var user = JSON.parse(localStorage.getItem('user'));
                if(user==null){
                    window.location.href = 'login.php';
                    return;
                }
                var files = document.getElementById("file").files;

                if (files.length > 0) {

                    var formData = new FormData();
                    formData.append("file", files[0]);

                    var xhttp = new XMLHttpRequest();

                    xhttp.open("POST", "ajaxfile.php", true);

                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {

                            var response = this.responseText;
                            if (response == 1) {
                                location.reload();
                            } else {
                                alert("File not uploaded.");
                            }
                        }
                    };

                    // Send request with data
                    xhttp.send(formData);

                } else {
                    alert("Please select a file");
                }

            }

            function getAlbumStr(){
                var str=""
                document.getElementById('')
                for (i = 0; i < indexes.length; ++i) {
                    index = indexes[i];

                    if (document.getElementById(`${index}-button`).checked) {
                        image = document.getElementById(`${index}-pic`).src;
                        var img_name = image.replace(/^.*[\\\/]/, ''); 
                        str+=img_name+"+";
                        document.getElementById(`${index}-button`).checked = false;

                    }
                }
            }

        </script>

    </div>
</body>

</html>