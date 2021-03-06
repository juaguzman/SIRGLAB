<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
$error_msg_cedu = "";
$error_msg_usu = "";
$error_msg_ema = "";
$error_msg_psw = "";

if (isset($_POST['cedu'],$_POST['username'], $_POST['email'], $_POST['p'], $_POST['name'], $_POST['apell'])) 
                {
    // Sanear y validar los datos provistos.
    $estd = $_POST['rol'];
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $apell = filter_input(INPUT_POST, 'apell', FILTER_SANITIZE_STRING);
    $cedu = filter_input(INPUT_POST, 'cedu', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $psw = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
        // No es un correo electrónico válido.
        $error_msg .= '<p class="error">el Correo electronico no es valido</p>';
        $error_msg_ema .= '<p class="error">el Correo electronico no es valido</p>';
             }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128)
        {
        // La contraseña con hash deberá ser de 128 caracteres.
        // De lo contrario, algo muy raro habrá sucedido. 
        $error_msg .= '<p class="error">Contraseña invalida o mal configurada.</p>';
        $error_msg_psw .= '<p class="error">Contraseña invalida o mal configurada.</p>';
    }
 
    // La validez del nombre de usuario y de la contraseña ha sido verificada en el cliente.
    // Esto será suficiente, ya que nadie se beneficiará de
    // violar estas reglas.
    //
 
    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
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
            $error_msg .= '<p class="error">El correo electronico ya existe con otro usuario.</p>';
            $error_msg_ema .= '<p class="error">El correo electronico ya existe.</p>';
                        $stmt->close();
                        
        }
            
    } 
    else 
        {
        $error_msg .= '<p class="error">error en la base de datos</p>';
                $stmt->close();
    }
    
    $prep_stmt = "SELECT id FROM members WHERE id  = ? LIMIT 1";
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
            $error_msg .= '<p class="error">La identificacion ya existe.</p>';
            $error_msg_cedu .= '<p class="error">La identificacion ya existe.</p>';
                        $stmt->close();
                        
        }
            
    } 
    else 
        {
        $error_msg .= '<p class="error">error en la base de datos</p>';
                $stmt->close();
    }
 
    // Verifica el nombre de usuario existente. 
    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) 
        {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1) 
                {
                        // Ya existe otro usuario con este nombre de usuario.
                        $error_msg .= '<p class="error">Ya existe otro usuario con este nombre de usuario.</p>';
                        $error_msg_usu .= '<p class="error">El usuario ya existe.</p>';
                        
                        
                }
                
        } 
        else 
            {
                $error_msg .= '<p class="error">Database error line 55</p>';
               
            }
 
    // Pendiente: 
    // También habrá que tener en cuenta la situación en la que el usuario no tenga
    // derechos para registrarse, al verificar qué tipo de usuario intenta
    // realizar la operación.
 
    if (empty($error_msg)) 
        {
        // Crear una sal aleatoria.
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Crea una contraseña con sal. 
        $password = hash('sha512', $password . $random_salt);
 
        // Inserta el nuevo usuario a la base de datos.  
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (id,username, email, rol, password, salt) VALUES (?, ?, ?, ?, ?, ?)")) 
        {
            $insert_stmt->bind_param('ssssss', $cedu,$username, $email, $estd, $password, $random_salt);
            // Ejecuta la consulta preparada.
            if (! $insert_stmt->execute())
            {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        else 
        {
           if ($insert_stmt = $mysqli->prepare("INSERT INTO laboratoristas (members_id, nombres, apellidos,email,contra ) VALUE (?, ?, ?, ?, ?);")) 
        {
            $insert_stmt->bind_param('sssss', $cedu, $name, $apell,$email,$psw);
            // Ejecuta la consulta preparada.
            if (! $insert_stmt->execute())
            {
                header('Location: ../error.php?err=Registration failure lab: INSERT');
            }
            echo "<div id=dialog-message title=Cordinadores > <p> Cordinador Agregado Correctamente </p></div>";
        } 
        }
        
        }
       
    }
}