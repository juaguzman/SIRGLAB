<?php

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg_prog = "";
$band = FALSE;
if (isset($_POST['category'],$_POST['text']))
{
    
 $idpro = filter_input(INPUT_POST, 'category',FILTER_SANITIZE_NUMBER_INT);  
 $mate = $_POST['text']; 
 
 $prep_stmt = "SELECT idprograma  FROM programa WHERE idprograma = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    
   
    if ($stmt) 
        {
        $stmt->bind_param('s', $idpro);
        $stmt->execute();
        $stmt->store_result(); 
        // Obtiene las variables del resultado.
        $stmt->bind_result($idprograma);
        $stmt->fetch();
 
        if (!$stmt->num_rows ==1) 
            {
            $error_msg_prog='<p class="error">Seleccione un programa</p>';
            }
        else
            {
                     foreach ($mate as $value) 
                    {
                           $value = ucwords(strtolower($value));

                          $prep_stmt = "SELECT idmaterias, nombre  FROM materias WHERE nombre = ? LIMIT 1";
                          $stmt = $mysqli->prepare($prep_stmt);


                            if ($stmt) 
                                {
                                $stmt->bind_param('s', $value);
                                $stmt->execute();
                                $stmt->store_result(); 
                                // Obtiene las variables del resultado.
                                $stmt->bind_result($idmaterias,$nombre);
                                $stmt->fetch();

                                if (!$stmt->num_rows ==1) 
                                    {
                                    /*
                                     * materia no existe se agrega y se asigna al laboratorio 
                                     */
                                    if ($insert_stmt = $mysqli->prepare("INSERT INTO materias (nombre) VALUE (?)")) 
                                            {
                                                $insert_stmt->bind_param('s', $value);
                                                // Ejecuta la consulta preparada.
                                                if (! $insert_stmt->execute())
                                                {
                                                    header('Location: ../error.php?err=Registration failure: INSERT');
                                                }
                                                $prep_stmt = "SELECT idmaterias, nombre  FROM materias WHERE nombre = ? LIMIT 1";
                                                 $stmt = $mysqli->prepare($prep_stmt);
                                                 if ($stmt) 
                                                        {
                                                        $stmt->bind_param('s', $value);
                                                        $stmt->execute();
                                                        $stmt->store_result(); 
                                                        // Obtiene las variables del resultado.
                                                        $stmt->bind_result($idmaterias,$nombre);
                                                        $stmt->fetch();

                                                        if ($stmt->num_rows ==1) 
                                                            {
                                                            if ($insert_stmt = $mysqli->prepare("INSERT INTO programa_has_matrias (programa_idprograma, materias_idmaterias) VALUES (?, ?)")) 
                                                                {
                                                                    $insert_stmt->bind_param('ss', $idpro,$idmaterias);
                                                                    // Ejecuta la consulta preparada.
                                                                    if (! $insert_stmt->execute())
                                                                    {
                                                                        header('Location: ../error.php?err=Registration failure: INSERT');
                                                                    }
                                                                    else {$band=TRUE;}
                                                                }
                                                            }

                                                         }
                                               
                                            }
                                    }
                                    /*
                                     * materia ya existe se asigna a un laboratorio
                                     */
                                    else
                                    {
                                        
                                                $prep_stmt = "SELECT idmaterias, nombre  FROM materias WHERE nombre = ? LIMIT 1";
                                                 $stmt = $mysqli->prepare($prep_stmt);
                                                 if ($stmt) 
                                                        {
                                                        $stmt->bind_param('s', $value);
                                                        $stmt->execute();
                                                        $stmt->store_result(); 
                                                        // Obtiene las variables del resultado.
                                                        $stmt->bind_result($idmaterias,$nombre);
                                                        $stmt->fetch();

                                                        if ($stmt->num_rows ==1) 
                                                            {
                                                            
                                                                     $prep_stmt = "SELECT programa_idprograma, materias_idmaterias FROM programa_has_matrias WHERE programa_idprograma = ? AND materias_idmaterias = ? LIMIT 1;";
                                                                     $stmt = $mysqli->prepare($prep_stmt);
                                                                     if ($stmt) 
                                                                            {
                                                                            $stmt->bind_param('ss', $idpro,$idmaterias);
                                                                            $stmt->execute();
                                                                            $stmt->store_result(); 
                                                                            // Obtiene las variables del resultado.
                                                                            $stmt->bind_result($programa_idprograma,$materias_idmaterias);
                                                                            $stmt->fetch();

                                                                            if ($stmt->num_rows ==1) 
                                                                                {

                                                                                 } 
                                                                             else {
                                                                                    
                                                                                    if ($insert_stmt = $mysqli->prepare("INSERT INTO programa_has_matrias (programa_idprograma, materias_idmaterias) VALUES (?, ?)")) 
                                                                                    {
                                                                                        $insert_stmt->bind_param('ss', $idpro,$idmaterias);
                                                                                        // Ejecuta la consulta preparada.
                                                                                        if (! $insert_stmt->execute())
                                                                                        {
                                                                                            header('Location: ../error.php?err=Registration failure: INSERT');
                                                                                        }
                                                                                        else {$band=TRUE;}
                                                                                    }
                                                                                  }
                                                                                 
                                                                                  }
                                                            
                                                                        
                                                                        }

                                                         }
                                            
                                    }
                                    
                                   
                                }
                                
                    }   
            }
 
        }
        
        if($band==TRUE)
        {
            echo "<div id=dialog-message title=Materias> <p>Materia(s) agregada(s) correctamente</p></div>"; 
        }
        else 
        {
             echo "<div id=dialog-message title=Materias> <p> No se Agrego las Materia(s) correctamente</p></div>";
        }
}


