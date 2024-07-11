<? header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include_once "../../AdminUAG/sesion/arriba.php";
//print_r($_POST);
//error_reporting(E_ALL); ini_set('display_errors', 1);

$alfon=file_get_contents('https://admision.uag.mx/api/ws/programas');
$alfon=json_decode($alfon,true);


$wService = file_get_contents('php://input');
if($wService!=""){
$wService=json_decode($wService,true);



if($wService['hubSpot']==1){

 	$hubSpot=$wService['hubSpot'];
    $nombre=$wService['nombre'];
    $apellidoP=$wService['apellido'];
    $telefono=$wService['telefono'];
    $nivel=$wService['nivel'];
	if($nivel=="LI"){$nivel="licenciatura";}
	if($nivel=="ES"){$nivel="especialidad";}
	if($nivel=="MA"){$nivel="maestria";}
	
    $estado=$wService['estado'];
    $correo=$wService['email'];
	$vengoUrl=$wService['vengoUrl'] ?? 'hubSpot';
    $programa=strtoupper($wService['programa']);
    $inicio=$wService['inicio'];
    $idRegistro=$wService['idRegistro'];
	$campus="VIR";

}


}


$arregloEnvioSeleccion=array();
//echo"SELECT * FROM registros WHERE id='$idRegistro'";
$res6 = $mysqli->query("SELECT * FROM registros WHERE id='$idRegistro'");
 $res6->data_seek(0);
 while ($fila = $res6->fetch_assoc()) 
	{
	$tituloR= $fila['titulo'];
	$areaR= $fila['area'];
	$campos= $fila['campos'];
	$crm= $fila['crm'];
	$orden= $fila['orden'];
	$camposFM= $fila['camposF'];
	$refersCode= unserialize($fila['refersCode']);
	$gracias= unserialize($fila['gracias']);
	$usuarios= $fila['usuarios'];
	$correos= explode(',',$fila['correos']);
	$permisos= $fila['usuarios'];
	$proceso= $fila['proceso'];
	}
		
if($origenReg!=""){$tituloR=$origenReg;}	
		
$arregloAutos=array();
$arregloAutos['nombre']="Nombre";
$arregloAutos['apellidoP']="Apellido Paterno";
$arregloAutos['apellidoM']="Apellido Materno";
$arregloAutos['correo']="Correo";
$arregloAutos['telefono']="Teléfono";
$arregloAutos['celular']="Celular";


$arregloCRM=array();
$arregloCRM['nacionalidad']="Nacionalidad";
$arregloCRM['pais']="País";
$arregloCRM['estado']="Estado";
$arregloCRM['ciudad']="Ciudad";
$arregloCRM['campus']="Campus";
$arregloCRM['nivel']="Nivel";
$arregloCRM['programa']="Programa";
$arregloCRM['inicio']="Inicio";
$arregloCRM['como']="¿Cómo se enteró?";
	
	$campos=arregloSaca($campos);
	$orden=explode(',',$orden); 
	
	$arregloRespuestas=array();
	
	
	//los basicos
	foreach ($arregloAutos as $ordecin=>$ordecin){
		$esteValor=${$ordecin};
		$esteValor=mataMalos($esteValor);
		$arregloRespuestas[$ordecin]=$esteValor;
	}
	
	foreach ($arregloCRM as $ordecin=>$ordecin){
	

	$mas="";
	$esteValor=${$ordecin};
	if($ordecin=="campus"){
	
	$campusT="Guadalajara";
	if($esteValor=="TAB"){ $campusT="Tabasco"; }
	if($esteValor=="VIR"){$campusT="Online";}
	
	
	$esteValor= $esteValor. " ".$campusT ;

	}
	
	if($ordecin=="nivel"){
		$esteValor= ucfirst($esteValor);
	}
	
	if($ordecin=="como"){
		$esteValor= $alfon['como'][$esteValor]['t'];
	}
	
	if($ordecin=="programa"){
		$esteValor= $esteValor. " ".$alfon['programas'][$esteValor]['t'] ;
		$programaT=$esteValor;
		$nivelT=$alfon['programas'][$programa]['n'];
		//echo"***** $programa **** $nivelT ****";
	}
	
	if($ordecin=="inicio"){
		$inicioT=$esteValor;
		$periodoT=$alfon['programas'][$programa]['per'][$esteValor];
		$esteValor= $esteValor. " ".$periodoT ;
		
	}
		
		$esteValor=mataMalos($esteValor);
		$arregloRespuestas[$ordecin]=$esteValor.$mas;
		//echo $ordecin." / ".$esteValor."<br>";
	}
	
	
	
	
	
	
	foreach ($orden as $ordecin){
	
	$esteArreglo=arregloSaca($campos[$ordecin]);
	$tituloC=$esteArreglo['titulo'];
	$tipoC=$esteArreglo['tipoC'];
	$valoresC=$esteArreglo['valores'];
	$requeridoC= $esteArreglo['requerido'];
	$proveedorC= $esteArreglo['proveedor'];
		
		
		$esteValor=${$ordecin}." ".${$ordecin."OtraVal"};
		$esteValorC=$esteValor;
		//tiene envio especial? //
		
		$esteValor2=explode('°',$esteValor);
		$esteValor2Correo=$esteValor2[1];
	 
			
		if($esteValor2Correo!=""){
			
			$esteValor2Correo=trim($esteValor2Correo);
			$correoSelect=$losUsuarios['correo'.$esteValor2Correo];
			$arregloEnvioSeleccion[]=$correoSelect;
			$esteValorC=$esteValor2[0];
			 }
		
		//
		
		
		$esteValor=mataMalos($esteValor);
		$arregloRespuestas[$ordecin]=$esteValor;
		
		//para correos
		
		$extras .='<tr><td>'.$tituloC.':</td><td>'.$esteValorC.'</td>	</tr>';
		
		
	}

$callCen="";
$soyCall="";
if($campus=="VIR"){
	$callCen=1;
	$soyCall=".";
	include "callCenter.php";
}

if($nivel=="especialidad" || $nivel=="maestria" || $nivel=="doctorado"){
if($programa!="MAG22" && $programa!="DDE22"){
if($campus!="TAB" && $soyCall==""){
	$callCen=1;
	$soyCall=".";
	include "callCenter.php";
	}
	}
}
$callCen="";
if( $crm>0 && $callCen==""){
	include "zenApi.php";
}


$arregloRespuestas['ales']=$ales;
$arregloRespuestas['browser']=$browser;
$arregloRespuestas['ip']=$ip;
$captura=serialize($arregloRespuestas);


$arregloUtm=array();
$arregloUtm["zendesk"]=$idZen;
$arregloUtm["zendeskT"]=$idticketZD;
$arregloUtm["google_userid"]=$google_userid;
$arregloUtm["referral_path"]=$referral_path;
$arregloUtm["source"]=$source;
$arregloUtm["medium"]=$medium;
$arregloUtm["campaign"]=$campaign;
$arregloUtm["ad_content"]=$ad_content;
$arregloUtm["keyword"]=$keyword;
$arregloUtm["social_network"]=$social_network;
$arregloUtm["social_source_referral"]=$social_source_referral;
$utm=serialize($arregloUtm);




if($tituloR!=""){	

if($ales==""){$ales=aleatorio(10);}

$query="INSERT INTO registrosRegistros ( clave, area, idDonde,donde, idRegistro,	registro,		nombre,	apellidoP,	apellidoM,	correo,	telefono, celular,	refer, utm,	captura, vengoUrl	) VALUES ('$ales','$areaR', '$queTitulo','$idQue','$idRegistro' ,		'$tituloR' ,	'$nombreF' ,	'$apellidoPF' ,	'$apellidoMF' , '$correoF' ,	'$telefonoF' ,	'$celularF' ,	'$refer' , '$utm',	'$captura','$vengoUrl' )";
$mysqli->query($query); 
//echo $query;
//pongamos la ultima
$hoy=date("Y-m-d H:i:s");
$query="UPDATE registros SET ultima='$hoy' WHERE id='$idRegistro'";
$mysqli->query($query);

}else{die();}



// aqui viene el crm



//die();
?>

 
<script>
 $('#alertaBg').remove();
$('body').prepend('<div id="alertaCRM" style="z-index:9999; position:fixed; height:100vh; width:100%; background-color:rgba(255,255,255,.8)"></div>');
	 $('#alertaCRM').prepend('<div id="alertaBox" style="    background-color: #FFF; transform: translate(-50%,-50%);    padding: 20px;    left: 50%; text-align:center; max-width:300px;     top: 50%;    position: absolute;    box-shadow: 0 0 10px #666;" class="alertaBox"></div>');
	 var apendaxF='<div class="close" style="padding:10px; cursor:pointer; width:30px; float:right; text-align:center; background-color:#333; color:#FFF;" onClick="closeAlert(); return false;">X</div> '+
	 '<div style="clear:both"></div><div class="alertaBoxTitulo"></div><br>'+
	 '<div class="clear30"></div>';
	 $('#alertaBox').append(apendaxF);
	 $('.alertaBoxTitulo').html('<br><b>Mensaje enviado exitosamente</b><br>En breve nos comunicaremos<?=$soyCall?>');
  function closeAlert(){
 top.location.reload();

 }
 $(".load").hide();
 $(".loadGracias").hide();
  setTimeout(function(){ closeAlert() }, 5000);

	</script>