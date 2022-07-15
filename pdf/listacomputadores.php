
<?php

include "../inc/comun.php";
require("../fpdf/fpdf.php");

$bd = new GestarBD;
$x1="";

date_default_timezone_set('America/santiago');
$hora = date('H:i:s a');
$fecha = date('d/m/Y ');
$fecha7dias = date('d-m-Y', strtotime('-1 week')) ; // resta 1 semana
$size_=7;

$cabeceraT = array("Codigo ");

// Creación del objeto de la clase heredada
$mipdf = new FPDF('L');
$mipdf-> AddPage();
$mipdf-> Setfont('Arial','B',$size_);
$mipdf-> Ln (2);
$mipdf-> Cell(200,10,"LISTA DE COMPUTADORES",0,0,'C');

$mipdf -> Ln (15);
			
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(25,10,"TIPO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(20,10,"MARCA",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(35,10,"MODELO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(40,10,"SERIE",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(120,10,"CARACTERISTICAS",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(15,10,"L WINDOWS",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(15,10,"L OFFICE",1,0,'C',true);
		
//$mipdf -> Image("../webcam/fotos/$imagen",10,43,30,"JPG");
$mipdf -> Ln(10);
	
$sql="SELECT computadores.*, marcas.descripcion AS d_marca
			FROM computadores, marcas
			WHERE computadores.c_marca = marcas.codigo
			ORDER BY computadores.t_computador, computadores.c_marca, computadores.modelo";
//$consulta=mysql_query($conexion,$sql); 
$sql2=$bd->consulta($sql);

$fila=0;

while ($datos = $bd-> mostrar_registros($sql2)){

	$caracteristicas=$datos ['procesador'].' Disco '.$datos ['t_hdd'].' de '.$datos ['size_hdd'].' '.$datos ['ram'].' RAM'.' Office '.$datos ['office'].' SO '.$datos ['s_o'].' '.$datos ['ver_s_o'];
	$tipo= $datos ['t_computador'];
	$d_marca = $datos ['d_marca'];
	$modelo = $datos ['modelo'];
	$serial = $datos ['serial'];
	$l_windows= $datos ['lic_windows'];
	$l_office = $datos ['lic_office'];
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(25,10,$tipo,1,0,'C',true);	

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(20,10,$d_marca,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(35,10,$modelo,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(40,10,$serial,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(120,10,$caracteristicas,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(15,10,$l_windows,1,0,'C',true);		
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(15,10,$l_office,1,1,'C',true);		
	
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
