
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
$mipdf-> Cell(200,10,"LISTA DE CELULARES",0,0,'C');

$mipdf -> Ln (15);

$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(40,10,"USUARIO",1,0,'C',true);			
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(20,10,"COMPANIA",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(20,10,"NUMERO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(80,10,"PLAN",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(60,10,"CARACTERISTICAS",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(15,10,"Est LINEA",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(15,10,"Est EQUIPO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(15,10,"RECAMBIO",1,0,'C',true);
		
//$mipdf -> Image("../webcam/fotos/$imagen",10,43,30,"JPG");
$mipdf -> Ln(10);
	
$sql="SELECT celulares.*, marcas.descripcion AS d_marca, compania.descripcion AS d_compania, usuarios.NOMBRE, asignaciones.id_usuario
				FROM celulares, marcas, compania, asignaciones, usuarios
				WHERE celulares.C_MARCA = marcas.codigo AND
						celulares.C_COMPANIA = compania.codigo AND
						asignaciones.id_equipo = celulares.ID_EQUIPO AND
						asignaciones.T_EQUIPO = 'CL' AND
						usuarios.id_usuarios = asignaciones.id_usuario
				ORDER BY usuarios.NOMBRE";			
//$consulta=mysql_query($conexion,$sql); 
$sql2=$bd->consulta($sql);

while ($datos = $bd-> mostrar_registros($sql2)){

	$caracteristicas=$datos ['d_marca'].' '.$datos ['MODELO'];
	$plan=$datos ['PLAN'].' TIPO PLAN '.$datos ['T_PLAN'];
	$usuario= $datos ['NOMBRE'];
	$compania= $datos ['d_compania'];
	$numero = $datos ['NUMERO'];
	$estado_linea=$datos ['ESTADO_LINEA'];
	$estado_equipo=$datos ['ESTADO_EQUIPO'];
	$f_recambio = $datos ['F_RECAMBIO'];

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(40,10,$usuario,1,0,'C',true);	
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(20,10,$compania,1,0,'C',true);	

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(20,10,$numero,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(80,10,$plan,1,0,'C',true);	
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(60,10,$caracteristicas,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(15,10,$estado_linea,1,0,'C',true);		
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(15,10,$estado_equipo,1,0,'C',true);		
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(15,10,$f_recambio,1,1,'C',true);		

}

$mipdf -> Ln(10);
$mipdf -> cell(178,5,"fecha : $fecha" , 0 , 10, true);
$mipdf -> cell(178,1,"hora : $hora" , 0 , 10, true);
$mipdf-> Output();	
	

?>
