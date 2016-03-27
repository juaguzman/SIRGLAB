<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 

 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SIRGLAB Umariana</title>
        <link rel="stylesheet" href="styles/login.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
   <?php include 'header.php';?>
    <body>
        <div>
            <table id="inicio">
                <tbody id="inicio">
            <tr id="tit">
                <td colspan="2"> <p>Inicio De Sesion</p></td>
            </tr>
            
        <form action="includes/process_login.php" method="post" name="login_form">                      
            <tr id="correo">  <td>Correo electrónico: </td><td><input type="text" name="email" /></td></tr>
            <tr id="contra"> <td>Contraseña:</td><td> <input type="password" name="password" id="password"/> </td></tr>
            <tr id="boton"> <td colspan="2"> <input id="btnini" type="button" value="Login" onclick="formhash(this.form, this.form.password);" /></td> </tr>
        </form>        
                </tbody>
        </table>
         <table>
             <tbody>
                   <tr> <td colspan="2"><p> Si no tiene una cuenta, por favor comuniquese con el administrador de el sistema</p></td></tr> 
             </tbody>
         </table>
        </div>
    </body>
</html>