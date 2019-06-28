<?php
$id_korisnik = $_POST['id_korisnik'];
$id_sostanok = $_POST['id_sostanok'];
include("config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$id_korisnik = mysqli_real_escape_string($conn,$id_korisnik);
$id_sostanok = mysqli_real_escape_string($conn,$id_sostanok);

$sql = "SELECT * FROM sostanoci WHERE id = '$id_sostanok'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$datum = $row['datum'];
$vreme = $row['vreme'];
$pokaneti = $row['pokaneti'];
$sql2 = "INSERT INTO prifateni_sostanoci (id_korisnik, id_sostanok, datum, vreme, pokaneti) VALUES ('$id_korisnik', '$id_sostanok', '$datum', '$vreme', '$pokaneti')";
$result2 = $conn->query($sql2);

header("location:sostanoci.php");
?>