<?php

include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
$error_msg_mnt="";
$error_msg_lab="";
$error_msg_hr="";
$error_msg_prog="";

if (isset($_POST['idcord'],$_POST['idmon'], $_POST['category'], $_POST['subcategory'], $_POST['labor'], $_POST['npractica'], $_POST['docente'], $_POST['rpor']
        , $_POST['nuestud'], $_POST['nugrup'], $_POST['hinicio'], $_POST['hfin'])) 
{
    $idcor = filter_input(INPUT_POST, 'idcord', FILTER_SANITIZE_NUMBER_INT);
    $idmon = filter_input(INPUT_POST, 'idmon', FILTER_SANITIZE_NUMBER_INT);
    $prog = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
    $mate = filter_input(INPUT_POST, 'subcategory', FILTER_SANITIZE_NUMBER_INT);
    $labor = filter_input(INPUT_POST, 'labor', FILTER_SANITIZE_NUMBER_INT);
    $npractica = filter_input(INPUT_POST, 'npractica', FILTER_SANITIZE_STRING);
    $docen = filter_input(INPUT_POST, 'docente', FILTER_SANITIZE_STRING);
    $rporguia = filter_input(INPUT_POST, 'rpor', FILTER_SANITIZE_STRING);
    $nestudian = filter_input(INPUT_POST, 'nuestud', FILTER_SANITIZE_NUMBER_INT);
    $ngrup = filter_input(INPUT_POST, 'nugrup', FILTER_SANITIZE_NUMBER_INT);
    $hinicio = $_POST['hinicio'];
    $hfin = $_POST['hfin'];
    if(isset($_POST['obscor']))
    {
        $obscor = $_POST['obscor'];
    }
    
    if($hinicio>$hfin)
    {
      $error_msg_hr = '<p class="error">La hora de inicio es mayor a la hora de finalizacion </p>';     
    }
    if($hinicio>"17:00" or $hfin>"18:00")
    {
       $error_msg_hr .= '<p class="error">Horario fuera del establecido mayor a las 6:00 pm</p>';  
    }
    
         $prep_stmt = "SELECT * FROM monitores where cedula = ? and monitores.laboratoristas_members_id = ? LIMIT 1";
         $stmt = $mysqli->prepare($prep_stmt);
     // Verifica si selecciono un monitor.  
    if ($stmt) 
        {
            $stmt->bind_param('ss', $idmon,$idcor);
            $stmt->execute();
            $stmt->store_result();

            if (!$stmt->num_rows == 1) 
                {
                 // no selecciono un monitor
                $error_msg_mnt = '<p class="error">Seleccione un monitor</p>';               

                }
                
        } 
    else 
        {
            $error_msg .= '<p class="error">Database error line 55</p>';
            $stmt->close();
        }
        
         $prep_stmt = "SELECT idlaboratorios FROM laboratorios where idlaboratorios = ? LIMIT 1";
         $stmt = $mysqli->prepare($prep_stmt);
     // Verifica si selecciono un monitor.  
    if ($stmt) 
        {
            $stmt->bind_param('s', $labor);
            $stmt->execute();
            $stmt->store_result();

            if (!$stmt->num_rows == 1) 
                {
                 // no selecciono un monitor
                $error_msg_lab = '<p class="error">No selecciono laboratorio</p>';               

                }
                
        } 
    else 
        {
            $error_msg .= '<p class="error">Database error line 55</p>';
            $stmt->close();
        }
         $prep_stmt = "SELECT * FROM programa where idprograma = ? LIMIT 1";
         $stmt = $mysqli->prepare($prep_stmt);
     // Verifica si selecciono un monitor.  
    if ($stmt) 
        {
            $stmt->bind_param('s', $prog);
            $stmt->execute();
            $stmt->store_result();

            if (!$stmt->num_rows == 1) 
                {
                 // no selecciono un monitor
                $error_msg_prog= '<p class="error">Seleccione un programa</p>';               

                }
                
        } 
    else 
        {
            $error_msg .= '<p class="error">Database error line 55</p>';
            $stmt->close();
        }
        
        $prep_stmt = "SELECT idmaterias FROM materias where idmaterias = ? LIMIT 1";
         $stmt = $mysqli->prepare($prep_stmt);
     // Verifica si selecciono una materia .  
    if ($stmt) 
        {
            $stmt->bind_param('s', $mate);
            $stmt->execute();
            $stmt->store_result();

            if (!$stmt->num_rows == 1) 
                {
                 // no selecciono un monitor
                $error_msg_mat = '<p class="error">No selecciono una materia</p>';               

                }
                
        } 
    else 
        {
            $error_msg .= '<p class="error">Database error line 55</p>';
            $stmt->close();
        }
        
        
        $prep_stmt = "select max(numficha) as 'ficha' from practicas where laboratorios_idlaboratorios = ? LIMIT 1";
                $stmt = $mysqli->prepare($prep_stmt);


                if ($stmt) 
                   {
                    $stmt->bind_param('s', $labor);
                    $stmt->execute();
                    $stmt->store_result(); 
                    // Obtiene las variables del resultado.
                    $stmt->bind_result($ficha);
                    $stmt->fetch();
                   }
        
        
        if (empty($error_msg) && empty($error_msg_hr) && empty($error_msg_lab) && empty($error_msg_mnt)&& empty($error_msg_prog)) 
        {
 
        // Inserta el nuevo prectica a la base de datos.  
        if ($insert_stmt = $mysqli->prepare("insert into practicas (nombre_pract, docente, guia, numgrupos, numestudiantes, obscordinador, laboratoristas_members_id, laboratorios_idlaboratorios, monitores_cedula, materias_idmaterias, programa_idprograma, horapl, horaini, horaplfn, fecha, numficha) Values ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) 
        {
//            date_default_timezone_set("America/Bogota");
            $horain = date("H:i:s");
            $fecha = date("Y-m-d");
            $fichan = $ficha+1;
            $insert_stmt->bind_param('ssssssssssssssss', $npractica ,$docen, $rporguia, $ngrup, $nestudian, $obscor,$idcor,$labor,$idmon,$mate,$prog,$hinicio,$horain,$hfin,$fecha,$fichan);
            // Ejecuta la consulta preparada.
            if (! $insert_stmt->execute())
            {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        $idcor =NULL;
        $idmon = NULL;
        $prog = NULL;
        $mate =NULL;
        $labor = NULL;
        $npractica = NULL;
        $docen = NULL;
        $rporguia = NULL;
        $nestudian = NULL;
        $ngrup = NULL;
        $hinicio = NULL;
        $hfin = NULL;
        
        echo "<div id=dialog-message title=Inicio de practica> <p>Practica iniciada</p></div>";
    }
        
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

