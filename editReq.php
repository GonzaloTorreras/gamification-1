<?php
if(isset($_POST['id'])){
	include 'mysql.php';
	
	//Creamos el update
	$sql='UPDATE `requisito` SET `titulo`=?,`prioridad`=?,`impacto`=?,`dependencias`=?,`descripcion`=? WHERE id = ?';
	$titulo = $_POST['titulo'];
	$prioridad = $_POST['prioridad'];
	$impacto = $_POST['impacto'];
	$dependencias = $_POST['dependencias'];
	$descripcion = $_POST['descripcion'];
	$id = $_POST['id']; 
	 
	// Preparamos el statement
	$stmt = $conn->prepare($sql);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	
	//Unimos los parámetros. Tipos: s = string, i = integer, d = double,  b = blob
	$stmt->bind_param('siisss',$titulo,$prioridad,$impacto,$dependencias,$descripcion,$id);
	 
	//Ejecutamos el statement
	if(!$stmt->execute()){
		//Si no se puede completar la acción, lo indicamos y volvemos atrás
		print '<script type="text/javascript">'; 
		print 'alert("No se ha podido modificar los requisitos. Compruebe los datos.");'; 
		print 'history.back();';
		print '</script>'; 
		$stmt->close();
		exit();
	}
	
	//Cerramos el statement
	$stmt->close();	
}

//Redirigimos al index
header("Location: index.php");
?>