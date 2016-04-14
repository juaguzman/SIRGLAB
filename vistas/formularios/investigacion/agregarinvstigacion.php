<!DOCTYPE html>
<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
include_once '../../../includes/accienesFR.php';
include_once '../../../includes/reginvestig.inc.php';
 
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
        <link rel="stylesheet" href="../../../styles/jquery-ui.css" />
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
        <script language="javascript">
             $(document).ready(function()
        {
           $("#labor").change(function () 
           {
                   $("#labor option:selected").each(function () 
                   {
                    id_category = $(this).val();
                    $.post("categories.php", { id_category: id_category }, function(data){
                        $("#category").html(data);
                    });            
                });
           })
        });
        
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
            
            <script type="text/javascript">

        icremento =1;
        function crear(obj) 
        {
          icremento++;

          field = document.getElementById('field'); 
         contenedor = document.createElement('div'); 
          contenedor.id = 'div'+icremento;
          contenedor.className = "divct";
          field.appendChild(contenedor); 

          boton = document.createElement('input'); 
          boton.type = 'text'; 
          boton.placeholder = "Equipo ";
          boton.name = 'text'+'[]'; 
          boton.className = 'form-field';
          contenedor.appendChild(boton); 


          boton = document.createElement('input'); 
          boton.type = 'button'; 
          boton.value = ' - '; 
          boton.name = 'div'+icremento; 
          boton.className = 'submit-button-env';
          boton.onclick = function () {borrar(this.name)} //aqui llamamos a la funcion borrar
          contenedor.appendChild(boton); 
          return contenedor.id;
        }
        function borrar(obj) {//aqui la ejecutamos
          field = document.getElementById('field'); 
          field.removeChild(document.getElementById(obj)); 
        }
        
        icrementos =1;
        function crear2(obj) 
        {
          icrementos++;

          field = document.getElementById('fields'); 
         contenedor = document.createElement('div'); 
          contenedor.id = 'divs'+icrementos;
          contenedor.className = "divct";
          field.appendChild(contenedor); 

          botons = document.createElement('input'); 
          botons.type = 'text'; 
          botons.name = 'insumos'+'[]'; 
          botons.placeholder = "insumo ";
          botons.className = 'form-field';
          contenedor.appendChild(botons); 


          botons = document.createElement('input'); 
          botons.type = 'button'; 
          botons.value = ' - '; 
          botons.name = 'divs'+icrementos; 
          botons.className = 'submit-button-env';          
          botons.onclick = function () {borrars(this.name)} //aqui llamamos a la funcion borrar
          contenedor.appendChild(botons); 
          return contenedor.id;
        }
        function borrars(obj)
        {//aqui la ejecutamos
            field = document.getElementById('fields'); 
          field.removeChild(document.getElementById(obj)); 
        }
</script>
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        
         <?php include 'header.php';?>
        
        
       
  <div id="monadd">
            <form class="form-container" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-title"><h2>Registro y Control de Practicas</h2></div><br/>
<!--                <div></div>-->
                <table class="form-container-tab">
                    <tr>
                        <td>
                <?php if (!empty($error_msg)) { echo $error_msg;} ?>
                <div class="form-title">Cordinador</div>
                <input class="form-field" type="text" readonly value="<?php  echo $_SESSION['username'] ?>" name="cordinador" maxlength="10" required />
                <input type="hidden" name="idcord" value="<?php  echo $_SESSION['user_id'] ?>"/>
                       </td>
                        <td>
                <div class="form-title">Monitor  <?php if (!empty($error_msg_mnt)) { echo $error_msg_mnt;} ?></div>  
                 <?php $id = $_SESSION['user_id'];
                 formularios::salMon($id)?>
                        </td>
                 </tr>
                 <tr>
                      <td>
                <div class="form-title">Laboratorio <?php if (!empty($error_msg_lab)) { echo $error_msg_lab;} ?> </div>
               <?php formularios::sallabor($id)?>
                    </td>
                            <td>
                <div class="form-title">Nombre Investigacion</div>
                <input class="form-field" type="text" name="ninvestiga" value="<?php if (!empty($nominvest)) { echo $nominvest;} ?>" required placeholder="Nombre Investigacion" />            
                    </td>                 
                </tr>
                <tr>
                      <td>
                <div class="form-title">Investigador</div>
                <input class="form-field" type="text" name="ninvestigador" value="<?php if (!empty($nivestig)) { echo $nivestig;} ?>" required placeholder="Nombre del investigador"/>
                    </td>
                    <td>
                <div class="form-title">Cedula Investigador</div>
                <input class="form-field" type="number" name="cedulainvg" value="<?php if (!empty($cedulain)) { echo $cedulain;} ?>" required placeholder="Cedula del investigador"/>
                    </td>
              
                </tr>
                 <tr>
                      <td>
                <div class="form-title">Asesor</div>
                <input class="form-field" type="text" name="nasesor" value="<?php if (!empty($asesor)) { echo $asesor;} ?>" required placeholder="Nombre del investigador"/>
                    </td>
              
                </tr>
           
                <tr>
                    <td colspan="2">
                       <div class="form-title">Observaciones Del Cordinador</div>  
                       <textarea id="area" placeholder="Observaciones del cordinador de laboratorio" name="obscor"><?php if (!empty($obscor)) { echo $obscor;} ?></textarea>
                    </td>
                </tr>
                 <tr>
                    <td colspan="2">
                       <div class="form-title">Procedimientos</div>  
                       <textarea id="area" placeholder="Procedimientos a realizarse" name="proced"><?php if (!empty($proced)) { echo $proced;} ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                       
                        <fieldset id="field" class="form-container-set">
                        <div class="form-title">Equipo Entregado</div>
                        <div id="div1">
                        <input type="text" name="text[]" class="form-field" placeholder="Equipo"/>
                        </div>
                        </fieldset>
                        <p>
                         <input class="submit-button" type="button" value="Nueva Equipo" onClick="crear(this)">
                    </td>
                    
                     <td>
                       
                        <fieldset id="fields" class="form-container-set">
                        <div class="form-title">Insumos Entregado</div>
                        <div id="divs1">
                            <input type="text" name="insumos[]" class="form-field" placeholder="Insumo"/>
                        </div>
                        </fieldset>
                        <p>
                         <input class="submit-button" type="button" value="Nueva Insumo" onClick="crear2(this)">
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