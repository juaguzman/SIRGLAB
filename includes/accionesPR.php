<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class programa
{
 static function ckeProg()
 {
     include 'db_connect.php';
        $consulta= "SELECT * FROM programa" ;        
        if($result   = $mysqli->query($consulta))
        {
           
             while ($campo=mysqli_fetch_object($result)) 
             {
                 echo "<div class=form-title>";
                 echo "<input type=checkbox name=prog[] value=$campo->idprograma /> $campo->nombre  "; 
                 echo "</div>";
             }
        }
 }
    
}