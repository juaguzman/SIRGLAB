<!DOCTYPE html>
<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="../styles/main.css" />
        <link rel="stylesheet" href="../styles/menu.css" />
 
    </head>
    
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
            <div class="img1"  >
                <img class="imge" src="../imagenes/alvernia.PNG">
            </div>    
            <div  class="tabla2">
                <table class="tablaI">
                    <tbody>
                        <tr>
                            <td class="cont1">
                                <a href="formularios/practicas/index.php"><img class="dentro" src="../imagenes/iconoPra.png"></a>
                            </td>
                            <td class="cont1" >
                                <a href="monitores.php"><img  class="dentro" src="../imagenes/iconoMon.png"></a>
                            </td>
                            <td class="cont1 ">
                                <a href="investigacion.php"><img  class="dentro" src="../imagenes/iconoInv.png"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>
           
    </body>
</html>