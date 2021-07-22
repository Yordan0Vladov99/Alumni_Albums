<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="cart.css" />
    <link rel="stylesheet" type="text/css" href="photos.css" />
</head>

<body>
<div class="navbar">
        <a href="index.php">Home</a>
        <a href="photoInbox.php">Inbox</a>
        <a href="photoSessions.php">Photo Sessions</a>
        <a href="p_photos.php">Albums</a>
    </div>
    
    <div class="top-container">
        <span class="extra-large">Photos</span>
        <button class="order-sender" onclick="downloadImages()">Download Images</button>
        <input class="orders" type="file" name="file" id="file">
        <input class="orders" type="button" id="btn_uploadfile" value="Upload" onclick="uploadFile();">
    </div>
    <div id="photos" class="photos">
        <script>
            var indexes = [],
                cnt = 0;
            window.onload = function getItems() {
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

                    // Set POST method and ajax file path
                    xhttp.open("POST", "ajaxfile.php", true);

                    // call on request changes state
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
        </script>

    </div>
</body>

</html>