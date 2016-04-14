<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
$error_msg_mnt="";
$error_msg_lab="";
$error_msg_inv="";
$error_msg_cedinv="";
$error_msg_aser="";
$error_msg_psd="";

if(isset($_POST['idcord'],$_POST['idmon'], $_POST['labor'], $_POST['ninvestiga'], $_POST['ninvestigador'], $_POST['cedulainvg'], $_POST['nasesor']))
{
    $idcor = filter_input(INPUT_POST, 'idcord', FILTER_SANITIZE_NUMBER_INT);
    $idmon = filter_input(INPUT_POST, 'idmon', FILTER_SANITIZE_NUMBER_INT);
    $labor = filter_input(INPUT_POST, 'labor', FILTER_SANITIZE_NUMBER_INT);
    $nominvest = filter_input(INPUT_POST, 'ninvestiga', FILTER_SANITIZE_STRING);
    $nivestig = filter_input(INPUT_POST, 'ninvestigador', FILTER_SANITIZE_STRING);
    $obscor = filter_input(INPUT_POST, 'obscor', FILTER_SANITIZE_STRING);
    $asesor = filter_input(INPUT_POST, 'nasesor', FILTER_SANITIZE_STRING);
    $proced = filter_input(INPUT_POST, 'proced', FILTER_SANITIZE_STRING);
    $cedulain = filter_input(INPUT_POST, 'cedulainvg', FILTER_SANITIZE_NUMBER_INT);
    $equip = $_POST['text'];
    $insum = $_POST['insumos'];
    
    
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
     // Verifica si selecciono un laboratorio.  
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
        
        
         $prep_stmt = "select max(numficha) as 'ficha' from investigaciones where laboratorios_idlaboratorios = ? LIMIT 1";
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
                   
                   
     if (empty($error_msg) && empty($error_msg_mnt) && empty($error_msg_lab))
     {
          if ($insert_stmt = $mysqli->prepare("INSERT INTO investigaciones(nombre_investg, cedulainvestg, investigador, asesor, obscordinador, laboratoristas_members_id, laboratorios_idlaboratorios, monitores_cedula, horaini, fecha, estado, numficha, preocedimentos) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) 
        {
           date_default_timezone_set("America/Bogota");
            $horain = date("H:i:s");
            $fecha = date("Y-m-d");
            $fichan = $ficha+1;
            $estado = "in";
            $insert_stmt->bind_param('sssssssssssss', $nominvest,$cedulain,$nivestig  , $asesor, $obscor,$idcor,$labor,$idmon,$horain,$fecha,$estado,$fichan,$proced);
            // Ejecuta la consulta preparada.
            if (! $insert_stmt->execute())
            {
                header('Location: ../../error.php?err=Registration failure: INSERT');
            }
            else
            {
                
                 $prep_stmt = "SELECT idinvestigacion FROM investigaciones WHERE numficha = ? AND laboratorios_idlaboratorios = ?";
                $stmt = $mysqli->prepare($prep_stmt);


                if ($stmt) 
                   {
                    $stmt->bind_param('ss', $fichan, $labor);
                    $stmt->execute();
                    $stmt->store_result(); 
                    // Obtiene las variables del resultado.
                    $stmt->bind_result($idinvestigacion);
                    $stmt->fetch();
                   }
                   if(!empty($equip))
                   {
                         foreach ($equip as $value) 
                        {
                               $value = ucwords(strtolower($value));

                               if ($insert_stmt = $mysqli->prepare("INSERT INTO equiposentre (equipo, investigaciones_idinvestigacion ) VALUES ( ?, ?);")) 
                                {

                                    $insert_stmt->bind_param('ss', $value, $idinvestigacion);
                                    // Ejecuta la consulta preparada.
                                    if (! $insert_stmt->execute())
                                    {
                                        header('Location: ../../error.php?err=Registration failure: INSERT');
                                    }
                                }
                        }
                   }
                   
                   
                   if(!empty($insum))
                   {
                         foreach ($insum as $value) 
                        {
                               $value = ucwords(strtolower($value));

                               if ($insert_stmt = $mysqli->prepare("INSERT INTO inumosentre (insumo, investigaciones_idinvestigacion ) VALUES ( ? , ?);")) 
                                {

                                    $insert_stmt->bind_param('ss', $value, $idinvestigacion);
                                    // Ejecuta la consulta preparada.
                                    if (! $insert_stmt->execute())
                                    {
                                        header('Location: ../../error.php?err=Registration failure: INSERT');
                                    }
                                }
                        }
                   }
                   
                   
        $nivestig=NULL;
        $cedulain=NULL;
        $nominvest=NULL;
        $asesor=NULL;
        $obscor=NULL;
        $idcor=NULL;
        $labor=NULL;
        $idmon=NULL;
        $horain=NULL;
        $fecha=NULL;
        $hinicio=NULL;
        $estado=NULL;
        $fichan=NULL;
        $proced=NULL;        
        echo "<div id=dialog-message title=Inicio de Investigacion> <p>Investigacion iniciada con exito</p></div>";
        
            }
        }
        
       
     }
    
}


        