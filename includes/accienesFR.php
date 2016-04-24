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

static function sallabor($id)
{
     include 'db_connect.php';
     echo "<select class=form-field  name=labor id=labor>";
     echo "<option >Seleccione Laboratorio </option>";
      $result = $mysqli->query("SELECT idlaboratorios, nombre FROM laboratorios where laboratoristas_members_id = $id");
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
 * Select de todos los laboratorios no po id de cordinador
 */
static function sallaborTot()
{
     include 'db_connect.php';
     echo "<select class=form-field  name=labor id=labor>";
     echo "<option >Seleccione Laboratorio </option>";
      $result = $mysqli->query("SELECT idlaboratorios, nombre FROM laboratorios");
             if ($result->num_rows > 0) 
               {
             while ($row = $result->fetch_assoc()) 
                     {                
             echo '<option value="'.$row['idlaboratorios'].'">'.$row['nombre'].'</option>';
                    }
                }
    echo "</select>";
}

static function sellabora()
{
     include 'db_connect.php';
     echo "<select class=form-field  name=cord id=cord>";
     echo "<option >Seleccione Laboratorio </option>";
      $result = $mysqli->query("SELECT members_id, CONCAT(nombres,' ',apellidos) as 'nombres' FROM laboratoristas");
             if ($result->num_rows > 0) 
               {
             while ($row = $result->fetch_assoc()) 
                     {                
             echo '<option value="'.$row['members_id'].'">'.$row['nombres'].'</option>';
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
        $consulta= "SELECT practicas.* , laboratorios.nombre as 'labo', monitores.nombres as 'monit', programa.nombre as 'prog', materias.nombre as 'mater' FROM practicas,laboratorios, monitores,programa, materias WHERE practicas.laboratorios_idlaboratorios = laboratorios.idlaboratorios AND practicas.monitores_cedula = monitores.cedula AND programa.idprograma = practicas.programa_idprograma and practicas.materias_idmaterias = materias.idmaterias AND practicas.laboratoristas_members_id = $idlab and practicas.estado = 'in';";
        $result   = $mysqli->query($consulta);
        echo "<table> \n";
        echo "<thead><tr><td colspan=10>Listado de practicas activas</td></tr></thead>";
        echo "<tbody> \n";
        echo "<tr><td>&nbsp;NUM PRACTICA&nbsp;</td><td>&nbsp;LABORATORIO&nbsp;</td><td>&nbsp;MONITOR&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;MATERIA&nbsp;</td><td >&nbsp;PRACTICA&nbsp;</td><td >&nbsp;DOCENTE&nbsp;</td><td >&nbsp;FECHA&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {                      
                 echo "<tr><td>$campo->numficha</td><td>$campo->labo</td><td>$campo->monit</td><td>$campo->prog</td><td>$campo->mater</td><td>$campo->nombre_pract</td><td>$campo->docente</td><td>$campo->fecha</td><td><a href=../../../includes/procesarFR.php?id=$campo->idpracticas&req=finp /><img src=../../../imagenes/iconos/stop.png width=30px heigt=30px ></a></td>";
                }
        echo "</tbody></table> \n";
      $mysqli->close();        
            
    
}

static function listapracticas($idlab)
{
    
    include 'db_connect.php';
        $consulta= "SELECT practicas.* , laboratorios.nombre as 'labo', monitores.nombres as 'monit', programa.nombre as 'prog', materias.nombre as 'mater' FROM practicas,laboratorios, monitores,programa, materias WHERE practicas.laboratorios_idlaboratorios = laboratorios.idlaboratorios AND practicas.monitores_cedula = monitores.cedula AND programa.idprograma = practicas.programa_idprograma and practicas.materias_idmaterias = materias.idmaterias AND practicas.laboratoristas_members_id = $idlab and practicas.estado = 'in';";
        $result   = $mysqli->query($consulta);
        echo "<table> \n";
        echo "<thead><tr><td colspan=10>Listado de practicas activas</td></tr></thead>";
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
 * lista todas la practicas de un cordinador 
 */
static function listatodpractlab($idlab)
{
    $horas = "0:00:00";    
     include 'db_connect.php';
        $consulta= "SELECT practicas.* , laboratorios.nombre as 'labo', monitores.nombres as 'monit', programa.nombre as 'prog', materias.nombre as 'mater' FROM practicas,laboratorios, monitores,programa, materias WHERE practicas.laboratorios_idlaboratorios = laboratorios.idlaboratorios AND practicas.monitores_cedula = monitores.cedula AND programa.idprograma = practicas.programa_idprograma and practicas.materias_idmaterias = materias.idmaterias AND practicas.laboratoristas_members_id = $idlab ORDER BY laboratorios.nombre desc, practicas.numficha;";
        $result   = $mysqli->query($consulta);
        $sumHoras="0:00:00";
        $sumh="";
        $summ="";
        $sums="";
        echo "<table> \n";
        echo "<thead><tr><td colspan=12>Listado de practicas</td></tr></thead>";
        echo "<tr><td>&nbsp;NUM PRACTICA&nbsp;</td><td>&nbsp;LABORATORIO&nbsp;</td><td>&nbsp;MONITOR&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;MATERIA&nbsp;</td><td >&nbsp;PRACTICA&nbsp;</td><td >&nbsp;DOCENTE&nbsp;</td><td >&nbsp;FECHA&nbsp;</td><td >&nbsp;HORA INI&nbsp;</td><td >&nbsp;HORA FIN&nbsp;</td><td >&nbsp;TOTAL HORAS&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {     
                   $hini = $campo->horaini;
                   $hfin=$campo->horafin;
                   if(empty($hfin))
                   {
                       $horas="Sin Finalizar";
                   }
                   else
                   {
                   $horas=date("H:i:s", strtotime("00:00:00") + strtotime($hfin) - strtotime($hini) );
                   $horaSplit = explode(":", $horas);
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
                 echo "<tr><td>$campo->numficha</td><td>$campo->labo</td><td>$campo->monit</td><td>$campo->prog</td><td>$campo->mater</td><td>$campo->nombre_pract</td><td>$campo->docente</td><td>$campo->fecha</td><td>$campo->horaini</td><td>$campo->horafin</td><td>$horas</td><td><a href=../../../includes/procesarFR.php?id=$campo->idpracticas&req=ver /><img src=../../../imagenes/iconos/ver.png width=30px heigt=30px ></a></td>";
                }
                $sumHoras = "$sumh:$summ:$sums";
                echo "<tr><td colspan=10 >Total de Horas</td><td>$sumHoras</td><td>Generar Reporte </td> </tr>";
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
            echo "<textarea id=area2 name=obsercor  placeholder= Observaciones&nbsp;del&nbsp;cordinador&nbsp;de&nbsp;laboratorio  >$campo->obscordinador</textarea></td><td colspan=3 > <textarea id=area2 name=obserdos placeholder= Observaciones&nbsp;del&nbsp;docente&nbsp;responsable >$campo->obsdocente</textarea></td></tr>";
            echo " <input type=hidden name=id value=$campo->idpracticas >";
           }
                
            echo "</tbody>";
            echo "</table> \n";
            echo "</div>";
            echo "<div>";
            echo "<input type=hidden name=req value=terminap >";
            echo "<input type=submit value=Finalizar class=btn-style>";
            echo "</form>";
            echo "</div>";
      $mysqli->close(); 

}

/*
 * muesta un listado de las practicas del cordinador de practicas sesion iniciada
 */

static function darPracticas($id)
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
            echo "<tr><td colspan=3 > Observaciones del Coordinador</td><td colspan=3 >Observaciones del Docente</td> </tr>";
            echo "<tr ><td colspan=3>";
            echo "<textarea id=area2 name=obsercor placeholder= Observaciones&nbsp;del&nbsp;cordinador&nbsp;de&nbsp;laboratorio readonly  >$campo->obscordinador</textarea ></td><td colspan=3 > <textarea id=area2 name=obserdos readonly placeholder= Observaciones&nbsp;del&nbsp;docente&nbsp;presponsable >$campo->obsdocente</textarea></td></tr>";
           }
                
            echo "</tbody>";
            echo "</table> \n";           
            echo "</div>";
      $mysqli->close(); 

    
}

/*
 * asiga laboratorio a el cordinado de laboratorios
 */
static function asiglaborat()
{
    include 'db_connect.php';
    $consulta= "SELECT * FROM laboratorios;";
        $result   = $mysqli->query($consulta);
        echo "<table> \n";
        echo "<thead><tr><td colspan=10>Lista de laboratorios Laboratoristas</td></tr></thead>";
        echo "<tbody> \n";
        echo "<tr><td>&nbsp;ID LABORATORIO&nbsp;</td><td>&nbsp;NOMBRE&nbsp;</td><td>&nbsp;SEDE&nbsp;</td><td >&nbsp;CORDINADOR&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {                      
            echo "<tr><td>$campo->idlaboratorios</td><td>$campo->nombre</td><td>$campo->sede</td>";
                                        if($campo->laboratoristas_members_id<1)
                                        {
                                            echo "<td>No asignado</td>";
                                        }
                                        else 
                                        {
                                                  $prep_stmt = "SELECT CONCAT(nombres,' ',apellidos)   FROM laboratoristas WHERE members_id = ? LIMIT 1;";
                                                  $stmt = $mysqli->prepare($prep_stmt);
                                                  if ($stmt) 
                                                        {
                                                        $stmt->bind_param('s', $campo->laboratoristas_members_id);
                                                        $stmt->execute();
                                                        $stmt->store_result(); 
                                                        // Obtiene las variables del resultado.
                                                        $stmt->bind_result($nombre);
                                                        $stmt->fetch();
                                                         echo "<td>$nombre</td>"; 
                                                        }
                                        }
           
            echo "</tr>";
                }
                   echo "</tbody>";                   
                  echo "</table>";
                
             
    
}


/*
 * muesta las investigacion que estan en curso y que no an sido finalizadas
 */
static function listainvestigactiva($idlab)
{
    
    include 'db_connect.php';
        $consulta= "SELECT investigaciones.* , laboratorios.nombre as 'labo', monitores.nombres as 'monit'  FROM investigaciones, laboratorios, monitores WHERE investigaciones.laboratorios_idlaboratorios = laboratorios.idlaboratorios AND investigaciones.monitores_cedula = monitores.cedula AND investigaciones.laboratoristas_members_id = $idlab and investigaciones.estado = 'in';";
        $result   = $mysqli->query($consulta);
        echo "<table> \n";
        echo "<thead><tr><td colspan=10>Listado de investigaciones activas</td></tr></thead>";
        echo "<tbody> \n";
        echo "<tr><td>&nbsp;NUM INVESTIGACION&nbsp;</td><td>&nbsp;LABORATORIO&nbsp;</td><td>&nbsp;NOMBRE DE LA INVESTIGACION&nbsp;</td><td >&nbsp;INVESTIGADOR&nbsp;</td><td >&nbsp;CEDULA INVESTIGADOR&nbsp;</td><td >&nbsp;MONITOR&nbsp;</td><td >&nbsp;DOCENTE&nbsp;</td><td >&nbsp;FECHA&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {                      
                 echo "<tr><td>$campo->numficha</td><td>$campo->labo</td><td>$campo->nombre_investg</td><td>$campo->investigador</td><td>$campo->cedulainvestg</td><td>$campo->monit</td><td>$campo->asesor</td><td>$campo->fecha</td><td><a href=../../../includes/procesarFR.php?id=$campo->idinvestigacion&req=fini /><img src=../../../imagenes/iconos/stop.png width=30px heigt=30px ></a></td>";
                }
        echo "</tbody></table> \n";
      $mysqli->close();        
            
    
}






/*
 * muesta la investigacion para terminarla y agregar las observaciones del cordinador, investigador y las condiciones de entrega de 
 * equipos e insumos
 */
static function darInvestigacion($id)
{
    include 'db_connect.php';
    
        $consulta= "SELECT i.*, labs.nombre as 'laboratorio', cord.nombres as 'cordinador', monit.nombres as 'monitor' "
                . "FROM investigaciones i "
                . "INNER JOIN laboratoristas cord on (cord.members_id = i.laboratoristas_members_id) "
                . "INNER JOIN laboratorios labs on (labs.idlaboratorios = i.laboratorios_idlaboratorios) "
                . "INNER JOIN monitores monit on (monit.cedula = i.monitores_cedula) "
                . "WHERE i.idinvestigacion = $id LIMIT 1";
        $result   = $mysqli->query($consulta);
        echo " <div class=CSSTableGenerator> ";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<td  colspan=6 ><h2>REGISTRO Y CONTROL DE INVESTIGACIONES </h2> </td>";
        echo "</tr>";
        echo "</thead>";
         echo "<tbody>";
        echo "<tr>";
        echo "<td colspan=6 ></td>";
        echo "</tr>";
       
        while ($campo=mysqli_fetch_object($result)) 
           {  
            $id = $campo->idinvestigacion;
            echo "<tr><td>Fecha:</td><td>$campo->fecha</td><td  colspan=2></td><td>Ficha numero:</td><td>$campo->numficha</td></tr>";
            echo "<tr><td colspan=3 >Cordinador:</td><td colspan = 3>$campo->cordinador</td></tr>";
            echo "<tr><td colspan=3 >Laboratorio:</td><td colspan = 3>$campo->laboratorio</td></tr>";
            echo "<tr><td colspan=3 >Monitor:</td><td colspan = 3>$campo->monitor</td></tr>";
            echo "<tr><td colspan=3 >Nombre de la investigacion:</td><td colspan = 3>$campo->nombre_investg</td></tr>";
            echo "<tr><td colspan=3 >Nombre del investigador:</td><td colspan = 3>$campo->investigador</td></tr>";
            echo "<tr><td colspan=3 >Cedula del investigador</td><td colspan = 3>$campo->cedulainvestg</td></tr>";
            echo "<tr><td colspan=3 >Asesor de la investigacion</td><td colspan = 3>$campo->asesor</td></tr>";
            echo "<tr><td colspan=6 ><table><thead><tr><td colspan=4>Horarios</td></tr></thead>";
            echo "<tbody><tr><td colspan=4></td></tr>";
            echo "<tr><td colspan=4>Horario</td></tr>";
            echo "<tr><td>Hora inicio</td><td>Hora fin</td></tr>";
            echo "<tr><td>$campo->horaini</td><td>$campo->horafin</td></tr>";
            echo "</tbody><form method=POST action=../../../includes/procesarFR.php ></table></td></tr>";
            $consulta2 ="SELECT equipo FROM equiposentre WHERE investigaciones_idinvestigacion = $campo->idinvestigacion;";
            $result2   = $mysqli->query($consulta2);
            $num = mysqli_num_rows($result2)+1;
            $consulta3="SELECT * FROM inumosentre WHERE investigaciones_idinvestigacion = $campo->idinvestigacion;";
            $result3   = $mysqli->query($consulta3);
            $num2= mysqli_num_rows($result3)+1;
            if($num>$num2)
            {
                $row=$num+1;
            }
            else
            {
                $row=$num2+1;
            }
            echo "<tr><td colspan=6 ><table><thead><tr><td colspan=6>Equips e Insumos utilizados</td></tr></thead>";
            echo '<tbody><tr><td colspan=3></td></tr>';
            echo "<tr>";
            echo "<td>";
                    echo "<table><thead><tr><td colspan=2 >Equipos</td></thead></tr>";
                     echo "<tr><tbody><td>Numero</td><td>Equipos</td></tr>";
                    $cont=1;
                    while ($campo2=mysqli_fetch_object($result2)) 
                   { 
                        echo "<tr><td>$cont</td><td>$campo2->equipo</td></tr>";
                        $cont++;
                    }

                    echo "</tbody></table>";
            echo "</td>";
            
            echo "<td>";
                    echo "<table><thead><tr><td colspan=2 >Insumos</td></thead></tr>";
                    echo "<tr><tbody><td>Numero</td><td>Inusmo</td></tr>";
                    $cont1=1;
                    while ($campo3=mysqli_fetch_object($result3)) 
                   { 
                        echo "<tr><td>$cont1</td><td>$campo3->insumo</td></tr>";
                        $cont1++;
                    }
                    echo "</tbody></table>";
            echo "</td>";
            echo "<td >";
                     echo "<table><thead><tr><td colspan=2 >Condiciones de devolucion</td></thead></tr>";
                     echo "<tr><tbody><td colspan =2 ></td></tr>";
                     echo "<tr><td rowspan=$row ><textarea required id=area3 name=conddevol placeholder= Condiciones&nbsp;de&nbsp;devolucion></textarea > </td></tr>";
                    
            echo "</td>";
             echo "</tbody></table>";
            echo "</tr>";
            
            
             echo "</tbody></table></td></tr>";
            echo "<tr><td colspan=6 ><table><thead><tr><td colspan=4>Observaciones</td></tr></thead>";
            echo "<tbody><tr><td colspan=6></td></tr>";
            echo "<tr><td colspan=3 > Observaciones del Coordinador <textarea id=area2 name=obsercor placeholder= Observaciones&nbsp;del&nbsp;cordinador&nbsp;de&nbsp;laboratorio>$campo->obscordinador</textarea > </td><td colspan=3 >Observaciones del Investigador  <textarea id=area2 name=obserinves placeholder= Observaciones&nbsp;del&nbsp;investigador >$campo->obinvestigador</textarea></td> </tr>";
            echo "</tbody></table></td></tr>";
           }
                
            echo "</tbody>";
            echo "</table> \n";           
               echo "</div>";
            echo "<div>";
            echo "<input type=hidden name=req value=terminai >";
            echo "<input type=hidden name=id value=$id >";
            echo "<input type=submit value=Finalizar class=btn-style>";
            echo "</form>";
            echo "</div>";
      $mysqli->close(); 

    
}


static function finin($id,$obsercor,$obserinves,$conddevol)
{
      include 'db_connect.php';
    
    if(!empty($obsercor) && !empty($obserinves))
    {
         if ($insert_stmt = $mysqli->prepare("UPDATE investigaciones SET obinvestigador=?, obscordinador=? ,horafin=?,estado=?,condevol=? WHERE idinvestigacion = ?;")) 
         {
                 date_default_timezone_set("America/Bogota");
                $est ="fn";
                $hora = date("H:i:s");
                $fecha = date("Y-m-d");
                $insert_stmt->bind_param('ssssss', $obserinves,$obsercor,$hora,$est,$conddevol,$id);
                // Ejecuta la consulta preparada.
                if (! $insert_stmt->execute())
                {
                    header('Location: ../vistas/error.php?err=Registration failure: UPDTAE');
                }
                else
                {
                    $msj="<div id=dialog-message title=Fin Dia> <p>Investigacion finalizada a las $hora correctamente </p></div>";
                   header('Location: ..//vistas/formularios/investigacion/fininvestig.php?msj='.$msj); 
                }

        }
    }
    else if(!empty($obsercor) && empty($obserinves))
    {
         if ($insert_stmt = $mysqli->prepare("UPDATE investigaciones SET obscordinador=? ,horafin=?,estado=?,condevol=? WHERE idinvestigacion = ?;")) 
         {
                 date_default_timezone_set("America/Bogota");
                $est ="fn";
                $hora = date("H:i:s");
                $fecha = date("Y-m-d");
                $insert_stmt->bind_param('sssss', $obsercor,$hora,$est,$conddevol,$id);
                // Ejecuta la consulta preparada.
                if (! $insert_stmt->execute())
                {
                    header('Location: ../vistas/error.php?err=Registration failure: UPDTAE');
                }
                else
                {
                    $msj="<div id=dialog-message title=Fin Dia> <p>Investigacion finalizada a las $hora correctamente </p></div>";
                   header('Location: ..//vistas/formularios/investigacion/fininvestig.php?msj='.$msj); 
                }

        }
    }
    else if(empty($obsercor) && !empty($obserinves))
    {
         if ($insert_stmt = $mysqli->prepare("UPDATE investigaciones SET obinvestigador=? ,horafin=?,estado=?,condevol=? WHERE idinvestigacion = ?;")) 
         {
                 date_default_timezone_set("America/Bogota");
                $est ="fn";
                $hora = date("H:i:s");
                $fecha = date("Y-m-d");
                $insert_stmt->bind_param('sssss', $obserinves,$hora,$est,$conddevol,$id);
                // Ejecuta la consulta preparada.
                if (! $insert_stmt->execute())
                {
                    header('Location: ../vistas/error.php?err=Registration failure: UPDTAE');
                }
                else
                {
                    $msj="<div id=dialog-message title=Fin Dia> <p>Investigacion finalizada a las $hora correctamente </p></div>";
                   header('Location: ..//vistas/formularios/investigacion/fininvestig.php?msj='.$msj); 
                }

        }
    }
     else if(empty($obsercor) && empty($obserinves))
    {
         if ($insert_stmt = $mysqli->prepare("UPDATE investigaciones SET horafin=?,estado=?,condevol=? WHERE idinvestigacion = ?;")) 
         {
                 date_default_timezone_set("America/Bogota");
                $est ="fn";
                $hora = date("H:i:s");
                $fecha = date("Y-m-d");
                $insert_stmt->bind_param('ssss', $hora,$est,$conddevol,$id);
                // Ejecuta la consulta preparada.
                if (! $insert_stmt->execute())
                {
                    header('Location: ../vistas/error.php?err=Registration failure: UPDTAE');
                }
                else
                {
                    $msj="<div id=dialog-message title=Fin Dia> <p>Investigacion finalizada a las $hora correctamente </p></div>";
                   header('Location: ..//vistas/formularios/investigacion/fininvestig.php?msj='.$msj); 
                }

        }
    }
    else
    {
        $msj="<div id=dialog-message title=Error> <p>Ocurrio un error al finalizar la investigacion intente de nuevo</p></div>";
        header('Location: ..//vistas/formularios/investigacion/fininvestig.php?msj='.$msj); 
    }
    
}


/*
 * lista todas la Investigaciones de un cordinador 
 */
static function ListatodInvestigCord($idlab)
{
    $horas = "0:00:00";    
     include 'db_connect.php';
        $consulta= "SELECT investigaciones.* , laboratorios.nombre as 'labo', monitores.nombres as 'monit'  FROM investigaciones,laboratorios, monitores WHERE investigaciones.laboratorios_idlaboratorios = laboratorios.idlaboratorios AND investigaciones.monitores_cedula = monitores.cedula AND investigaciones.laboratoristas_members_id = $idlab ORDER BY laboratorios.nombre desc, investigaciones.numficha;";
        $result   = $mysqli->query($consulta);
        $sumHoras="0:00:00";
        $sumh="";
        $summ="";
        $sums="";
        echo "<table> \n";
        echo "<thead><tr><td colspan=12>Listado de practicas</td></tr></thead>";
        echo "<tr><td>&nbsp;NUM PRACTICA&nbsp;</td><td>&nbsp;LABORATORIO&nbsp;</td><td>&nbsp;MONITOR&nbsp;</td><td >&nbsp;PROGRAMA&nbsp;</td><td >&nbsp;MATERIA&nbsp;</td><td >&nbsp;PRACTICA&nbsp;</td><td >&nbsp;DOCENTE&nbsp;</td><td >&nbsp;FECHA&nbsp;</td><td >&nbsp;HORA INI&nbsp;</td><td >&nbsp;HORA FIN&nbsp;</td><td >&nbsp;TOTAL HORAS&nbsp;</td><td >&nbsp;OPCIONES&nbsp;</td></tr> \n";
        while ($campo=mysqli_fetch_object($result)) 
                {     
                   $hini = $campo->horaini;
                   $hfin=$campo->horafin;
                   if(empty($hfin))
                   {
                       $horas="Sin Finalizar";
                   }
                   else
                   {
                   $horas=date("H:i:s", strtotime("00:00:00") + strtotime($hfin) - strtotime($hini) );
                   $horaSplit = explode(":", $horas);
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
                 echo "<tr><td>$campo->numficha</td><td>$campo->labo</td><td>$campo->monit</td><td>$campo->nombre_investg</td><td>$campo->investigador</td><td>$campo->cedulainvestg</td><td>$campo->asesor</td><td>$campo->fecha</td><td>$campo->horaini</td><td>$campo->horafin</td><td>$horas</td><td><a href=../../../includes/procesarFR.php?id=$campo->idinvestigacion&req=verin /><img src=../../../imagenes/iconos/ver.png width=30px heigt=30px ></a></td>";
                }
                $sumHoras = "$sumh:$summ:$sums";
                echo "<tr><td colspan=10 >Total de Horas</td><td>$sumHoras</td><td>Generar Reporte </td> </tr>";
        echo "</table> \n";
      $mysqli->close();              
            
    
}
}

//        $msj="<div id=dialog-message title=Fin Dia> <p>acaba de marcar su salida</p></div>";  

//<td colspan=2 rowspan=$num >Insumos <textarea id=area2 name=conddevol placeholder= Condiciones&nbsp;de&nbsp;devolucion></textarea > </td>