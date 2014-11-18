<?php
require_once("fpdf2.php");
class PDF extends FPDF
{

//Cabecera de pgina
function Header()
{
    //Logo
    $this->Image('./logo/logo.jpg',10,8,09);
  $this->SetFont('Arial', 'B', 11);
        $this->SetY(8);
        $this->Cell(270, 5, utf8_decode('Reportes Generados a Través de COPERA'), 0, 0, 'R');
         $this->SetY(10);
        $this->Cell(120, 5, utf8_decode('Cooperativa de Servicios Múltiples Frutos de Selva'), 0, 0, 'R');
        $this->SetFont('Arial', '', 11);
        $this->SetY($this->GetY() + 5);
        $this->Cell(260, 5, date("d/m/Y H:i:s"), 0, 0, 'R');
       $this->SetY($this->GetY() + 5);
       $this->SetFont('Arial', 'B', 11);
       $this->Cell(100, 5, $this->titulo, 0, 0, 'R');
        $this->SetFont('Arial', 'B', 12);
        $this->SetY(25);
        $this->SetX(10);
    $this->Ln(25);	
}

//Pie de pgina
function Footer()
{
    $this->SetFont('Arial','',9);
	$this->SetY(-21);
	//$this->Cell(0,10,'Software Sic',0,0,'C'); //TITULO EN EL PIE
	$this->SetY(-30);
	//$this->Cell(0,10,html_entity_decode('Inscrita en el Registro Mercantil de XXXXXX Tomo 000. Folio 00. Hoja XX-00000. Inscripci&oacute;n 1&deg;'),0,0,'C');
	$this->SetY(-15);
	//$this->Cell(0,10,html_entity_decode('Codeka, inscrita con el n&uacute;mero X 00000000 ante la Oficina Espa&ntilde;ola de Patentes y Marcas.'),0,0,'C');
	$this->SetY(-12);
	$this->Cell(0,10,'Pagina '.$this->PageNo().'',0,0,'R');	
	///$this->Image('./logo/logo.jpg',60,190,170);
   
}

}

?>
