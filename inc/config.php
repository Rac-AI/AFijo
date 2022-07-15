<?php 
//Configuración general
$config = array(
	"titulo"=>"celulares?",
	"subtitulo"=>"Inicio",
	"url"=>"http://{$_SERVER['HTTP_HOST']}/AFijo/", //Con / al final
	//"url" => "http://localhost/AFijo/",
	"charset"=>"utf-8",

	"friendlyurls"=>false,

	//Datos para la configuracion del envio de correo
	"emailadmin"=>"",
	"emailenvios"=>"",
	"nombreenvios"=>"celulares?",
	"servidor"=>"localhost",
	"basedatos"=>"basecelulares",
	"usuario"=>"root",
	"pass"=>"grupocyg$",

	"googleanalytics"=>false,//Codigo UA- usado en las analiticas de Google
	"googlesiteverification"=>false,
	"mssiteverification"=>false
	); ?>