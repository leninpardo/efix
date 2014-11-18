<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
//error_reporting (E_ALL);
ob_start();
?>

        <h3>Lista de averias por facultad</h3>
        <div id="reporte">
        <table>
            <tr>
                <td>
                    <b>Ord.</b>
                </td>
                <td>
                    <b>Fecha Reporte</b>
                </td>
                <td>
                    <b>Fecha Atencion</b>
                </td>
                <td>
                    <b>Facultad</b>
                </td>
                <td>
                    <b>Tipo Averia</b>
                </td>
                <td>
                    <b>Incidencia</b>
                </td>
                <td>
                    <b>Cantidad</b>
                </td>
                <td>
                    <b>Reportador</b>
                </td>
                <td>
                    <b>Estado</b>
                </td>
                <td></td>
            </tr>
            
            <?php 
                $total = 0;
                $idx = 1;
                foreach ($datos as $value) {
                    $estado = '';
                    $color = '';
                    if ($value['estado'] == 'P'){
                        $estado = 'PENDIENTE';
                        $color = '242, 222, 222';
                    }
                    if ($value['estado'] == 'O'){
                        $estado = 'EN PROCESO';
                        $color = '252, 248, 227';
                    }
                    if ($value['estado'] == 'A'){
                        $estado = 'ATENDIDO';
                        $color = '223, 240, 216';
                    }
                    
                    echo "<tr style='color: rgb(68, 68, 68); background-image: none; background-color: rgb($color);'>
                            <td style='font-size: 10px;'>".$idx."</td>
                            <td style='font-size: 10px;'>".$value['fecha_reporte']."</td>
                            <td style='font-size: 10px;'>".$value['fecha_atencion']."</td>
                            <td style='font-size: 10px;'>".$value['facultad']."</td>
                            <td style='font-size: 10px;'>".$value['tipo_averia']."</td>
                            <td style='font-size: 10px;'>".$value['incidencia']."</td>
                            <td style='font-size: 10px;'>".$value['cantidad']."</td>
                            <td style='font-size: 10px;'>".$value['reportador']."</td>
                            <td style='font-size: 10px;'>".$estado."</td>
                                <td></td>
                        </tr>";
                    
                    $idx++;
                }
                
            ?>
        </table>
        </div>

      
    <?php 
  /*$content = ob_get_clean();

    require_once('lib/html_pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
         ob_end_clean(); 
        //$html2pdf->createIndex('Sommaire', 25, 12, false, true, 1);
        $html2pdf->Output('bookmark.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }*/

?>