<!DOCTYPE html>
<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
include_once '../../../includes/accienesFR.php';
 
sec_session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="../../../styles/main.css" />
        <link rel="stylesheet" href="../../../styles/menu.css" />
        <link rel="stylesheet" href="../../../styles/tabla.css" />
        <link rel="stylesheet" href="../../../styles/monitores_1.css" />
        <link rel="stylesheet" href="../../../styles/formularios.css" />
    </head>
    
    <body>
        <?php include './header.php'; ?>
        <?php if (login_check($mysqli) == true) : ?>
         
        <?php if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];
            formularios::darPracticas($id); ?>   <?php }?>        
        <?php else : ?>
      
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>