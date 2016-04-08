<?php

include_once 'db_connect.php';
include_once 'psl-config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class laboratorista
{
    static function ListarLaboratorista()
    {
        
           
        include 'db_connect.php';
        $consulta= "SELECT * FROM laboratoristas" ;        
        if($result   = $mysqli->query($consulta))
        {
           
        echo "<table> \n";
        echo "<thead>";
        echo "<tr><td colspan=9>Lista de Laboratoristas</td></tr>";
        echo "<thead>";
        echo "<tr><td>&nbsp;Cedula&nbsp;</td>"
                . "<td>&nbsp;Nombres&nbsp;</td><td>&nbsp;Apellidos&nbsp;</td>"
                . "<td>&nbsp;Celular&nbsp;</td><td>&nbsp;Direccion&nbsp;</td>"
                . "<td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        
            while ($campo=mysqli_fetch_object($result)) 
            {
                echo "<tr><td>$campo->members_id</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->celular</td><td>$campo->direccion</td>"
                    . "<td><img src=../../imagenes/iconos/horario.png width=30px heigt=30px ></td>";
            }  
             echo "</table> \n";
        $mysqli->close();
        }
        else 
        {
           echo "no existe un perfil";   
        }
       
    }
        
        
    static function verPerfil($id)
    {
         include 'db_connect.php';
         
         $prep_stmt = "SELECT * FROM laboratoristas WHERE members_id = ? LIMIT 1";
         $stmt = $mysqli->prepare($prep_stmt);
    
   
    if ($stmt) 
        {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->store_result(); 
        // Obtiene las variables del resultado.
        $stmt->bind_result($cedula, $nombres, $apellidos,$celular,$direccion,$email,$contra);
        $stmt->fetch(); 
        if ($stmt->num_rows ==1) 
            {
            echo "<table><thead><tr><td colspan=3>Perfil Cordinador de Laboratorio</td></tr></thead>";
            echo "<tbody><tr><td colspan=3></td></tr>";
            echo "<tr><td colspan=2>Cedula</td><td>$cedula</td></tr>";
            echo "</table>";
            }
         
        }     
    }  
    
    
    static function conpassw()
    {
        echo "Bienvinido";
        echo "<form><input type=text name=pasw value='' >";
    }
}