<!DOCTYPE html>
<html>
	<head>


		<head>
		<title>Efix-Fisi</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet" />
		<link rel="shortcut icon"  href="images/icono.ico" />

		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
                <script src="js/home.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/noscript.css" />
		</noscript>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
                
	</head>
	<body class="homepage" style=" background: #77c646;">
			<div id="wrapper">
					<nav id="nav">
						<a href="#me" class="fa fa-home active"><span>Inicio</span></a>
						<a href="#work" class="fa fa-folder"><span>Archivo</span></a>
						<a href="#email" class="fa fa-envelope"><span>Contactanos</span></a>
                                                <a href="login.php" class="fa fa-android"><span>Login</span></a>
					</nav>
					<div id="main">
							<article id="me" class="panel">
								<header>
									<h1>Efix</h1>
									<span class="byline">Estrategia de Gestión de Averias </span>
								</header>
								<a href="#work" class="jumplink pic">
									<span class="arrow fa fa-chevron-right"><span>See my work</span></span>
									<img src="images/me.jpg" alt="" />
								</a>
							</article>

				
							<article id="work" class="panel">
								
									<h2>Reporte de Averías</h2>
								<p>
								</p>
								<section class="is-gallery">
									<form  action="setAveria.php" method="post" enctype="multipart/form-data">
									<div>
                                                                            <?php 
                                                                            include 'model/averia.php';
                                                                            $av=new averia();
                                                                           $data_facultad= $av->getfacultad();
                                                                            
                                                                            ?>
										<div class="row half">
											<div class="6u">
											<label for="tipoa">Tipo :</label> 
											<select id="tipoa"name="tipoa">
												<option value="1">Software</option>
												<option value="2">Redes</option>
												<option value="3">Hardware</option>
											</select>
											</div>
										</div>
										<div>
											<label for="tipof">Facultad :</label> 
											<select id="tipof" name="tipof">
											<?php
                                                                                        echo "<option value=''>::Seleccione::</option>";  
                                                                                        foreach ($data_facultad as $f)
                                                                                        {
                                                                                         echo "<option value='$f[0]'>$f[1]</option>";    
                                                                                        }
                                                                                        ?>	
											</select>
											<label for="tipoam">Ambientes :</label> 
											<select id="tipoam" name="tipoam">
												
											</select>
                                                                                      
											<label for="tipoau">Aula :</label> 
											<select id="tipoau" name="tipoau" >
											
											</select>
										</div>	

										<div class="row half">
											</br>
											<span class="button green fileinput-button"/> <span>Add foto...</span>
				                                                   <input type="file" id="nameimagen"  name="nameimagen" />
				
											
										</div>
										<div class="row half">
											<div class="12u">
												<textarea name="descripcion" id="descripcion" name="descripcion" placeholder="Descripción de la averia" ></textarea>
											</div>
										</div>
										<div class="row">
											<div class="12u">
												<input type="submit" class="button" value="Enviar" />
											</div>
										</div>
									</div>
								</form>
								</section>
							</article>

						<!-- Email -->
							<article id="email" class="panel">
								<header>
									<h2>Contactenos</h2>
								</header>
								<form action="#" method="post">
									<div>
										<div class="row half">
											<div class="6u">
												<input type="text" class="text" name="name" placeholder="Nombre" />
											</div>
											<div class="6u">
												<input type="text" class="text" name="email" placeholder="Correo" />
											</div>
										</div>
										<div class="row half">
											<div class="12u">
												<input type="text" class="text" name="subject" placeholder="Asunto" />
											</div>
										</div>
										<div class="row half">
											<div class="12u">
												<textarea name="message" placeholder="Descripción del mensaje"></textarea>
											</div>
										</div>
										<div class="row">
											<div class="12u">
												<input type="submit" class="button" value="Enviar" />
											</div>
										</div>
									</div>
								</form>
							</article>

					</div>
                            <script type="">
                                $(function(){
                                   /* $("#frm_solicitud").submit(function(){
                                      alert("hola"); 
                                    });*/
                                });
                            </script>
				<!-- Footer -->
					<div id="footer">
						<ul class="links">
							<li>&copy;EFIX</li>
		
						</ul>
					</div>
		
			</div>
         
	</body>
</html>