<?php

include_once('ControllerBase.php');
include_once 'models/incidencia.php';

class cReportes extends ControllerBase {

    protected $defaultaction = 'index';
    protected $model = 'incidencia';

    /**
     *  listAjax
     *  saveAjax
     *  selectAjax
     *  deleteAjax
     */
    public function indexAction() {
        $this->formAction();
    }
    
    public function averiasAction(){
        include_once 'models/tipo_averia.php';
        $tipo_averia = new Tipo_Averia();
        $tipo_averia = $tipo_averia->getAll()->WhereAnd('estado=', 'true');
        
        include_once 'models/facultad.php';
        $facultad = new Facultad();
        $facultad = $facultad->getAll()->WhereAnd('facu_estado=', 'true');
        
        global $smarty;
        $smarty->assign('tipo_averia',$tipo_averia);
        $smarty->assign('facultad',$facultad);
        $smarty->assign('links', 'links.tpl');
        $smarty->display('reportes/averias.tpl');
    }
    

    public function showAveriasAction(){
        
        include_once 'models/facultad.php';
        $datos = Facultad::datosReporte($_REQUEST['desde'],$_REQUEST['hasta'],$_REQUEST['id_tipoaveria'],$_REQUEST['facu_id'],$_REQUEST['estado']);
                ob_start();

        include 'templates/reportes/averias_facultad.php';
        //include_once 'lib/fpdf/fpdf.php';
        //$fpdf=new FPDF();
       // include_once 'lib/fpdf/comunes.php';
    }
    public function listAction()
    {
        include_once 'models/personal.php';
		  include_once 'models/tarea.php';
        $personal = new personal();
		$tarea=new tarea();
        $personal_data = $personal->datos();
        $data=array();
		$table="<table border='1'><tr><td colspan='4' rowspan='2'></td><th colspan='8'>INDICADORES</th><td></td></tr>
		<tr><th colspan='3'>Atencion</th><th colspan='4'>Efectividad</th>  </tr>
		<tr><th colspan='4'>Personal</th><th>Atendido</th><th>Proceso</th><th>Total</th> <th>Excelente</th><th>Bueno</th><th>Malo</th><th>Total</th> </tr>
		";
		$i=0;
		foreach($personal_data as $p)
		{
                  
		  $id_personal=$p['id_personal'];
		  $nombres=$p['nombres'].' '.$p["apellido_paterno"].' '.$p["apellido_materno"];
		   $table.="<tr><td colspan='4'>".$nombres."</td>";
		  $data_tarea=$tarea->getTareas($id_personal);
                  $data[$i]=$data_tarea;
		  foreach($data_tarea as $dt)
		  {
                      
		   $atendido=$dt["atendido"];
		   if($atendido==null)$atendido=0;
		   $pendiente=$dt["pendiente"];
		    if($pendiente==null)$pendiente=0;
		   $total=$atendido+$pendiente;
		   $p_a=round(($atendido*100)/$total,2);
		   $p_p=round(($pendiente*100)/$total,2);

		  $table.="<td>". $p_a."%</td>";
		  $table.="<td>".$p_p."%</td>";
		  $table.="<td>100%</td>";

		  $excelente=$dt["excelente"];

		  if($excelente==null)$excelente=0;

		  $bueno=$dt["bueno"];
		  if($bueno==null)$bueno=0;
		  $malo=$dt["malo"];
		  if($malo==null)$malo=0;
		 $total_e=$excelente+$bueno+$malo;

		 if($total_e==0)
		 {
		 $p_e=0;$p_b=0;$p_m=0;
		 }else{
		 $p_e=round(($excelente*100)/$total_e,2);
		 $p_b=round(($bueno*100)/$total_e,2);
		 $p_m=round(($malo)*100/$total_e,2);
		 }

		 $table.="<td>". $p_e."%</td>";
		 $table.="<td>". $p_b."%</td>";
		 $table.="<td>". $p_m."%</td>";
		 $table.="<td>100%</td>";
		  }
		  $table.="</tr>";
		  $i++;
		}
		echo json_encode($data);//$table."</table>";
    }
    public function efectividadAction()
	{
        $this->formAction();
	
	}
    public function tecnicoAction(){
        include_once 'models/tipo_averia.php';
        $tipo_averia = new Tipo_Averia();
        $tipo_averia = $tipo_averia->getAll()->WhereAnd('estado=', 'true');
        
        include_once 'models/personal.php';
        $personal = new Personal();
        $personal = $personal->getAll()->WhereAnd('estado=', 'true');
        
        global $smarty;
        $smarty->assign('tipo_averia',$tipo_averia);
        $smarty->assign('personal',$personal);
        $smarty->assign('links', 'links.tpl');
        $smarty->display('reportes/tecnico.html');
    }
    
    public function showAveriasTecnicoAction(){
        
        include_once 'models/personal.php';
        $datos = Personal::datosReporte($_REQUEST['desde'],$_REQUEST['hasta'],$_REQUEST['id_tipoaveria'],$_REQUEST['id_personal'],$_REQUEST['estado']);
        
        ob_start();
        include 'templates/reportes/averias_tecnico.php';
        
    }
    
    public function showAveriasGraficoAction(){
        
        include_once 'models/facultad.php';
        $datos = Facultad::datosReporteGrafico($_REQUEST['desde'],$_REQUEST['hasta'],$_REQUEST['id_tipoaveria'],$_REQUEST['facu_id'],$_REQUEST['estado']);
        
        $columnas = array();
        foreach ($datos as $value) {
            $columnas["'".$value['facu_descripcion']."'"] = $value['facu_descripcion'];
        }
        
        $columnas = array_keys($columnas);
        $columnas = implode(',', $columnas);
        
        $valores = array();
        foreach ($datos as $value) {
            
        }
        
        ob_get_clean();
        ob_start();
        include 'templates/reportes/facultad_grafico.php';
        $outputHtml = ob_get_clean();

        $grafico = array(
                "$('#container').highcharts({",
                    "title: {",
                        "text: 'Grafico averias por facultad y tipo de insidencia',",
                        "x: -20",
                    "},",
                    "xAxis: {",
                        "categories: [$columnas]",
                    "},",
                    "yAxis: {",
                        "title: {",
                            "text: 'Insidencias'",
                        "},",
                        "plotLines: [{",
                                "value: 0,",
                                "width: 1,",
                                "color: '#808080'",
                            "}]",
                    "},",
                    "tooltip: {",
                        "valueSuffix: '',valuePrefix: ''",
                    "},",
                    "legend: {",
                        "layout: 'vertical',align: 'right',verticalAlign: 'middle',borderWidth: 0",
                    "},",
                    "plotOptions: {        
                        series: {
                            marker: {
                                states: {
                                    select: {
                                        enabled: false
                                    }
                                }
                            }
                        }
                    },",
                    "series: [$series]",
                "});"
        );
        
        return $html = str_replace("{{JSGRAFICO}}", implode('', $grafico), $html);
    }



  /////////////////////////////////
     public function formAction() {
        $grilla = new jsGrid();
        $grilla->setCaption("Medicion de la efectividad");
        $grilla->setPager("pgefecitividad");
      $grilla->setTabla("lsefectividad");
       // $grilla->
        $grilla->setSortname("descripcion");
        $grilla->setUrl($_SESSION['URL_INDEX'] . "reportes/list");
        $grilla->setWidth(400);
        $grilla->setAlto(350);
        $grilla->addColumnas("descripcion", "Descripcion");
        global $smarty;
        $smarty->assign('links', 'links.tpl');
        $smarty->assign('grilla', $grilla->buildJsGrid());
        $smarty->display('reportes/efectividad.tpl');
    }

    public function listaAction() {
        $db = new jsGridBdORM();
        $db->setTabla('tipo_averia');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('id_tipoaveria');
        $db->addColumna('descripcion');
        $db->addWhereAnd("estado=", "true");
        echo $db->to_json();
    }


}

?>
