<?php

define('FPDF_FONTPATH','font/');
include("comunes.php");

require_once 'model/reporte.php';
$reporte=  new reporte();
if(isset($_GET['tabla']))
{
 switch($_GET['tabla'])
 {
 
  case 'prestamo':
     $r=$reporte->getList("v_prestamo");
	 $header=$reporte->getHead("v_prestamo");
	 $title="LISTADO DE PRESTAMOS";
	 $w=array(10,50,20,20,22,35);
  break;  
	 case 'nacional':
     $r=$reporte->getList("v_prestamos_fn");
	 $header=$reporte->getHead("v_prestamos_fn");
	 $title="LISTADO DE PRESTAMOS NACIONALES";
	 $w=array(10,50,20,20,22,35);
  break; 
  case 'internacional':
     $r=$reporte->getList("v_prestamos_fi");
	 $header=$reporte->getHead("v_prestamos_fi");
	 $title="LISTADO DE PRESTAMOS INTERNACIONALES";
	 $w=array(10,50,20,20,22,20,20);
  break; 
  case 'liquidacion':
     $r=$reporte->getList("vista_liquidacion");
	 $header=$reporte->getHead("vista_liquidacion");
	 $title="LISTADO DE LIQUIDACIONES";
	 $w=array(10,50,30,30,30);
  break; 
    case 'caja':
     $r=$reporte->getList("vista_caja");
	 $header=$reporte->getHead("vista_caja");
	 $title="LISTADO DE CAJAS DE BANCOS Y CHICA";
	 $w=array(10,20,20,20,80);
  break; 
  case 'Movimiento':
     $r=$reporte->getList("vista_movimiento");
	 $header=$reporte->getHead("vista_movimiento");
	 $title="LISTADO MOVIMIENTOS DE CAJA";
	 $w=array(10,100,40,30,30);
  break;

    case 'concepto':
     $r=$reporte->getList("vista_gasto");
	 $header=$reporte->getHead("vista_gasto");
	 $title="LISTADO DE CONCEPTOS";
	 $w=array(20,50,60);
  break; 

	case 'venta':
     $r=$reporte->getList("v_venta");
	 $header=$reporte->getHead("v_venta");
	 $title="LISTADO DE VENTAS";
	 $w=array(20,30,35,18,50,40);
   break; 
    case 'parcela':
     $r=$reporte->getList("vista_parcela");
	 $header=$reporte->getHead("vista_parcela");
	 $title="LISTADO DE PARCELAS";
	 $w=array(17,50,75,50,35,20,22);
  break;
  
   case 'productor':
     $r=$reporte->getList("vista_productor");
	 $header=$reporte->getHead("vista_productor");
	 $title="LISTADO DE PRODUCTORES";
	 $w=array(10,20,55,17,15,30,30);
  break;

    case 'list-comite':
        $id=  utf8_decode($_GET['id']);
     $r=$reporte->getList("vista_productor where comite='$id'");
	 $header=$reporte->getHead("vista_productor");
	 $title="LISTADO DE PRODUCTORES";
	 $w=array(10,20,55,17,15,30,30);
  break;
  case 'list-comunidad':
        $id=  utf8_decode($_GET['id']);
     $r=$reporte->getList("vista_productor where comunidad='$id'");
	 $header=$reporte->getHead("vista_productor");
	 $title="LISTADO DE PRODUCTORES";
	 $w=array(10,20,55,17,15,30,30);
  break;
    case 'Acopio':
     $r=$reporte->getList("vista_acopio");
	 $header=$reporte->getHead("vista_acopio");
	 $title="LISTADO DE ACOPIO";
	 $w=array(15,55,25,20,20,20,20,20);
  break;  
  
  case 'cliente':
     $r=$reporte->getList("v_cliente");
	 $header=$reporte->getHead("v_cliente");
	 $title="LISTADO CLIENTES";
	 $w=array(10,30,30,40,30);
  break; 
	  case 'contrato':
     $r=$reporte->getList("vista_contrato");
	 $header=$reporte->getHead("vista_contrato");
	 $title="LISTADO CONTRATOS";
	 $w=array(10,30,60,40);
  break; 
	 case 'comite':
     $r=$reporte->getList("vista_comite");
	 $header=$reporte->getHead("vista_comite");
	 $title="LISTADO COMITES";
	 $w=array(60);
	 break;
	 case 'comunidad':
     $r=$reporte->getList("vista_comunidad");
	 $header=$reporte->getHead("vista_comunidad");
	 $title="LISTADO CLIENTES";
	 $w=array(60);
   break;  
	 case 'inspeccion':
     $r=$reporte->getList("vista_inspeccion");
	 $header=$reporte->getHead("vista_inspeccion");
	 $title="LISTADO DE INSPECCIONES";
	 $w=array(10,60,35);
   break; 
    case 'salida':
     $r=$reporte->getList("vista_salida");
	 $header=$reporte->getHead("vista_salida");
	 $title="LISTADO DE SALIDAS";
	 $w=array(15,20,35,35,35,35);
   break; 
          case 'proceso':
     $r=$reporte->getList("vista_proceso");
	 $header=$reporte->getHead("vista_proceso");
	 $title="LISTADO DE PROCESOS";
	 $w=array(10,40,35,35,35,35);
   break; 
   
     case 'entrada':
     $r=$reporte->getList("vista_entrada");
	 $header=$reporte->getHead("vista_entrada");
	 $title="LISTADO DE ENTRADAS";
	 $w=array(10,30,30,30,30,30,30);
   break; 
   
   case 'centro':
     $r=$reporte->getList("vista_centro_acopio");
	 $header=$reporte->getHead("vista_centro_acopio");
	 $title="LISTADO DE ENTRADAS";
	 $w=array(50);
   break; 
      case 'cuentasxcobrar':
     $r=$reporte->getList("v_cuentasxcobrar");
	 $header=$reporte->getHead("v_cuentasxcobrar");
	 $title="LISTADO DE ENTRADAS";
	 $w=array(10,30,50,20,20,30);
   break; 
    case 'usuario':
     $r=$reporte->getList("v_usuario");
	 $header=$reporte->getHead("v_usuario");
	 $title="LISTADO DE ENTRADAS";
	 $w=array(20,30,80);
   break; 
   case 'perfil':
     $r=$reporte->getList("vista_perfil");
	 $header=$reporte->getHead("vista_perfil");
	 $title="LISTADO DE ENTRADAS";
	 $w=array(60);
   break; 
 case 'financiera':
     $r=$reporte->getList("v_financiera");
	 $header=$reporte->getHead("v_financiera");
	 $title="LISTADO DE ENTRADAS";
	 $w=array(10,120);
         
   break; 
  default:exit(0);
 }

}else
{
exit(0);
}
$pdf=new PDF();
$pdf->titulo=$title;
$pdf->Open();
$pdf->AddPage();

//Restauracin de colores y fuentes
 $pdf->SetFillColor(224,235,255);
 $pdf->SetTextColor(0);
 $pdf->SetFont('Arial','B',11);
//Ttulos de las columnas
$pdf->SetX(10);
//Colores, ancho de lnea y fuente en negrita
$pdf->SetFillColor(154,228,174);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.2);
$pdf->SetFont('Arial','B',11);
//Cabecera

for($i=0;$i<count($header);$i++)
{
    
  if($i>0)
  {
	$pdf->Cell($w[$i],5,$header[$i],1,0,'C',1);
  }else{
     $pdf->Cell($w[$i],5,"item",1,0,'C',1); 
  }
}
	/* el 5 es para el ancho*/
    $pdf->Ln();
    $pdf->SetFont('Arial','',9);
foreach($r as $val)
 {
  
    $cont++;
 $pdf->SetX(10);
   foreach($header as $key=>$c)
   {
        
       if($key>0)
   {
     $pdf->Cell($w[$key],5,ucwords(strtolower(($val[$key]))),'LRTB',0,'L');
   }
   else{
        $pdf->Cell($w[$key],5,$cont,'LRTB',0,'L');
   }
   }
  $pdf->Ln();
 }
 
$pdf->Output("",'');

?> 

<?php
include("log.php");
?>


