<!DOCTYPE html>
<html class="html-login">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="CSS/index.css" media="screen" />
	<title>Sign in</title>
</head>

<body>
	
	<div class="bg-image"></div>

	<main>
		<!--Login-->
		<div class="main">
			<p class="sign" align="center">Login</p>
			<form class="form1" action="index.php" method="post">
				<input name="act" type="hidden" value="login" />
				<input class="un" name="name" type="text" align="center" placeholder="Benutzername" required />
				<input class="pass" name="pass" type="password" align="center" placeholder="Passwort" required />
				<input name="submit" type="submit" class="submit-login" align="center" value="Anmelden" />
				<div class="validation-username"></div>
				<div class="validation-password"></div>
			</form>
		</div>
	</main>
</body>

</html>