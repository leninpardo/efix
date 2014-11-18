<?php

include_once('ControllerBase.php');

class cIndex extends ControllerBase {

    protected $defaultaction = 'index';
    protected $autoRoute = true;
    protected $route = array(
        //Averias
        "facultad" => "cFacultad",
        "ambiente" => "cAmbiente", //rhkg3
        "ubicacion" => "cUbicacion",
        "tipo_averia" => "cTipo_Averia",
        "incidencia" => "cIncidencia",
        "area_administrativa" => "cArea_Administrativa",
        "personal" => "cPersonal",
        "averia" => "cAveria",
        "tarea" => "cTarea",
        //Seguridad
        "modulo" => "cModulo",
        "perfil" => "cPerfil",
        "usuario" => "cUsuario",
        "reportes" => "cReportes",
        "patrimonio" => "cPatrimonio",
		       "reportes" => "cReportes",
        "Graficos"=>"cGraficos",
        "Config"=>"cConfig",
    );

    protected function init() {
        date_default_timezone_set('America/Lima');
        global $smarty;
        $smarty->assign('login', @$_SESSION['usuario']);
        $smarty->assign('menu', 'menu.tpl');
    }

    public function rights() {

        if ($this->actionName == 'indexAction')
            return true;

        if ($this->actionName == 'nuevoAction')
            return true;
        
        if ($this->actionName == 'confirmarCorreoAction')
            return true;
        //// Procesa el Login
        if ($this->actionName == 'loginAction')
            return true;
        // Muestra la pantalla de login

        if ($this->actionName == 'logoutAction')
            return true;

        // Si se ha logueado
        if (array_key_exists('usuario', $_SESSION))
            return true;

        return false;
    }

    public static function _403() {
        $url_script = $_SERVER['SCRIPT_NAME'];
        header('Location: ' . $url_script);
    }

    public function loginAction() {

        include_once('models/usuario.php');
        include_once('models/personal.php');
        //print_r($_REQUEST);
        //die();
        $obj = new Usuario();
        $obj = $obj->getAll()
                ->whereAnd('usua_estado =', 'true')
                ->whereAnd('usua_login =', strtoupper($_REQUEST['login']))
                ->whereAnd('usua_clave =', strtoupper($_REQUEST['clave']))
                ->whereAnd('estado_conectado=','1');
     //  $_REQUEST['estado_conectado']=2;
      // $obj->find($_REQUEST);
     //  $obj->estado_conectado=2;
         //$obj->update();
      

        $url_script = $_SERVER['SCRIPT_NAME'];

        if ($obj->count() == 0) {
            // NO tiene permisos de acceso
            header("Location: $url_script?error=NOT_VALID");
            die();
        }

        $usuario = $obj->get(0);
        if ($usuario->id_personal == null) {
            $usuario->id_personal = 0;
        }
        $_SESSION['usuario'] = $usuario->getFields();
        header("Location: $url_script");
    }

    private function getIpPc() {
        if ($_SERVER) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }

        return $realip;
    }

    public function logoutAction() {

        unset($_SESSION['usuario']);

        session_destroy();

        $url_script = $_SERVER['SCRIPT_NAME'];

        header('Location: ' . $url_script);
    }

    public function indexAction() {
        global $smarty;

        $mensaje = '-';
        $mensaje_registro = '-';
        $mensaje_averia = '-';
        if (array_key_exists('error', $_REQUEST)) {
            $mensaje = 'Error: usuario o clave incorrectos';
        }
        if (array_key_exists('error_registro', $_REQUEST)) {
            $mensaje_registro = 'Error: el correo ingresado ya existe';
        }
        if (array_key_exists('msgerror', $_REQUEST)) {
            $mensaje_registro = 'Error: El archivo seleccionado es invalido';
        }
        if (array_key_exists('msg', $_REQUEST)) {
            $mensaje_averia = 'Averia enviada correctamente';
        }
        if (array_key_exists('correo', $_REQUEST)) {
            $mensaje_averia = 'Se envio una correo para validar su usuario';
        }

        include_once 'models/facultad.php';
        $facultad = new Facultad();
        $facultad = $facultad->getAll()->WhereAnd('facu_estado=', 'true')->Orderby('facu_descripcion');
        $smarty->assign('facultad', $facultad);

        include_once 'models/tipo_averia.php';
        $tipo_averia = new Tipo_Averia();
        $tipo_averia = $tipo_averia->getAll()->WhereAnd('estado=', 'true');;
        $smarty->assign('tipo_averia', $tipo_averia);
        
        if (isset($_REQUEST['intranet'])) {
            if (!isset($_SESSION['usuario'])) {
                  $usuario = $_SESSION['usuario'];
            $smarty->assign('usuario', $usuario);
                $smarty->assign('mensaje', $mensaje);
                $smarty->assign('mensaje_averia', $mensaje_averia);
                $smarty->assign('mensaje_registro', $mensaje_registro);
                $smarty->assign('logeado', 'N');
                $smarty->display('home.html');
            } else {
                $usuario = $_SESSION['usuario'];
                $smarty->assign('info', 'S');
                $smarty->assign('mensaje_averia', $mensaje_averia);
                $smarty->assign('contenido', 'inicio.html');
                $smarty->display('index.html');
            }
        } else {
            if (!isset($_SESSION['usuario'])) {
                $smarty->assign('usuario', null);
                $smarty->assign('logeado', 'N');
                $smarty->assign('mensaje', $mensaje);
                $smarty->assign('mensaje_averia', $mensaje_averia);
                $smarty->assign('mensaje_registro', $mensaje_registro);
                $smarty->display('home.html');
            } else {
                
                $usuario = $_SESSION['usuario'];
                include_once 'models/incidencia.php';
                $mis_reportes = Incidencia::misReportes($usuario['usua_id']);
                
                $smarty->assign('mis_reportes', $mis_reportes);
                $smarty->assign('usuario', $usuario);
                $smarty->assign('mensaje_averia', $mensaje_averia);
                $smarty->assign('logeado', 'S');
                $smarty->display('home.html');
            }
        }
    }

    public function activarAjax() {
        return array('ok');
    }

/////NUEVOSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS

    public function nuevoAction() {
        include_once 'models/usuario.php';

        $objUSU = new Usuario();
        $objUSU = $objUSU->getAll()->WhereAnd('usua_estado=', 'true')->WhereAnd('usua_login=', $_REQUEST['correo'] . $_REQUEST['tipocorreo']);

        if ($objUSU->count()) {
            $url_script = $_SERVER['SCRIPT_NAME'];
            header('Location: ' . $url_script . '?error_registro=NOT_VALID');
        }


        $obj = new Usuario();
        $obj->usua_login = strtoupper($_REQUEST['correo'] . $_REQUEST['tipocorreo']);
        $obj->usua_clave = strtoupper($_REQUEST['clave_re']);
        $obj->usua_documeto_identidad = $_REQUEST['dni'];
        $obj->usua_apellido_paterno = $_REQUEST['apellido_paterno'];
        $obj->usua_apellido_materno = $_REQUEST['apellido_materno'];
        $obj->usua_nombres = $_REQUEST['nombres'];
        $obj->usua_direccion = '-';
        $obj->usua_telefono = '-';
        $obj->usua_estado = 'false';
        $obj->perf_id = 3;
        $obj->id_personal = 0;
        $obj->create();


        //ENVIAR CORREO

        $idmd = md5($obj->usua_id);
        
        $asunto = 'Validacion de usuario';
        $cuerpo = 'Click en el siguiente link para confirmar <br />'
                . '<a href="http://www.delycius.pe/efix/index.php/confirmarCorreo?usuario='.$idmd.'" target="_blank">Click Aqui</a>';
        $header = 'From: efixunsm@gmail.com \r\n';
        //$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/plain";

        mail(strtolower($obj->usua_login), $asunto, utf8_decode($cuerpo), $header);

//        $_SESSION['usuario'] = $obj->getFields();
        $url_script = $_SERVER['SCRIPT_NAME'];
        header('Location: ' . $url_script . '?correo');
    }

    public function averiarepAction() {
        include_once 'models/averia.php';

        $usuario = $_SESSION['usuario'];

        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], 'archivos/'.$_FILES['imagen']['name'])){
            $url_script = $_SERVER['SCRIPT_NAME'];
            header('Location: ' . $url_script . '?msgerror');
        }
        
        $obj = new Averia();
        $obj->id_incidencia = $_REQUEST['id_incidencia'];
        $obj->usua_id = $usuario['usua_id'];
        $obj->fecha_reporte = date('Y-m-d');
        $obj->hora_reporte = date('H:i:s');
        $obj->estado = 'true';
        $obj->seguimiento = 'P';
        $obj->observacion = $_REQUEST['observaiones'];
        $obj->ubic_id = $_REQUEST['ubic_id'];
        $obj->imagen = $_FILES['imagen']['name'];
        $obj->cantidad = 1;
        $obj->codigo_movil = '';
        $obj->calificacion = 0;
        $obj->codigo_patrimonial = $_REQUEST['codigo_patrimonial'];
        $obj->create();
        
        $url_script = $_SERVER['SCRIPT_NAME'];
        header('Location: ' . $url_script . '?msg');
        
    }
    
    public function confirmarCorreoAction(){
        if(isset($_REQUEST['usuario'])){
            
            $usuario = $_REQUEST['usuario'];
            
            include_once 'models/usuario.php';
            
            $usuarios = new Usuario();
            $usuarios = $usuarios->getAll()->WhereAnd('md5(cast(usua_id as text)) = ', $usuario);
            
            if ($usuarios->count() > 0){
                
                $usuarios = $usuarios->get(0);
                $usuarios->usua_estado = 'true';
                $usuarios->update();
                
                $url_script = $_SERVER['SCRIPT_NAME'];
                header('Location: ' . $url_script);
            }else{
                die('ERROR el usuario no existe');
            }
            
        }else{
            die('ERROR en la validacion');
        }
    }
}

?>
