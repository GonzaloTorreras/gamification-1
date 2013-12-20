<?php
if(isset($_POST['id'])){
	include 'mysql.php';
	include 'funciones.php';
	
	//Creamos el update
	$sql='UPDATE comentario SET resuelto=1 WHERE idrequisito=? AND autor=?';
	$id = $_POST['id'];
	$autor = $_POST['autor'];
	 
	//Preparamos el statement
	$stmt = $conn->prepare($sql);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	
	//Unimos los parámetros. Tipos: s = string, i = integer, d = double,  b = blob
	$stmt->bind_param('ss',$id,$autor);
	 
	//Ejecutamos el statement
	if(!$stmt->execute()){
		//Si no se puede completar la acción, lo indicamos y volvemos atrás
		print '<script type="text/javascript">'; 
		print 'alert("No ha sido posible resolver el comentario. Inténtelo de nuevo más tarde.");'; 
		print 'history.back();';
		print '</script>'; 
		$stmt->close();
		exit();
	}
	
	//Cerramos el statement
	$stmt->close();	
	
	//Añadimos puntos al autor
	session_start();
	addPoints(1,$_SESSION['rowUser']['user']);
}

//Redirigimos al index
header("Location: index.php");
?>