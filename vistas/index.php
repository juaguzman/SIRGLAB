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
        <link rel="stylesheet" href="../styles/monitores_1.css" />
        <link rel="stylesheet" href="../styles/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
        <script>
        $(function() {
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
  </script>
 
    </head>
    
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
        <?php if(isset($_REQUEST['msj'])){
        $msj = $_REQUEST['msj'];
     echo "$msj";
             }?>
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
                                <a href="monitores/index.php"><img  class="dentro" src="../imagenes/iconoMon.png"></a>
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