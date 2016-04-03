<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/regprog.inc.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agregar programa</title>
        <link rel="stylesheet" href="../../styles/main.css" />
        <link rel="stylesheet" href="../../styles/monitores_1.css" />
        <link rel="stylesheet" href="../../styles/menu.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
        <div id="monadd">
            <form class="form-container" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-title"><h2>Agregar Programa</h2></div><br/>
<!--        <div><?php if (!empty($error_msg_prog)) { echo $error_msg_prog;} ?></div>-->
            <div class="form-title">Programa  <?php if (!empty($error_msg_prog)) { echo $error_msg_prog;} ?></div>
            <input class="form-field" type="text" value="<?php if (!empty($nomP)) { echo $nomP;} ?>" name="nomPro" maxlength="45" required />
            <div class="form-title">Director</div>
            <input class="form-field" type="text" name="dirc" value="<?php if (!empty($dir)) { echo $dir;} ?>" maxlength="45" required /><br />
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