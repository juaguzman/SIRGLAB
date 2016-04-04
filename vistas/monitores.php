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
            <p>¡Bienvenido, <?php echo htmlentities($_SESSION['username']); ?>!</p>
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>
            <div class="img1"  >
                <img class="imge" src="../imagenes/practicas/laboratorio-unimar3.jpg">
            </div>    
            <div  class="tabla2">
                <table class="tablaI">
                    <tbody>
                        <tr>
                            <th colspan="3"><h1>Monitiores</h1></th>
                        </tr>
                        <tr>
                            <td class="cont1">
                                <img class="dentro" src="../imagenes/monitores/iconoMon+.png"><a href="#"></a>
                            </td>
                            <td class="cont1" >
                                <img  class="dentro" src="../imagenes/monitores/iconoMon-.png"><a href="#"></a>
                            </td>
                            <td class="cont1 ">
                                <img  class="dentro" src="../imagenes/monitores/iconoMonV.png"><a href="#"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </body>
</html>