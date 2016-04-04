<?php

include_once './accienesFR.php';

if(isset($_REQUEST['req']))
{
    $rq = $_REQUEST['req'];
    switch ($rq)
    {
    case "finp":
     if(isset($_REQUEST['id']))
     {
       $id = $_REQUEST['id'];
       
       header('Location: ../vistas/formularios/practicas/finprectobs.php?id='.$id);
     }
    break;
    case "fin":
         if(isset($_REQUEST['id']))
     {
       $id = $_REQUEST['id'];
    
     }
     else
     {
         
     }
     if(isset($_REQUEST['obsercor']))
     {
       $obsercor = $_REQUEST['obsercor'];
     } 
     if(isset($_REQUEST['obserdos']))
     {
         $obserdos = $_REQUEST['obserdos'];
     }
     formularios::finpr($id,$obsercor,$obserdos);
     
    break;
    case "asign":
         if(isset($_REQUEST['prog'],$_POST['labor']))
     {
       $lab = $_REQUEST['labor'];
       
       $progs = $_POST['prog'];
    
     }
     
    break;
    }
}
