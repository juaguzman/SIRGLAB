<?php

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";
$error_msg_cedu = "";
$error_msg_emi = "";
$error_msg_celu = "";
$error_msg_psw = "";
if (isset($_POST['cedula'],$_POST['nombres'], $_POST['apellidos'], $_POST['celular'], $_POST['email'], $_POST['programa'], $_POST['semestre'])) 
{
    $cedu = filter_input(INPUT_POST, 'cedula',FILTER_SANITIZE_NUMBER_INT);
    $nom = filter_input(INPUT_POST, 'nombres',FILTER_SANITIZE_STRING);
    $apell = filter_input(INPUT_POST, 'apellidos',FILTER_SANITIZE_STRING);
    $celu = filter_input(INPUT_POST, 'celular',FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL);
    $prog = filter_input(INPUT_POST, 'programa',FILTER_SANITIZE_STRING);
    $semes = filter_input(INPUT_POST, 'semestre',FILTER_SANITIZE_NUMBER_INT);
    $idc = $_POST['idc'];
    $cont = $_POST['p'];
    $est = "fr";
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
        // No es un correo electrónico válido.
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
             }
    else
    {
        $prep_stmt = "SELECT cedula FROM monitores where cedula= ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
     // Verifica el correo electrónico existente.  
    if ($stmt) 
        {
        $stmt->bind_param('s', $cedu);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) 
            {
            // Ya existe otro usuario con este correo electrónico.
            $error_msg .= '<p class="error">La identificacion de monitor ya existe</p>';
            $error_msg_cedu = '<p class="error">La identificacion de monitor ya existe</p>';
                        
                        
        }
                
        } 
         else 
            {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
            }
        
         $prep_stmt = "SELECT cedula FROM monitores where email= ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Verifica el correo electrónico existente.  
    if ($stmt) 
        {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) 
            {
            // Ya existe otro usuario con este correo electrónico.
            $error_msg .= '<p class="error">El correo electronico de monitor ya existe</p>';
            $error_msg_emi = '<p class="error">El correo electronico de monitor ya existe</p>';
                     
                        
        }
           
        } 
         else 
            {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
            }
        if(strlen($celu)!= 10)
        {
            $error_msg_celu = '<p class="error">celular incorrecto deben ser 10 numeros</p>';
        }
  
        
    $prep_stmt = "SELECT cedula FROM monitores where email= ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Verifica el correo Cordinador
    
    if ($stmt) 
        {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) 
            {
            // Ya existe otro usuario con este correo electrónico.
            $error_msg .= '<p class="error">El correo electronico de monitor ya existe</p>';
            $error_msg_emi = '<p class="error">El correo electronico de monitor ya existe</p>';
                     
                        
        }
           
        } 
         else 
            {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
            }
            
   $prep_stmt = "SELECT * FROM members where id = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Verifica el correo Cordinador
    
    if ($stmt) 
        {
        $stmt->bind_param('s', $idc);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $username, $email,$rol ,$db_password, $salt);
        $stmt->fetch();
        if ($stmt->num_rows == 1) 
            {
            $password = hash('sha512', $cont . $salt);
            }
        } 
    else 
        {
            $error_msg .= '<p class="error">El correo electronico de monitor ya existe</p>';
            $stmt->close();
        }         
 
        if($password != $db_password)
        {
            $error_msg_psw = '<p class="error">La contraseña no coinside</p>';
            $error_msg .= '<p class="error">La contraseña no coinside intente de nuevo</p>';
        }
        
        
        
     if (empty($error_msg)) 
     {
       if ($insert_stmt = $mysqli->prepare("INSERT INTO monitores(cedula,nombres,apellidos,celular,email,programa,semestre,estado,laboratoristas_members_id) values (?, ?, ?, ?, ?, ?, ?, ?,?)")) 
        {
           $estd = "fr";
            $insert_stmt->bind_param('sssssssss', $cedu, $nom, $apell, $celu, $email, $prog, $semes, $estd,$idc);
            // Ejecuta la consulta preparada.
            if (! $insert_stmt->execute())
            {
                header('Location: ../../vistas/error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ../../vistas/index.php');  
     } 
    }
    
}
