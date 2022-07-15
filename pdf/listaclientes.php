
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
$mipdf-> Cell(200,10,"LISTA DE USUARIOS",0,0,'C');

$mipdf -> Ln (15);
			
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(50,10,"NOMBRE",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(20,10,"T USUARIO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(50,10,"EMPRESA",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(20,10,"UBICACION",1,0,'C',true);

$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(50,10,"DEPARTAMENTO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(50,10,"CORREO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(20,10,"CELULAR",1,0,'C',true);
		
//$mipdf -> Image("../webcam/fotos/$imagen",10,43,30,"JPG");
$mipdf -> Ln(10);
	
$sql="SELECT usuarios.id_usuarios AS id_usuarios, usuarios.NOMBRE AS nombre, usuarios.C_TUSUARIO, tusuarios.descripcion AS d_tusuario, usuarios.C_EMPRESA, empresa.descripcion AS d_empresa, 
			usuarios.C_UBICACION, oficinas.descripcion AS d_ubicacion,
			usuarios.C_DEPTO, areas.descripcion AS d_depto,
			usuarios.MAIL AS mail, usuarios.CELULAR as celular
		FROM usuarios, tusuarios, empresa, oficinas, areas
		WHERE usuarios.C_TUSUARIO = tusuarios.codigo AND
			usuarios.C_EMPRESA = empresa.codigo AND
			usuarios.C_UBICACION = oficinas.codigo AND
			usuarios.C_DEPTO = areas.codigo
		ORDER BY usuarios.NOMBRE ASC;";
//$consulta=mysql_query($conexion,$sql); 
$sql2=$bd->consulta($sql);

$fila=0;

while ($datos = $bd-> mostrar_registros($sql2)){

	$nombre= $datos ['nombre'];
	$d_tusuario= $datos ['d_tusuario'];
	$d_empresa = $datos ['d_empresa'];
	$d_ubicacion = $datos ['d_ubicacion'];
	$d_depto = $datos ['d_depto'];
	$correo= $datos ['mail'];
	$celular = $datos ['celular'];
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(50,10,$nombre,1,0,'C',true);	

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(20,10,$d_tusuario,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(50,10,$d_empresa,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(20,10,$d_ubicacion,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(50,10,$d_depto,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(50,10,$correo,1,0,'C',true);		
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(20,10,$celular,1,1,'C',true);		
	
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
