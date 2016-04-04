<?php

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

 if(isset($_REQUEST['prog'],$_POST['labor']))
     {
       $lab = $_REQUEST['labor'];       
       $progs = $_POST['prog'];
    
     }