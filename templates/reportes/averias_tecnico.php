<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Averias por Tecnico</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <h3>Lista de averias por Tecnico</h3>
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
                    <b>Atendido Por</b>
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
                            <td style='font-size: 10px;'>".$value['atendedor']."</td>
                            <td style='font-size: 10px;'>".$estado."</td>
                                <td></td>
                        </tr>";
                    
                    $idx++;
                }
                
            ?>
        </table>
        
    </body>
</html>
