<?php

include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg_prog = "";

if (isset($_POST['nomP'], $_POST['dir']))
{
    $nomP = filter_input(INPUT_POST, 'nomP', FILTER_SANITIZE_STRING);
    $dir = filter_input(INPUT_POST, 'dir', FILTER_SANITIZE_STRING);
}
    $prep_stmt = "SELECT * FROM programa where nombre = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) 
        {
            $stmt->bind_param('s', $nomP);
            $stmt->execute();
            $stmt->store_result();

            if (!$stmt->num_rows == 1) 
                {
                 // no selecciono un monitor
                $error_msg_prog= '<p class="error">El programa ya existe</p>';               

                }
            else 
                {
                    $error_msg .= '<p class="error">Database error line 55</p>';
               }
                if (empty($error_msg)) 
                    {
                        // Crear una sal aleatoria.
                        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
                        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
                    }
                // Inserta el nuevo usuario a la base de datos.  
                if ($insert_stmt = $mysqli->prepare("INSERT INTO programa (nombre, director) VALUES (?, ?)")) 
                {
                    $insert_stmt->bind_param('ss', $nomP,$dir);
                    // Ejecuta la consulta preparada.
                    if (! $insert_stmt->execute())
                    {
                        header('Location: ../error.php?err=Registration failure: INSERT');
                    }
                    header('Location: ./register_success.php');
                }
        }