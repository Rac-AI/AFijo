
<?php

include "../inc/comun.php";
require("../fpdf/fpdf.php");

$id_usuario=$_POST['s_usuario'];
$t_computador=$_POST['s_computador'];
$c_marca=$_POST['s_marca'];
$modelo=$_POST['modelo'];
$t_hdd=$_POST['s_tipodisco'];
$office=$_POST['office'];
$s_o=$_POST['s_o'];
$ver_s_o=$_POST['ver_s_o'];
$procesador=$_POST['procesador'];
$lic_windows=$_POST['s_lic_windows'];
$lic_office=$_POST['s_lic_office'];

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
$mipdf -> Cell(40,10,"NOMBRE",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(20,10,"TIPO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(15,10,"MARCA",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(25,10,"MODELO",1,0,'C',true);
$mipdf -> SetFont('ARIAL','B', $size_);
$mipdf -> SetFillColor(0, 191, 255);
$mipdf -> Cell(30,10,"SERIE",1,0,'C',true);
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
	
$sql="SELECT computadores.*, marcas.descripcion AS d_marca, usuarios.nombre AS n_usuario ";
$sql.="FROM computadores, marcas, usuarios ";
$sql.="WHERE computadores.c_marca = marcas.codigo AND computadores.id_usuarios = usuarios.id_usuarios AND ";
if( $id_usuario!="0" ){
	$sql.="computadores.id_usuarios = $id_usuario AND ";}
if( $t_computador!="0" ){
	$sql.="computadores.t_computador = '$t_computador' AND ";}
if( $c_marca!="0" ){
	$sql.= "computadores.c_marca = '$c_marca' AND ";}
if( $modelo!="" ){
	$sql.="computadores.modelo = '$modelo' AND ";}
if( $procesador!="" ){
	$sql.="computadores.procesador = '$procesador' AND ";}
if( $t_hdd!="0" ){
	$sql.="computadores.t_hdd = '$t_hdd' AND ";}
if( $office!="" ){
	$sql.="computadores.office = '$office' AND ";}
if( $lic_office!="0" ){
	$sql.="computadores.lic_office = '$lic_office' AND ";}	
if( $s_o!="" ){
	$sql.="computadores.s_o = '$s_o' AND ";}
if( $ver_s_o!="" ){
	$sql.="computadores.ver_s_o = '$ver_s_o' AND ";}
if( $lic_windows!="0" ){
	$sql.="computadores.lic_windows = '$lic_windows' AND ";}
if (substr(rtrim($sql),-3) == "AND") {$sql=substr(rtrim($sql), 0, -3);}
$sql.="ORDER BY computadores.t_computador, computadores.c_marca, computadores.modelo";

//echo $sql;

//$consulta=mysql_query($conexion,$sql); 
$sql2=$bd->consulta($sql);

while ($datos = $bd-> mostrar_registros($sql2)){

    $n_usuario= $datos ['n_usuario'];
	$caracteristicas=$datos ['procesador'].' Disco '.$datos ['t_hdd'].' de '.$datos ['size_hdd'].' '.$datos ['ram'].' RAM'.' Office '.$datos ['office'].' SO '.$datos ['s_o'].' '.$datos ['ver_s_o'];
	$tipo= $datos ['t_computador'];
	$d_marca = $datos ['d_marca'];
	$modelo = $datos ['modelo'];
	$serial = $datos ['serial'];
	$l_windows= $datos ['lic_windows'];
	$l_office = $datos ['lic_office'];

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(40,10,$n_usuario,1,0,'C',true);	
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(20,10,$tipo,1,0,'C',true);	

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(15,10,$d_marca,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(25,10,$modelo,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(30,10,$serial,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(120,10,$caracteristicas,1,0,'C',true);		

	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(15,10,$l_windows,1,0,'C',true);		
	
	$mipdf -> SetFont('ARIAL','B', $size_);
	$mipdf -> SetFillColor(1000,1000,255);
	$mipdf -> Cell(15,10,$l_office,1,1,'C',true);		
	
}

$mipdf -> Ln(10);
$mipdf -> cell(178,5,"fecha : $fecha" , 0 , 10, true);
$mipdf -> cell(178,1,"hora : $hora" , 0 , 10, true);
$mipdf-> Output();	
	

?>
