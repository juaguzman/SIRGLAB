<!DOCTYPE html>
<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/iniciodia.inc.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio monitoria</title>
        <link rel="stylesheet" href="../../styles/main.css" />
        <link rel="stylesheet" href="../../styles/monitores_1.css" />
        <link rel="stylesheet" href="../../styles/menu.css" />
        <link rel="stylesheet" href="../../styles/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
        <script>
         $(function() 
         {
         $( "#dialog" ).dialog();
         });
  </script>
   
 
    </head>
    
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
       

        <div id="monadd">
            <form class="form-container" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-title"><h2>Registrar Monitoria</h2></div>
                <div class="form-title">Cedula  <?php if (!empty($error_msg)) { echo $error_msg;} ?></div>
                <input class="form-field" type="number" value="" name="cedula" maxlength="10" required placeholder="Cedula"/>
                <div class="submit-container">
                    <?php $id = $_SESSION['user_id']?>
                    <input type="hidden" name="idlab" value="<?php echo $id;?>" />
                    <input class="submit-button" type="submit" value="Iniciar"/>
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