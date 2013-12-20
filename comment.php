<?php
if(isset($_POST['id'])){
	
	session_start();

	include 'mysql.php';
	include 'funciones.php';
	
	//Creamos el insert
	$sql = "INSERT INTO `comentario`(`autor`, `idrequisito`, `contenido`) VALUES (?,?,?)";
	$autor =  $_SESSION['rowUser']['user'];
	$id = $_POST['id'];
	$comentario = $_POST['addComment'];
	
	 
	// Preparamos el statement
	$stmt = $conn->prepare($sql);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	
	//Unimos los par�metros. Tipos: s = string, i = integer, d = double,  b = blob
	$stmt->bind_param('sss',$autor,$id,$comentario);
	 
	//Ejecutamos el statement
	if(!$stmt->execute()){
		//Si no se puede completar la acci�n, lo indicamos y volvemos atr�s
		print '<script type="text/javascript">'; 
		print 'alert("No se ha podido a�adir el comentario.");'; 
		print 'history.back();';
		print '</script>'; 
		$stmt->close();
		exit();
	}
	
	//Cerramos el statement
	$stmt->close();
	
	//A�adimos puntos al autor
	addPoints(2,$autor);
}

//Redirigimos al index
header("Location: index.php");
?>