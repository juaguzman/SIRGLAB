
<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/procmonitores.inc.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agregar monitores</title>
        <link rel="stylesheet" href="../../styles/main.css" />
        <link rel="stylesheet" href="../../styles/monitores_1.css" />
        <link rel="stylesheet" href="../../styles/menu.css" />
   
 
    </head>
    
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
       

        <div id="monadd">
            <form class="form-container" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-title"><h2>Agregar Monitor</h2></div><br/>
<!--                <div><?php if (!empty($error_msg)) { echo $error_msg;} ?></div>-->
                <div class="form-title">Cedula  <?php if (!empty($error_msg_cedu)) { echo $error_msg_cedu;} ?></div>
                <input class="form-field" type="number" value="<?php if (!empty($cedu)) { echo $cedu;} ?>" name="cedula" maxlength="10" required />               
                <div class="form-title">Nombres</div>
                <input class="form-field" type="text" name="nombres" value="<?php if (!empty($nom)) { echo $nom;} ?>" maxlength="45" required /><br />
                <div class="form-title">Apellidos</div>
                <input class="form-field" type="text" name="apellidos" value="<?php if (!empty($apell)) { echo $apell;} ?>" maxlength="45" required /><br />
                <div class="form-title">Celular <?php if (!empty($error_msg_celu)) { echo $error_msg_celu;} ?></div>
                <input class="form-field" type="number" name="celular" value="<?php if (!empty($celu)) { echo $celu;} ?>" required minlength="9" maxlength="10" /><br />
                <div class="form-title">Email <?php if (!empty($error_msg_emi)) { echo $error_msg_emi;} ?></div>
                <input class="form-field" type="email" name="email" value="<?php if (!empty($email)) { echo $email;} ?>" required />
                 <br />               
                <div class="form-title">Programa</div>
                <input class="form-field" type="text" name="programa" value="<?php if (!empty($prog)) { echo $prog;} ?>" required /><br />
                <div class="form-title">semestre</div>
                <input class="form-field" type="number" name="semestre" max="9" value="<?php if (!empty($semes)) { echo $semes;} ?>" required /><br />
                <div class="submit-container">
                    <input type="hidden" name="rsp" value="agregar" />
                    <input class="submit-button" type="submit" value="Agregar"/>
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