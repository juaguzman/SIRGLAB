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
                    $consulta2 = "SELECT horarios.* FROM monitores,horarios where monitores.cedula = horarios.monitores_cedula and horarios.monitores_cedula =$campo->cedula";
                    $result2   = $mysqli->query($consulta);
                    
            echo "<tr id=resul><td>$campo->cedula</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->celular</td><td>$campo->email</td><td>$campo->programa</td><td>$campo->semestre</td><td>$estado</td>"
                    . "<td><a href=verHorarios.ph?cedu=$campo->cedula><img src=../../imagenes/iconos/horario.png width=30px heigt=30px ></a></td>";

            
            
        }
        echo "</table> \n";
      $mysqli->close();        
            
        } 
        
        
  static function verHorarios($cedu)
  {
      $h1="07:00:00";
      $h2="08:00:00";
      $h3="09:00:00";
      $h4="010:00:00";
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
        
         echo "<table id=res > \n";
          echo "<tr> <td colspan=9 id=titu >Horario de asistencia</td> </tr>";
      
  }
        

}