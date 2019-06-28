<?php
session_start();
if (!isset($_POST['email1']))
	header("location:register.php");
include("config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$email = mysqli_real_escape_string($conn,$_POST['email1']); 
$password = mysqli_real_escape_string($conn,$_POST['password1']); 

$sql = "INSERT INTO korisnici (email, password) VALUES ('$email', '$password')";

if ($conn->query($sql) === TRUE) {
    $test = "Успешно додаден нов корисник";
    $_SESSION['login_email'] = $email;
} else {
    $test = "Грешка: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Систем за состаноци</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="jquery.timepicker.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="jquery.timepicker.min.js"></script>
<script type="text/javascript">
	window.onload = function () {
		$("#time1").timepicker();
		$("#datum1").datepicker({ minDate: 0});
	};
</script>
<style type="text/css">
	a.nav-link {
		color: black;
	}
	a.nav-link:hover {
		color: white;
	}
	div.form-group label {
		width: 100%;
	}
</style>
</head>
<body>
		<nav class="navbar navbar-dark bg-primary">
		<ul class="nav nav-pills">
			<li class="nav-item">
				<a class="nav-link" href="index.php">
					Креирај нов состанок
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="sostanoci.php">
					Мои состаноци
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="login.php">
					Најави се
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="register.php">
					Регистрирај се
				</a>
			</li>
			<?php if (isset($_SESSION['login_email'])) echo '<li class="nav-item">
				<a class="nav-link text-danger" href="logout.php">
					Одјави се
				</a>
			</li>' ?>
		</ul>
	</nav>
	<div class="container">
		<h5><?php echo $test; ?></h5>
	</div>
</body>
</html>