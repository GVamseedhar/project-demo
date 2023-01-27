<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home page12styles.css">
</head>
<body onload="username()">
<div class="top">
        <div class="inside-top">
            <div class="top-box"> <img src="profile.png" alt="" style="width:30px;height:30px"> &nbsp;&nbsp; <p id="username">Hi user</p></div>
            <div class="inside-top2">
                <a href="home page1.php"><div  class="top-box">Home</div></a>
                <a href="home page2.php"><div class="top-box">View or update record</div></a>
                <div class="top-box">About</div>
                <a href="logout.php"><div class="top-box">Logout &nbsp;&nbsp;&nbsp; <img src="log-out.png" alt="" style="width:20px;height:20px"></div></a>
            </div>
        </div>
    </div>
    <div class="graph1-container">
        <iframe class="graph" src="https://thingspeak.com/channels/1994248/charts/1?bgcolor=%23ffffff&color=%23ff0000&dynamic=true&results=60&type=spline"></iframe>
        <iframe class="graph" src="https://thingspeak.com/channels/1994248/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=spline"></iframe>
    </div>
    <div class="graph2-container">
        <iframe class="graph" src="https://thingspeak.com/channels/1994248/charts/3?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=spline"></iframe>
    </div>

    <script>
        function username(){
            document.getElementById("username").innerHTML="Hi "+"<?php echo $_SESSION["username"] ?>";
        }
    </script>
</body>
</html>