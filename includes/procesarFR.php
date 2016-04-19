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
    case "ver":
     if(isset($_REQUEST['id']))
     {
       $id = $_REQUEST['id'];
       
       header('Location: ../vistas/formularios/practicas/verpract.php?id='.$id);
     }
    break;
     case "fini":
     if(isset($_REQUEST['id']))
     {
       $id = $_REQUEST['id'];
       
       header('Location: ../vistas/formularios/investigacion/finInvestigyobservbs.php?id='.$id);
     }
    break;
    case "terminap":
        if(isset($_POST['id'],$_POST['obsercor'],$_POST['obserdos']))
        {
            $id=$_POST['id'];
            $obsercor=$_POST['obsercor'];
            $obserdos=$_POST['obserdos'];
            
            formularios::finpr($id, $obsercor, $obserdos);
        }
    break;
    case "terminai":
         if(isset($_POST['id'],$_POST['conddevol'],$_POST['obsercor'],$_POST['obserinves']))
        {
            $id=$_POST['id'];
            $obsercor=$_POST['obsercor'];
            $conddevol=$_POST['conddevol'];
            $obserinves = $_POST['obserinves'];
            
            formularios::finin($id,$obsercor,$obserinves,$conddevol);
        }
    
    
     
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
