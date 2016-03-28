<?php

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

if (isset($_POST['cedula']))
{
    
 $cedu = filter_input(INPUT_POST, 'cedula',FILTER_SANITIZE_NUMBER_INT);   
 
 
}

