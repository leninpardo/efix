<?php 
require("fpdf2.php");
class PDF extends FPDF
{

    function Header()
    {
        $this->SetMargins(20,15,10);
        $this->SetFont('times','B',17);
        //$this->Image("../images/logo.jpg", 100, 100);
        //$this->Image("../images/logo.jpg", 20,7,51, 26);
       // $this->Image("../images/titulo.JPG",72,17,115,16);

        $this->Cell(0, 5,utf8_decode('           '), 0, 1, 'C');
	$this->Cell(0, 5, '', 0, 1, 'C');
	$this->Cell(0, 5, utf8_decode('          '), 0, 1, 'C');
	$this->SetFont('times','',13);
        $this->Cell(0, 5, '', 0, 1, 'C');
        $this->Cell(0, 5, '', 0, 1, 'C');
        $this->SetTextColor(15, 0, 0);
		
    }   
    function Footer()
    {
        
    // Pie de página
        $this->SetY(-18);
        
        $this->SetFont('Arial','',8);
        //$this->Image("../images/nota.jpg",30,260,150,14);
        $this->SetFillColor(255,255,255);
        $this->Cell(14, 7, utf8_decode(''),'',0,'C',false);
        //$this->Cell(20, 12, utf8_decode('NOTA'),'LTBR',0,'C',false);
        $this->Text(40, 250, "______________________________");
          $this->Text(40, 255, "jefe de Almacen");
       $this->Text(120, 250, "______________________________");
         $this->Text(120, 255, "Transportista/responsable");
    
        
    }
  
 
    
}
?>