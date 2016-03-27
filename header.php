<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) 
{
    $logged = 'in';
   header('Location: vistas/index.php');
} else {
    $logged = 'out';
}
?> 
<header>
     <div id="titu">
        <img src="imagenes/nombre.png">
        <div id="estado">
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?>
        </div>
     </div>    
        
     

    </header>