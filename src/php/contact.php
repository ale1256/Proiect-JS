<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);

    if (empty($firstname) || empty($lastname) || empty($email) || empty($subject)) {
        $message = "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO contact_form (firstname, lastname, email, subject) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $subject);

        if ($stmt->execute()) {
            $message = "Form submitted successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="contactcss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="write">
    <a class="nav" href="interfata.php">If you wish to return to our homepage, please click me!</a>
</div>
<div class="boxes">
    <div class="box">
        <h1><b>Contact Us</b></h1>
        <div class="message-container">
            <?php if (!empty($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" id="fname" name="firstname" placeholder="Your First Name..." required>
            <br>
            <input type="text" id="lname" name="lastname" placeholder="Your Last Name..." required>
            <br>
            <input type="text" id="email" name="email" placeholder="Your E-mail Address..." required>
            <br>
            <textarea id="subject" name="subject" placeholder="Write something here..." style="height: 150px;" required></textarea>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
</body>
</html>
