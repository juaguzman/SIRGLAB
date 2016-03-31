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
     echo "<select class=form-field  name=mon >";
     echo "<option value=>Seleccione Monitor </option>";
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
    
    
    
    
}

