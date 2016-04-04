<?php

include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg_prog = "";

if (isset($_POST['nomPro'], $_POST['dirc']))
{
    $nomP = filter_input(INPUT_POST, 'nomPro', FILTER_SANITIZE_STRING);
    $dir = filter_input(INPUT_POST, 'dirc', FILTER_SANITIZE_STRING);
    $nomP = ucwords(strtolower($nomP));;

    $prep_stmt = "SELECT * FROM programa where nombre = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) 
        {
            $stmt->bind_param('s', $nomP);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) 
                {
                 // no selecciono un monitor
                $error_msg_prog= '<p class="error">El programa ya existe</p>';               

                }
        }
            else 
                {
                    $error_msg_prog .= '<p class="error">Database error line 55</p>';
               }
                if (empty($error_msg_prog)) 
                    {
                             // Inserta el nuevo usuario a la base de datos.  
                if ($insert_stmt = $mysqli->prepare("INSERT INTO programa (nombre, director) VALUES (?, ?)")) 
                {
                    $insert_stmt->bind_param('ss', $nomP,$dir);
                    // Ejecuta la consulta preparada.
                    if (! $insert_stmt->execute())
                    {
                        header('Location: ../error.php?err=Registration failure: INSERT');
                    }
                    $nomP = NULL;
                    $dir = NULL;                    
                   echo "<div id=dialog-message title=Programa> <p>Programa agregado correctamente</p></div>";
                }
 
                    }
          
        }
        
 