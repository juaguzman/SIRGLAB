<?php

if(isset($_POST['elun'],$_POST['slun'],$_POST['idm'], $_POST['emar'],$_POST['smar']))
{
    $error_msj_lun="";
    $error_msj_mar="";
    $error_msj_mier="";
    $error_msj_jue="";
    $error_msj_vie="";
    /*
     * prueba del lunes y lo agrega de lo contraro devuelve un error
     */
     $idm  = $_POST['idm'];
    if(!empty($_POST['elun']) && !empty($_POST['slun']))
    {
       $elun = $_POST['elun'];
       $slun = $_POST['slun'];
      

       if($elun>$slun)
       {
           $error_msj_lun = '<p class="error">La hora de inicio es mayor a la hora de finalizacion </p>';       
       }
       if($elun>"17:00" or $slun>"18:00")
       {
           $error_msj_lun .= '<p class="error">Horario fuera del establecido mayor a las 6:00 pm</p>';  
       }
        if($elun<"07:00" or $slun<"08:00")
       {
           $error_msj_lun .= '<p class="error">Horario fuera del establecido menor a las 7:00 am</p>';  
       }
    }
     /*
     * prueba del Martes y lo agrega de lo contraro devuelve un error
     */
    if(!empty($_POST['emar']) && !empty($_POST['smar']))
    {
       $emar = $_POST['emar'];
       $smar = $_POST['smar'];

       if($emar>$smar)
       {
           $error_msj_mar = '<p class="error">La hora de inicio es mayor a la hora de finalizacion </p>';       
       }
       if($emar>"17:00" or $smar>"18:00")
       {
           $error_msj_mar .= '<p class="error">Horario fuera del establecido mayor a las 6:00 pm</p>';  
       }
        if($emar<"07:00" or $smar<"08:00")
       {
           $error_msj_mar .= '<p class="error">Horario fuera del establecido menor a las 7:00 am</p>';  
       }
        
        if (empty($error_msj_lun) && empty($error_msj_mar)) 
        {

                if ($insert_stmt = $mysqli->prepare("INSERT INTO horarios (dia, horaentra, horasale, monitores_cedula ) VALUES (?, ?, ?, ?)")) 
                {
                    $dia="Martes";
                    $insert_stmt->bind_param('ssss', $dia,$emar, $smar, $idm);
                    // Ejecuta la consulta preparada.
                            if (! $insert_stmt->execute())
                            {
                                header('Location: ../error.php?err=Registration failure: INSERT');
                            }
                }
       }
    }
     /*
     * prueba del Miercoles y lo agrega de lo contraro devuelve un error
     */
    if(!empty($_POST['emier']) && !empty($_POST['smier']))
    {
       $emier = $_POST['emier'];
       $smier = $_POST['smier'];
       

       if($emier>$smier)
       {
           $error_msj_mier = '<p class="error">La hora de inicio es mayor a la hora de finalizacion </p>';       
       }
       if($emier>"17:00" or $smier>"18:00")
       {
           $error_msj_mier .= '<p class="error">Horario fuera del establecido mayor a las 6:00 pm</p>';  
       }
        if($emier<"07:00" or $smier<"08:00")
       {
           $error_msj_mier .= '<p class="error">Horario fuera del establecido menor a las 7:00 am</p>';  
       }
        
        if (empty($error_msj_lun )&& empty($error_msj_mar ) && empty($error_msj_mier ) ) 
        {

                if ($insert_stmt = $mysqli->prepare("INSERT INTO horarios (dia, horaentra, horasale, monitores_cedula ) VALUES (?, ?, ?, ?)")) 
                {
                    $dia="Miercoles";
                    $insert_stmt->bind_param('ssss', $dia,$emier, $smier, $idm);
                    // Ejecuta la consulta preparada.
                            if (! $insert_stmt->execute())
                            {
                                header('Location: ../error.php?err=Registration failure: INSERT');
                            }
                }
       }
    }
    /*
     * prueba del Jueves y lo agrega de lo contraro devuelve un error
     */
    if(!empty($_POST['ejue']) && !empty($_POST['sjue']))
    {
       $ejue = $_POST['ejue'];
       $sjue = $_POST['sjue'];
       

       if($ejue>$sjue)
       {
           $error_msj_jue = '<p class="error">La hora de inicio es mayor a la hora de finalizacion </p>';       
       }
       if($ejue>"17:00" or $sjue>"18:00")
       {
           $error_msj_jue .= '<p class="error">Horario fuera del establecido mayor a las 6:00 pm</p>';  
       }
       if($ejue<"07:00" or $sjue<"08:00")
       {
           $error_msj_jue .= '<p class="error">Horario fuera del establecido menor a las 7:00 am</p>';  
       }
        
        if (empty($error_msj_lun )&& empty($error_msj_mar ) && empty($error_msj_mier )&& empty($error_msj_jue ) ) 
        {

                if ($insert_stmt = $mysqli->prepare("INSERT INTO horarios (dia, horaentra, horasale, monitores_cedula ) VALUES (?, ?, ?, ?)")) 
                {
                    $dia="Jueves";
                    $insert_stmt->bind_param('ssss', $dia,$ejue, $sjue, $idm);
                    // Ejecuta la consulta preparada.
                            if (! $insert_stmt->execute())
                            {
                                header('Location: ../error.php?err=Registration failure: INSERT');
                            }
                }
       }
    }
    /*
     * prueba del Jueves y lo agrega de lo contraro devuelve un error
     */
    if(!empty($_POST['evie']) && !empty($_POST['svie']))
    {
       $evie = $_POST['evie'];
       $svie = $_POST['svie'];

       if($evie>$svie)
       {
           $error_msj_vie = '<p class="error">La hora de inicio es mayor a la hora de finalizacion </p>';       
       }
       if($evie>"17:00" or $svie>"18:00")
       {
           $error_msj_vie .= '<p class="error">Horario fuera del establecido mayor a las 6:00 pm</p>';  
       }
       if($evie<"07:00" or $svie<"08:00")
       {
           $error_msj_vie .= '<p class="error">Horario fuera del establecido menor a las 7:00 am</p>';  
       }
        
        if (empty($error_msj_lun )&& empty($error_msj_mar ) && empty($error_msj_mier )&& empty($error_msj_jue )&& empty($error_msj_vie ) ) 
        {

                if ($insert_stmt = $mysqli->prepare("INSERT INTO horarios (dia, horaentra, horasale, monitores_cedula ) VALUES (?, ?, ?, ?)")) 
                {
                    $dia="Viernes";
                    $insert_stmt->bind_param('ssss', $dia,$evie, $svie, $idm);
                    // Ejecuta la consulta preparada.
                            if (! $insert_stmt->execute())
                            {
                                header('Location: ../error.php?err=Registration failure: INSERT');
                            }
                }
       }
    }
    
           
       if (empty($error_msj_lun )&& empty($error_msj_mar ) && empty($error_msj_mier )&& empty($error_msj_jue )&& empty($error_msj_vie ) )
        {

                if ($insert_stmt = $mysqli->prepare("INSERT INTO horarios (dia, horaentra, horasale, monitores_cedula ) VALUES (?, ?, ?, ?)")) 
                {
                    $dia="Lunes";
                    $insert_stmt->bind_param('ssss', $dia,$elun, $slun, $idm);
                    // Ejecuta la consulta preparada.
                            if (! $insert_stmt->execute())
                            {
                                header('Location: ../error.php?err=Registration failure: INSERT');
                            }
                }
       }
       
       $mensaje="<div id=dialog-message title=horario> <p>Horario agregado con exito</p></div>";
       header('Location: listarmonitores.php?msj='.$mensaje);
    
}

