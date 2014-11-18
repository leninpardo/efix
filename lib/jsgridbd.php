<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class jsGridBd{
    
    var $pagina;
    var $numRowsPagina;
    var $condicionGrilla;
    var $columnaId;
    var $condicionesAnd = array();
    var $condicionesOr = array();
    var $sqlSelect = null;
    var $sqlWhere = null;
    var $sqlOrder = null;
    var $sqlfrom = null;
    var $sqlOrderDefault = null;
    var $sql;
    var $sqlTotal;
    var $sqlCount;
    var $columnas = array();
    var $countRows;
    var $totalPaginas;
    
    var $datosFooter = array();
    var $groupBySql = "";
    
    //$dato = array('Columna'=>'nombre','Tipo'=>'T(texto),S(suma)','Dato'=>'valor','Condicion'=>'valor')
    
    public function addDatosFooter($dato){
        $this->datosFooter[] = $dato;
    }
    
    public function setSelect($sql){
        $this->sqlSelect = $sql;
    }
    public function setWhere($sql){
        $this->sqlWhere = " ".$sql;
    }
    public function setGroupBy($sql){
        $this->groupBySql = " ".$sql;
    }
    public function setOrder($sql){
        $this->sqlOrder = $sql;
    }
    public function setFrom($sql){
        $this->sqlfrom = $sql;
    }
    
    var $exporOper = null;
    
    var $opcionesPdf = null;
    
    var $ValCell = array();
    
    /*
        Paramcell array('nom_col'=>'estado','valores'=>array('A'=>'Activo','I'=>'Inactivo'))
     
     */
    
    public function valCell($Paramcell){
        $this->ValCell[] = $Paramcell;
    }


    public function setOpcionesPdf($parametros){
        $this->opcionesPdf = $parametros;
    }
    
    public function setParametros($parametros){

        if(!$parametros['sidx']) $parametros['sidx'] =1;

        $this->pagina = $parametros['page'];
        $this->numRowsPagina = $parametros['rows'];
        $this->condicionGrilla = $this->getCondicion($parametros['_search'],$parametros);
        $this->addOrderBy($parametros['sidx'], $parametros['sord']=='asc');
        
        if (isset ($parametros['oper'])){
            $this->exporOper = $parametros['oper'];
        }else{
            $this->exporOper = null;
        }

    }

    private function addOrderBy($columna,$sort){
        
        $s = $sort==true?' asc ':' desc ';
        
        $this->sqlOrderDefault = $columna.$s;
    }
    
    function prepareJSON($input) {

        //This will convert ASCII/ISO-8859-1 to UTF-8.
        //Be careful with the third parameter (encoding detect list), because
        //if set wrong, some input encodings will get garbled (including UTF-8!)
        $imput = mb_convert_encoding($input, 'UTF-8', 'ASCII,UTF-8,ISO-8859-1');

        //Remove UTF-8 BOM if present, json_decode() does not like it.
        if(substr($input, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) $input = substr($input, 3);

        return $input;
        }

    private function getCondicion($search,$params){

        if ($search == 'true'){

            if(!isset ($params['filters'])){

                return $this->AgregarCondicion($params['searchField'],$params['searchString'],$params['searchOper'],'AND');
                
            }else{
                if(get_magic_quotes_gpc()){
                $d = stripslashes($params['filters']);
                }else{
                $d = $params['filters'];
                }

                $filtro = json_decode($this->prepareJSON($d));
//                $filtro = json_decode($params['filters']);
                
                $and_or = $filtro->groupOp;
                
                $reglas = $filtro->rules;
                
                foreach ($reglas as $value ) {
                    $this->AgregarCondicion($value->field,$value->data,$value->op,$and_or);
                }
                
            }
        }
        
    }
    
    private function AgregarCondicion($campo,$dato,$operacion,$tipo){
        $wh = "";
                
        $qopers = array(
                          'eq'=>" = ",
                          'ne'=>" <> ",
                          'lt'=>" < ",
                          'le'=>" <= ",
                          'gt'=>" > ",
                          'ge'=>" >= ",
                          'bw'=>" like ",
                          'bn'=>" not like ",
                          'in'=>" in ",
                          'ni'=>" not in ",
                          'ew'=>" like ",
                          'en'=>" not like ",
                          'cn'=>" like " ,
                          'nc'=>" not like " );
        
//        $field = "upper(".$params['searchField'].")";
//        $op = $params['searchOper'];
//        $text = strtoupper($params['searchString']);
        
        $text = strtoupper($dato);
        
        if (is_date($text) || es_numero($text,$campo)){
            $field = $campo;
            $operacion = "eq";
        }else{
            $field = "upper(".$campo.")";
        }
        
        $op = $operacion;
        $cond = $qopers[$op];

        switch ($op) {
            case 'bw':
            case 'bn':
                $text = es_numero($text,$campo)?$text:"'%".$text."%'";
                $wh = $field.$cond.$text;
                break;
            case 'ew':
            case 'en':
                $text = es_numero($text,$campo)?$text:"'%".$text."'";
                $wh = $field.$cond.$text;
                break;
            case 'cn':
            case 'nc':
                $text = es_numero($text,$campo)?$text:"'%".$text."%'";
                $wh = $field.$cond.$text;
                break;
            case 'in':
            case 'ni':
                $text = es_numero($text,$campo)?$text:" (".$text.")";
                $wh = $field.$cond.$text;
                break;
            default:
                $text = es_numero($text,$campo)?$text:"'".$text."'";
                $wh = $field.$cond.$text;
                break;
        }
        
        if ($tipo == 'AND')
            $this->addWhereAnd($field.$cond, $text);
        else
            $this->addWhereOr($field.$cond, $text);
        
        return $wh;
    }

    public function setColumnaId($columnaId){
        $this->columnaId = $columnaId;
    }

    public function addWhereAnd($property,$value=null)
    {
        $this->condicionesAnd[] = $property.$value;
    }

    public function addWhereOr($property,$value=null)
    {
        $this->condicionesOr[] = $property.$value;
    }

    public function to_json(){

        $sqlWhereOrAux = '';
        $op = '';
        
        if ($this->sqlWhere == null)
            $this->sqlWhere = '';
                
        foreach ($this->condicionesOr as $value) {
            $sqlWhereOrAux = $value.$op.$sqlWhereOrAux;
            $op = ' or ';
        }
        
        $sqlWhereAndAux = '';
        $op = '';
        
        foreach ($this->condicionesAnd as $value) {
            $sqlWhereAndAux = $value.$op.$sqlWhereAndAux;
            $op = ' and ';
        }
        
        if (strlen(trim($sqlWhereAndAux)) > 0 && strlen(trim($this->sqlWhere)) > 0){
            $sqlWhereAndAux = $sqlWhereAndAux.' and';
        }
        
        if (strlen(trim($sqlWhereOrAux)) > 0 && (strlen(trim($sqlWhereAndAux)) > 0 || strlen(trim($this->sqlWhere)) > 0)){
            $sqlWhereOrAux = ' ('.$sqlWhereOrAux.') and';
        }
        
        $where = $sqlWhereOrAux.$sqlWhereAndAux.$this->sqlWhere;
        
        if (strlen(trim($where)) > 0){
            $where = ' where '.$where;
        }

        if ($this->sqlOrderDefault == null)
            $this->sqlOrderDefault = '';
        if ($this->sqlOrder == null)
            $this->sqlOrder = '';
        
        if (strlen(trim($this->sqlOrderDefault)) > 0 && strlen(trim($this->sqlOrder)) > 0){
            $this->sqlOrderDefault = $this->sqlOrderDefault.', ';
        }
        
        $order = $this->sqlOrderDefault.$this->sqlOrder;
        
        if (strlen(trim($order)) > 0){
            $order = ' order by '.$order;
        }
        
        $groupBy = "";
        
        if (strlen(trim($this->groupBySql)) > 0){
            $groupBy = " group by ".$this->groupBySql;
        }
        
        $this->sqlCount = 'select count(*) as cantidad from '.$this->sqlfrom.$where;
        $this->sql = ' select '.$this->sqlSelect.' from '.$this->sqlfrom.$where.$groupBy.$order.'  limit '.$this->numRowsPagina.'  offset ?';
        $this->sqlTotal = ' select '.$this->sqlSelect.' from '.$this->sqlfrom.$where.$groupBy.$order;
        //die($this->sqlCount);
        if ($this->exporOper == null){
        
                $offset = ($this->pagina - 1) * $this->numRowsPagina;

                $resultado = ORMConnection::Execute($this->sql,array($offset));
                $resultadoCount = ORMConnection::Execute($this->sqlCount);


                if(isset($resultadoCount[0]['cantidad']))
                    $this->countRows = $resultadoCount[0]['cantidad'];
                else $this->countRows=0;

                if( $this->countRows >0 ) {
                    $this->totalPaginas = ceil($this->countRows/$this->numRowsPagina);
                } else {
                    $this->totalPaginas = 0;
                }
                
                include_once 'grilla.php';
                $responce = new grilla();
                $responce->page = $this->pagina;
                $responce->total = $this->totalPaginas;
                $responce->records = "".$this->countRows."";

                $i=0;

                foreach ($resultado as $key){

                    $idT = $this->columnaId;

                    $responce->rows[$i]['id']=$key[$idT];

                    $data = array();

                    foreach ($key as $c => $value) {

                        if ($idT != $c){

                            $index = $this->existeValue($c);

                            if ($index >= 0){
                                $data[] = $this->getValuesEq($index, $value);
                            }else{
                                $data[] = $value;
                            }
                        }

                    }

                    $responce->rows[$i]['cell']=$data;
                    $i++;

                }
                
                if (count($this->datosFooter) > 0){
                    
                    for ($index1 = 0; $index1 < count($this->datosFooter); $index1++) {
                        $dato = $this->datosFooter[$index1];
                        
                        if ($dato['Tipo'] == 'T'){
                            $responce->userdata[$dato['Columna']] = "<span style='color:blue;'>".$dato['Dato']."</span>";
                        }
                        if ($dato['Tipo'] == 'S'){
                            
                            $cond = "";
                            
                            $miwhere = $where;                            
                                    
                            if (strlen(trim($dato['Condicion'])) > 0){
                                if (strlen(trim($miwhere)) > 0)
                                    $cond = " and ".$dato['Condicion'];
                                else
                                    $cond = $dato['Condicion'];
                            }
                            
                            $sql ="select sum(".$dato['Dato'].") as suma from ".$this->sqlfrom.$miwhere.$cond;
                            
                            $rst = ORMConnection::Execute($sql);

                            $v = '0';
                            if(isset($rst[0]['suma']))
                            $v = $rst[0]['suma'];
                
                            $v = round(floatval($v), 2);
                            
                            
                            
//                            $a = new NumberFormatter("es-PE", NumberFormatter::DECIMAL); 
                            $v = number_format($v, 2, '.', ',');

                            $responce->userdata[$dato['Columna']] = "<span style='color:red;'>".$v."</span>";
                        }
                        
                    }
                    
                }
                
                // return the formated data
                //echo $json->encode($responce);
                echo json_encode($responce);
        }else{
            
            $resultado = ORMConnection::Execute($this->sqlTotal);
            
            $responce = array();
            
                foreach ($resultado as $key){

                    $idT = $this->columnaId;

                    $data = array();
                    
                    $col = array();
                    
                    foreach ($key as $c => $value) {

                        if ($idT != $c){

                            $index = $this->existeValue($c);

                            if ($index >= 0){
                                $data[] = $this->getValuesEq($index, $value);
                            }else{
                                $data[] = $value;
                            }
                            $col[] = array('Titulo'=>$c,'Nombre'=>$c,'Ordenado'=>'');
                        }
                    }
                            
                    $responce[]=$data;

                }
                
            $this->columnas = $col;
            
            switch ($this->exporOper){
                case 'pdf':
                    
                    include_once 'pdf.php';

                    $pdf = new pdf();
                    
                    if ($this->opcionesPdf != null){
                        $pdf->setPdfOptions($this->opcionesPdf);
                    }
                    
                    
                    
                    $pdf->exportToPdf($responce, $this->columnas);
                    break;
                    
                case 'excel':
                    
                    include_once 'excel.php';
                    
                    $excel = new excel();
                    
                    $excel->exportToExcel($responce, $this->columnas);
                    break;
                    
            }
            return false;
        }

    }

    private function getValuesEq($idx,$val){
        
        $values = $this->ValCell[$idx]['valores'];
        
        $result = $val;
        
        foreach ($values as $key => $value) {
            if ($key == $val){
                $result = $value;
                break;
            }
        }
        
        return $result;
    }


    private function existeValue($col){
        $long = count($this->ValCell);
        
        $result = -1;
        
        for ($index = 0 ; $index < $long ; $index++){            
            if ($this->ValCell[$index]['nom_col'] == $col){                
                $result = $index;
                break;
            }
        }
        
        return $result;
    }
    
}

?>

