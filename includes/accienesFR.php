<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class formularios
{
static function selprograma()
{
    include 'db_connect.php';
    echo "<select class=form-field  name=category id=category>";
     echo "<option value=>Seleccione Programa </option>";
        $result = $mysqli->query("SELECT idprograma, nombre FROM programa ");
             if ($result->num_rows > 0) 
               {
             while ($row = $result->fetch_assoc()) 
                     {                
             echo '<option value="'.$row['idprograma'].'">'.$row['nombre'].'</option>';
                    }
                }
    echo "</select>";
}

static function sallabor()
{
     include 'db_connect.php';
     echo "<select class=form-field  name=labor>";
     echo "<option value=>Seleccione Laboratorio </option>";
      $result = $mysqli->query("SELECT idlaboratorios, nombre FROM laboratorios ");
             if ($result->num_rows > 0) 
               {
             while ($row = $result->fetch_assoc()) 
                     {                
             echo '<option value="'.$row['idlaboratorios'].'">'.$row['nombre'].'</option>';
                    }
                }
    echo "</select>";
}

static function salMon()
{
     include 'db_connect.php';
     echo "<select class=form-field  name=idmon >";
     echo "<option>Seleccione Monitor </option>";
      $result = $mysqli->query("SELECT cedula, nombres FROM monitores ");
             if ($result->num_rows > 0) 
               {
             while ($row = $result->fetch_assoc()) 
                     {                
             echo '<option value="'.$row['cedula'].'">'.$row['nombres'].'</option>';
                    }
                }
    echo "</select>";
}
   
static function listapracticaactiva($idlab)
{
    
//    include 'db_connect.php';
//        $consulta= "SELECT practicas.* , laboratorios.nombre as 'labo', monitores.nombres as 'monit', programa.nombre as 'prog', materias.nombre as 'mater' FROM practicas,laboratorios, monitores,programa, materias WHERE practicas.laboratorios_idlaboratorios = laboratorios.idlaboratorios AND practicas.monitores_cedula = monitores.cedula AND programa.idprograma = practicas.programa_idprograma and practicas.materias_idmaterias = materias.idmaterias AND practicas.laboratoristas_members_id = 1 and practicas.estado = 'in';";
//        $result   = $mysqli->query($consulta);
//       echo "<table> \n";
//     echo "<tr><td>&nbsp;CEDULA&nbsp;</td><td>&nbsp;NOMBRES&nbsp;</td><td>&nbsp;APELLIDOS&nbsp;</td><td >&nbsp;CELULAR&nbsp;</td><td >&nbsp;EMAIL&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;SEMESTRE&nbsp;</td><td >&nbsp;ESTADO&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
//   while ($campo=mysqli_fetch_object($result)) 
//            {
//                                       
//            echo "<tr><td>$campo->idpracticas</td><td>$campo->labo</td><td>$campo->monit</td><td>$campo->prog</td><td>$campo->mater</td><td>$campo->nombre_pract</td><td>$campo->docente</td><td>$campo->fecha</td><";
//
//    
//            }
//
//            echo "</table>";
    
    include 'db_connect.php';
        $consulta= "SELECT practicas.* , laboratorios.nombre as 'labo', monitores.nombres as 'monit', programa.nombre as 'prog', materias.nombre as 'mater' FROM practicas,laboratorios, monitores,programa, materias WHERE practicas.laboratorios_idlaboratorios = laboratorios.idlaboratorios AND practicas.monitores_cedula = monitores.cedula AND programa.idprograma = practicas.programa_idprograma and practicas.materias_idmaterias = materias.idmaterias AND practicas.laboratoristas_members_id = 1 and practicas.estado = 'in';";
        $result   = $mysqli->query($consulta);
        
        echo "<table> \n";
        echo "<tr><td>&nbsp;NUM PRACTICA&nbsp;</td><td>&nbsp;LABORATORIO&nbsp;</td><td>&nbsp;MONITOR&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;MATERIA&nbsp;</td><td >&nbsp;PRACTICA&nbsp;</td><td >&nbsp;DOCENTE&nbsp;</td><td >&nbsp;FECHA&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {                      
                 echo "<tr><td>$campo->idpracticas</td><td>$campo->labo</td><td>$campo->monit</td><td>$campo->prog</td><td>$campo->mater</td><td>$campo->nombre_pract</td><td>$campo->docente</td><td>$campo->fecha</td><td><a href=verHorarios.php?cedu=$campo->idpracticas><img src=../../../imagenes/iconos/stop.png width=30px heigt=30px ></a></td>";
                }
        echo "</table> \n";
      $mysqli->close();        
            
    
}
}

