<?php
require_once('Main.php');
class Grilla 
{
  protected $data=array();
   function asign($titulo,$controller,$cabecera,$rows,$p,$pag,$query,$view,$imprimir=false)
    {
	    $objtotal = new Main();        
        $this->data['total'] = $objtotal->getnum();
		$this->data['titulo']=$titulo;
        $this->data['cabecera'] = $cabecera;
        $this->data['rows'] = $rows;
        $this->data['query'] = $query;
        $this->data['view'] = $view;
        $this->data['imprimir'] = $imprimir;
        $this->data['controller'] = $controller;
        $this->data['pag'] = $pag;
        $this->p=$p;
	   return $this->_render();
    }
	function _render()
	{
	$grilla="";
	$grilla.=$this->_header();
    $grilla.=$this->_body();
	$grilla.=$this->_footer();
	$grilla.=$this->_paginador();
	return $grilla;
	
	}
	 function _header()
	{
	$html="";
	$html.="<div id='divBloqueador'></div>";
	$html.="<div id='breadcrumbs' align='center'>". ucwords($this->data['titulo'])."</div>";
	$html.="<div id='page-content'>";
	$html.="<div class='row-fluid'>";
	$html.="<div class='span12 text-center'><div class='input-append'>";
    $html.="	<input type='hidden' name='c' id='c' value=".$this->data['controller']." />";
    $html.="   <input type='hidden' name='p' id='p' value='1' />";
    $html.="   <input  placeholder='Buscar...' name='q' id='q' class='ui-autocomplete-input' autocomplete='off' aria-autocomplete='list' aria-haspopup='true' class='input-xxlarge' /><button type='submit' class='btn btn-success' name='_buscar' id='_buscar' ><i class='icon-search'></i> Buscar</button>";
    if($_SESSION['insertar']==1){
    $html.="<button type='button' class='btn' onclick=\"paginacion('controller=".$this->data['controller']."&action=create');\"><i class='icon-edit'></i> Nuevo</button>";
   }
    //$html.="<button type='button' class='btn btn-light' onclick= 'imprimir(this.form);'><i class='icon-th-list'></i> Reporte</button>";
    $html.="</div></div></div>";
	return $html;
	}
	 function _body()
	{
             $i=0;
             $item=  $this->p;
             if($item>1){$item=(($item-1)*10)+1;}
	  $html="<div class='row-fluid'><div class='span12'><table class='table table-hover table-striped table-bordered'>";
      $html.="<tr>";
	   foreach($this->data['cabecera'] as $t)
	    {
               $i++;
               
	     $html.="<th><a href='javascript:void(0);'  class='order' id='Order".$t."' onclick=\"_order('".$t."','controller=".$this->data['controller']."');\">".$t."</a></th>";
            }
	   if( $this->data['view']){$html.=" <th width='50px'>".'Ver'."</th>";}
	   if( $this->data['imprimir']){$html.=" <th width='50px'>".'Imprimir'."</th>";}
       if($_SESSION['editar']==1){ $html.=" <th width='50px'>".'Editar'."</th>";}
	   if($_SESSION['delete']==1){ $html.=" <th width='40px'>".'Eliminar'."</th>";}
	   $html.="</tr>";
	   $c=0;
	   if($this->data['query']==0)
		  {
			$r=count($this->data['cabecera']);
			$html.="<td colspan='".$r."' align='center'>&nbsp;&nbsp;la consulta no obtuvo resultados</td>";
		 }
		// $html.=" <tbody >";
       foreach($this->data['rows'] as $val)
       {
          $c++;
         
		  $html.= "<tr class='_tr'
          onMouseOver=\"this.style.backgroundColor='#CCC';this.style.cursor='pointer';\"  onMouseOut=\"this.style.backgroundColor='#F5F5F5'\"o\"];\">";
		   foreach($this->data['cabecera'] as $key=>$t)
		   {
		     if($key==0){$html.="<td onClick=\"_ver('index.php?controller=".$this->data['controller']."&action=show&id=".$val[0]."');\" width='50px' >".$item."</td>";}
			  else if($key==1)
	           {
	              $html.="<td onClick=\"_ver('index.php?controller=".$this->data['controller']."&action=show&id=".$val[0]."');\">&nbsp;&nbsp;".utf8_encode($val[$key])."<input type='hidden' id='cod$val[0]' name='cod$val[0]'/></td>";
	           }else 
	           {
	           		$html.="<td onClick=\"_ver('index.php?controller=".$this->data['controller']."&action=show&id=".$val[0]."');\">".utf8_encode($val[$key])."</td>";
	           }
		    }
		 if( $this->data['view']){ $html.=" <td align='center'><a href=\"javascript:_ver('index.php?controller=". $this->data['controller']."&action=show&id=".$val[0]."');\" title='Ver'><img src='web/images/ver.png' border='0'></a></td>";}
		  if( $this->data['imprimir']){ $html.=" <td align='center'><a href=\"javascript:popup('index.php?controller=". $this->data['controller']."&action=_prinft&id=".$val[0]."',850,500);\" title='Ver'><img width='19px' height='19px' src='web/images/imprimir.jpg' border='0'></a></td>";}
		 if($_SESSION['editar']==1){$html.="<td align='center'><a href='javascript:void(0);'onClick=\"paginacion('controller=".$this->data['controller']."&action=_edit&id=".$val[0]."');\" title='Editar'><img src='web/images/edit.png' border='0'></a></td>";}
		 if($_SESSION['delete']==1){$html.="<td align='center' ><div id='_delete".$val[0]."''><a href='javascript:void(0);'onClick=\"eliminar('controller=".$this->data['controller']."&action=_delete&id=".$val[0]."','".$val[0]."','controller=".$this->data['controller']."');\" title='eliminar'><img src='web/images/delete.png' border='0'></a></div></td>";}
		 $html.="</tr>";
                  $item++;
		}
		// $html.=" </tbody >";
		for($i=0;$i<($this->data['total']-$c);$i++)
		{
		  $html.= "<tr style='border-bottom:1px solid #666; background:#F5F5F5' 
         onMouseOver=\"this.style.backgroundColor='#CCC';this.style.cursor='pointer';\" onMouseOut=\"this.style.backgroundColor='#F5F5F5'\"o\"];\">";
		   foreach($this->data['cabecera'] as $t)
	       {
	         $html.="<td>&nbsp;</td>";
		   }
		   if($this->data['view']){ $html.="<td>&nbsp;</td>";}
		   if($this->data['imprimir']){ $html.="<td>&nbsp;</td>";}
		   if($_SESSION['editar']==1){ $html.="<td>&nbsp;</td>";}
		   if($_SESSION['delete']==1){ $html.="<td>&nbsp;</td>";}
		   $html.="</tr>";
		}
		return $html;
	}
   function _footer()
	{
	  $html="</table></div></div></div>";
	  return $html;
	}
	 function _paginador()
	{
	  return $this->data['pag'];
	}

}
?>