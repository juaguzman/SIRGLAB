<?php

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

if (isset($_POST['cedula']))
{
    
 $cedu = filter_input(INPUT_POST, 'cedula',FILTER_SANITIZE_NUMBER_INT);   
 
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
 
        if ($stmt->num_rows == 1) 
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
                }
                         header('Location: ./register_success.php');  
            }
            else
            {
                $error_msg="El Monitor ya se encuentra en el sistema";
            }
            
                        
        }
        else
        {
           $error_msg="el nuero de cedula no existe en el sistema"; 
        }
 
        }
}

