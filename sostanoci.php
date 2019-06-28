<?php
session_start();
if (!isset($_SESSION['login_email']))
	header("location:login.php");
include("config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$email = mysqli_real_escape_string($conn,$_SESSION['login_email']);

$sql = "SELECT * FROM sostanoci WHERE pokaneti LIKE '%$email%'";
$result = $conn->query($sql);
$sql2 = "SELECT * FROM korisnici WHERE email = '$email'";
$result2 = $conn->query($sql2);
$row2id = $result2->fetch_assoc()['id'];
$sql3 = "SELECT * FROM prifateni_sostanoci WHERE id_korisnik = '$row2id'";
$result3 = $conn->query($sql3);

if ($result->num_rows > 0) {
	$test .= '<table><tr><td>Датум</td><td>Време</td><td>Поканети</td><td>Опции</td></tr>';
    while($row = $result->fetch_assoc()) {
    	$flag = false;
		$sql4 = "SELECT * FROM prifateni_sostanoci WHERE id_korisnik = '$row2id'";
		$result4 = $conn->query($sql4);
    	while($row2 = $result4->fetch_assoc()) {
    		if ($row['id'] == $row2['id_sostanok']) {
    			$flag = true;
    			break;
    		}
    	}
    	if ($flag == true)
    		continue;

    	$test .= '<tr><td>' . $row['datum'] . '</td><td>' . $row['vreme'] . '</td><td>' . $row['pokaneti'] . '</td><td><form method="POST" action="prifati_sostanok.php"><input type="hidden" name="id_sostanok" value="'. $row['id'] . '"><input type="hidden" name="id_korisnik" value="' . $row2id . '"><button class="btn btn-primary">Прифати</button></form></td></tr>';
    }
    $test .= '</table>';
} else {
    $test = "Нема состаноци каде сте поканети";
}

if ($result3->num_rows > 0) {
	$test2 .= '<table><tr><td>Датум</td><td>Време</td><td>Поканети</td></tr>';
    while($row = $result3->fetch_assoc()) {
    	$test2 .= '<tr><td>' . $row['datum'] . '</td><td>' . $row['vreme'] . '</td><td>' . $row['pokaneti'] . '</td></tr>';
    }
    $test2 .= '</table>';
} else {
    $test2 = "Немате прифатени состаноци";
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Систем за состаноци</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
	table, tr, td {
		border: 1px solid;
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
				<a class="nav-link active" href="sostanoci.php">
					Мои состаноци
				</a>
			</li>
			<?php if (isset($_SESSION['login_email'])) echo '<li class="nav-item">
				<a class="nav-link text-danger" href="logout.php">
					Одјави се
				</a>
			</li>' ?>
		</ul>
	</nav>
	<div class="container" style="margin-top: 30px;">
		<h4>Мои состаноци</h4>
		<?php echo $test; ?>
		<h4 style="margin-top: 30px;">Прифатени состаноци</h4>
		<?php echo $test2; ?>
	</div>
</body>
</html>