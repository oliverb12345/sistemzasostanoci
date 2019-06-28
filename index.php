<?php
session_start();
if (!isset($_SESSION['login_email']))
	header("location:login.php");
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
		$("#vreme1").timepicker();
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
				<a class="nav-link active" href="index.php">
					Креирај нов состанок
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="sostanoci.php">
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
		<h4>Креирај нов состанок</h4>
		<form method="POST" action="dodadi.php">
		<div class="form-group">
			<label for="datum1">Датум: </label>
			<input type="text" id="datum1" name="datum1" required="required" />
		</div>
		<div class="form-group">
			<label for="vreme1">Време: </label>
			<input type="text" id="vreme1" name="vreme1" required="required" />
		</div>
		<div class="form-group">
			<label for="pokaneti1">Внеси поканети: </label>
			<textarea placeholder="Внеси по 1 е-маил во секоја линија" name="pokaneti1" rows="8" cols="40" required="required"></textarea>
		</div>
		<div class="form-group">
			<button class="btn btn-primary">Закажи состанок</button>
		</div>
		</form>
	</div>
</body>
</html>