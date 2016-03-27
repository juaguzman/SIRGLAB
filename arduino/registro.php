<?php

 include '../includes/db_connect.php';
 
        $id=$_GET['id'];
       if(isset($id))
        {
        $consulta= "select * from empleados where codigo= $id";
        $result   = $mysqli->query($consulta);
        $num = mysqli_num_rows($result);
        if($num<=0)
       {
          echo "USUARIO INVALIDO"; 
       }
       else
       {
          while ($campo1 = mysqli_fetch_object($result))
          {
           $ceodigo=$campo1->codigo;
           $cedula=$campo1->cedula;
           $estado=$campo1->estado;
          }
          
          if($estado=="fr")
          {
             $sql = "Insert into entradas(hora,fecha,empleados_cedula)values(curtime(),curdate(),$cedula)";
         if($mysqli->query($sql)) 
         {
           echo "valor=" . $ceodigo . ";"; 
            $sql1= "UPDATE empleados SET estado = 'dn' where cedula = $cedula;";
           $mysqli->query($sql1);
         }
            else {    
                echo "ERROR";
                 }
           
       }  
       else
       {
           
          $sql = "Insert into salidas(hora,fecha,empleados_cedula)values(curtime(),curdate(),$cedula)";
         if($mysqli->query($sql)) 
         {
             $sql1= "UPDATE empleados SET estado = 'fr' where cedula = $cedula;";
           $mysqli->query($sql1);
           echo "valor=" . $ceodigo . ";";  
         }
            else {    
                echo "ERROR";
                 }  
       }
          }
        
        
        
        }
        

