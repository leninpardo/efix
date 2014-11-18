<?php

define('FPDF_FONTPATH','font/');
include("comunes2.php");

require_once '../model/reporte.php';
$reporte=  new reporte();
   $id=$_GET['id'];
 $r=$reporte->getList("vista_historial_productor where dni=$id");
	 $header=$reporte->getHead("vista_historial_productor");
	 $title="HISTORIAL DEL PRODUCTOR ".$r[0][1];
	 $w=array(0,0,18,20,20,13,20,11,11,14,17,12,12,12,15,12,13,12,13,22);
$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();

//Nombre del Listado
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B','U',16);
$pdf->SetY(20);//mover al titulo en orientacion a Y
$pdf->SetX(100);//mover al titulo en orientacion a X
$pdf->MultiCell(75,7,$title,0,1,'C',false);//titulo


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
    if($i>1)
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
       if($key>1)
     $pdf->Cell($w[$key],5,$val[$key],'LRTB',0,'L');
       
   }
  $pdf->Ln();
 }
 
$pdf->Output();

?> 

<?php
include("log.php");
?>


