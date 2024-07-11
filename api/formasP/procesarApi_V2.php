<? header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include_once "../../AdminUAG/sesion/arriba.php";
//print_r($_POST);
//error_reporting(E_ALL); ini_set('display_errors', 1);

$alfon=file_get_contents('https://www.uag.mx/api/programas.json');
$alfon=json_decode($alfon,true);
$lada=mataMalos($lada);
$paisIp=mataMalos($paisIp);
$maboToks=mataMalos($maboToks);
$wService = file_get_contents('php://input');
if($wService!=""){
$wService=json_decode($wService,true);

// api post
		if($wService['post']==1){
		$nombre=$wService['nombre'];
		$apellidoP=$wService['apellido'];
		$telefono=$wService['telefono'];
		$nivel=$wService['nivel'];
		$estado=$wService['estado'];
		$correo=$wService['email'];
		$vengoUrl=$wService['vengoUrl'];
		$programa=strtoupper($wService['programa']);
		$inicio=$wService['inicio'];
		$idRegistro=$wService['idRegistro'];
		$campus=$wService['campus'];

	}
	

	
	//esto es para hb
	if($wService['hubSpot']==1){

		$hubSpot=$wService['hubSpot'];
		$nombre=$wService['nombre'];
		$apellidoP=$wService['apellido'];
		$telefono=$wService['telefono'];
		$nivel=$wService['nivel'];
		if($nivel=="LI"){
			$nivel="licenciatura";  
			
		}
		if($nivel=="ES"){$nivel="especialidad";}
		if($nivel=="MA"){
			$nivel="maestria";
		}

		$estado=$wService['estado'];
		$correo=$wService['email'];
		$vengoUrl="hubSpot";
		$programa=strtoupper($wService['programa']);
		$inicio=$wService['inicio'];
		$idRegistro=$wService['idRegistro'];
		$campus="VIR";

	}

	//esto es para feeder
	if($wService['feederApi']==1){
		
		$nombre=$wService['nombre'];
		$apellidoP=$wService['apellido'];
		$telefono=$wService['telefono'];
		$nivel=$wService['nivel'];
		$estado=$wService['estado'] ?? '';
		$ciudad=$wService['ciudad'] ?? '';
		$escuelaProcedencia=$wService['escuelaProcedencia'] ?? '';
		$correo=$wService['email'];
		$actividad=$wService['actividad'] ?? '';
		$promotor=$wService['promotor'] ?? '';
		$vengoUrl="feedeApi";
		$programa=strtoupper($wService['programa']);
		$inicio=$wService['inicio'];
		$idRegistro=$wService['idRegistro'];
		$campus=$wService['campus'];
		$origenFeeder=$wService['origenFeeder'];
		
	}
	//feeder
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
	$origenRegistro= $fila['url'] ?? '';
	$camposFM= $fila['camposF'];
	$refersCode= unserialize($fila['refersCode']);
	$gracias= unserialize($fila['gracias']);
	$usuarios= $fila['usuarios'];
	$correos= explode(',',$fila['correos']);
	$permisos= $fila['usuarios'];
	$proceso= $fila['proceso'];
	}
	

$nivelon="";	
if($origenReg!=""){$tituloR=$origenReg;}	
		
$arregloAutos=array();
$arregloAutos['api']="V2";
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
$arregloCRM['contactoMedio']="Medio contacto";
$arregloCRM['contactoHora']="Hora contacto";
	
	$campos=arregloSaca($campos);
	$orden=explode(',',$orden); 
	
	$arregloRespuestas=array();
	
	
	//los basicos
	foreach ($arregloAutos as $ordecin=>$ordecin){
		$esteValor=${$ordecin};
		$esteValor=mataMalos($esteValor);
		
		if($ordecin=="telefono"){
			$telefonoCall=$telefono;
			$esteValor=$lada.$esteValor;
		}
		
		
		
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
		
		
		if($ordecin=="pais"){
			$esteValor=$paisIp;
		}
	
	if($ordecin=="nivel"){
		$nivelon=$esteValor;
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
$idZen="";

//primra inserción
if($tituloR!=""){
if($ales==""){$ales=aleatorio(10);}


$arregloRespuestas['ales']=$ales;
$arregloRespuestas['browser']=$browser;
$arregloRespuestas['ip']=$ip;
$captura=serialize($arregloRespuestas);

//revisemos tu ip



//
	
$hayToken="";
if( $crm>0){
//busquemos tu clave
	
	$selZD="SELECT * FROM registrosRegistros WHERE correo='$correo' and token!='' limit 1";
	$res6s = $mysqli->query($selZD);
	$res6s->data_seek(0);
	while ($fila = $res6s->fetch_assoc()) 
	{
		$hayToken=$fila['token'];
	}
	
}

if($hayToken!=""){
$maboToks=$hayToken;
}
//forzamos el token	
if($maboToks==""){
$maboToks='mb'.aleatorio(8);
}

$query="INSERT IGNORE INTO registrosRegistros ( clave, token, area, idDonde,donde, idRegistro,	registro,		nombre,	apellidoP,	apellidoM,	correo,	telefono, celular,	refer, utm,	captura, vengoUrl, ip	) VALUES ('$ales', '$maboToks', '$areaR', '$queTitulo','$idQue','$idRegistro' ,		'$tituloR' ,	'' ,	'' ,	'' , '$correo' ,	'' ,	'' ,	'' , '$utm',	'$captura','$vengoUrl','' )";
$mysqli->query($query);
$last_id = $mysqli->insert_id;

}

$callon="";
//gaby quitar idiomas
if($campus=="VIR" ){
	$callCen=1;
}
//posgrados se quita maestria correo gaby 10 07 24
if(   $nivelon=="especialidad"){
	$callCen=1;
}

if($programa=="MCC17"){$soyCall=""; $callCen="";}
if($programa=="MPT18"){$soyCall=""; $callCen="";}
if($programa=="MPT21"){$soyCall=""; $callCen="";}
if($programa=="MSL16"){$soyCall=""; $callCen="";}
if($programa=="MTR22"){$soyCall=""; $callCen="";}

if($programa=="MAH21"){$soyCall=""; $callCen="";}
if($programa=="MFN21"){$soyCall=""; $callCen="";}
if($programa=="MNE21"){$soyCall=""; $callCen="";}
if($programa=="MRK21"){$soyCall=""; $callCen="";}


if($paisIp!="MX"){$soyCall=""; $callCen="";}

if($callCen==1){
	$soyCall=".";
	include "callCenter.php";
}

/* ya no a posgrados
if($nivel=="especialidad" || $nivel=="maestria" || $nivel=="doctorado"){
if($programa!="MAG22" && $programa!="DDE22"){
if($campus!="TAB" && $soyCall==""){
	$callCen=1;
	$soyCall=".";
	include "callCenter.php";
	}
	}
}
*/

if( $crm>0){
$hayEstatus=0;
	
//busquemos tu clave

	
	
//aqui revisamos si ya esxite
$selZD="SELECT * FROM registrosRegistros WHERE clave!='$ales' AND captura like '%$correo%' AND  captura like '%$programa%' AND  captura like '%$inicio%' limit 1";
$res6s = $mysqli->query($selZD);
 $res6s->data_seek(0);
 while ($fila = $res6s->fetch_assoc()) 
	{
	$hayEstatus=1;
 	}
	include "zenApi.php";
}



$arregloUtm=array();
$arregloUtm["zendesk"]=$idZen;
$arregloUtm["zendeskT"]=$idticketZD;
$arregloUtm["habiaZD"]=$hayEstatus;
//$arregloUtm["selZD"]=base64_encode($selZD);
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


$captura=serialize($arregloRespuestas);
$query="UPDATE registrosRegistros SET captura='$captura', utm='$utm' WHERE clave='$ales'";
$mysqli->query($query); 

//echo $query;
//pongamos la ultima
$hoy=date("Y-m-d H:i:s");
$query="UPDATE registros SET ultima='$hoy' WHERE id='$idRegistro'";
$mysqli->query($query);


	


}else{die('code 45');}



// aqui viene el crm
$mandaMailsT="";
if($nivelon=="licenciatura" || $nivelon=="maestria"){
 $mandaMailsT="<span style=\"font-size:12px; line-height:1\">En breve recibirás un correo con la información del programa.<br> No olvides revisar tu correo no deseado</span><br><br>";
	
	
}
file_get_contents('https://www.uag.mx/api/crm/email?c='.$ales);


$graz="Gracias por tu información</b><br>".$mandaMailsT."Síguenos en nuestras redes sociales";
if($idRegistro=="xSlI0tCFN7"){
$graz=$gracias['es'];
}
//die();
//ligas a redes dependiendo si es campus gdl tab o egresados
$youTube=1;
$mueveRedes="84px";
$ligaFB="https://www.facebook.com/UAG.MX";
$ligaTwi="https://twitter.com/UAG_Oficial";
$ligaInsta="https://www.instagram.com/uag_oficial";
$ligaLin="https://www.linkedin.com/school/universidad-aut-noma-de-guadalajara/";    
$ligaYT="https://www.youtube.com/user/UAGoficial";    


if ($campusT=="Tabasco"){
$youTube=1;    
$ligaFB="https://www.facebook.com/uag.tabasco/";
$ligaTwi="https://twitter.com/UAGTab";
$ligaInsta="https://www.instagram.com/uagtab/?hl=es";    
}

if ( $idRegistro=="Pw04MDKmLP" || $idRegistro=="WbQ2X8hg49" ||  $idRegistro=="OyGxPaPLSt" ||   $idRegistro=="Ak9lsAt7gS" ||  $idRegistro=="Y9kVydi49b" ||  $idRegistro=="gQWJ1g0o3U" ||   $idRegistro=="B7T5WWeEHZ" || $idRegistro=="aITXC7FH0W" ){
$youTube=0;        
$ligaFB="https://www.facebook.com/AlumniUAG";
$ligaTwi="https://twitter.com/UAGAlumni";
$ligaInsta="https://www.instagram.com/uagalumni";    
$ligaLin="https://www.linkedin.com/school/313172/admin";    
$mueveRedes="96px";   
}

?>


 
<script>
 $('#alertaBg').remove();
$('body').prepend('<div id="alertaCRM" style="z-index:9999; position:fixed; height:100vh; width:100%; background-color:rgba(255,255,255,.8)"></div>');
	 $('#alertaCRM').prepend('<div id="alertaBox" style="    background-color: #FFF; transform: translate(-50%,-50%);    padding: 20px;    left: 50%; text-align:center; max-width:400px;     top: 50%;    position: absolute;    box-shadow: 0 0 10px #666;" class="alertaBox"></div>');
	 var apendaxF='<div class="close" style="padding:10px; cursor:pointer; width:30px; float:right; text-align:center; background-color:#333; color:#FFF;" onClick="closeAlert(); return false;">X</div> '+
	 '<div style="clear:both"></div><div class="alertaBoxTitulo"></div><br>'+
	 '<div class="clear30"></div>';
	 $('#alertaBox').append(apendaxF);
	 $('.alertaBoxTitulo').html(
        '<span style="font-size:18px;"><br><b><?=$graz?></span>'+
        '<div class="clear20"></div>'+
        '<div class="div100" style="transform: translateX(<?=$mueveRedes?>); width:260px;">'+ 
        '<div class="absolute left" style="margin-right:10px;">'+
        '<a href="<?=$ligaFB?>" target="_blank"><img src="https://www.uag.mx/contenido/pZnMGfGf8b/fb_D2A.svg" loading="lazy" alt="Facebook" data-src="https://www.uag.mx/contenido/pZnMGfGf8b/fb_D2A.svg" data-srcm="https://www.uag.mx/contenido/pZnMGfGf8b/fb_D2A.svg" style="max-width: 100%; opacity: 1;" class=" imas imagenesLoad" width="30"  />'+
        '</a>'+	
        '</div>'+     
        '<div class="absolute left" style="margin-right:10px;">'+
        '<a href="<?=$ligaTwi?>" target="_blank"><img src="https://www.uag.mx/contenido/pZnMGfGf8b/xamarillo-01_mld.svg" loading="lazy" alt="X" data-src="https://www.uag.mx/contenido/pZnMGfGf8b/xamarillo-01_mld.svg" data-srcm="https://www.uag.mx/contenido/pZnMGfGf8b/xamarillo-01_mld.svg" style="max-width: 100%; opacity: 1;" class=" imas imagenesLoad" width="30"  />'+
        '</a>'+	
        '</div>'+        
        '<div class="absolute left" style="margin-right:10px;">'+
        '<a href="<?=$ligaInsta?>" target="_blank"><img src="https://www.uag.mx/contenido/pZnMGfGf8b/ig_s7W.svg" loading="lazy" alt="Instagram" data-src="https://www.uag.mx/contenido/pZnMGfGf8b/ig_s7W.svg" data-srcm="https://www.uag.mx/contenido/pZnMGfGf8b/ig_s7W.svg" style="max-width: 100%; opacity: 1;" class=" imas imagenesLoad" width="30"  />'+
        '</a>'+	
        '</div>'+   
        '<div class="absolute left" style="margin-right:10px;">'+
        '<a href="<?=$ligaLin?>" target="_blank"><img src="https://www.uag.mx/contenido/pZnMGfGf8b/in_at0.svg" loading="lazy" alt="LinkedIn" data-src="https://www.uag.mx/contenido/pZnMGfGf8b/in_at0.svg" data-srcm="https://www.uag.mx/contenido/contenido/pZnMGfGf8b/in_at0.svg" style="max-width: 100%; opacity: 1;" class=" imas imagenesLoad" width="30"  />'+
        '</a>'+	
        '</div>'+
         <? if ($youTube==1){?> 
        '<div class="absolute left" style="margin-right:10px;">'+
        '<a href="<?=$ligaYT?>" target="_blank"><img src="https://www.uag.mx/contenido/pZnMGfGf8b/yt_tnd.svg" loading="lazy" alt="YouTube" data-src="https://www.uag.mx/contenido/pZnMGfGf8b/yt_tnd.svg" data-srcm="https://www.uag.mx/contenido/pZnMGfGf8b/yt_tnd.svg" style="max-width: 100%; opacity: 1;" class=" imas imagenesLoad" width="30"  />'+
        '</a>'+	
        '</div>'+
        <?}?> 
        '</div>'
     
     );
    
<? if($maboToks!=""){ ?>	
	//regresa el token original
	localStorage['maboToks']='<?=$maboToks?>';
<? } ?>
	
	
function closeAlert(){
  <? if($idRegistro!="xSlI0tCFN7"){ ?>
 top.location.reload();
 <? } else { ?>
 top.location.href="/es/egresados/plan-superate/m";
 <? } ?>

 }
    
 $(".load").hide();
 $(".loadGracias").hide();
  setTimeout(function(){  closeAlert() }, 50000);

	</script>