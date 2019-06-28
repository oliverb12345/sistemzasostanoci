<?php 
session_start();
if (isset($_SESSION['login_email']))
	header("location:index.php");
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
</style>
</head>
<body>
	<nav class="navbar navbar-dark bg-primary">
		<ul class="nav nav-pills">
			<li class="nav-item">
				<a class="nav-link active" href="login.php">
					Најави се
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="register.php">
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
	<div class="container" style="margin-top: 30px;">
		<h4>Најави се</h4>
		<form method="POST" class="form-group" action="login_form.php">
		<div class="form-group">
			<label for="datum1">Внеси е-маил: </label>
			<input type="text" id="email1" name="email1" required="required" />
		</div>
		<div class="form-group">
			<label for="password1">Внеси лозинка: </label>
			<input type="password" id="password1" name="password1" required="required" />
		</div>
		<button class="btn btn-primary">Најави се</button>
		</form>
		<div class="form-group">
			Немате регистрирано корисничко име?
			<button class="btn btn-secondary" onclick="location.href = 'register.php'">Регистрирај се</button>
		</div>
	</div>
</body>
</html>