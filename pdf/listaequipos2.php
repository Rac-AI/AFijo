
<?php

include "../inc/comun.php";
require("../fpdf/fpdf.php");

$id_usuario=$_POST['s_usuario'];

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
$mipdf-> Cell(200,10,"HISTORICO DE EQUIPOS POR USUARIO",0,0,'C');

$mipdf -> Ln (15);
			
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(50,10,"USUARIO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(50,10,"MARCA",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(60,10,"MODELO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(45,10,"SERIAL/Nro CELULAR",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(25,10,"ESTADO",1,0,'C',true);

//$mipdf -> Image("../webcam/fotos/$imagen",10,43,30,"JPG");
$mipdf -> Ln(10);

$sql="SELECT NOMBRE, descripcion, modelo, serial, estado ";
$sql.="FROM (";
$sql.="SELECT usuarios.NOMBRE, asignaciones.id_equipo, asignaciones.t_equipo, marcas.descripcion, computadores.modelo, computadores.serial, 
    CASE asignaciones.SITUACION 
    	WHEN 'A' THEN 'ACTIVO'
        ELSE 'INACTIVO' END AS estado ";
$sql.="FROM asignaciones, computadores, marcas, usuarios ";
$sql.="WHERE asignaciones.T_EQUIPO = 'PC' AND 
		computadores.id_equipo = asignaciones.id_equipo AND 
        computadores.c_marca = marcas.codigo AND
        asignaciones.id_usuario = usuarios.id_usuarios AND ";
if( $id_usuario!="0" ){
	$sql.= "asignaciones.id_usuario = '$id_usuario' ";}			
if (substr(rtrim($sql),-3) == "AND") {$sql=substr(rtrim($sql), 0, -3);}		
$sql.="UNION ";
$sql.="SELECT usuarios.NOMBRE, asignaciones.id_equipo, asignaciones.t_equipo, marcas.descripcion, celulares.modelo, celulares.NUMERO AS serial, 
    CASE asignaciones.SITUACION 
    	WHEN 'A' THEN 'ACTIVO'
        ELSE 'INACTIVO' END AS estado ";
$sql.="FROM asignaciones, celulares, marcas, usuarios ";
$sql.="WHERE asignaciones.T_EQUIPO = 'CL' AND 
		celulares.id_equipo = asignaciones.id_equipo AND 
        celulares.c_marca = marcas.codigo AND
        asignaciones.id_usuario = usuarios.id_usuarios AND ";
if( $id_usuario!="0" ){
	$sql.= "asignaciones.id_usuario = '$id_usuario' ";}			
if (substr(rtrim($sql),-3) == "AND") {$sql=substr(rtrim($sql), 0, -3);}			
$sql.=") equipos ORDER BY NOMBRE";

//echo $sql;
			
//$consulta=mysql_query($conexion,$sql); 
$sql2=$bd->consulta($sql);

while ($datos = $bd-> mostrar_registros($sql2)){

	$nombre=$datos ['NOMBRE'];
	$descrip=$datos ['descripcion'];
	$modelo=$datos ['modelo'];
	$serial=$datos ['serial'];
	$estado = $datos ['estado'];

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(50,10,$nombre,1,0,'C',true);	
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(50,10,$descrip,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(60,10,$modelo,1,0,'C',true);		
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(45,10,$serial,1,0,'C',true);		
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(25,10,$estado,1,1,'C',true);		

}

$mipdf -> Ln(10);
$mipdf -> cell(178,5,"fecha : $fecha" , 0 , 10, true);
$mipdf -> cell(178,1,"hora : $hora" , 0 , 10, true);
$mipdf-> Output();	
	

?>
