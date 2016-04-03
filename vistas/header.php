<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 

 
if (login_check($mysqli) == true) 
{
    $logged = 'in';
} 
else 
 {
    $logged = 'out';
 }
?> 
<header>
     <div id="titu">
         <img src="../imagenes/nombre.png">
        <br/>
        <br/>
     </div>    
    <div id='cssmenu'>
        <ul id="menu-bar">
            <li class="active"><a href="index.php">Inicio</a></li>
            <li><a href="#">Practicas</a>
                 <ul>
                   <li><a href="formularios/practicas/agregarpractica.php">Agregar Practica</a></li>
                   <li><a href="../formularios/practicas/finpractica.php">Finalizar Practica</a></li>
                 </ul>
            </li>
            <li><a href="#">Investigacion</a>
                <ul>
                    <li><a href="#">Services Sub Menu 1</a></li>
                </ul>
            </li>
            <li><a href="#">Monitores</a>
                <ul>
                    <li><a href="monitores/nuevodia.php">Registrar Dia</a></li>
                    <li><a href="monitores/listarmonitores.php">Ver monitores</a></li>
                    <li><a href="monitores/asignarmonitores.php">Asignar Monitores</a></li>
                </ul>
            </li>
            <li><a href="#">Empleados</a>
                <ul>
                    <li><a href="empleados/listarEmpleados.php">Ver Empleados</a></li>        
                </ul>
            </li>
            <li><a href="#">Contact Us</a></li>
            <div id="nomses">
            <li id="nomses"><a href="#">¡Bienvenido, <?php if (isset($_GET['error'])){echo '<p class="error">Error Logging In!</p>';}else {echo htmlentities($_SESSION['username']);}?> !</a>
               <ul>
                     <?php if($_SESSION['rol']=='admin') {?>
                    <li> <a href="../register2.php">Agregar Laboratorista</a> </li> <?php } ?>
                  <?php if($_SESSION['rol']=='admin' or $_SESSION['rol']=='admin' ) {?>
                    <li> <a href=laboratorista/datosLaboratorista.php>Perfil</a></li> <?php } ?> 
                     <?php if($_SESSION['rol']=='admin' or $_SESSION['rol']=='usua' ) {?>
                    <li><a href="monitores/agregarMonit.php">Agregar Monitores</a></li> <?php } ?>
                    <?php if($_SESSION['rol']=='admin' or $_SESSION['rol']=='admin' ) {?>
                    <li><a href="#">Ver Monitores</a></li> <?php } ?>
                    <li><a href="../includes/logout.php">Salir</a></li>  
                </ul>
            </li>
            </div>
        </ul>
    </div>
</header>