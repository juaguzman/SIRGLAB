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
            if(empty($email))
            {
                $email= "Sin&nbsp;Informacion";
            }
            if(empty($celular))
            {
                $celular= "Sin&nbsp;Informacion";
            }
            echo "<div class=form-title><h2>Perfil Cordinador de Laboratorios</h2></div><br/>";
            echo " <table class=form-container-tab>";
            echo "<tr><td>";
            echo "<div class=form-title>Cedula</div>";
            echo "<input class=form-field type=text readonly value='$cedula' name=cordinador maxlength=10 required />";
            echo "</td>";
            echo "<td>";
            echo "<div class=form-title>Email</div>";
            echo "<input class=form-field type=text readonly maxlength=10 required value='$email'   />";
            echo "</td>";
            echo "</tr>";
            /*
             * Renglon desde aqui
             */
            echo "<tr><td>";
            echo "<div class=form-title>Nombre</div>";
            echo "<input class=form-field type=text readonly value='$nombres' name=cordinador maxlength=10 required />";
            echo "</td>";
            echo "<td>";
            echo "<div class=form-title>Apellidos</div>";
            echo "<input class=form-field type=text readonly value='$apellidos' name=cordinador maxlength=10 required />";
            echo "</td>";
            echo "</tr>";
            /*
             * Renglon desde aqui
             */
            echo "<tr><td>";
            echo "<div class=form-title>Celular</div>";
            echo "<input class=form-field type=text readonly value='$celular' name=cordinador maxlength=10 required />";
            echo "</td>";
            echo "<td>";
            echo "<div class=form-title>Direccion</div>";
            echo "<input class=form-field type=text readonly value='$direccion' name=cordinador maxlength=10 required />";
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            echo "<div>";
            echo "<form>";
            echo "<input type=hidden name=cedu value=$cedula >";
            echo "<input type=hidden name=email value=$email >";
            echo "<input type=hidden name=noms value=$nombres >";
            echo "<input type=hidden name=apells value=$apellidos >";
            echo "<input type=hidden name=celu value=$celular >";
            echo "<input type=hidden name=cedu value=$direccion >";
            echo "<input type=submit value=Actualizar class=btn-style>";
            echo "</form>";
            echo "</div>";
            
            }
         
        }
      
    }  
    
    
    static function conpassw()
    {

    }
}
