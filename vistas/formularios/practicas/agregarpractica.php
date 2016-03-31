<!DOCTYPE html>
<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
include_once '../../../includes/accienesFR.php';
 
sec_session_start();
?>
<html>
    <head>
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="../../../styles/main.css" />
        <link rel="stylesheet" href="../../../styles/formularios.css" />
        <link rel="stylesheet" href="../../../styles/menu.css" />
        <script language="javascript" src="../../../js/jquery.js"></script>
        <script src="../../../js/jquery-1.4.2.min.js"></script>        
        <script language="javascript">
        $(document).ready(function()
        {
           $("#category").change(function () 
           {
                   $("#category option:selected").each(function () 
                   {
                    id_category = $(this).val();
                    $.post("subcategories.php", { id_category: id_category }, function(data){
                        $("#subcategory").html(data);
                    });            
                });
           })
        });
            </script>
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        
         <?php include 'header.php';?>
        
        
       
  <div id="monadd">
            <form class="form-container" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-title"><h2>Registro y Control de Practicas</h2></div><br/>
<!--                <div><?php if (!empty($error_msg)) { echo $error_msg;} ?></div>-->
                <table>
                    <tr>
                        <td>
                <div class="form-title">Cordinador</div>
                <input class="form-field" type="text" readonly value="<?php  echo $_SESSION['username'] ?>" name="cordinador" maxlength="10" required />
                <input type="hidden" name="idcord" value="<?php  echo $_SESSION['user_id'] ?>"/>
                       </td>
                        <td>
                <div class="form-title">Monitor</div>
                 <?php formularios::salMon()?>
                        </td>
                 </tr>
                 <tr>
                     <td>
                <div class="form-title">Programa</div>
                 <?php formularios::selprograma()?> 
                    </td>
                    <td>
                <div class="form-title">Materia</div>
                <select class="form-field" name="subcategory" id="subcategory" required>
                    <option>Seleccione un programa</option>
                </select>
                    </td>
                </tr>
                <tr>
                    <td>
                <div class="form-title">Laboratorio </div>
               <?php formularios::sallabor()?>
                    </td>
                    <td>
                <div class="form-title">Nombre Practica</div>
                <input class="form-field" type="text" name="npractica" value="" required placeholder="Practica" />            
                    </td>
                </tr>
                <tr>
                    <td>
                <div class="form-title">Docente</div>
                <input class="form-field" type="text" name="docente" value="" required placeholder="Nombre del docente"/>
                    </td>
                    <td>
                <div class="form-title">Reporte de verificacion de guia</div>
                <select class="form-field" name="rpor" required="">
                    <option value="COMPLETA">Completa</option>
                    <option value="INCOMPLETA">Incompleta</option>
                </select>
                    </td>
                </tr>
                <tr>
                    <td>
                <div class="form-title">Numero estudiantes</div>
                <input class="form-field" type="number" name="nuestud" value="" required placeholder="Numero de estudiantes" />
                    </td>
                    <td>
                <div class="form-title">Numero grupos</div>
                <input class="form-field" type="number" name="nugrup" value="" required placeholder="Numero de grupos" /><br />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                <div class="form-title"><h2>Horario Programado</h2></div>
                    </td>

                </tr>
                <tr>
                    <td>
                 <div class="form-title">Hora inicio</div>
                <input class="form-field" type="time" name="hinicio" value="" required />
                    </td>
                    <td>
                 <div class="form-title">Hora fin</div>
                <input class="form-field" type="time" name="hfin" value="" required /><br />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                       <div class="form-title">Observaciones Del Cordinador</div>  
                       <textarea id="area" placeholder="Observaciones del cordinador de laboratorio" name="obscor">
                           
                       </textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                <div class="submit-container">
                    <input type="hidden" name="rsp" value="agregar" />
                    <input class="submit-button" type="submit" value="Agregar"/>
                </div>
                    </td>
                </tr>
                </table>
                </form>
       </div>

        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>