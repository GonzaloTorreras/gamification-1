$(document).ready(function(){
	
	//Para cada botón de comentarios, hacemos que se muestre la zona de comentarios
	$(".fa-comment").click(function () {
		$(this).parent().children('.requisito').children('.comment').toggle("fast");
	});
	$(".fa-comment-o").click(function () {
		$(this).parent().children('.requisito').children('.comment').toggle("fast");
	});
	
	//Para el boton de editar
	$(".fa-edit").click(function () {
		if (!$(this).parent().children('.requisito').children('.form').find("input[type='submit']").length){
			//Si no estamos editando ya
			
			// obtenemos los span de cada campo del requisito
			var id = $(this).parent().children('.requisito').children('.form').children('.3u').children('.id');
			var titulo = $(this).parent().children('.requisito').children('.form').children('.9u').children('.titulo');
			var prioridad = $(this).parent().children('.requisito').children('.form').children('.3u').children('.prioridad');
			var impacto = $(this).parent().children('.requisito').children('.form').children('.3u').children('.impacto');
			var dependencias = $(this).parent().children('.requisito').children('.form').children('.6u').children('.dependencias');
			var descripcion = $(this).parent().children('.requisito').children('.form').children('.12u').children('.descripcion');
			
			//Los cambiamos por inputs con el valor que tenían
			id.html("<input type='text' name='id' size='10' maxlength='10' value='"+id.text()+"' readonly></input>");
			titulo.html("<input type='text' name='titulo' size='50' maxlength='50' value='"+titulo.text()+"' required></input>");
			prioridad.html("<input type='number' name='prioridad' style='width:70px;' value='"+prioridad.text()+"' required></input>");
			impacto.html("<input type='number' name='impacto' style='width:70px;' value='"+impacto.text()+"' required></input>");
			dependencias.html("<input type='text' name='dependencias' size='30' maxlength='150' value='"+dependencias.text()+"'></input>");
			descripcion.html("<textarea name='descripcion' rows='5' style='resize: none;' maxlength='350' required>"+descripcion.text()+"</textarea>");
			
			//Añadimos un boton para guardar
			$(this).parent().children('.requisito').children('.form').append("<input style='float:right;position:relative;top:-30px;left:-2px;' type='submit' value='Guardar'>");
		} else {
			//Si ya estabamos editando, recargamos la pagina
			location.reload();			
		}
		
	});
	
	//para el boton de añadir requisitos, hacemos que se muestre la seccion correspondiente
	$("#btnAdd").click(function () {
		$('#addReq').toggle("fast");
	});
	
	$('.showAddComment').click(function () {
		$(this).parent().children('.commentReq').toggle("fast");
	});
	
});
