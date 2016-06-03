
<?php

include_once 'db_connect.php';
include_once 'psl-config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class monitores 
{
    

static function ListarMonitores()
{
    
        
        include 'db_connect.php';
        $consulta= "SELECT * FROM monitores";
        $result   = $mysqli->query($consulta);
        
        echo "<table> \n";
        echo "<thead>";
        echo "<tr><td colspan=9>Lista de Monitores</td></tr>";
        echo "<thead>";
        echo "<tbody>";
        echo "<tr><td>&nbsp;CEDULA&nbsp;</td><td>&nbsp;NOMBRES&nbsp;</td><td>&nbsp;APELLIDOS&nbsp;</td><td >&nbsp;CELULAR&nbsp;</td><td >&nbsp;EMAIL&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;SEMESTRE&nbsp;</td><td >&nbsp;ESTADO&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {
                    if(strcmp($campo->estado, "fr")==0)
                    {
                        $estado="Inactivo";
                    }
                    else
                    {
                       $estado = "Activo";
                    }
                                       
            echo "<tr><td>$campo->cedula</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->celular</td><td>$campo->email</td><td>$campo->programa</td><td>$campo->semestre</td><td>$estado</td><td><a href=verHorarios.php?cedu=$campo->cedula><img src=../../imagenes/iconos/horario.png width=30px heigt=30px ></a></td>";
                }
        echo "<tbody>";
        echo "</table> \n";
      $mysqli->close();        
            
        } 
        
        
        static function ListarMonitoresCord($id)
{
    
        
        include 'db_connect.php';
        $consulta= "SELECT * FROM monitores WHERE laboratoristas_members_id = $id";
        $result   = $mysqli->query($consulta);
        
        echo "<table> \n";
        echo "<thead>";
        echo "<tr><td colspan=9>Lista de Monitores</td></tr>";
        echo "<thead>";
        echo "<tbody>";
        echo "<tr><td>&nbsp;CEDULA&nbsp;</td><td>&nbsp;NOMBRES&nbsp;</td><td>&nbsp;APELLIDOS&nbsp;</td><td >&nbsp;CELULAR&nbsp;</td><td >&nbsp;EMAIL&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;SEMESTRE&nbsp;</td><td >&nbsp;ESTADO&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {
                    if(strcmp($campo->estado, "fr")==0)
                    {
                        $estado="Inactivo";
                    }
                    else
                    {
                       $estado = "Activo";
                    }
                                       
            echo "<tr><td>$campo->cedula</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->celular</td><td>$campo->email</td><td>$campo->programa</td><td>$campo->semestre</td><td>$estado</td><td><a href=verHorarios.php?cedu=$campo->cedula><img src=../../imagenes/iconos/horario.png width=30px heigt=30px ></a>&nbsp;&nbsp;&nbsp;"
                    . "<a href=registromonitores.php?cedu=$campo->cedula><img src=../../imagenes/iconos/ver.png width=30px heigt=30px ></a></td>";
                }
                echo "<form method=post action=../reportes/prueb2.php>";
                echo "<input type=hidden name=id value=$id />";
                echo "<tr><td colspan=9><button type=submit class=btn>Generar Reporte</button></td></tr>";
                echo "</form>";
        echo "</tbody>";
        echo "</table> \n";
      $mysqli->close();        
            
        } 
        
 static function asignarM($idl)
 {
      include 'db_connect.php';
        $consulta= "SELECT * FROM monitores Where laboratoristas_members_id is null";
        $result   = $mysqli->query($consulta);
        
        
        echo "<table> \n";
        echo "<tr><td >&nbsp;CEDULA&nbsp;</td><td>&nbsp;NOMBRES&nbsp;</td><td>&nbsp;APELLIDOS&nbsp;</td><td >&nbsp;CELULAR&nbsp;</td><td >&nbsp;EMAIL&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;SEMESTRE&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {  
            $cedu = $campo->cedula;
            echo "<tr><td>$campo->cedula</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->celular</td><td>$campo->email</td><td>$campo->programa</td><td>$campo->semestre</td>"
                    . "<td><a href=# onclick=abrir_dialog($idl,$cedu)><img src=../../imagenes/iconos/mas.png width=30px heigt=30px ></a></td>";
                }
        echo "</table> \n";
      $mysqli->close(); 
 }

static function asigmonitores($idl,$cedu)
{
    include 'db_connect.php';
    
    $upd = "UPDATE monitores set laboratoristas_members_id = ? where cedula = ? ";
                        
                 if ($upd_stmt = $mysqli->prepare($upd)) 
                 {
                     
                        $upd_stmt->bind_param('ss',$idl ,$cedu);
                        // Ejecuta la consulta preparada.
                        if (! $upd_stmt->execute())
                        {
                            header('Location: ../error.php?err=Registration failure: UPDATE');
                        }
                          $msj="<div id=dialog-message title=ASIGNADO> <p>El monitor le fue asignado satisfactoriamente</p></div>";
                            header('Location: ../vistas/monitores/asignarmonitores.php?msj='.$msj);
                   }
    
}


static function verHorarios($cedu)
  {
      
      $h1="07:00:00";
      $h2="08:00:00";
      $h3="09:00:00";
      $h4="10:00:00";
      $h5="11:00:00";
      $h6="12:00:00";
      $h7="13:00:00";
      $h8="14:00:00";
      $h9="15:00:00";
      $h10="16:00:00";
      $h11="17:00:00";
      $h12="18:00:00";
        
        include 'db_connect.php';
        $consulta= "SELECT dia, DATE_FORMAT(horaentra , '%T') as horaentra, DATE_FORMAT(horasale , '%T') as horasale FROM horarios WHERE monitores_cedula = $cedu";
        $result   = $mysqli->query($consulta);
         echo "<table>";
         echo "<tr><td>HORAS</td><td>LUNES</td><td>MARTES</td><td>MIERCOLES</td><td>JUEVES</td><td>VIERNES</td></tr>";
      
         while ($campo=mysqli_fetch_object($result)) 
         {
             if($campo->dia=="Lunes") { $elun = $campo->horaentra; $slun = $campo->horasale; }
             if($campo->dia=="Martes"){$emar = $campo->horaentra;$smar = $campo->horasale;}
             if($campo->dia=="Miercoles"){$emier = $campo->horaentra;$smier = $campo->horasale;}
             if($campo->dia=="Jueves"){$ejue = $campo->horaentra; $sjue = $campo->horasale;}
             if($campo->dia=="Viernes"){$evie = $campo->horaentra;$svie = $campo->horasale;}                
         }
         if(!empty($elun) or !empty($emar) or !empty($emier) or !empty($ejue) or !empty($ejue) or !empty($evie))
         {
            echo "<tr><td>7:00 AM</td>";
            /*Comparacion para 7 am de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h1 && $slun>=$h2){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para 7 am de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h1 && $smar>=$h2){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para 7 am de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h1 && $smier>=$h2){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para 7 am de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h1 && $sjue>=$h2){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para 7 am de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h1 && $svie>=$h2){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            echo "<tr><td>8:00 AM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h2 && $slun>=$h3){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h2 && $smar>=$h3){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h2 && $smier>=$h3){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h2 && $sjue>=$h3){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h2 && $svie>=$h3){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            
            echo "<tr><td>9:00 AM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h3 && $slun>=$h4){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h3 && $smar>=$h4){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h3 && $smier>=$h4){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h3 && $sjue>=$h4){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h3 && $svie>=$h4){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            echo "<tr><td>10:00 AM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h4 && $slun>=$h5){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h4 && $smar>=$h5){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h4 && $smier>=$h5){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h4 && $sjue>=$h5){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h4 && $svie>=$h5){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            
             echo "<tr><td>11:00 AM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h5 && $slun>=$h6){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h5 && $smar>=$h6){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h5 && $smier>=$h6){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h5 && $sjue>=$h6){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h5 && $svie>=$h6){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            
            echo "<tr><td>12:00 PM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h6 && $slun>=$h7){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h6 && $smar>=$h7){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h6 && $smier>=$h7){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h6 && $sjue>=$h7){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h6 && $svie>=$h7){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            
            echo "<tr><td>1:00 PM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h7 && $slun>=$h8){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h7 && $smar>=$h8){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h7 && $smier>=$h8){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h7 && $sjue>=$h8){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h7 && $svie>=$h8){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            
             echo "<tr><td>2:00 PM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h8 && $slun>=$h9){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h8 && $smar>=$h9){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h8 && $smier>=$h9){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h8 && $sjue>=$h9){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h8 && $svie>=$h9){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            echo "<tr><td>3:00 PM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h9 && $slun>=$h10){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h9 && $smar>=$h10){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h9 && $smier>=$h10){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h9 && $sjue>=$h10){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h9 && $svie>=$h10){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            
            echo "<tr><td>4:00 PM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h10 && $slun>=$h11){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h10 && $smar>=$h11){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h10 && $smier>=$h11){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h10 && $sjue>=$h11){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h10 && $svie>=$h11){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            echo "<tr><td>5:00 PM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($elun<=$h11 && $slun>=$h12){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if($emar<=$h11 && $smar>=$h12){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($emier<=$h11 && $smier>=$h12){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($ejue<=$h11 && $sjue>=$h12){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($evie<=$h11 && $svie>=$h12){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            
            echo "<tr><td>6:00 PM</td>";
            /*Comparacion para horas de el lunes*/
            if(isset($elun,$slun))
            {if($slun==$h12){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Martes*/
            if(isset($emar,$smar))
            {if( $smar==$h12){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Miercoles*/
            if(isset($emier,$smier))
            {if($smier==$h12){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Jueves*/
            if(isset($ejue,$sjue))
            {if($sjue==$h12){ echo "<td id=ok></td>"; } else { echo "<td></td>";}}else { echo "<td></td>";}
            /*Comparacion para horas de el Viernes*/
            if(isset($evie,$svie))
            {if($svie==$h12){ echo "<td id=ok></td></tr>"; } else { echo "<td></td></tr>";}}else { echo "<td></td></tr>";}
            echo "</table>";
         }
        else {
         echo "</table>";
         echo "<form method=POST action=regHorario.php>";
         echo "<input type=hidden name=idm value=$cedu>";
         echo "<input type=submit value=Agregar Horario class=btn-style></form>";
             }
  }
  
  
   static function ListarMonitorRegistro($idm)
{
    
        
        include 'db_connect.php';
        $horas = "0:00:00";
        $horasp ="";
        $sumHoras="0:00:00";
        $sumh="";
        $summ="";
        $sums="";
        $resh="";
        $resm="";
        $ress="";
        
   $prep_stmt = "SELECT * FROM monitores WHERE cedula = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);   
    if ($stmt) 
        {
        $stmt->bind_param('s', $idm);
        $stmt->execute();
        $stmt->store_result(); 
        // Obtiene las variables del resultado.
        $stmt->bind_result($cedula, $nombres, $apellidos,$celular,$email,$programa,$semetre, $estado,$idlabora);
        $stmt->fetch(); 
        if ($stmt->num_rows ==1) 
            {
             if($estado=="dn"){$std= "ACTIVO";}else{$std= "INACTIVO";};
             echo "<table> \n";
             echo "<thead>";
             echo "<tr><td colspan=8>Registro de Horas Monitor</td></tr>";
             echo "<thead>";
             echo "<tbody><tr><td colspan=8></td></tr>";
             echo "<tr><td>Cedula</td><td>$cedula</td><td colspan=4> </td><td>Estado</td><td>$std</td></tr>";
             echo "</tbody>";
             echo "</table> \n";
             echo "<table> \n";
              echo "<tr><td colspan=8></td></tr>";
             echo "<tr><td colspan=2>Nombres:</td><td colspan=2>$nombres</td><td colspan=2 >Apellidos:</td><td colspan=2 >$apellidos</td></tr>";
             echo "<tr><td colspan=2>Celular:</td><td colspan=2>$celular</td><td colspan=2>Email:</td><td colspan=2>$email</td></tr>";
             echo "<tr><td colspan=2>Programa:</td><td colspan=2>$programa</td><td colspan=2>Semestre:</td><td colspan=2>$semetre</td></tr>";
             echo "</table> \n";
//             echo "<br/><br/>";
             
                  $consulta= "SELECT mregistro.* FROM mregistro WHERE mregistro.monitores_cedula = $cedula ";
                  $result   = $mysqli->query($consulta);
              
                echo "<table> \n";
                echo "<thead>";
                echo "<tr><td colspan=9>Registro de Horas</td></tr>";
                echo "<thead>";
                echo "<tbody>";
                echo "<tr><td>&nbsp;FECHA&nbsp;</td><td>&nbsp;HORA ENTRADA&nbsp;</td><td>&nbsp;HORA SALIDA&nbsp;</td><td >&nbsp;HORAS REALIZADAS&nbsp;</td></tr> \n";
                
                 while ($campo=mysqli_fetch_object($result))
                 {
                   $hini = $campo->horaen;
                   $hfin=$campo->horasal;
                   if(empty($hfin))
                   {
                       $hfin="Sin Finalizar";
                       $horasp="Sin Finalizar";
                   }
                   else 
                   {
                       $horai = explode(":", $hini);
                       $horas = explode(":", $hfin);
                       list($hini,$minin,$segin)=$horai;
                       list($hsal,$minsa,$segsa)=$horas;
                       $resh=0;
                       $resm=0;
                       $ress=0;
                       $ress=$segsa-$segin;
                       $resh = $hsal-$hini;
                       $resm = $minsa-$minin;
                       if($ress<0)
                       {
                           $resm--;
                           $ress=$ress+60;
                           
                       }
                       
                        if($resm<0)
                       {
                           $resh--;
                           $resm=$resm+60;
                           
                       }
                       
                     $horasp = "$resh:$resm:$ress" ; 
                     $horas=date("H:i:s", strtotime("00:00:00") + strtotime($hfin) - strtotime($hini) );
                     $horaSplit = explode(":", $horasp);
                   list($hour1, $min1, $sec1)=$horaSplit;
                  
                   $sums = $sums+$sec1;                   
                   if($sums>59)
                   {
                       $summ++;
                       $sums=$sums-60;
                   }
                   $summ = $summ+$min1;
                   if($summ>59)
                   {
                       $sumh++;
                       $summ=$summ-60;
                   }
                    $sumh = $sumh+$hour1;
                   }
                   echo "<tr> <td>$campo->fecha</td><td>$campo->horaen</td><td>$hfin</td><td>$horasp</td> </tr>";
                   echo "<input type=hidden name=hrs[] value=$campo->horaen />";
                 }
                 $sumHoras = "$sumh:$summ:$sums";
                 echo "<tr><td colspan=3 >Total de Horas</td><td>$sumHoras Horas</td></tr>";
       
                 echo "</table>";
            
            }
        
        }    
            
        } 
        

}
