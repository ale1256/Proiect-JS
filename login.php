<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="logincss.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
</head>
<body>
    
    <div class="login_form">
        <div class="form_box">
        <?php
    if(isset($_SESSION['message'])):?>
    <div class="message <?php echo $_SESSION['message_type'];?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        ?>
    </div>
    <?php endif;?>
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log-in</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <form id="login" class="inputs" action="register_login.php" method="POST">
                <input type="text" name="user_id" class="input_field" placeholder="User ID" required>
                <input type="password" name="password" class="input_field" placeholder="Enter Password" required>
                <input type="checkbox" class="check_box"><span>Remember me</span>
                <button type="submit" name="login" class="submit_btn">Log-In</button>
            </form>
            <form id="register" class="inputs" action="register_login.php" method="POST">
                <input type="text" name="user_id" class="input_field" placeholder="User ID" required>
                <input type="email" name="email" class="input_field" placeholder="E-mail" required>
                <input type="password" name="password" class="input_field" placeholder="Enter Password" required>
                <input type="checkbox" class="check_box"><span>Checking this means you agree with our terms and conditions</span>
                <button type="submit" name="register" class="submit_btn">Register</button>
            </form>
        </div>
    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
        }
    </script>
</body>
</html>
