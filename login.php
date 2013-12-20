<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>
	
		<title>Gamificación - Login</title>
		<meta name="author" content="Luis Alberto Santos">
		<meta name="description" content="Ejercicio de Gamificacion">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"> 
		<link rel="Shortcut Icon" href="images/icono.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="css/style-login.css">

    </head>

    <body>
		<div class="fullscreen-img">
			<div class="page-container">
				<h1>Login</h1>
				<form name="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<input type="text" name="user" class="username" placeholder="Usuario" autocomplete="off">
					<input type="password" name="password" class="password" placeholder="Contrase&ntilde;a">
					<button type="submit">Entrar</button>
					<div class="error"><span>+</span></div>
				</form>

			</div>
			<div class="connect">
                <p><?php if (isset($_SESSION['error'])) echo $_SESSION['error'];?></p>
            </div>
		</div>
        <!-- Javascript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/script-login.js"></script>

    </body>

</html>

