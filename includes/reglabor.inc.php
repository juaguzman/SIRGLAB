<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg_cord = "";
$error_msg_lab ="";

if (isset($_POST['nomlab'], $_POST['desc'],$_POST['sede'], $_POST['cord']))
{
    $noml = filter_input(INPUT_POST, 'nomlab', FILTER_SANITIZE_STRING);
    $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
    $sede = filter_input(INPUT_POST, 'sede', FILTER_SANITIZE_STRING);
    $cord = filter_input(INPUT_POST, 'cord', FILTER_SANITIZE_NUMBER_INT);
    $noml = ucwords(strtolower($noml));
    
    if(empty($cord))
    {
      $error_msg_cord = '<p class="error">Seleccione un cordinador de laboratorio</p>';  
    }
    
    $prep_stmt = "SELECT nombre FROM laboratorios where nombre = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) 
        {
            $stmt->bind_param('s', $noml);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) 
                {
                 // no selecciono un monitor
                $error_msg_lab= '<p class="error">El programa ya existe</p>';               

                }
        }
        
        if(empty($error_msg_lab) && empty($error_msg_cord))
        {
            
            if ($insert_stmt = $mysqli->prepare("INSERT INTO laboratorios(nombre,descripcion,sede,laboratoristas_members_id) VALUES (?, ?, ?, ?);")) 
                {
                    $insert_stmt->bind_param('ssss', $noml,$desc, $sede,$cord);
                    // Ejecuta la consulta preparada.
                    if (! $insert_stmt->execute())
                    {
                        header('Location: ../error.php?err=Registration failure: INSERT');
                    }
                    $noml=NULL;
                    $desc=NULL;
                    $sede=NULL;
                    $cord=NULL;                    
                   echo "<div id=dialog-message title=Programa> <p>Programa agregado correctamente</p></div>";
                }
            
        }
    
}