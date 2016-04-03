<!DOCTYPE html>
<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/accionesMN.php';
 
sec_session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="../../styles/main.css" />
        <link rel="stylesheet" href="../../styles/menu.css" />
        <link rel="stylesheet" href="../../styles/tabla.css" />
        <link rel="stylesheet" href="../../styles/monitores_1.css" />
        
 
    </head>
    
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
           
           <div id=dialog title=Asignar Monitor style=display:none;><p>Desea agregar el monitor sus monitores.</p></div>
             <div class="CSSTableGenerator" > 
           <?php    
                $id = $_SESSION['user_id'];
               monitores::ListarMonitoresCord($id)?>
            </div>  
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>
           
    </body>
</html>