<?php


    $file = @$_REQUEST['file'];
    $patch = @$_REQUEST['patch'];

    $img = @$_REQUEST['img'];

    $id = @$_REQUEST['id'];
    
    $idIden = $id;
        
    if (!isset ($_REQUEST['file'])){
        echo json_encode(array('RES'=>'ERROR','MSG'=>"Error archivo no existe, o es muy grande"));
        die();
    }

    if ($id){
        $id = $id.'_';
    }else{
        $id = '';
    }

    $tempFile = $_FILES[$file]['tmp_name'];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $patch . '/';

    $res = explode('.', $_FILES[$file]['name']);

    $long = count($res);

    $ext = $res[ $long - 1 ];

    if ( strtoupper(trim($ext))  == "PHP"){
        echo json_encode(array('RES'=>'ERROR','MSG'=>"Error: Tipo de archivo no permitido [application/x-php] - [" .$_FILES[$file]['name'] ."]"));
        die();
    }

    if ( $img ){
        if ( strtoupper(trim($ext))  == "JPG" || strtoupper(trim($ext))  == "JPEG" || strtoupper(trim($ext))  == "PNG"){

        }else{
            echo json_encode(array('RES'=>'ERROR','MSG'=>"Error: Tipo de archivo permitidos para imagenes [JPG - JPEG - PNG]  - [" .$_FILES[$file]['name'] ."]"));
            die();
        }
    }
    
    $nomdoc = $idIden.'.'.$ext;
    
    $targetFile =  str_replace('//','/',$targetPath) .$nomdoc;
    
    if (move_uploaded_file($tempFile, $targetFile)) {
            
        $data = "OK";
        $msg = 'Archivo cargado';
        
    } else {

        switch ($_FILES[$file]['error'])
                {
                    case 0:
                     $msg = ""; // comment this out if you don't want a message to appear on success.
                     break;
                    case 1:
                      $msg = "The file is bigger than this PHP installation allows";
                      break;
                    case 2:
                      $msg = "The file is bigger than this form allows";
                      break;
                    case 3:
                      $msg = "Only part of the file was uploaded";
                      break;
                    case 4:
                     $msg = "No file was uploaded";
                      break;
                    case 6:
                     $msg = "Missing a temporary folder";
                      break;
                    case 7:
                     $msg = "Failed to write file to disk";
                     break;
                    case 8:
                     $msg = "File upload stopped by extension";
                     break;
                    default:
                    $msg = "unknown error ".$_FILES[$file]['error'];
                    break;
                }
            
        $data = 'ERROR';
        $msg = 'Error al guardar :' . $msg;
    }

    echo json_encode(array('RES'=>$data,'MSG'=>$msg));
//    header('Content-type: text/html');
//    echo $data;

?>
