
<?php

include "../inc/comun.php";
require("../fpdf/fpdf.php");

$bd = new GestarBD;
$x1="";

date_default_timezone_set('America/santiago');
$hora = date('H:i:s a');
$fecha = date('d/m/Y ');
$fecha7dias = date('d-m-Y', strtotime('-1 week')) ; // resta 1 semana

$cabeceraT = array("Codigo ");

// Creación del objeto de la clase heredada
$mipdf = new FPDF();
$mipdf-> AddPage();
$mipdf-> Setfont('Arial','B',10);
$mipdf-> Ln (2);
$mipdf-> Cell(200,10,"LISTA DE COMPANIAS",0,0,'C');

$mipdf -> Ln (15);
			
$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(35,10,"EMPRESA",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', 9);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(  60,10,"DESCRIPCION",1,0,'C',true);

		
//$mipdf -> Image("../webcam/fotos/$imagen",10,43,30,"JPG");
$mipdf -> Ln(10);
	
$sql="SELECT * FROM compania ORDER BY descripcion";
//$consulta=mysql_query($conexion,$sql); 
$sql2=$bd->consulta($sql);

$fila=0;

while ($datos = $bd-> mostrar_registros($sql2)){

	$codigo= $datos ['codigo'];
	$descripcion = $datos ['descripcion'];

	$mipdf -> SetFont('ARIAL','B', 9);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(35,10,$codigo,1,0,'C',true);	

	$mipdf -> SetFont('ARIAL','B', 9);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell( 60,10,$descripcion,1,1,'C',true);		
	
	
	$fila=1;
}


//$fecha55=$fecha7dias;
//$consulta55=mysql_query($conexion,$fecha55); 
//$result=mysql_query($fecha55,$link) or die("Error: ".mysql_error());
$oye=0;
$num = 0; 

$mipdf -> Ln(10);
$mipdf -> cell(178,5,"fecha : $fecha" , 0 , 10, true);
$mipdf -> cell(178,1,"hora : $hora" , 0 , 10, true);
$mipdf-> Output();	
	

?>
