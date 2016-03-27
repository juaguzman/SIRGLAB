<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once './acciones.php';

switch ($_REQUEST['rsp'])
{
    
case "agregar":
    $cedu = filter_input(INPUT_POST, 'cedula',FILTER_SANITIZE_NUMBER_INT);
    $nom = filter_input(INPUT_POST, 'nombres',FILTER_SANITIZE_STRING);
    $apell = filter_input(INPUT_POST, 'apellidos',FILTER_SANITIZE_STRING);
    $celu = filter_input(INPUT_POST, 'celular',FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL);
    $prog = filter_input(INPUT_POST, 'programa',FILTER_SANITIZE_STRING);
    $semes = filter_input(INPUT_POST, 'nombres',FILTER_SANITIZE_NUMBER_INT);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
        // No es un correo electrónico válido.
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
             }
    else
    {
     $error_msg = monitores::agregarMonitor($cedu, $nom, $apell, $celu, $email, $prog, $semes); 
    }
    
}
