<?php
session_start();
if (!isset($_POST['email1']))
	header("location:login.php");
include("config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$email = mysqli_real_escape_string($conn,$_POST['email1']); 
$password = mysqli_real_escape_string($conn,$_POST['password1']); 

$sql = "SELECT * FROM korisnici WHERE email = '$email' and password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$_SESSION['login_email'] = $email;
    header("location:index.php");
} else {
    $test = "Неуспешна најава";
}

$conn->close();
echo $test;
?>

<a href="index.php">Оди назад</a>