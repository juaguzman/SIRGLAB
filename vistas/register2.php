<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
include_once '../includes/register.inc.php';

sec_session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SIRGLAB Umariana: Formulario de registro</title>
        <script type="text/JavaScript" src="../js/sha512.js"></script> 
        <script type="text/JavaScript" src="../js/forms.js"></script>
        <link rel="stylesheet" href="../styles/main.css" />
        <link rel="stylesheet" href="../styles/menu.css" />
        <link rel="stylesheet" href="../styles/registro.css" />
        <link rel="stylesheet" href="../styles/monitores_1.css" />
    </head>
    <?php include './header.php';?>
    <body>
        <?php if (login_check($mysqli) == true and $_SESSION['rol']=='admin') : ?>
        <!-- Formulario de registro que se emitirá si las variables POST no se
          establecen o si la secuencia de comandos de registro ha provocado un error. -->
        <div id="registro" >
        <h1>Regístro de laboratoristas</h1>       
        <ul>
            <?php if (!empty($error_msg)) { echo $error_msg;} ?>
            <li> Los nombres de usuario podrían contener solo dígitos, letras mayúsculas, minúsculas y guiones bajos.</li>
            <li> Los correos electrónicos deberán tener un formato válido. </li>
            <li> Las contraseñas deberán tener al menos 6 caracteres.</li>
            <li>Las contraseñas deberán estar compuestas por:
                <ul>
                    <li> Por lo menos una letra mayúscula (A-Z)</li>
                    <li> Por lo menos una letra minúscula (a-z)</li>
                    <li> Por lo menos un número (0-9)</li>
                </ul>
            </li>
            <li> La contraseña y la confirmación deberán coincidir exactamente.</li>
        </ul>
        <div id="reg">
        <form class="form-container" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>"  method="post" name="registration_form">
             <div class="form-title"><h2>Agregar Laboratorista</h2></div>
              <div class="form-title">Cedula</div>
              <input class="form-field" type="number" name="cedu" id="cedu" required/><br>
            <div class="form-title">Nombre de usuario</div> 
            <input class="form-field" type='text'name='username' id='username' required="" /><br>
            <div class="form-title">Correo electrónico</div>
            <input class="form-field" type="text" name="email" id="email" required /><br>
            <div class="form-title">Contraseña</div>
            <input class="form-field" type="password" name="password" id="password" required/><br>
            <div class="form-title">Confirmar contraseña</div>
            <input class="form-field" type="password" name="confirmpwd" id="confirmpwd" required/><br>
            <div class="submit-container">
            <input type="hidden" value="usua" name="rol"/>
            <input class="submit-button" type="button" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" /> 
            </div>
        </form>
        </div>
         <?php else : ?>
           <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>