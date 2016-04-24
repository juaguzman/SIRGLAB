<?php
include_once 'functions.php';
include 'db_connect.php';

sec_session_start();
$band = FALSE;
$id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT * FROM investigaciones WHERE estado = 'in' AND laboratoristas_members_id = $id;");
             if ($result->num_rows > 0) 
               {
                 $band=TRUE;  
                }
$result1 = $mysqli->query("SELECT * FROM practicas WHERE estado = 'in' AND laboratoristas_members_id = $id;");
             if ($result1->num_rows > 0) 
               {
                 $band=TRUE;  
               }
$result2 = $mysqli->query("select * FROM monitores WHERE estado = 'dn' AND laboratoristas_members_id = $id;");
             if ($result1->num_rows > 0) 
               {
                 $band=TRUE;  
               }

if ($band==TRUE)
{
                
$msj="<div id=dialog-message title=Error> <p>no se puede cerrar la Session por que existen monitores, pacticas o investigaciones activas en este momento </p></div>";
header('Location: ../vistas/index.php?msj='.$msj);    
}
else
{
    // Desconfigura todos los valores de sesión.
$_SESSION = array();
 
// Obtiene los parámetros de sesión.
$params = session_get_cookie_params();
 
// Borra el cookie actual.
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Destruye sesión. 
session_destroy();
header('Location: ../index.php');
}
