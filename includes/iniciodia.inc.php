<?php

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

if (isset($_POST['cedula'],$_POST['idlab']))
{
    
 $cedu = filter_input(INPUT_POST, 'cedula',FILTER_SANITIZE_NUMBER_INT);  
 $lab = $_POST['idlab']; 
 
 $prep_stmt = "SELECT cedula,nombres,apellidos,estado FROM monitores WHERE cedula = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    
   
    if ($stmt) 
        {
        $stmt->bind_param('s', $cedu);
        $stmt->execute();
        $stmt->store_result(); 
        // Obtiene las variables del resultado.
        $stmt->bind_result($cedula, $nombres, $apellidos, $estado);
        $stmt->fetch();
 
        if ($stmt->num_rows >0) 
            {
                $prep_stmt = "SELECT cedula,nombres,apellidos,estado FROM monitores WHERE laboratoristas_members_id = ? LIMIT 1";
                $stmt = $mysqli->prepare($prep_stmt);


                if ($stmt) 
                   {
                    $stmt->bind_param('s', $lab);
                    $stmt->execute();
                    $stmt->store_result(); 
                    // Obtiene las variables del resultado.
                    $stmt->bind_result($cedula, $nombres, $apellidos, $estado);
                    $stmt->fetch();
 
        if ($stmt->num_rows >0) 
            {
            
        
            if($estado == "fr")
            {
                 if ($insert_stmt = $mysqli->prepare("INSERT INTO mentradas (hora, fecha,monitores_cedula) VALUES (?, ?, ?)")) 
                 {
                         date_default_timezone_set("America/Bogota");
                        $hora = date("H:i:s");
                        $fecha = date("Y-m-d");
                        $insert_stmt->bind_param('sss', $hora,$fecha,$cedula);
                        // Ejecuta la consulta preparada.
                        if (! $insert_stmt->execute())
                        {
                            header('Location: ../error.php?err=Registration failure: INSERT');
                        }
                        $dn = "dn";
                        $upd = "UPDATE monitores set estado = ? where cedula = ? ";
                        
                 if ($upd_stmt = $mysqli->prepare($upd)) 
                 {
                     
                        $upd_stmt->bind_param('ss',$dn ,$cedula);
                        // Ejecuta la consulta preparada.
                        if (! $upd_stmt->execute())
                        {
                            header('Location: ../error.php?err=Registration failure: UPDATE');
                        }
                           
                            header('Location: ../register_success.php');
                   }
                }
            }
            else
            {
                $error_msg='<p class="error">El monitor ya se registro</p>';
            }
            }
            else
            {
                $error_msg='<p class="error">El monitor pertenese a otro laboratorio</p>';
            }
            
                    }
            
            
                        
        }
        else
            {
                $error_msg='<p class="error">El nuero de cedula no resgistra</p>';
            }
 
        }
}



