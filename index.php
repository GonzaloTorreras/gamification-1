<?php
include 'mysql.php';

//Damos de alta la sesion
session_start();

if(isset($_GET['logout'])){
	//Si queremos cerrar sesión, destruimos la sesion y redirigimos al index
	session_destroy();
	header("Location: index.php");
	die();
}

if (isset($_POST['user']) || isset($_SESSION['rowUser'])){ //Si acabamos de loguearnos o ya lo estabamos, mostramos la página
	if (isset($_POST['user'])){
		//Si venimos de hacer login
		$user = $_POST['user'];
		$pass = $_POST['password'];
		$sql = "SELECT * FROM usuario WHERE user = ?";
		
		/* Prepare statement */
		$stmt = $conn->prepare($sql);
		if($stmt === false) {
		  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		}
		 
		/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param('s',$user);
		 
		/* Execute statement */
		$stmt->execute();
		
		$recordset = $stmt->get_result();
		if($recordset === false) {
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
			$rows_returned = $recordset->num_rows;
			if ($rows_returned == 0){
				//No ha encontrado el usuario
				$_SESSION['error'] = 'El usuario no existe en la base de datos.';
				header("Location: index.php");
				die();
			}else{
				$recordset->data_seek(0);
				while($row = $recordset->fetch_assoc()){
					if ($row['password'] == $pass){
						//Guardamos los datos del usuario en sesion
						$_SESSION['rowUser'] = $row;
						unset($_SESSION['error']);
					}
				}
				if (!isset($_SESSION['rowUser'])){
					//No ha coincidido el pass
					$_SESSION['error'] = 'La contrase&ntilde;a no es correcta';
					header("Location: index.php");
					die();
				}
			}
		}
		$stmt->close(); //Cerramos el statement
		$recordset->free(); //Liberamos el resultado
	}
	
	//Mostramos la página
	include 'contenido.php';

} else {
	//No estamos logueados ni venimos de loguearnos
	include 'login.php';
} 
?>