<html>
    
</html>
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
        
        echo "<table id=res > \n";
        echo "<tr> <th colspan=9 id=titu >Lista Monitores</th> </tr>";
        echo "<tr><td >&nbsp;CEDULA&nbsp;</td><td>&nbsp;NOMBRES&nbsp;</td><td>&nbsp;APELLIDOS&nbsp;</td><td >&nbsp;CELULAR&nbsp;</td><td >&nbsp;EMAIL&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;SEMESTRE&nbsp;</td><td >&nbsp;ESTADO&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
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
                                       
            echo "<tr id=resul><td>$campo->cedula</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->celular</td><td>$campo->email</td><td>$campo->programa</td><td>$campo->semestre</td><td>$estado</td>"
                    . "<td><a href=verHorarios.php?cedu=$campo->cedula><img src=../../imagenes/iconos/horario.png width=30px heigt=30px ></a></td>";

            
            
        }
        echo "</table> \n";
      $mysqli->close();        
            
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
        echo "$result->num_rows";
         echo "<table id=res border= 3px solid  > \n";
         echo "<tr> <td colspan=9 id=titu >Horario de asistencia</td> </tr> "
         . "<tr><td>HORAS</td><td>LUNES</td><td>MARTES</td><td>MIERCOLES</td><td>JUEVES</td><td>VIERNES</td></tr>";
      
         while ($campo=mysqli_fetch_object($result)) 
         {
             if($campo->dia=="Lunes") { $elun = $campo->horaentra; $slun = $campo->horasale; }
             if($campo->dia=="Martes"){$emar = $campo->horaentra;$smar = $campo->horasale;}
             if($campo->dia=="Miercoles"){$emier = $campo->horaentra;$smier = $campo->horasale;}
             if($campo->dia=="Jueves"){$ejue = $campo->horaentra; $sjue = $campo->horasale;}
             if($campo->dia=="Viernes"){$evie = $campo->horaentra;$svie = $campo->horasale;}                
         }
         
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
            
            
  }
        

}
