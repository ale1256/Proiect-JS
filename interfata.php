<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>* {box-sizing: border-box;}</style>
    <link rel="stylesheet" href="cssinterfata.css">
    <link rel="stylesheet" href="logostyle.css"> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfata</title>
</head>
<body>
  
<div class="topnav">
    <div class="logo">
        <img src="logo.jpg" alt="Logo">
    </div>
    
    <a class="nav" href="interfata.php"><b>Home</b></a>
    <a class="nav" href="about.html"><b>About</b></a>
    <div class="dropdown">
        <button class="dropbtn"><b>Profile </b>
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a class="nav" href="login.php"><b>Login</b></a>
            <a href="logout.php"><b>Logout</b></a>
        </div>
    </div> 

    <div class="dropdown">
        <button class="dropbtn"><b>Review </b>
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a class="nav" href="review.php"><b>Write a Review</b></a>
            <a href="reviewsphp.php"><b>Review Pages</b></a>
        </div>
    </div> 
    <a class="nav" href="contact.php"><b>Contact</b></a>
    <div class="search-container">
        <form action="/script.php"> 
            <input type="text" value="" placeholder="Search..." name="search" id="search" onchange="OpenPage()">
            <button type="submit"><i class="fa fa-search"></i></button>
            <script>
                function OpenPage()
                {
                    var x = document.getElementById("search").value;
                    if (x === "about") window.open("/proiect_ewd/about.html");
                    if (x === "review") window.open("/proiect_ewd/review.php");
                    if (x === "contact") window.open("/proiect_ewd/contact.php");
                    if (x === "login") window.open("/proiect_ewd/login.php");
                    if (x === "register") window.open("/proiect_ewd/login.php");
                    if (x === "write a review") window.open("/proiect_ewd/reviewsphp.php");
                }
            </script>
        </form>
    </div>
</div>
<div class="hover-container">
    <h1 class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?>!</h1>
</div>
<script>
$(document).ready(function() {
    $('.hover-container').hover(
        function() {
            $('.welcome-message').css('opacity', '0');
        },
        function() {
            $('.welcome-message').css('opacity', '1');
        }
    );
});
</script>
<h2>Every bite of food, all in one place!</h2>
<div class="row">
    <div class="col">
        <img class="imagini" src="img1.jpg" alt="img1" style="width: 100%;">
    </div>
    <div class="col">
        <img class="imagini" src="img2.jpg" alt="img2" style="width: 100%;">
    </div>
    <div class="col">
        <img class="imagini" src="img4.jpg" alt="img3" style="width: 100%;">
    </div>
</div>

<h3>OUR FINEST SELECTION</h3>

<div class="rest_section">
  <div class="rest_list" id="restList">
    <div class="restaurant">
        <a href="https://argentinian.ro/en" target="_blank">
            <img src="download1.jpeg" alt="argentinian">
        </a>
    </div>
    <div class="restaurant">
        <a href="https://vie.groupe-tamara.com/" target="_blank">
            <img src="vie2.jpg" alt="vie">
        </a>
    </div>
    <div class="restaurant">
        <a href="https://piata9.ro/en" target="_blank">
            <img src="piata9.jpeg" alt="piata9">
        </a>
    </div>
    <div class="restaurant">
        <a href="https://www.onesoul.ro/" target="_blank">
            <img src="onesoul.jpeg" alt="onesoul">
        </a>
    </div>
    <div class="restaurant">
        <a href="https://www.baracca.ro/" target="_blank">
            <img src="baraca.jpeg" alt="baracca">
        </a>
    </div>
  </div>
</div>
<button id="interchangeButton">Interchange Restaurants</button>
<footer>
    <div>
        <i class="fa fa-instagram"></i>
        <i class="fa fa-facebook"></i>
        <i class="fa fa-twitter"></i>
    </div>
</footer>
<script>
document.getElementById('interchangeButton').addEventListener('click', function() {
    var restList = document.getElementById('restList');
    if (restList.children.length > 1) {
        restList.appendChild(restList.children[0]);
    }
});
</script>
</body>
</html>