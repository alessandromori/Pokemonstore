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
			<a class="oggetto-nav" href="./registrazione.html">Registrati</a>
		</li>
		<li class="nav-item">
			<a class="oggetto-nav" href="./cerca.html">Cerca Pokemon</a>
		</li>
	</ul>
	<div class="container">
		<div id="main">
      <?php
			require_once("dbhelper.php");
			Catalogo(Connetti());
			?>

    </div>
  </div>
  </body>
</html>
