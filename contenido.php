<!DOCTYPE HTML>
<html>
	<head>
		<title>Gamificación</title>
		<meta name="author" content="Luis Alberto Santos">
		<meta name="description" content="Ejercicio de Gamificacion">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"> 
		<link rel="Shortcut Icon" href="images/icono.ico" type="image/x-icon" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/script.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-narrow.css" />
			<link rel="stylesheet" href="css/style-mobile.css" />
		</noscript>
	</head>
	<body>
		<!-- Header -->
			<div id="header" class="skel-panels-fixed">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><a href="index.php?logout=true"><img src="images/avatar.jpg" alt="avatar" /></a> </span>
							<h1 id="title"><?php echo $_SESSION['rowUser']['nombre'] ?></h1>
							<span class="byline"><?php echo $_SESSION['rowUser']['apellido'] ?></span>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#top" id="top-link" class="skel-panels-ignoreHref"><span class="fa fa-home">Inicio</span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-panels-ignoreHref"><span class="fa fa-th">Requisitos</span></a></li>
								<li><a href="#about" id="about-link" class="skel-panels-ignoreHref"><span class="fa fa-group">Leaderboard</span></a></li>
								<li><a href="#contact" id="contact-link" class="skel-panels-ignoreHref"><span class="fa fa-trophy">Logros</span></a></li>
							</ul>
						</nav>
						
				</div>
				
				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="#" class="fa fa-google-plus solo"><span>Google +</span></a></li>
							<li><a href="#" class="fa fa-twitter solo"><span>Twitter</span></a></li>
							<li><a href="#" class="fa fa-facebook solo"><span>Facebook</span></a></li>
							<li><a href="#" class="fa fa-github solo"><span>Github</span></a></li>
							<li><a href="#" class="fa fa-envelope solo"><span>Email</span></a></li>
						</ul>
				
				</div>
			
			</div>

		<!-- Main -->
			<div id="main">
			
				<!-- Intro -->
					<section id="top" class="one">
						<div class="container">

							<img class="image featured" src="images/pic01.jpg" alt="" /> <header id="titulo">Ejercicio de Gamificación</header>

							<header>
								<h2 class="alt">Con esta herramienta de requisitos se pretende 
								crear un ejemplo de <strong>Gamificación</strong> aplicado 
								a las herramientas de desarrollo software.</h2>
							</header>
							
							<p>Ésta es una herramienta desarrollada por un estudiante de ingeniería informática de
							la Universidad Carlos III de Madrid para la asignatura Equipos Virtuales y sirve únicamente 
							a modo de ejemplo introductorio de la <strong>gamificación</strong> en las herramientas de desarollo 
							software y no está diseñada para ser plenamente funcional.</p>

							<footer>
								<a href="#portfolio" class="button scrolly">Ir a Requisitos</a>
							</footer>

						</div>
					</section>
					
				<!-- Requisitos -->
					<section id="portfolio" class="two">
						<div class="container">
					
							<header>
								<h2>Requisitos</h2>
							</header>
							
							<p>A continuación se muestran los requisitos descritos hata la fecha.</p>
							
							<?php
							include 'funciones.php';
							
							$sql = "SELECT * FROM requisito ORDER BY id";
							
							$recordset = $conn->query($sql);
							if($recordset === false) {
								trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
							} else {
								$rows_returned = $recordset->num_rows;
								if ($rows_returned != 0){
									$recordset->data_seek(0);
									while($row = $recordset->fetch_assoc()){
									?>
									<div class="container 6u">
										<div class="contenedorReq">
											<span class="fa fa-comment"></span>
											<?php
											//Si somos los autores, mostramos el icono de edición
											if ($row['autor'] == $_SESSION['rowUser']['user']){
												echo "<span class='fa fa-edit'></span>";
											}
											?>
											<article class="requisito">
												<form class="form" name="editReq" method="post" action="editReq.php">
													<div class="3u"><span class="fuerte">ID: </span><span class="id"><?php echo $row['id'];?></span></div> <div class="9u"><span class="fuerte">Título: </span><span class="titulo"><?php echo $row['titulo'];?></span></div>
													<div class="3u"><span class="fuerte">Prioridad: </span><span class="prioridad"><?php echo $row['prioridad'];?></span></div><div class="3u"><span class="fuerte">Impacto: </span><span class="impacto"><?php echo $row['impacto'];?></span></div> <div class="6u"><span class="fuerte">Dependencias: </span><span class="dependencias"><?php echo $row['dependencias'];?></span></div>
													<div class="12u"><span class="fuerte">Descripción: </span><span class="descripcion"><?php echo $row['descripcion'];?></span></div>
												</form>
												<div class="clear"></div>
												<div class="comment">
													<?php
													$sql2 = "SELECT * FROM comentario WHERE idrequisito = '" . $row['id'] . "'";
													
													$recordset2 = $conn->query($sql2);
													if($recordset2 === false) {
														trigger_error('Wrong SQL: ' . $sql2 . ' Error: ' . $conn->error, E_USER_ERROR);
													} else {
														$rows_returned2 = $recordset2->num_rows;
														if ($rows_returned2 != 0){
															$recordset2->data_seek(0);
															while($row2 = $recordset2->fetch_assoc()){
															?>
															<div class="comentario">
																<h4 style="margin-left:10px;font-size:14px;font-weight:bold;color:#555">
																<?php 
																//Si está resuelto mostramos un tick
																if ($row2['resuelto']){
																	echo "<span style='font-size:10px;color:green;' class='fa fa-check'></span> ";
																}
																
																//Mostramos el autor del comentario
																echo getName($row2['autor']);
																
																//Si no esta resuelto y somos los autores del requisito, podemos marcarlo como resuelto
																if (!$row2['resuelto'] && $row['autor'] == $_SESSION['rowUser']['user']){
																	?>
																	<form name="resolver" action="resolver.php" method="post">
																		<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
																		<input type="hidden" name="autor" value="<?php echo $row2['autor'];?>"/>
																		<input style="float:right;position:relative;top:-5px;left:-10px;" type="submit" value="Resuelto!">
																	</form>
																	<?php
																}
																
																?></h4>
																<p style="padding-left:20px;font-size:12px;"><?php echo $row2['contenido'];?></p>
															</div>
															<?php
															}
														}else{
															echo "No hay comentarios";
														}
													}
													$recordset2->free(); //Liberamos el resultado
													
													//Si no somos los autores del comentario, podemnos comentarlo
													if ($row['autor'] != $_SESSION['rowUser']['user']){
													?>
														<a class="showAddComment">A&ntildeadir Comentario</a>
														<div style="display:none;" class="commentReq" >
															<form name="commentReq" method="post" action="comment.php">
																<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
																<textarea class=".addComment" name="addComment" rows="5" style="resize: none; width:100%" maxlength="350" placeholder="Comentario" required></textarea>
																<input style="float:right;position:relative;top:-30px;left:-2px;" type="submit" value="Comentar">
															</form>
														</div>
													<?php 
													}
													?>
												</div>
												<div class="clear"></div>
											</article>
											
										</div>							
									</div>
									<?php
									}
								}
							}
							$recordset->free(); //Liberamos el resultado
							?>
							<div class="clear"></div>
							<a id="btnAdd" class="button add">Añadir un Requisito</a>
							
							<div id="addReq">
								<article class="requisito">
									<form name="newReq" method="post" action="addReq.php">
										<div class="3u"><span class="fuerte">ID: </span><input type="text" name="id" size="10" maxlength="10" required></input></div> <div class="9u"><span class="fuerte">Título: </span><input type="text" name="titulo" size="50" maxlength="50" required></input></div>
										<div class="3u"><span class="fuerte">Prioridad: </span><input type="number" name="prioridad" min="0" style="width:70px;" required></input></div><div class="3u"><span class="fuerte">Impacto: </span><input type="number" name="impacto" min="0" style="width:70px;" required></input></div> <div class="6u"><span class="fuerte">Dependencias: </span><input type="text" name="dependencias" size="30" maxlength="150"></div>
										<div class="descripcion"><span class="fuerte">Descripción: </span><textarea name="descripcion" rows="5" style="resize: none;" maxlength="350" required></textarea></div>
										<div class="modificar"></div><div class="comentar"></div>
										<input style="float:right;position:relative;top:-30px;left:-2px;" type="submit" value="A&ntilde;adir">
									</form>
								</article>
							</div>

						</div>
					</section>

				<!-- Leaderboard -->
					<section id="about" class="three">
						<div class="container">

							<header>
								<h2>Leaderboard</h2>
							</header>
							
							<p>A continuación se muestra una tabla con la <strong>clasificación</strong> del Top10 de usuarios.</p>
							
							<div id="clasificacion">
								<div id="nombre" class="9u">
									<p>Nombre</p>
								</div>
								<div id="puntos" class="3u">
									<p>Puntos</p>
								</div>
								<?php 
								$sql = "SELECT user, nombre, apellido, puntos FROM usuario ORDER BY puntos DESC limit 10";
							
								$recordset = $conn->query($sql);
								if($recordset === false) {
									trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
								} else {
									$rows_returned = $recordset->num_rows;
									if ($rows_returned != 0){
										$recordset->data_seek(0);
										while($row = $recordset->fetch_assoc()){
										?>
										<div class="nombre 9u">
											<p <?php if($row['user']==$_SESSION['rowUser']['user']){echo "style='font-weight:bold'";}?>><?php echo $row['nombre'] . " " . $row['apellido'];?></p>
										</div>
										<div class="puntos 3u" >
											<p <?php if($row['user']==$_SESSION['rowUser']['user']){echo "style='font-weight:bold'";}?>><?php echo $row['puntos'];?></p>
										</div>
										<?php
										}
									}
								}
								$recordset->free(); //Liberamos el resultado
								?>
							</div>
							
							<div id="leaderboard">
							</div>

						</div>
					</section>
			
				<!-- Logros -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Logros</h2>
							</header>
							
							<p style="margin-bottom:2em">Logros desbloqueados:</p>
							<?php 
							$sql = "SELECT * FROM logrouser WHERE idUser='" . $_SESSION['rowUser']['user'] . "'";
						
							$recordset = $conn->query($sql);
							if($recordset === false) {
								trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
							} else {
								$rows_returned = $recordset->num_rows;
								if ($rows_returned != 0){
									$recordset->data_seek(0);
									while($row = $recordset->fetch_assoc()){
									$sql2 = "SELECT * FROM logro WHERE id=" . $row['idLogro'];
									$recordset2 = $conn->query($sql2);
									$recordset2->data_seek(0);
									$row2 = $recordset2->fetch_assoc()
									?>
									<div class="logro">
										<h4><img src="images/Logros/<?php echo $row['idLogro']?>.png"  alt="<?php echo $row2['titulo']?>" height="50" width="50"><span><?php echo $row2['titulo']?></span></h4>
										<div><p><?php echo $row2['descripcion']?></p></div>
									</div>
									<?php
									$recordset2->free();
									}
								}
							}
							$recordset->free(); //Liberamos el resultado
							?>
							<div style="margin-bottom:2em" class="clear"></div>
						</div>
					</section>
			
			</div>

		<!-- Footer -->
			<div id="footer">
				
				<!-- Copyright -->
					<div class="copyright">
						<p>Design: &copy; 2013 Jane Doe. All rights reserved. <a href="http://html5up.net">HTML5 UP</a></p>
					</div>
				
			</div>

	</body>
</html>