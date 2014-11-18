<?php

define('FPDF_FONTPATH','font/');
include("comunes2.php");

require_once '../model/reporte.php';
$reporte=  new reporte();
   $id=$_GET['id'];
  $table= utf8_decode($_GET['table']);
  switch ($table)
  {
  case 'salida':$sql="vista_trazabilidad_salida";$sql1="vista_trazabilidad_salida where idsalida=$id";
  $w=array(15,100,70,50);
            break;
  case 'proceso':$sql="vista_proceso_trazabilidad";
      $sql1="vista_proceso_trazabilidad where idproceso=$id";
  $w=array(15,100,70,50);
            break;
        
        
  }
 $r=$reporte->getList($sql1);
	 $header=$reporte->getHead($sql);
	 $title="Trazabilidad por ".$table;
	 
$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();

//Nombre del Listado
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B','U',16);
$pdf->SetY(30);//mover al titulo en orientacion a Y
$pdf->SetX(120);//mover al titulo en orientacion a X
$pdf->MultiCell(75,7,$title,0,1,'C',false);//titulo
$pdf->Cell(0,0.1,'',1,1,'C',false); //Titulo
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,'FECHA : '.date('d/m/Y'),0,1,'R',false); //Titulo
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
{
    if($i>0)
	$pdf->Cell($w[$i],5,$header[$i],1,0,'C',1);
}
	/* el 5 es para el ancho*/
    $pdf->Ln();
    $pdf->SetFont('Arial','',9);
foreach($r as $val)
 {
 $pdf->SetX(5);
   foreach($header as $key=>$c)
   {
       if($key>0)
     $pdf->Cell($w[$key],5,$val[$key],'LRTB',0,'L');
       
   }
  $pdf->Ln();
 }
 
$pdf->Output();

?> 

<?php
include("log.php");
?>


