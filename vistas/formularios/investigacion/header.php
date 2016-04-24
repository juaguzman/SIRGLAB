<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
  
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
         <img src="../../../imagenes/nombre.png">
        <br/>
        <br/>
     </div>    
    <div id='cssmenu'>
        <ul id="menu-bar">
            <li ><a href="../../index.php">Inicio</a></li>
            <li  ><a href="#">Practicas</a>
                 <ul>
                     <li><a href="../practicas/agregarpractica.php">Agregar Practica</a></li>
                     <li><a href="../practicas/finpractica.php">Finalizar Practica</a></li>
                     <li><a href="../practicas/listarpracticascord.php">Ver Practicas</a></li>
                 </ul>
            </li>
            <li class="active" ><a href="#">Investigacion</a>
                <ul>
                    <li><a href="agregarinvstigacion.php">Agregar Investigacion</a></li>
                    <li><a href="fininvestig.php">Fin Investigacion</a></li>
                     <li><a href="listarInvestigaCord.php">Ver Investigaciones</a></li>
                </ul>
            </li>
            <li ><a>Monitores</a>
               <ul>
                   <li><a href="../../monitores/nuevodia.php">Registrar Dia</a></li>
                    <li><a href="../../monitores/listarmonitores.php">Ver Monitores</a></li>
                    <li><a href="../../monitores/asignarmonitores.php">Asignar Monitores</a></li>
                </ul>
            </li>
            <li><a href="#">Empleados</a>
                <ul>
                    <li><a href="../../empleados/listarEmpleados.php">Ver Empleados</a></li>        
                </ul>
            </li>
            <li><a href="#">Contact Us</a></li>
            <div id="nomses">
            <li id="nomses"><a href="#">¡Bienvenido, <?php if (isset($_GET['error'])){echo '<p class="error">Error Logging In!</p>';}else {echo htmlentities($_SESSION['username']);}?> !</a>
               <ul>
                     <?php if($_SESSION['rol']=='admin') {?>
                   <li> <a href="../../admin/register2.php">Agregar Laboratorista</a> </li> <?php } ?>
                     <?php if($_SESSION['rol']=='admin') {?>
                    <li> <a href="../admin/agregarLaboratorio.php">Agregar Laboratorio</a> </li> <?php } ?>
                     <?php if($_SESSION['rol']=='admin') {?>
                    <li><a href="../../admin/agregarMonit.php">Agregar Monitores</a></li> <?php } ?>
                    <?php if($_SESSION['rol']=='admin') {?>
                    <li> <a href="../../admin/agregarprogramas.php">Agregar Programa</a> </li> <?php } ?>
                    <?php if($_SESSION['rol']=='admin') {?>
                    <li> <a href="../../admin/agregarmaterias.php">Agregar Materias</a> </li> <?php } ?>
                    <?php if($_SESSION['rol']=='admin') {?>
                    <li> <a href="../../admin/asignarproglab.php">Asignar Programas a Laboratorios</a> </li> <?php } ?>
                    <?php if($_SESSION['rol']=='admin') {?>
                    <li> <a href="../../admin/verLaboratoristas.php">Ver Laboratorista</a> </li> <?php } ?>
                    <?php if($_SESSION['rol']=='admin') {?>
                    <li> <a href="../../admin/verLabortorios.php">Ver Laboratorios</a> </li> <?php } ?>
                     <?php $id= $_SESSION['user_id'];?>
                    <?php if($_SESSION['rol']=='usua' or $_SESSION['rol']=='admin' ) {?>
                    <li> <a href="../../laboratorista/verLaboratorista.php">Perfil</a></li> <?php } ?> 
                    <li><a href="../../../includes/logout.php">Salir</a></li>  
                </ul>
            </li>
            </div>
        </ul>
    </div>
</header>