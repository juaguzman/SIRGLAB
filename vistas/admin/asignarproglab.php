<!DOCTYPE html>
<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/accionesPR.php';
include_once '../../includes/accienesFR.php';
include_once '../../includes/asignarprogslabs.inc.php';

 
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
        <link rel="stylesheet" href="../../styles/jquery-ui.css" />
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
        
        <div id="monadd">
            
            <form class="form-container" method="POST" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
        <div class="form-title"><h2>Asignar Programa</h2></div><br/>
        <div class="form-title">Laboratorio <?php if (!empty($error_msg_lab)) { echo $error_msg_lab;} ?></div>
       <?php
       $id = $_SESSION['user_id'];
           formularios::sallabor($id);?>
        <div class="form-title">Programas <?php if (!empty($error_msg_prog)) { echo $error_msg_prog;} ?></div>
        <?php
           programa::ckeProg();
       ?>
         <div class="submit-container">
            <input type="hidden" name="req" value="asign" />
            <input class="submit-button" type="submit" value="Asignar"/>
        </div>
        </form>
         </div>
       
       
          
          
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>
           
    </body>
</html>