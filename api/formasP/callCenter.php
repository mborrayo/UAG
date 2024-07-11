<?
// Initialize WS with the WSDL
ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 5);

$idUAG= $ales;

if($ales==""){$idUAG=aleatorio(5);}

// Set request params
$params = array(
  "IDUAG" => "$idUAG",
  "TelFijo" => "$telefono",
  "TelMovil" => "$telefono",
  "NombreCompleto" => "$nombre $apellidoP $apellidoM",
  "Correo" => "$correo",
  "Programa" => "$programaT",
"Nivel" => "$nivelT",
  "Periodo" => "$inicioT",
  "Medio" => "$medium",
  "Source" => "$source",
);


//echo json_encode($params);

$arregloRespuestas['callCenter']=base64_encode('Peticion de envio:'.json_encode($params));

//print_r($params);
//$realIP = file_get_contents("http://ipecho.net/plain");
//echo $realIP;
$wsdl = 'http://200.94.80.210:90/WS_UAGReg.asmx?WSDL';
$options = array(
		'uri'=>'http://schemas.xmlsoap.org/soap/envelope/',
		'style'=>SOAP_RPC,
		'use'=>SOAP_ENCODED,
		'soap_version'=>SOAP_1_1,
		'cache_wsdl'=>WSDL_CACHE_NONE,
		'connection_timeout'=>15,
		'trace'=>true,
		'encoding'=>'UTF-8',
		'exceptions'=>true,
	);
try {
	$soap = new SoapClient($wsdl, $options);
	$data = $soap->InsertaRegistro_Cadena($params);
	
	$data = json_decode(json_encode($data), true);
	$callon=$data['InsertaRegistro_CadenaResult'];
	$arregloRespuestas['callCenter']=base64_encode($callon);
	$soyCall="!";

}
catch(Exception $e) {
	$soyCall=$e->getMessage();
}


//echo $callon;
  ?>