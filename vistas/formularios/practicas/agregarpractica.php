<!DOCTYPE html>
<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
 
sec_session_start();
?>
<html>
    <head>
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="styles/main.css" />
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
           <?php
?>
Marca: <select name="category" id="category">
    <?php
        $result = $mysqli->query("SELECT cedula, nombres FROM monitores ");
             if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {                
             echo '<option value="'.$row['cedula'].'">'.$row['nombres'].'</option>';
                }
                }
   ?>
</select>
<br/>
<br/>
Modelo: <select name="subcategory" id="subcategory"></select>

        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>