<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "user_db";
$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error)
  die("Connection Failed".$conn->connect_error);
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $firstname=htmlspecialchars($_POST['firstname']);
    $lastname=htmlspecialchars($_POST['lastname']);
    $email=htmlspecialchars($_POST['email']);
    $subject=htmlspecialchars($_POST['subject']);
    $sql="INSERT INTO contact_form(firstname,lastname,email,subject) VALUES('$firstname','$lastname','$email','$subject')";
    if ($conn->query($sql) === TRUE)
        echo "New record created successfully";
    else
        echo "Error:".$sql."<br>".$conn->error;
    
        header("Location: contact.php");
        exit();
}
$conn->close();
?>