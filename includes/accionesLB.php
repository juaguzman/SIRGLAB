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
        echo "<tr><td >&nbsp;Numero&nbsp;</td><td>&nbsp;Cedula&nbsp;</td>"
                . "<td>&nbsp;Nombres&nbsp;</td><td>&nbsp;Apellidos&nbsp;</td>"
                . "<td>&nbsp;Celular&nbsp;</td><td>&nbsp;Direccion&nbsp;</td>"
                . "<td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        
            while ($campo=mysqli_fetch_object($result)) 
            {
                echo "<tr><td>$campo->members_id</td><td>$campo->members_id</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->celular</td><td>$campo->direccion</td>"
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
    
}