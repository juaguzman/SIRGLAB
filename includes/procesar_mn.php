<?php
include_once './accionesMN.php';
if(isset($_REQUEST['req']))
{
    $rq = $_REQUEST['req'];
    switch ($rq)
    {
    case "asig":
     if(isset($_REQUEST['id'],$_REQUEST['cedu']))
     {
       $id = $_REQUEST['id'];
       $cedu = $_REQUEST['cedu'];
     monitores::asigmonitores($id, $cedu);
     }
    break;
    }
}