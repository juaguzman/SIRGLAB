<?php
include_once '../../../includes/db_connect.php';
$id_category = $_POST['id_category'];
$result = $mysqli->query("SELECT materias.idmaterias, materias.nombre from materias, programa, programa_has_matrias where materias.idmaterias = programa_has_matrias.materias_idmaterias AND programa.idprograma = programa_has_matrias.programa_idprograma AND programa.idprograma =$id_category");
if ($result->num_rows > 0) 
    {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['idmaterias'].'">'.$row['nombre'].'</option>';
    }
}
echo $html;
?>