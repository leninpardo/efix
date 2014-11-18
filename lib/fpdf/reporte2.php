<?php

define('FPDF_FONTPATH','font/');
include("comunes2.php");

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
	 $w=array(15,120,35,18,50,50);
	 
  break;  
	
	case 'venta':
     $r=$reporte->getList("v_venta");
	 $header=$reporte->getHead("v_venta");
	 $title="LISTADO DE VENTAS";
	 $w=array(20,120,35,18,50,40);
   break; 
   
   
  
    case 'parcela':
     $r=$reporte->getList("vista_parcela");
	 $header=$reporte->getHead("vista_parcela");
	 $title="LISTADO DE REGISTROS DE PARCELAS";
	 $w=array(17,50,75,50,35,20,22);
  break;
  
   case 'productor':
     $r=$reporte->getList("vista_productor");
	 $header=$reporte->getHead("vista_productor");
	 $title="LISTADO DE PRODUCTORES";
	 $w=array(17,30,50,60,40,60,30);
  break;

  
    case 'Acopio':
     $r=$reporte->getList("vista_acopio");
	 $header=$reporte->getHead("vista_acopio");
	 $title="LISTADO ACOPIO";
	 $w=array(30,88,40,30,30,30,30);
  break;  
  
  case 'cliente':
     $r=$reporte->getList("v_cliente");
	 $header=$reporte->getHead("v_cliente");
	 $title="LISTADO CLIENTES";
	 $w=array(30,30,88,70,35,30);
  break; 
	
	 case 'comite':
     $r=$reporte->getList("vista_comite");
	 $header=$reporte->getHead("vista_comite");
	 $title="LISTADO COMITES";
	 $w=array(30,30,88,88,35);
	 break;
	 case 'comunidad':
     $r=$reporte->getList("vista_comunidad");
	 $header=$reporte->getHead("vista_comunidad");
	 $title="LISTADO COMUIDADES";
	 $w=array(30,30,88,88,35);
   break;  
	 case 'inspeccion':
     $r=$reporte->getList("vista_inspeccion");
	 $header=$reporte->getHead("vista_inspeccion");
	 $title="LISTADO INSPECCIONES";
	 $w=array(20,20,50,35,20,20,30,25,30,30,20);
   break; 
    case 'salida':
     $r=$reporte->getList("vista_salida");
	 $header=$reporte->getHead("vista_salida");
	 $title="LISTADO SALIDAS";
	 $w=array(20,90,50,35,50);
   break; 
       case 'proceso':
     $r=$reporte->getList("vista_proceso");
	 $header=$reporte->getHead("vista_proceso");
	 $title="LISTADO PROCESOS";
	 $w=array(20,90,50,35,50);
   break; 
   
     case 'entrada':
     $r=$reporte->getList("vista_entrada");
	 $header=$reporte->getHead("vista_entrada");
	 $title="LISTADO PROCESOS";
	 $w=array(10,20,20,20,20,20,20);
   break; 
case 'historial-productor':
    $id=$_GET['id'];
 $r=$reporte->getList("vista_historial_productor where dni=$id");
	 $header=$reporte->getHead("vista_historial_productor");
	 $title="HISTORIAL DE PRODUCTOR";
	 $w=array(15,40,18,18,18,10,18,10,10,15,15,10,10,10,15,12,13,12);
   break;
  case 'Movimiento':
     $r=$reporte->getList("vista_movimiento");
	 $header=$reporte->getHead("vista_movimiento");
	 $title="LISTADO MOVIMIENTOS DE CAJA";
	 $w=array(20,140,40,30,30);
  break; 
//
}

}else
{
exit(0);
}
$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();

//Nombre del Listado
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B','U',16);
$pdf->SetY(30);//mover al titulo en orientacion a Y
$pdf->SetX(120);//mover al titulo en orientacion a X
$pdf->MultiCell(100,7,$title,0,1,'C',false);//titulo
//$pdf->Cell(0,0.1,'',1,1,'C',false); //Titulo
$pdf->SetFont('Arial','',7);
//$pdf->Cell(0,5,'FECHA : '.date('d/m/Y'),0,1,'R',false); //Titulo
$pdf->SetY(37);
$pdf->Ln();    
//Restauracin de colores y fuentes
 $pdf->SetFillColor(224,235,255);
 $pdf->SetTextColor(0);
 $pdf->SetFont('Arial','B',7);
//Ttulos de las columnas
$pdf->SetX(5);
//Colores, ancho de lnea y fuente en negrita
$pdf->SetFillColor(154,228,174);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.2);
$pdf->SetFont('Arial','B',8);
//Cabecera

for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],5,$header[$i],1,0,'C',1);
	/* el 5 es para el ancho*/
    $pdf->Ln();
    $pdf->SetFont('Arial','',9);
foreach($r as $val)
 {
 $pdf->SetX(5);
   foreach($header as $key=>$c)
   {
     $pdf->Cell($w[$key],5,ucwords(strtolower(utf8_decode($val[$key]))),'LRTB',0,'L');
   }
  $pdf->Ln();
 }
 
$pdf->Output();

?> 

<?php
include("log.php");
?>


