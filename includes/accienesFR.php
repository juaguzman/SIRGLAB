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
 /*
 * llena el slect de programas para agragar practicas
 */
    
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

/*
 * llena el slect de laboratorios para agragar practicas
 */

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

/*
 * llena el slect de monitores para agragar practicas
 */
static function salMon($id)
{
     include 'db_connect.php';
     echo "<select class=form-field  name=idmon >";
     echo "<option>Seleccione Monitor </option>";
      $result = $mysqli->query("SELECT * FROM monitores where laboratoristas_members_id = $id and estado = 'dn';");
             if ($result->num_rows > 0) 
               {
             while ($row = $result->fetch_assoc()) 
                     {                
             echo '<option value="'.$row['cedula'].'">'.$row['nombres'].'</option>';
                    }
                }
    echo "</select>";
}
 
/*
 *lista las practicas activas de el coordinador de laboratorios
 */
static function listapracticaactiva($idlab)
{
    
    include 'db_connect.php';
        $consulta= "SELECT practicas.* , laboratorios.nombre as 'labo', monitores.nombres as 'monit', programa.nombre as 'prog', materias.nombre as 'mater' FROM practicas,laboratorios, monitores,programa, materias WHERE practicas.laboratorios_idlaboratorios = laboratorios.idlaboratorios AND practicas.monitores_cedula = monitores.cedula AND programa.idprograma = practicas.programa_idprograma and practicas.materias_idmaterias = materias.idmaterias AND practicas.laboratoristas_members_id = 1 and practicas.estado = 'in';";
        $result   = $mysqli->query($consulta);
        
        echo "<table> \n";
        echo "<tr><td>&nbsp;NUM PRACTICA&nbsp;</td><td>&nbsp;LABORATORIO&nbsp;</td><td>&nbsp;MONITOR&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;MATERIA&nbsp;</td><td >&nbsp;PRACTICA&nbsp;</td><td >&nbsp;DOCENTE&nbsp;</td><td >&nbsp;FECHA&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {                      
                 echo "<tr><td>$campo->idpracticas</td><td>$campo->labo</td><td>$campo->monit</td><td>$campo->prog</td><td>$campo->mater</td><td>$campo->nombre_pract</td><td>$campo->docente</td><td>$campo->fecha</td><td><a href=../../../includes/procesarFR.php?id=$campo->idpracticas&req=finp /><img src=../../../imagenes/iconos/stop.png width=30px heigt=30px ></a></td>";
                }
        echo "</table> \n";
      $mysqli->close();        
            
    
}

/*
 * finaliza la practica y actualiza datos de observaciones 
 */
static function finpr($id,$obsercor,$obserdos)
{
      include 'db_connect.php';
    /*
     * actuliza datos de todos los campos, observaciones y hora de fin de practica
     */
    if(!empty($obsercor) && !empty($obserdos))
    {
         if ($insert_stmt = $mysqli->prepare("UPDATE practicas SET obsdocente = ? , obscordinador = ? , horafin = ?, estado= ? where idpracticas = ?;")) 
         {
                 date_default_timezone_set("America/Bogota");
                 $est ="fn";
                $hora = date("H:i:s");
                $fecha = date("Y-m-d");
                $insert_stmt->bind_param('sssss', $obserdos,$obsercor,$hora,$est,$id);
                // Ejecuta la consulta preparada.
                if (! $insert_stmt->execute())
                {
                    header('Location: ../vistas/error.php?err=Registration failure: UPDTAE');
                }
                else
                {
                    $msj="<div id=dialog-message title=Fin Dia> <p>Practica finalizada a las $hora </p></div>";
                   header('Location: ..//vistas/formularios/practicas/finpractica.php?msj='.$msj); 
                }

        }
    }
    else if (empty($obsercor) && !empty($obserdos))
    {
        /*
         * actuliza datos de observaciones de docente y la hora no de observaciones de cordinador
         */
    if ($insert_stmt = $mysqli->prepare("UPDATE practicas SET obsdocente = ?, horafin = ?, estado= ? where idpracticas = ?;")) 
         {
                 date_default_timezone_set("America/Bogota");
                 $est ="fn";
                $hora = date("H:i:s");
                $fecha = date("Y-m-d");
                $insert_stmt->bind_param('ssss', $obserdos,$hora,$est,$id);
                // Ejecuta la consulta preparada.
                if (! $insert_stmt->execute())
                {
                    header('Location: ../vistas/error.php?err=Registration failure: INSERT');
                }
                else
                {
                    $msj="<div id=dialog-message title=Fin Dia> <p>Practica finalizada a las $hora </p></div>";
                   header('Location: ..//vistas/formularios/practicas/finpractica.php?msj='.$msj); 
                }    
        }        
    }
     else if (!empty($obsercor) && empty($obserdos))
    {
        /*
         * actuliza datos de observaciones de docente y la hora no de observaciones de cordinador
         */
    if ($insert_stmt = $mysqli->prepare("UPDATE practicas SET obscordinador = ?, horafin = ?, estado= ? where idpracticas = ?;")) 
         {
                 date_default_timezone_set("America/Bogota");
                 $est ="fn";
                $hora = date("H:i:s");
                $fecha = date("Y-m-d");
                $insert_stmt->bind_param('ssss', $obsercor,$hora,$est,$id);
                // Ejecuta la consulta preparada.
                if (! $insert_stmt->execute())
                {
                    header('Location: ../vistas/error.php?err=Registration failure: INSERT');
                }
                else
                {
                    $msj="<div id=dialog-message title=Fin Dia> <p>Practica finalizada a las $hora </p></div>";
                   header('Location: ..//vistas/formularios/practicas/finpractica.php?msj='.$msj); 
                }    
        }        
    }
 else 
     {
     if ($insert_stmt = $mysqli->prepare("UPDATE practicas SET horafin = ?, estado= ? where idpracticas = ?;")) 
         {
                 date_default_timezone_set("America/Bogota");
                 $est ="fn";
                $hora = date("H:i:s");
                $fecha = date("Y-m-d");
                $insert_stmt->bind_param('sss',$hora,$est,$id);
                // Ejecuta la consulta preparada.
                if (! $insert_stmt->execute())
                {
                    header('Location: ../vistas/error.php?err=Registration failure: INSERT');
                }
                else
                {
                    $msj="<div id=dialog-message title=Fin Dia> <p>Practica finalizada a las $hora </p></div>";
                   header('Location: ..//vistas/formularios/practicas/finpractica.php?msj='.$msj); 
                }    
     }

}
}
/*
 * muestra la practica escogida o en curso 
 */
static function darPractica($id)
{
    include 'db_connect.php';
    
        $consulta= "SELECT practicas.*, laboratoristas.nombres as 'cord', laboratorios.nombre as 'lab', concat(monitores.nombres,' ',monitores.apellidos) as 'nomm',"
                . " programa.nombre as 'prog', materias.nombre as'mat'  FROM practicas,laboratoristas,laboratorios,monitores, programa,materias "
                . "WHERE programa.idprograma = practicas.programa_idprograma  AND "
                . "monitores.cedula = practicas.monitores_cedula AND"
                . " practicas.laboratorios_idlaboratorios = laboratorios.idlaboratorios AND"
                . " practicas.laboratoristas_members_id = laboratoristas.members_id AND"
                . " practicas.materias_idmaterias = materias.idmaterias AND"
                . "  idpracticas = $id LIMIT 1";
        $result   = $mysqli->query($consulta);
        echo " <div class=CSSTableGenerator> ";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<td  colspan=6 ><h2>REGISTRO Y CONTROL DE PRACTICAS </h2> </td>";
        echo "</tr>";
        echo "</thead>";
         echo "<tbody>";
        echo "<tr>";
        echo "<td colspan=6 ></td>";
        echo "</tr>";
       
        while ($campo=mysqli_fetch_object($result)) 
           {                      
            echo "<tr><td>Fecha:</td><td>$campo->fecha</td><td  colspan=2></td><td>Ficha numero:</td><td>$campo->numficha</td></tr>";
            echo "<tr><td colspan=3 >Cordinador:</td><td colspan = 3>$campo->cord</td></tr>";
            echo "<tr><td colspan=3 >Laboratorio:</td><td colspan = 3>$campo->lab</td></tr>";
            echo "<tr><td colspan=3 >Monitor:</td><td colspan = 3>$campo->nomm</td></tr>";
            echo "<tr><td colspan=3 >Programa:</td><td colspan = 3>$campo->prog</td></tr>";
            echo "<tr><td colspan=3 >Espacio academico:</td><td colspan = 3>$campo->mat</td></tr>";
            echo "<tr><td colspan=3 >Nombre de la practica:</td><td colspan = 3>$campo->nombre_pract</td></tr>";
            echo "<tr><td colspan=3 >Docente responsable</td><td colspan = 3>$campo->docente</td></tr>";
            echo "<tr><td colspan=3 >Verificacion de la guia</td><td colspan = 3>$campo->guia</td></tr>";
            echo "<tr><td colspan=3 >$campo->numestudiantes Estudiantes</td><td colspan = 3>$campo->numgrupos Grupos</td></tr>";
            echo "<tr><td colspan=6 ><table><thead><tr><td colspan=4>Horarios</td></tr></thead>";
            echo "<tbody><tr><td colspan=4></td></tr>";
            echo "<tr><td colspan=4>Horario Programado</td></tr>";
            echo "<tr><td colspan=2>Hora programada</td><td colspan=2>Hora ejecucion</td></tr>";
            echo "<tr><td>Hora inicio</td><td>Hora fin</td><td>Hora inicio</td><td>Hora fin</td></tr>";
            echo "<tr><td>$campo->horapl</td><td>$campo->horaplfn</td><td>$campo->horaini</td><td>$campo->horafin</td></tr>";
            echo "</tbody></table></td></tr>";
            echo "<tr><td colspan=3 ><form method=POST action=../../../includes/procesarFR.php > Observaciones del Coordinador</td><td colspan=3 >Observaciones del Docente</td> </tr>";
            echo "<tr ><td colspan=3>";
            echo "<textarea id=area2 name=obsercor >$campo->obscordinador</textarea placeholder= Observaciones&nbsp;del&nbsp;cordinador&nbsp;de&nbsp;laboratorio ></td><td colspan=3 > <textarea id=area2 name=obserdos placeholder= Observaciones&nbsp;del&nbsp;docente&nbsp;presponsable >$campo->obsdocente</textarea></td></tr>";
            echo " <input type=hidden name=id value=$campo->idpracticas >";
           }
                
            echo "</tbody>";
            echo "</table> \n";
            echo "</div>";
            echo "<div>";
            echo "<input type=hidden name=req value=fin >";
            echo "<input type=submit value=Finalizar class=btn-style>";
            echo "</form>";
            echo "</div>";
      $mysqli->close(); 
    
//    $prep_stmt1 = "SELECT * FROM practicas WHERE idpracticas = ? LIMIT 1";
//        $stmt1 = $mysqli->prepare($prep_stmt1);
//        if ($stmt1) 
//           {
//            $stmt1->bind_param('s', $id);
//            $stmt1->execute();
//            $stmt1->store_result(); 
//            // Obtiene las variables del resultado.
//            $stmt1->bind_result($idpractica,$nombre_pract ,$docente, $guia,
//                    $numgrup,$numestudiantes,$obsdocente,$obscordinador,
//                    $laboratoristas_members_id,$laboratorios_idlaboratorios,
//                    $monitores_cedula,$materias_idmaterias,$programa_idprograma,
//                    $horapl,$horaini,$horaplfn,$horafin,$fecha,$estado,$numficha);                    
//            $stmt1->fetch();
//           }
    
}


}

//        $msj="<div id=dialog-message title=Fin Dia> <p>acaba de marcar su salida</p></div>";            