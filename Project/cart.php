<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Project</title>
    <link rel="stylesheet" type="text/css" href="cart.css" />
    <link rel="stylesheet" type="text/css" href="navbar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="navbar">
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="inbox.php">Inbox</a>
        <a href="photoSessionForm.php">Request Photo Session</a>
        <a href="photos.php">Albums</a>
    </div>

<div class="cart-body">
    <div class="left-container">
        <h1>Your Shopping Cart</h1>
        <div>
            <button onclick='submitCart()' class="order-sender">Submit</button>
        </div>
    </div>
    <div id="cart" class="cart">
        <script>
            var indexes = [],
                cnt = 0, albums=[], cnt2=0;
            window.onload = function init(){
                getItems();
                getAlbums();

            }
            function getItems() {
                var user = JSON.parse(localStorage.getItem('user'));
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        console.log(this.responseText);
                        if (this.responseText == "User cart is empty") {

                            var tag = document.createElement("p");
                            tag.innerHTML = "User cart has no items."
                            document.getElementById('cart').appendChild(tag);

                        } else {
                            var res = this.responseText.split(";");
                            for (let i = 0; i < res.length - 1; i++) {
                                var tag = document.createElement("p");
                                var item = JSON.parse(res[i]);
                                indexes[cnt++] = item.id;
                                console.log(res[i]);
                                tag.innerHTML = `      
            <div class="cart-item">
                    <div class="description">
                        <p>Type: <span id=${item.id}-type>${item.name}</span></p>
                        <p>Price: <span id=${item.id}-price>${item.price}</span></p>
                        <span>Quantity:</span>
                        <input type="number" min="1" id=${item.id}-quantity></input>
                        <button onclick='sendItem(${item.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;"><i class="fa fa-check"></i></button>
                        <button onclick='removeItem(${item.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;"><i class="fa fa-times"></i></button>
                        </br>
                        <span id=${item.id}-quantity-error></span>
                    </div>
                <img id=${item.id}-image class="item-image" src="./images/${item.image}">
            </div>
            `;
                                document.getElementById('cart').appendChild(tag);
                            }

                        }
                    }
                }
                xmlhttp.open("GET", "getCartItems.php?username=" + user.username, true);
                xmlhttp.send();
            }

            function getAlbums(){
                var user = JSON.parse(localStorage.getItem('user'));
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        console.log(this.responseText);
                        if (this.responseText == "User cart is empty") {

                            var tag = document.createElement("p");
                            tag.innerHTML = "User cart has no albums."
                            document.getElementById('cart').appendChild(tag);

                        } else {
                            var res = this.responseText.split(";");
                            for (let i = 0; i < res.length - 1; i++) {
                                var tag = document.createElement("p");
                                var item = JSON.parse(res[i]);
                                albums[cnt2++] = item.id;
                                console.log(res[i]);
                                tag.innerHTML = `      
            <div class="cart-item">
                    <div class="description">
                        <p>Type:Album</p>
                        <a href="album.php?id=${item.id}">Title: <span id=album-${item.id}-name>${item.name}</span></a>
                        <p>Price: <span id=album-${item.id}-price>${item.price}</span></p>
                        <span>Quantity:</span>
                        <input type="number" min="1" id=album-${item.id}-quantity></input>
                        <button onclick='sendAlbum(${item.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;"><i class="fa fa-check"></i></button>
                        <button onclick='removeAlbum(${item.id})' style="background-color:lightgray;font-weight:bold;border-width:0ch;"><i class="fa fa-times"></i></button>
                        </br>
                        <span id=album-${item.id}-quantity-error></span>
                    </div>
            </div>
            `;
                                document.getElementById('cart').appendChild(tag);
                            }

                        }
                    }
                }
                xmlhttp.open("GET", "getUserAlbums.php?username=" + user.username, true);
                xmlhttp.send();
            }

            function sendItem(id) {
                var user = JSON.parse(localStorage.getItem('user'));
                var isError = 0;

                quantity = document.getElementById(`${id}-quantity`).value;
                if (quantity == "" || quantity < 1) {
                    document.getElementById(`${id}-quantity-error`).innerHTML = "Quantity must be a positive integer";
                    isError = 1;
                } else {
                    document.getElementById(`${id}-quantity-error`).innerHTML = "";
                }

                if (isError == 0) {

                    type = document.getElementById(`${id}-type`).innerHTML;
                    price = document.getElementById(`${id}-price`).innerHTML;
                    quantity = document.getElementById(`${id}-quantity`).value;
                    image = document.getElementById(`${id}-image`).src;
                    var img_name = image.replace(/^.*[\\\/]/, ''); 
                    total = price * quantity;
                    if (quantity >= 1000) {
                        total *= 0.7;
                    } else if (quantity >= 100) {
                        total *= 0.8;
                    } else if (quantity >= 10) {
                        total *= 0.9;
                    }
                    var str = "Item:" + type + "     Quantity:" + quantity + "      Total Price:" + total;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "submitRequest.php?username=" + user.username + "&image=" + img_name + "&description=" + str + "&id=" + id, true);
                    xmlhttp.send();
                    location.reload();
                }
            }

            function sendAlbum(id){
                var user = JSON.parse(localStorage.getItem('user'));
                var isError = 0;

                quantity = document.getElementById(`album-${id}-quantity`).value;
                    if (quantity == "" || quantity < 1) {
                        document.getElementById(`album-${id}-quantity-error`).innerHTML = "Quantity must be a positive integer";
                        isError = 1;
                    } else {
                        document.getElementById(`album-${id}-quantity-error`).innerHTML = "";
                    }
                
                if(isError==0){
                        type = "Album";
                        price = document.getElementById(`album-${id}-price`).innerHTML;
                        quantity = document.getElementById(`album-${id}-quantity`).value;
                        link = id;
                        total = price * quantity;
                        if (quantity >= 1000) {
                            total *= 0.7;
                        } else if (quantity >= 100) {
                            total *= 0.8;
                        } else if (quantity >= 10) {
                            total *= 0.9;
                        }
                        var str = "Item:" + type + "     Quantity:" + quantity + "      Total Price:" + total;
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "submitAlbumRequest.php?username=" + user.username + "&link=" + link + "&description=" + str, true);

                        xmlhttp.send();
                        location.reload();
                }
            }

            function removeItem(id) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "removeItem.php?id=" + id, true);
                xmlhttp.send();
                location.reload();
            }

            function submitCart() {
                var user = JSON.parse(localStorage.getItem('user'));
                var isError = 0;
                for (i = 0; i < indexes.length; ++i) {

                    index = indexes[i];
                    quantity = document.getElementById(`${index}-quantity`).value;
                    if (quantity == "" || quantity < 1) {
                        document.getElementById(`${index}-quantity-error`).innerHTML = "Quantity must be a positive integer";
                        isError = 1;
                    } else {
                        document.getElementById(`${index}-quantity-error`).innerHTML = "";
                    }
                }
                for (i = 0; i < albums.length; ++i) {

                    index = albums[i];
                    quantity = document.getElementById(`album-${index}-quantity`).value;
                    if (quantity == "" || quantity < 1) {
                        document.getElementById(`album-${index}-quantity-error`).innerHTML = "Quantity must be a positive integer";
                        isError = 1;
                    } else {
                        document.getElementById(`album-${index}-quantity-error`).innerHTML = "";
                    }
                }

                if (isError == 0) {
                    for (i = 0; i < indexes.length; ++i) {
                        index = indexes[i];
                        type = document.getElementById(`${index}-type`).innerHTML;
                        price = document.getElementById(`${index}-price`).innerHTML;
                        quantity = document.getElementById(`${index}-quantity`).value;
                        image = document.getElementById(`${index}-image`).src.replace(/^.*[\\\/]/, '');
                        total = price * quantity;
                        if (quantity >= 1000) {
                            total *= 0.7;
                        } else if (quantity >= 100) {
                            total *= 0.8;
                        } else if (quantity >= 10) {
                            total *= 0.9;
                        }
                        var str = "Item:" + type + "     Quantity:" + quantity + "      Total Price:" + total;
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "submitRequest.php?username=" + user.username + "&image=" + image + "&description=" + str + "&id=" + index, true);

                        xmlhttp.send();
                    }
                    for (i = 0; i < albums.length; ++i) {
                        index = albums[i];
                        type = "Album";
                        price = document.getElementById(`album-${index}-price`).innerHTML;
                        quantity = document.getElementById(`album-${index}-quantity`).value;
                        link = index;
                        total = price * quantity;
                        if (quantity >= 1000) {
                            total *= 0.7;
                        } else if (quantity >= 100) {
                            total *= 0.8;
                        } else if (quantity >= 10) {
                            total *= 0.9;
                        }
                        var str = "Item:" + type + "     Quantity:" + quantity + "      Total Price:" + total;
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "submitAlbumRequest.php?username=" + user.username + "&link=" + link + "&description=" + str, true);

                        xmlhttp.send();
                    }
                    location.reload();
                }
            }
        </script>

    </div>

</div>

</body>

</html>