<html>
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="oggetto-nav" href="./index.html">Home</a>
			</li>
			<li class="nav-item">
				<a class="oggetto-nav" href="./login.html">Login</a>
			</li>
			<li class="nav-item">
				<a class="oggetto-nav-attivo" href="./registrazione.html">Registrati</a>
			</li>
			<li class="nav-item">
				<a class="oggetto-nav" href="./cerca.html">Cerca Pokemon</a>
			</li>
		</ul>
		<div class="container">
			<div id="main">
				<?php
				require_once("dbhelper.php");
				$user = $_POST['username'];
				$nome = $_POST['nome'];
				$cognome = $_POST['cognome'];
				$email = $_POST['email'];
				$telefono = $_POST['telefono'];
				$datana = $_POST['datanascita'];
				$paesena = $_POST['paesedinascita'];
				$pass = $_POST['password'];
				$insertok = Registrati(Connetti(),$user,$nome,$cognome,$pass,$email,$telefono,$datana,$paesena);
				if($insertok == true){
					echo "Benvenuto " . $user;
				}
				?>
			</div>
		</div>

	</body>
</html>
