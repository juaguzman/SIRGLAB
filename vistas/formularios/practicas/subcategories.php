<?php
include_once '../../../includes/db_connect.php';

$id_category = $_POST['id_category'];

$result = $mysqli->query("SELECT idmentradas, horaen FROM mregistro where monitores_cedula = $id_category");
if ($result->num_rows > 0) 
    {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['id_category'].'">'.$row['horaen'].'</option>';
    }
}
echo $html;
?>