<!DOCTYPE html>
<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/accionesMN.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
            <title>Inicio de sesión segura: Página protegida</title>
            <link rel="stylesheet" href="../../styles/main.css" />
            <link rel="stylesheet" href="../../styles/menu.css" />
            <link rel="stylesheet" href="../../styles/monitores_1.css" />
            <link rel="stylesheet" href="../../styles/tabla.css" />
            <link rel="stylesheet" href="../../styles/jquery-ui.css" />
            <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
            <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
            <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
         <script>
 function abrir_dialog(idl,cedu) {
      $( "#dialog" ).dialog(
              {
          modal: true,
          buttons: {
                "Sí": function() 
                {
                    $( this ).dialog( "close" );
                   window.location.href = "../../includes/procesar_mn.php?req=asig&id="+idl+"&cedu="+cedu;
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
      });
    };
    </script>
        
 
    </head>
    
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
            <p>¡Bienvenido, <?php echo htmlentities($_SESSION['username']); ?>!</p>
            <div class="CSSTableGenerator">
                
      <div id="dialog" title="Asignar monitor" style="display:none;"> <p>Desea asignar este monitor a sus monitores</p></div>
           <?php 
              $idl = $_SESSION['user_id'];
               monitores::asignarM($idl)?>
            </div> 
            
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>
           
    </body>
</html>