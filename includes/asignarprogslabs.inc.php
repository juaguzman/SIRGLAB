<?php

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";
$error_msg_prog="";
$band = FALSE;
$asignados = "";
$mensaje="";

 if(isset($_REQUEST['prog'],$_POST['labor']))
     {
     
     
       $lab = $_REQUEST['labor'];       
       $progs = $_POST['prog'];
       
       $prep_stmt = "SELECT idlaboratorios  FROM laboratorios WHERE idlaboratorios = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    
   
    if ($stmt) 
        {
        $stmt->bind_param('s', $lab);
        $stmt->execute();
        $stmt->store_result(); 
        // Obtiene las variables del resultado.
        $stmt->bind_result($idlaboratorios);
        $stmt->fetch();
 
        if (!$stmt->num_rows ==1) 
            {
            $error_msg_lab='<p class="error">Seleccione un programa</p>';
            }
       
            else
            {
                    foreach ($progs as $value) 
                    {
            
            
                     
                     $prep_stmt = "SELECT programa_idprograma, laboratorios_idlaboratorios, laboratorios.nombre, programa.nombre FROM programas_has_laboratorios, laboratorios, programa  WHERE programa.idprograma = programas_has_laboratorios.programa_idprograma AND laboratorios.idlaboratorios = programas_has_laboratorios.laboratorios_idlaboratorios AND programa_idprograma = ? AND laboratorios_idlaboratorios = ? LIMIT 1;";
                    $stmt = $mysqli->prepare($prep_stmt);

                    if ($stmt) 
                        {
                        $stmt->bind_param('ss', $value,$lab);
                        $stmt->execute();
                        $stmt->store_result();
                         $stmt->bind_result($idprograma,$idlaboratorios,$nombrel,$nombrep);
                        $stmt->fetch();

                                if ($stmt->num_rows == 1) 
                                {
                                     $error_msg_prog .='<p class="error">Programa '.$nombrep.' ya asignado</p>';  
                                }
                                else 
                                    {
                                    
                                        $prep_stmt = "SELECT nombre from programa where idprograma = ?";
                                            $stmt = $mysqli->prepare($prep_stmt);

                                            if ($stmt) 
                                                {
                                                $stmt->bind_param('s', $value);
                                                $stmt->execute();
                                                $stmt->store_result();
                                                 $stmt->bind_result($nombrep);
                                                $stmt->fetch();

                                                        if ($stmt->num_rows == 1) 
                                                        {
                                                          if ($insert_stmt = $mysqli->prepare("INSERT INTO programas_has_laboratorios(programa_idprograma,laboratorios_idlaboratorios) VALUES ( ?, ?);")) 
                                                             {
                                                                    $insert_stmt->bind_param('ss', $value,$lab);
                                                                    // Ejecuta la consulta preparada.
                                                                    if (! $insert_stmt->execute())
                                                                    {
                                                                        header('Location: ../error.php?err=Registration failure: INSERT');
                                                                    }                    
                                                                    else{$band=TRUE; $mensaje .= $nombrep.', '; }
                                                                }  
                                                        }
                                                        
                                            
                                                }
                                                 else 
                                                    {
                                                        $error_msg .= '<p class="error">Database error line 55</p>';

                                                    }
 
                                    } 
                   
            
                    }
       
        
            }
        }
        
        if($band==TRUE)
        {
             echo "<div id=dialog-message title=Laboratorio> <p>Programas asignados al laboratorio correctamente: $mensaje </p></div>";
        }
        else
        {
             echo "<div id=dialog-message title=Laboratorio> <p>No se asigno programas al laboratorio</p></div>";
        }
        }
     }