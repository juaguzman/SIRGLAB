<!DOCTYPE html>
<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/reghorarios.inc.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="../../styles/main.css" />
        <link rel="stylesheet" href="../../styles/menu.css" />
        <link rel="stylesheet" href="../../styles/formularios.css" />
 
    </head>
    
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';
        if(isset($_POST['idm']))
        {
            $idm = $_POST['idm'];
        }
        ?>
        
        <div id="monadd">
            <form class="form-container" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
               
<!--                <div></div>-->
                <table class="form-container-tab">
                    <tr>
                        <td colspan="2">
                             <div class="form-title"><h2>Agregar horario a monitor</h2></div><br/>
                        </td>
                    </tr>
                        
                                 <tr>
                                    <td colspan="2">
                                   <!--Agregar lunes-->
                                <div class="form-title"><h2>Lunes</h2> <?php if (!empty($error_msj_lun)) { echo $error_msj_lun;} ?></div>
                                    </td>
                                </tr>
                                    <tr>
                                        <td>                      
                                <div class="form-title">Entrada</div>
                                <input class="form-field" type="time" value="<?php if (!empty($elun)) { echo $elun;} ?>" name="elun" maxlength="10" />
                                       </td>
                                        <td>
                                <div class="form-title">Salida </div>  
                                <input class="form-field" type="time" value="<?php if (!empty($slun)) { echo $slun;} ?>" name="slun" maxlength="10"/>
                                        </td>
                                 </tr>
                                 <!--Agregar Martes-->
                                 <tr>
                                     <td colspan="2">
                                 <div class="form-title"><h2>Martes</h2> <?php if (!empty($error_msj_mar)) { echo $error_msj_mar;} ?></div>
                                    </td>
                                </tr>
                                    <tr>
                                        <td>                      
                                <div class="form-title">Entrada</div>
                                <input class="form-field" type="time" value="<?php if (!empty($emar)) { echo $emar;} ?>" name="emar" maxlength="10" />
                                       </td>
                                        <td>
                                <div class="form-title">Salida</div>  
                                <input class="form-field" type="time" value="<?php if (!empty($smar)) { echo $smar;} ?>" name="smar" maxlength="10"/>
                                        </td>
                                 </tr>
                                 <!--Agregar Miercoles-->
                                 <tr>
                                     <td colspan="2">
                                 <div class="form-title"><h2>Miercoles</h2> <?php if (!empty($error_msj_mar)) { echo $error_msj_mar;} ?></div>
                                    </td>
                                </tr>
                                    <tr>
                                        <td>                      
                                <div class="form-title">Entrada</div>
                                <input class="form-field" type="time" value="<?php if (!empty($emier)) { echo $emier;} ?>" name="emier" maxlength="10" />
                                       </td>
                                        <td>
                                <div class="form-title">Salida</div>  
                                <input class="form-field" type="time" value="<?php if (!empty($smier)) { echo $smier;} ?>" name="smier" maxlength="10"/>
                                        </td>
                                 </tr>
                                 <!--Agregar Jueves-->
                                 <tr>
                                     <td colspan="2">
                                 <div class="form-title"><h2>Jueves</h2> <?php if (!empty($error_msj_jue)) { echo $error_msj_jue;} ?></div>
                                    </td>
                                </tr>
                                    <tr>
                                        <td>                      
                                <div class="form-title">Entrada</div>
                                <input class="form-field" type="time" value="<?php if (!empty($ejue)) { echo $ejue;} ?>" name="ejue" maxlength="10" />
                                       </td>
                                        <td>
                                <div class="form-title">Salida</div>  
                                <input class="form-field" type="time" value="<?php if (!empty($sjue)) { echo $sjue;} ?>" name="sjue" maxlength="10"/>
                                        </td>
                                 </tr>
                                 <!--Agregar Viernes-->
                                 <tr>
                                     <td colspan="2">
                                 <div class="form-title"><h2>Viernes</h2> <?php if (!empty($error_msj_vie)) { echo $error_msj_vie;} ?></div>
                                    </td>
                                </tr>
                                    <tr>
                                        <td>                      
                                <div class="form-title">Entrada</div>
                                <input class="form-field" type="time" value="<?php if (!empty($evie)) { echo $evie;} ?>" name="ejue" maxlength="10" />
                                       </td>
                                        <td>
                                <div class="form-title">Salida </div>  
                                <input class="form-field" type="time" value="<?php if (!empty($svie)) { echo $svie;} ?>" name="sjue" maxlength="10"/>
                                        </td>
                                 </tr>
                   <tr>
                    <td colspan="2">
                <div class="submit-container">
                    <input type="hidden" name="idm" value="<?php echo "$idm";?>" />
                    <input class="submit-button" type="submit" value="Agregar"/>
                </div>
                    </td>
                </tr>
                
                </table>
                </form>
       </div>
        
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>
           
    </body>
</html>