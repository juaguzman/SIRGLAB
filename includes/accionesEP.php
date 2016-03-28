<?php

include_once 'db_connect.php';
include_once 'psl-config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class empleados
{
    static function ListarEmpleados()
    {
        include 'db_connect.php';
        $consulta= "SELECT * FROM empleados";
        $result   = $mysqli->query($consulta);
        
        echo "<table id=res > \n";
        echo "<tr> <th colspan=9 id=titu >Lista Empleados</th> </tr>";
        echo "<tr><td >&nbsp;Cedula&nbsp;</td><td>&nbsp;Codigo&nbsp;</td><td>&nbsp;Nombres&nbsp;</td><td >&nbsp;Apellidos&nbsp;</td><td >&nbsp;Dependeica&nbsp;</td><td >&nbsp;ESTADO&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
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
            echo "<tr id=resul><td>$campo->cedula</td><td>$campo->codigo</td><td>$campo->nombres</td><td>$campo->apellidos</td><td>$campo->dependencia</td><td>$estado</td>"
                    . "<td><img src=../../imagenes/iconos/horario.png width=30px heigt=30px ></td>";
        }
        echo "</table> \n";
        $mysqli->close();  
    }
}