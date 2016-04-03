<?php
include_once '../../../includes/db_connect.php';
$id_category = $_POST['id_category'];

$result = $mysqli->query("SELECT idprograma, programa.nombre as 'nombre' FROM programa, programas_has_laboratorios, laboratorios where programa.idprograma = programas_has_laboratorios.programa_idprograma and laboratorios.idlaboratorios = programas_has_laboratorios.laboratorios_idlaboratorios and laboratorios.idlaboratorios = $id_category");
$html .= '<option>Seleccione un programa</option>';
if ($result->num_rows > 0) 
    {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['idprograma'].'">'.$row['nombre'].'</option>';
    }
}
echo $html;
?>