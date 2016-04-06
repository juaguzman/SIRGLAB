<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/register.inc.php';

sec_session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SIRGLAB Umariana: Formulario de registro</title>
        <script type="text/JavaScript" src="../../js/sha512.js"></script> 
        <script type="text/JavaScript" src="../../js/forms.js"></script>
        <link rel="stylesheet" href="../../styles/main.css" />
        <link rel="stylesheet" href="../../styles/menu.css" />
        <link rel="stylesheet" href="../../styles/registro.css" />
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
    <?php include './header.php';?>
    <body>
        <?php if (login_check($mysqli) == true and $_SESSION['rol']=='admin') : ?>
        <!-- Formulario de registro que se emitirá si las variables POST no se
          establecen o si la secuencia de comandos de registro ha provocado un error. -->
        <div id="registro" >
        <h1>Regístro de laboratoristas</h1>       
        <ul>            
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
<!--        $error_msg_cedu = "";
        $error_msg_usu = "";
        $error_msg_ema = "";
        $error_msg_psw = "";-->
        <div id="reg">
        <form class="form-container" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>"  method="post" name="registration_form">
             <div class="form-title"><h2>Agregar Laboratorista</h2></div>
              <div class="form-title">Cedula <?php if (!empty($error_msg_cedu)) { echo $error_msg_cedu;} ?> </div>
              <input class="form-field" type="number" name="cedu" id="cedu" required/><br>
               <div class="form-title">Nombres <?php if (!empty($error_msg_usu)) { echo $error_msg_usu;} ?></div> 
               <input class="form-field" type='text'name='name' id='name' required="" maxlength="45" /><br>
               <div class="form-title">Apellidos <?php if (!empty($error_msg_usu)) { echo $error_msg_usu;} ?></div> 
               <input class="form-field" type='text'name='apell' id='apell' required="" maxlength="45" /><br>
            <div class="form-title">Nombre de usuario <?php if (!empty($error_msg_usu)) { echo $error_msg_usu;} ?></div> 
            <input class="form-field" type='text'name='username' id='username' required="" /><br>
            <div class="form-title">Correo electrónico <?php if (!empty($error_msg_ema)) { echo $error_msg_ema;} ?></div>
            <input class="form-field" type="text" name="email" id="email" required /><br>
            <div class="form-title">Contraseña <?php if (!empty($error_msg_psw)) { echo $error_msg_psw;} ?></div>
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