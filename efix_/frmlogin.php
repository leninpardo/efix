<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title> efix</title>
		<link rel="stylesheet" type="text/css" href="web/themes/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="web/themes/css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" type="text/css" href="web/themes/font-awesome/css/font-awesome.min.css" />
		
		<link rel="stylesheet" type="text/css" href="web/themes/css/w8.min.css" />
		<link rel="stylesheet" type="text/css" href="web/themes/css/w8-responsive.min.css" />
		<link rel="stylesheet" type="text/css" href="web/themes/css/w8-skins.min.css" />
		<link rel="stylesheet" type="text/css" href="web/themes/css/main.css" />

		<script type="text/javascript" src="web/js/jquery-1.7.1.min.js"></script>
		<link href="web/images/icon.ico" type="image/x-icon" rel="shortcut icon" />
		<!--<script type="text/javascript" src="web/js/index.js"></script>-->
<!--		<script type="text/javascript" src="web/js/login.js"></script>-->
	</head>
	
	<body class="navbar-fixed">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a href="javascript:" class="brand">
                        <small>
                            <i class="icon-unlock-alt"></i>
                            EFIX
                        </small>
                    </a><!--/.brand-->
                    
                </div>
            </div>
        </div>
        <div class="container-fluid" id="main-container">
                        
                        <div class="clearfix">
                        
                    <div class="row-fluid" id="contenido">
                        <!--PAGE CONTENT BEGINS HERE-->

                                <div class="row-fluid">
            <div class="span3"></div>
            <div class="span6" id="login_2">
                <h1>Inicio de Sesión</h1>
                <form id="frmperfil" name="frmperfil" method="post"  action="process.php" class="form-horizontal">                                   
                    <div class="control-group">
                        <label class="control-label">Usuario:</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="text" class="input-xlarge" autofocus id="login" name="login" />
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Clave:</label>
                        <div class="controls">
                            <div class="input-append">
                                <input type="password" class="input-xlarge" id="clave" name="clave" />
                            </div>
                        </div>
                    </div>
                    <div class="controls">
                        <button type="submit" class="btn btn-success" name="submit" id="submit">Ingresar</button>
                        <button type="reset" class="btn" name="reset" id="reset" onclick="$('#usuario').focus()">Limpiar</button>
                    </div>
                </form>            
            </div>
            <div class="span3" ><?php if($_GET['msg']!=null){echo "<p style='background:red;'>Error al ingresar/usuario o clave incorrectos</p>";} ?></div>
        </div>          
                    </div>
                        </div>
        </div>
		<center>
			<div id="foot">
				<div class="footer fsm fwn fcg ">
                                Derechos Reservados &copy;EFIX  <?php echo date('Y'); ?>
				  
			   </div>
			</div>
		</center>
		<div id="dialog" style="font-size:15px;"></div>
		<script type="text/javascript" src="web/js/bootstrap.min.js"></script>
	</body>
</html>
