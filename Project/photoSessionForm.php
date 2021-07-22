<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaScript Homework</title>
    <link rel="stylesheet" href="./photoSessionForm.css">
    <script>
    function requestSession(){
        var location=document.getElementById('location').value;
        var time=document.getElementById('time').value;
        var date=document.getElementById('date').value;
        var quantity=document.getElementById('quantity').value;
        var description=document.getElementById('description').value;
        var isError=0;

        if (location=="" || location.length<10 || location.length>50) {
        document.getElementById("location-error").style.display="inline-block"
        document.getElementById('location').borderColor="#B0706D"
        isError=1;
        }
        else{
        document.getElementById('location-error').style.display="none"
        document.getElementById('location').borderColor="#C3CDC0"
        }
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' +   mm + '-' + dd;

        if (date=="" | date < today) {
        document.getElementById("date-error").style.display="inline-block"
        document.getElementById('date').borderColor="#B0706D"
        isError=1;
        }else{
        document.getElementById('date-error').style.display="none"
        document.getElementById('date').borderColor="#C3CDC0"
        }

        if (time=="") {
        document.getElementById("time-error").style.display="inline-block"
        document.getElementById('time').borderColor="#B0706D"
        isError=1;
        }else{
        document.getElementById('time-error').style.display="none"
        document.getElementById('time').borderColor="#C3CDC0"
        }

        if (quantity=="" | quantity<1 ) {
        document.getElementById("quantity-error").style.display="inline-block"
        document.getElementById('quantity').borderColor="#B0706D"
        isError=1;
        }
        else{
        document.getElementById('quantity-error').style.display="none"
        document.getElementById('quantity').borderColor="#C3CDC0"
        }

        if (description=="" || description.length<10 ||  description.length > 150 ) {
        document.getElementById("description-error").style.display="inline-block"
        document.getElementById('description').borderColor="#B0706D"
        isError=1;
        }
        else{
        document.getElementById('description-error').style.display="none"
        document.getElementById('description').borderColor="#C3CDC0"
        }

    
        

        if(isError==0){
        var user=JSON.parse(localStorage.getItem('user'));
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            window.location.href = 'index.php';
        }
    };
    xmlhttp.open("GET","requestSession.php?username="+user.username+"&date="+date+"&time="+time+"&location="+location+"&quantity="+quantity+"&description="+description,true);
    xmlhttp.send();
    }
 } 
    </script>
</head>
<body>
<div class="LoginForm" >
  
        <h1 class="headers">Photo Session Form</h1>
    <div class="container">
        <div class="one-line">
        <label class="field-name" for="location">Location</label>
        <input class="field-input" id="location" name="location" type="text"></input>
        </div>
        <span id="location-error" class="error">Location must contain 10-45 characters</span>

        <div class="one-line">
        <label class="field-name" for="date">Date</label>
        <input id="date" class="field-input" name="date" type="date"></input>
        </div>
        <span id="date-error" class="error">Field mustn't be empty</span>
        
        <div class="one-line">
        <label class="field-name" for="time">Time</label>
        <input id="time" class="field-input" name="time" type="time"></input>
        </div>
        <span id="time-error" class="error">Field mustn't be empty and must be a future date</span>

        <div class="one-line">
        <label class="field-name" for="quantity">Number of people</label>
        <input id="quantity" class="field-input" name="quantity" type="number" min="1"></input>
        </div>
        <span id="quantity-error" class="error">Number must be a positive integer</span>

        <div class="one-line">
        <label class="field-name" for="description">Description</label>
        <textarea class="field-input" id="description" name="description" rows=5></textarea>
        </div>
        <span id="description-error" class="error">Description must contain 10-150 characters</span>

    </div>
    <button onclick="requestSession()" class="submit-btn" name="submit" value="Submit">Submit</button>

</div>
</body>

</html>