<!DOCTYPE html>
<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/accienesFR.php';
include_once '../../includes/regmateriasprogs.inc.php';

 
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
          boton.name = 'text'+'[]'; 
          boton.className = 'form-field';
          contenedor.appendChild(boton); 


          boton = document.createElement('input'); 
          boton.type = 'button'; 
          boton.value = 'Borrar'; 
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
</script>
 
    </head>
    
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
        
        <div id="monadd">
       <form class="form-container" name="form1" method="POST" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
           <div class="form-title"><h2>Agregar Materias</h2></div><br/>
       <div class="form-title">Programa <?php if (!empty($error_msg_prog)) { echo $error_msg_prog;} ?> </div>       
           <?php formularios::selprograma()?>           
       <fieldset id="field" class="form-container-set">
          <div id="div1">
          <input type="text" name="text[]" class="form-field"/>
           </div>
        </fieldset>
          <p>
          <input class="submit-button" type="button" value="Nueva Materia" onClick="crear(this)">
          <input class="submit-button" name="send" type="submit" value="Enviar" id="send">
          </p>
        </form>
         </div>
          
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>
           
    </body>
</html>