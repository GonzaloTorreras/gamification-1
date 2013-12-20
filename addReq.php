<?php		
if(isset($_POST['id'])){
	
	session_start();

	include 'mysql.php';
	include 'funciones.php';
	
	//Creamos el insert
	$sql = "INSERT INTO `requisito`(`id`, `titulo`, `prioridad`, `impacto`, `dependencias`, `descripcion`, `autor`) VALUES (?,?,?,?,?,?,?)";
	$id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$prioridad = $_POST['prioridad'];
	$impacto = $_POST['impacto'];
	$dependencias = $_POST['dependencias'];
	$descripcion = $_POST['descripcion'];
	$autor =  $_SESSION['rowUser']['user'];
	 
	// Preparamos el statement
	$stmt = $conn->prepare($sql);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	
	//Unimos los parámetros. Tipos: s = string, i = integer, d = double,  b = blob
	$stmt->bind_param('ssiisss',$id,$titulo,$prioridad,$impacto,$dependencias,$descripcion,$autor);
	 
	//Ejecutamos el statement
	if(!$stmt->execute()){
		//Si no se puede completar la acción, lo indicamos y volvemos atrás (al index con el formulario relleno)
		print '<script type="text/javascript">'; 
		print 'alert("No se ha podido insertar el requisito. Compruebe los datos.");'; 
		print 'history.back();';
		print '</script>'; 
		$stmt->close();
		exit();
	}
	
	//Cerramos el statement
	$stmt->close();
	
	//Añadimos puntos al autor
	addPoints(5,$autor);
}

//Redirigimos al index
header("Location: index.php");
?>