<?php

require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;

$documento = new PhpWord();

// Nueva seccion
$seccion = $documento->addSection();

// Texto con formato
$seccion->addText(
		htmlspecialchars('San Juan De Pasto ' .date('d M Y') ),
		array('name' => 'Arial', 'size' => '12', 'bold' => 'false')
);


//salto de linea
$seccion->addTextBreak(4);

// Texto con formato
$seccion->addText(
		htmlspecialchars('Señor Juan Carlos Narvaez'),
		array('name' => 'Arial', 'size' => '12', 'bold' => 'false')
);

//salto de linea
$seccion->addTextBreak(1);

// Texto con formato
$seccion->addText(
		htmlspecialchars('Por medio de la presente me dirijo a usted para enviarle el '
                        . 'reporte de los monitores de los laboratorios con la cantidad de '
                        . 'horas cumplidas por cada uno de ellos de ante mano agradezco '
                        . 'su atención '),
		array('name' => 'Arial', 'size' => '12', 'bold' => 'false')
);

//salto de linea
$seccion->addTextBreak(2);

// Tabla personalizada
$estilo_tabla = array(
		'borderSize' => '5',
		'cellMargin' => '50',
                'valign' => 'center'
		
);

    include_once '../../includes/db_connect.php';
    $id = $_POST['id'];
     $consulta= "SELECT cedula FROM monitores where monitores.laboratoristas_members_id = $id;";
     $result   = $mysqli->query($consulta);
     while ($campo=mysqli_fetch_object($result))
                 {
                    $cedu[]=$campo->cedula;
                 }
        $num = count($cedu);

        
$primera_fila = array('bgColor' => 'F2F2F2', 'cellMargin' => '50', 'valign' => 'center');
$documento->addTableStyle('mitabla',$estilo_tabla, $primera_fila);
$tabla = $seccion->addTable('mitabla');


    $num1=$num+1;
    $tabla->addRow();
    $tabla->addCell(400)->addText(htmlspecialchars('Nombres'));
    $tabla->addCell(400)->addText(htmlspecialchars('Apellidos'));
    $tabla->addCell(400)->addText(htmlspecialchars('Identificación'));
    $tabla->addCell(400)->addText(htmlspecialchars('Programa'));
    $tabla->addCell(400)->addText(htmlspecialchars('Semestre'));
    $tabla->addCell(400)->addText(htmlspecialchars('Horas'));
     for ($row = 0; $row <= $num; $row++)
     {
     
     $horas = "0:00:00";
     $horasp ="";
     $sumHoras="0:00:00";
     $sumh="";
     $summ="";
     $sums="";
     $resh="";
     $resm="";
     $ress="";
     $hini = 0;
     $hfin =0;
     $nombres='';
     $apellidos='';
     $cedula=0;
     $programa='';
     $semestre=0;
     $ced = $cedu[$row];
    $consulta = "SELECT monitores.nombres as nombres,monitores.laboratoristas_members_id as cord, monitores.apellidos as apellidos, monitores.cedula as cedula, monitores.programa as programa, monitores.semestre as semestre, mregistro.horaen as horaen, mregistro.horasal as horasal FROM mregistro , monitores where mregistro.monitores_cedula = monitores.cedula AND monitores_cedula = $ced";
     $result = $mysqli->query($consulta);
      if ($result->num_rows >= 1) 
         {
     while ($campo=mysqli_fetch_object($result))
                 {                
                   $hini = $campo->horaen;
                   $hfin=$campo->horasal;
                   $nombres=$campo->nombres;
                   $apellidos=$campo->apellidos;
                   $cedula=$campo->cedula;
                   $programa=$campo->programa;
                   $semestre=$campo->semestre;
                   $cord=$campo->cord;
                   if(empty($hfin))
                   {
                       $hfin="Sin Finalizar";
                       $horasp="Sin Finalizar";
                   }
                   else 
                   {
                       $horai = explode(":", $hini);
                       $horas = explode(":", $hfin);
                       list($hini,$minin,$segin)=$horai;
                       list($hsal,$minsa,$segsa)=$horas;
                       $resh=0;
                       $resm=0;
                       $ress=0;
                       $ress=$segsa-$segin;
                       $resh = $hsal-$hini;
                       $resm = $minsa-$minin;
                       if($ress<0)
                       {
                           $resm--;
                           $ress=$ress+60;
                           
                       }
                       
                        if($resm<0)
                       {
                           $resh--;
                           $resm=$resm+60;
                           
                       }
                       
                     $horasp = "$resh:$resm:$ress" ; 
                     $horas=date("H:i:s", strtotime("00:00:00") + strtotime($hfin) - strtotime($hini) );
                     $horaSplit = explode(":", $horasp);
                   list($hour1, $min1, $sec1)=$horaSplit;
                  
                   $sums = $sums+$sec1;                   
                   if($sums>59)
                   {
                       $summ++;
                       $sums=$sums-60;
                   }
                   $summ = $summ+$min1;
                   if($summ>59)
                   {
                       $sumh++;
                       $summ=$summ-60;
                   }
                    $sumh = $sumh+$hour1;
                   }
                 }
                 $tabla->addRow();
                 $sumHoras = "$sumh:$summ:$sums";
                 $tabla->addCell(400)->addText(htmlspecialchars($nombres));
                 $tabla->addCell(400)->addText(htmlspecialchars($apellidos));
                 $tabla->addCell(400)->addText(htmlspecialchars($cedula));
                 $tabla->addCell(400)->addText(htmlspecialchars($programa));
                 $tabla->addCell(400)->addText(htmlspecialchars($semestre));
                 $tabla->addCell(400)->addText(htmlspecialchars($sumHoras));
                 
       } 
     
     
   }
   $prep_stmt = "select members_id,nombres from laboratoristas where members_id = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);   
    if ($stmt) 
        {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->store_result(); 
        // Obtiene las variables del resultado.
        $stmt->bind_result($cedula, $nombres);
        $stmt->fetch(); 
        }
   $seccion->addTextBreak(7);
   $seccion->addText(
		htmlspecialchars('_________________'),
		array('name' => 'Arial', 'size' => '12', 'bold' => 'false')
);
   $seccion->addText(
		htmlspecialchars($nombres),
		array('name' => 'Arial', 'size' => '12', 'bold' => 'false')
);
$seccion->addText(
		htmlspecialchars($cedula),
		array('name' => 'Arial', 'size' => '12', 'bold' => 'false')
);

//Guardando documento
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, 'Word2007');
$objWriter->save('reporte.docx');

header("Content-Disposition: attachment; filename='reporte.docx'");
echo file_get_contents('reporte.docx');
header('Location:../monitores/');
?>