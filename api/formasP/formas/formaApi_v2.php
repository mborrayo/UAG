<? header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include_once "../../AdminUAG/sesion/arriba.php";
$idRegistro=mataMalos($idRegistro);
if($idRegistro==""){die();}
$idioma="es";

$campus=mataMalos($campus);
$nivel=mataMalos($nivel);
$anchoApi=mataMalos($width ?? '');
$programa=mataMalos($programa);
$camposPido=array();
$contadores=array();
$camposPosibles=array();
$camposPosibles['campus']=1;
$camposPosibles['nivel']=1;
$camposPosibles['programa']=1;



//yo soy los campus

foreach($camposPosibles as $camp=>$daa){
$esteCam=${$camp};

	if($esteCam!=""){
	$esteCampus=array();
	$cuentaCampus=0;
	
	$a=explode(',',$esteCam);
	foreach($a as $ai){
		$camposPido[$camp]['e'][$ai]=1;
		$cuentaCampus=$cuentaCampus+1;
	}
		$esteCampus=json_encode($esteCampus);
		$camposPido[$camp]['c']=$cuentaCampus;
	}
}

//print_r($camposPido);


$ales=aleatorio(5);
$vengode= mataMalos($vengode);


$datas=array();
$refer=$_GET['refer'];
$quer="SELECT * FROM registros WHERE id='$idRegistro'";
  $res6443 = $mysqli->query($quer);
 $res6443->data_seek(0);
 while ($filaxx = $res6443->fetch_assoc()) 
	{
	$idArea= $filaxx['idArea'];
	$campos= $filaxx['campos'];
	$crm= $filaxx['crm'];
	
	
	$orden= $filaxx['orden'];
	$columnasF= $filaxx['columnas'];
	$camposFM= unserialize($filaxx['camposF']);
	$graciasMensaje= $filaxx['gracias'];

	}
	$plural="s";
 
	
	$campos=arregloSaca($campos);
	$orden=explode(',',$orden); 


$anchoCampo=100;
if($columnasF>1){$anchoCampo=100/$columnasF;}

$arregloAutos=array();
$arregloAutos['nombre']="Nombre";
$arregloAutos['apellidoP']="Apellido Paterno";
$arregloAutos['apellidoM']="Apellido Materno";
$arregloAutos['correo']="Correo";
$arregloAutos['telefono']="Teléfono";
$arregloAutos['celular']="Celular";
$arregloAutos['contactoMedio']="Medio de contacto";
$arregloAutos['contactoHora']="Hora de contacto preferida";

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

/* */
$setix=array();
if($set!=""){
$set=explode('|',$set);
foreach($set as $seti){
$seti=explode('_',$seti);
	$setix[$seti[0]]=$seti[1];
}
}

$myIP="http://ip-api.com/json/".$ip;
	//$myIP="https://ipinfo.io/".$ip."?token=6fc9c57468412d";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$myIP);
	curl_setopt($ch, CURLOPT_TIMEOUT, 2); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	$resultIPO=curl_exec ($ch);
	$resultIP=json_decode($resultIPO,true);
	$paisIP=$resultIP['country'];
$paisIP=$resultIP['countryCode'];
//echo $resultIPO;

if($paisIP==""){$paisIP="MX";}
//if ($huella=="mZT7hcG2tShKLZx987UqsAXXvXfqIAjAuGN6TzQcyAj15gHZ1T"){	$paisIP="AR";	}
	//campos fijos
	?>

<link   href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
<style>
.div50 { float: left; width: 50%; padding-right: 10px; position: relative;}
.div100 { float: left; width: 100%; position: relative;}
.left { position: relative; float: left;}
.right  { position: relative; float: right;}
.botonEnviar {
    background-color: #76232f;
    padding: 6px;
    border: none;
    min-width: 100px;
    color: #fff;
    display: inline-block;
    font-size: 14px;
    opacity: .9;
    text-align: center;
}

.displayNone {
display: none;
}
.botonEnviarNo {
    background-color: #76232f;
    padding: 6px;
    border: none; display: none;  
    min-width: 100px;
    color: #fff;
    display: inline-block;
    font-size: 14px;
    opacity: .5; cursor: not-allowed !important;
    text-align: center;
}
.clear10{ clear: both; height: 10px;}
.inputCrtl {
    width: 1px!important;
    height: 1px;
    padding: 0!important;
    opacity: 0;
}
.absoluteV{position:absolute!important;z-index:2;top:50%; transform:translateY(-50%)}
.cursor { cursor: pointer; z-index: 9;}
<?
if($bgCI==""){
$bgCI="#dedede";
}else {
$bgCI="#".$bgCI;
}
if($colI==""){
$colI="#000";
}else {
$colI="#".$colI;
}
?>

.field {
 
    outline: 0;
    box-sizing: border-box;
    width: 100%;
    background-color: <?=$bgCI?> !important;
	color: <?=$colI?> !important;
    border: 1px solid #EBEBEB;
    padding: 10px; font-size: 12px; transition: .1s linear;  margin-bottom:10px;
}
.field:hover { border: 1px solid #ccc;}

	.inputShow {}

@media screen and (max-width: 600px) {
.div50 { float: left; width: 100%;}
	.inputShow {display: none;}
}


.formaErrorApi { border: 1px solid red !important; color: red !important; font-weight: bold !important;  }
.formaErrorApiFix { border: 1px solid red !important; color: red !important; font-weight: bold !important;}
.erroritos, .erroritosC  { width: 20px; height: 20px; border-radius: 100px; text-align: center; background-color: #FFF; top: 45%;   color:Red; z-index:99; font-size:16px; right:0px;}

	
	
</style>



<div style="clear:both; height: 10px"></div>

 <div class=" formaForma" id="gracias" style=" width:100%; float: left;   <? if ($graciasGet!="") { ?> margin-bottom:50px;  <? } ?> " >

<div class="tituloForma">
<?=$tituo?>
</div>
<div style="float:left;   width:100%;">
<? $ligaForma=$dominioUrl."/api/formasP/formaProcesar.php"; ?>
<form    enctype="multipart/form-data" id="forma<?=$ales?>">
<input type="text" name="contra" value="" style="width:0px; height:0px; border:0; padding:0;" />
<input type="hidden" class="refer" name="refer" value="<?=$refer?>" />
<input type="hidden" name="posicion" class="formaPosicion" id="posicion<?=$ales?>"  />
<input type="hidden" name="idRegistro" value="<?=$idRegistro?>" />
<input type="hidden" name="paisIp" id="paisIp" value="<?=$paisIP?>" />
<input type="hidden"  name="vengoUrl" id="vengo<?=$ales?>" value="<?=$vengode?>"/>
<input type="hidden"  name="origenReg" id="origen<?=$ales?>" value="<?=$origenReg?>"/>
<input type="hidden"  name="idQue" value="<?=$idQue?>"/>
<input type="hidden"  name="ales" value="<?=$ales?>"/>
<input type="hidden"  name="queTitulo" value="<?=$queTitulo?>"/>
<input type="hidden"  name="ses" value="<?=$elToken?>"/>
<input type="hidden"  name="idiomaF" value="<?=$idioma?>"/>
<input type="hidden"  name="dAt74s" id="datas"/>
<input type="hidden" name="google_userid" id="google_userid" value=""/>
<input type="hidden" name="referral_path" id="referral_path" value=""/>
<input type="hidden" name="source" id="utm_source" value=""/>
<input type="hidden" name="medium" id="utm_medium" value=""/>
<input type="hidden" name="campaign" id="utm_campaign" value=""/>
<input type="hidden" name="ad_content" id="ad_content" value=""/>
<input type="hidden" name="keyword" id="utm_keyword" value=""/>
<input type="hidden" name="social_network" id="social_network" value=""/>
<input type="hidden" name="social_source_referral" id="social_source_referral" value=""/>
	
<input type="hidden" name="maboToks" id="maboToks" value=""/>
<input type="hidden" name="maboUTM" id="maboUTM" value=""/>


<script>
var liga=$(location).attr('href');
$('#vengo<?=$ales?>').val(liga);
	$('#maboUTM').val(localStorage['maboUTM']);
	$('#maboToks').val(localStorage['maboToks']);
</script>
 <? 
 
	
 foreach($arregloAutos as $auto=>$tit) { 

	 
 if($camposFM[$auto]!=""){
 $reqs="";
 if($camposFM[$auto]['req']==1){$reqs="required";}
 
 $camposCRM="";
 if($crm>0){
 $camposCRM="camposCRM";
 }
 $anchin=$camposFM[$auto]['ancho'];
 
 if($anchoApi!=""){$anchin=$anchoApi;}
 
 $changeT="";
 $soySelect="";
 if($auto=="contactoMedio"){ ?>
 
 <div class="padd5 apiForm inputShow  div<?=$anchin?>">
<select <?=$changeT?> data-tipo="<?=$auto?>"   class=" <?=$auto?> <?=$auto?>CRM <?=$auto?><?=$ales?> 
 f<?=$ales?>requerido validate[<?=$reqs?>] <?=$camposCRM?> field fieldS" name="<?=$auto?>" id="<?=$auto?>" placeholder="<?=$camposFM[$auto][$idioma]?>">
<option value=""><?=$camposFM[$auto][$idioma]?></option>
<option value="whatsApp">WhatsApp</option>
<option value="llamada">Llamada</option>
<option value="correo_electrónico">Correo electrónico</option>
</select>
</div>
 
 <? 
 $soySelect=1;
 }
 
  if($auto=="contactoHora"){ ?>
 
 <div class="padd5 apiForm  inputShow  div<?=$anchin?>">
<select <?=$changeT?> data-tipo="<?=$auto?>"   class=" <?=$auto?> <?=$auto?>CRM <?=$auto?><?=$ales?> 
  f<?=$ales?>requerido validate[<?=$reqs?>] <?=$camposCRM?> field fieldS" name="<?=$auto?>" id="<?=$auto?>" placeholder="<?=$camposFM[$auto][$idioma]?>">
<option value=""><?=$camposFM[$auto][$idioma]?></option>
<option value="8:00a.m.–3:00p.m.">8:00 a.m. – 3:00 p.m.</option>
<option value="3:00p.m.–8:00p.m.">3:00 p.m. – 8:00 p.m.</option>
<option value="8:00p.m._en_adelante">8:00 p.m. en adelante</option>
</select>
</div>
 
 <?
 $soySelect=1;
 }
 
 $libreTel=$camposFM[$auto]['libre'] ?? '';
if($libreTel!=""){ ?>
 
<input type="hidden" id="libreTel" value="1">
<? }
	 
	 
 if($auto=="correo"){
 $changeT='" onblur="validateEmail'.$ales.'(this.value)"';
 }
 if($soySelect==""){
	 
	$placeH=$camposFM[$auto][$idioma]; 
	 
 ?>
<div class="padd5 apiForm   div<?=$anchin?>" id="div<?=$auto?>"><input <?=$changeT?> data-tipo="<?=$auto?>" <? if($auto=="telefono"){ ?>autocomplete="sd" <? } ?> type="text" class=" <?=$auto?> <?=$auto?>CRM <?=$auto?><?=$ales?> 
<? if($auto=="telefono"){ echo $ales; }?> f<?=$ales?>requerido validate[<?=$reqs?>] <?=$camposCRM?> field fieldS" name="<?=$auto?>" id="<?=$auto?>" placeholder="<?=$camposFM[$auto][$idioma]?>"/>
	
	<? if($auto=="telefono"){ ?>
<input autocomplete="xxx" type="hidden" class="  "id="telefonoV" value="" name="lada">
<div class="clear"></div>
<span id="msg-telefono" class="  absoluteV  "  style="display: none; right:40px; font-size: 10px;"></span>

	<? } ?>
	</div>
 
<? } 

}
// fin del puesto
}

if($crm>0){

$displaCRM="";
if($crmVisibles==1){
$displaCRM="displayNone";
}
 
 $defaults=array();
  foreach($arregloCRM as $auto=>$tit) { 
	  	 
 if($camposFM[$auto]!=""){
 $reqs="";
 if($camposFM[$auto]['req']==1){$reqs="required";}
 
 $defaults[$auto]['t']=$camposFM[$auto][$idioma];
 
$displaCRM="";
 
 if($camposPido[$auto]['c'] == 1){ $displaCRM="displayNone";}
 
 $anchin=$camposFM[$auto]['ancho'];
 if($anchoApi!=""){$anchin=$anchoApi;}
  ?>
<div class=" padd5 apiForm  inputShow <?=$displaCRM?> div<?=$anchin?> div<?=$auto?><?=$ales?>" id="div<?=$auto?>" style="min-height: 58px">
<select autocomplete="sd" onChange="crm_<?=$auto?>('<?=$ales?>', this.value )"  class="f<?=$ales?>requerido validate[<?=$reqs?>] crm<?=$auto?> field fieldS" name="<?=$auto?>" id="<?=$ales?>_<?=$auto?>">
<option  value=""><?=$camposFM[$auto][$idioma]?></option>
<? if($auto=="campus"){ ?>
<? if($camposPido['campus']['c']<1 || $camposPido['campus']['e']['JAL']==1) { ?><option value="JAL">GUADALAJARA</option><? } ?>
<? if($camposPido['campus']['c']<1 || $camposPido['campus']['e']['TAB']==1) { ?><option value="TAB">TABASCO</option><? } ?>
<? if($camposPido['campus']['c']<1 || $camposPido['campus']['e']['VIR']==1) { ?><option value="VIR">ONLINE</option><? } ?>
<? } ?>

</select>
</div>


<?  } }  } ?>

								
    <?
	//


	foreach ($orden as $ordecin){

	$este=$campos[$ordecin];

	$tituloC=($este['titulo_'.$idioma]);
	$tipoC=$este['tipoC'];
	$anchoC=$este['ancho'];
	$valoresC=$este['valores'];
	$requeridoC=$este['requerido'];
	//$proveedorC=$este[4];
	
	$custom="";
	
	$tipoC=explode('_',$tipoC);
	$tipoCampo=$tipoC[0];
	$tipoCampoN=$tipoC[1];
	

	
	if($tipoC=="Telefono"){
	$custom=",custom[phone]";	
	}
	
	if($tipoC=="Númerico"){
	$custom=",custom[number]";	
	}
	
	//comienzan los campos
	if($tituloC!=""){ 
	
	
	$tituloC=explode('|',$tituloC);
	if($idioma=="es"){$tituloC=$tituloC[0];}else {$tituloC=$tituloC[1];}
	
	$puestado="";
	if(isset($setix[$ordecin])){
	
	$puestado=$setix[$ordecin];
	}
		 $cuentaInputs=$cuentaInputs+1;
	?>
		
        <div class="padd5 apiForm  inputShow  div<?=$anchoC?>" id="div<?=$ordecin?>">
         <? if ($tipoCampo=="titulo"){ ?> 
         
         <? if ($valoresC!=""){ ?><a href="<?=$valoresC?>" target="_blank"><? } ?>
         <?=$tituloC?>
          <? if ($valoresC!=""){ ?></a><? } ?>
         <? } ?>
		 
		 <? if ($tipoCampo=="date"){ ?>
         <input onfocus="(this.type='date')" type="text"  class="  <? if($requeridoC=="1"){ ?>f<?=$ales?>requerido<? } ?> field fieldS   " <? if ($tipoC=="Telefono") {?>maxlength="14"  <? } ?> name="<?=$ordecin?>" id="<?=$ordecin?>" placeholder=" <?=$tituloC?>"/>
         <? } ?>
         
          <? if ($tipoCampo=="text"){ ?>
         <input  type="text" class="<? if($requeridoC=="on"){ ?>f<?=$ales?>requerido<? } ?> field fieldS" name="<?=$ordecin?>" value="<?=$puestado?>" id="<?=$ordecin?>" placeholder=" <?=$tituloC?>"/>
         <? } ?>
		 
		 <? if ($tipoCampo=="email"){ ?>
         <input type="email" class="<? if($requeridoC=="on"){ ?>f<?=$ales?>requerido<? } ?> field fieldS" name="<?=$ordecin?>" id="<?=$ordecin?>" placeholder=" <?=$tituloC?>"/>
         <? } ?>
         
         <? if ($tipoCampo=="check"){ ?>
         <label style="font-size:12px;">
         <input type="checkbox"  <? if($requeridoC=="on"){ ?>checked disabled <? } ?>  name="<?=$ordecin?>" id="<?=$ordecin?>"> <?=$tituloC?>
         </label>
         <? } ?>

         <? if ($tipoCampo=="textarea"){ ?>
         <textarea class="field fieldS <? if($requeridoC=="on"){ ?>f<?=$ales?>requerido<? } ?> field fieldS" name="<?=$ordecin?>" id="<?=$ordecin?>" rows=5 placeholder=" <?=$tituloC?>"></textarea>
         <? } ?>
         
         
         <? if ($tipoCampo=="file"){
			 
			
			 $datas[]=aleatorio(5).base64_encode($ordecin);
			 
			  ?>
         <?=$tituloC?>
           <input type="file" class="<? if($requeridoC=="on"){ ?>validate[required<?=$custom?>] archivosForma<? } ?> field fieldS" name="<?=$ordecin?>" id="<?=$ordecin?>" placeholder=" <?=$tituloC?>"/>
         <? } ?>
         

         <? if ($tipoCampo=="select"){ 
		 
		 $valoresC=explode('|',$valoresC);
		 
		 
		 
		 
		 ?>
         
         <select  data-tipo="<?=$tipoCampo?>"  class="<? if($requeridoC=="on"){ ?> f<?=$ales?>requerido validate[required] <? } ?> field fieldS" name="<?=$ordecin?>" id="<?=$ordecin?>" >
         <option value=""><?=$tituloC?></option>
         <? foreach($valoresC as $valin) { 
		 
		 $valin=explode('°',$valin);
		 $valinV=$valin[0];
		 $valinVC=$valin[1] ?? '';
		 
		 if($valinVC==""){$valinVC=$valinV;}
	
		 $correoSecreto="";
	 
		 ?>
			<option value="<?=$valinVC?>"><?=$valinV?></option> 
			 
		
         <? } ?>
         </select>
		 <? } ?>
         
         
         </div>

<?	
//fin del ciclo
} 
?>
 
<?

	}
	?>      

      
	  <div class="clear10 clearBotonForma"></div>
	
	<? if($colL==""){$colL="#000";} else {
	$colL="#".$colL;
	}
	$colBot="";
	$colBotT="";
	
	if($colB!=""){
	$colB=str_replace('#','',$colB);
	$colBot=" background-color:#".$colB."; ";
	}
	
	if($colBT!=""){
	$colBT=str_replace('#','',$colBT);
	$colBotT=" color:#".$colBT."; ";
	}
	
	?>
	
	<div class="div100" style="font-size: 11px; color: <?=$colL?>" >
	Al continuar acepto los  <a href="https://www.uag.mx/contenido/SoJEgnT2E7/proteccion_datos_personales_hFZ.pdf" target="_blank" style="color: <?=$colL?>; text-decoration: underline">	términos y condiciones</a>
	</div>
	<div class="clear10"></a>
 
 <div class="div100 centrado loadForm<?=$ales?>" style="display:none ; height: 50px; background-image: url(https://www.uag.mx/img/load.gif); background-position: center center; background-repeat: no-repeat"> </div>
        
        <input type="text" name="ctrl" class="inputCrtl" >   
		<input type="text" name="ctrlTmp" class="inputCrtl" value="<?=encripta('encrypt',$hoySt);?>" >   
        <div style="margin-top: 10px; <?=$colBot?> <?=$colBotT?>" onclick="enviarForma('<?=$ales?>')" class="botonEnviar botonEnviar<?=$ales?> cursor right b<?=$ales?>"  ><? if($idioma=="es") { ?>Enviar <? } else { ?> Send<? } ?></div>
		
		
		<div style="margin-top: 10px; opacity: .5; display: none; cursor:not-allowed; <?=$colBot?> <?=$colBotT?>"   class=" botonEnviarNo botonEnviarNo<?=$ales?> cursor right b<?=$ales?>"  ><? if($idioma=="es") { ?>Enviar <? } else { ?> Send<? } ?></div>
 
 <div class="div100" id="crmRespuesta<?=$ales?>"></div>      
   </form>       
     </div>
     </div>


<link rel="stylesheet" href="https://www.uag.mx/api/intl/intl.css?u=8">
 




<script>

$.getScript( "https://www.uag.mx/api/intl/intl.js?u=2", function( data, textStatus, jqxhr ) {

	intelis();  
})
	
	

<? 
 
if($paisIP!="MX")	{ ?>
$('#divestado').remove();
<? } ?>
	
	
var idRegistro='<?=$ales?>';
var cual='<?=$ales?>';


var paisesLargo;
var paisLargoMin=10;
var paisLargoMax=10;
var url='https://www.uag.mx/api/paisesDigitos.php?i';
$.getJSON(url, function(data) {
paisesLargo=data;
//console.log(paisesLargo)
 paisLargoMin=data['<?=$paisIP?>']['min'];
 paisLargoMax=data['<?=$paisIP?>']['max'];
 let teldis=paisLargoMin;
 if(paisLargoMax!=paisLargoMin){ teldis= paisLargoMin+' a ' +paisLargoMax;}
 $('.telefonoCRM ').attr('placeholder','Teléfono '+teldis+' dígitos');
})

console.log(paisLargoMin+ ' '+paisLargoMax)

var campusPido=<?=json_encode($camposPido)?>;
var elCampus;
var idiomaC
var defaults=<?=json_encode($defaults)?>;								 

var dataCRM;
function startCRM(){
console.log('start')

var url='https://www.uag.mx/api/programasJson?u=<?=$hoySt?>Asx';
$.getJSON(url, function(data) {
		dataCRM=data;
		crm_pais(cual,'');
		//console.log('pais')
	//console.log('-<?=$campus?>');
		
<? if($camposPido['campus']['c']==1){ ?>
elCampus='<?=$campus?>'; 
$('#'+cual+'_campus').val('<?=$campus?>');
crm_campus('<?=$ales?>','<?=$campus?>'); 
console.log(elCampus+'a')
<? } ?>
<? if($camposPido['nivel']['c']==1){ ?>
var niveNoAlfa=dataCRM['niveles']['<?=$nivel?>']['t'];
$('#'+cual+'_nivel').val(niveNoAlfa); 
crm_nivel('<?=$ales?>',niveNoAlfa);  <? } ?>
<? if($camposPido['programa']['c']==1){ ?>
$('#'+cual+'_programa').val('<?=$programa?>');
crm_programa('<?=$ales?>','<?=$programa?>');  <? } ?>


}).fail(function(jqXHR, textStatus, errorThrown) { alert('getJSON request failed! ' + textStatus); })

 
 
 }

startCRM();
var idiomaC="es";


function crm_campus(cual, que){
 
elCampus=que;
  $('#'+cual+'_programa').html('<option selected   value="">'+defaults['programa']['t']+'</option>');
  $('#'+cual+'_nivel').html('<option selected   value="">'+defaults['nivel']['t']+'</option>');
  $('#'+cual+'_inicio').html('<option selected   value="">'+defaults['inicio']['t']+'</option>');

var puedoN;
if(campusPido['nivel']){
puedoN=campusPido['nivel']['c']
};


var losNives=dataCRM['campus'][que]
$.each(losNives, function(key, val) {
  selon="1";
  if(puedoN && puedoN>1){
  	selon="";
	if(campusPido['nivel']['e'][val.id]==1){selon=1;}
  }
   esteT=val.t;
   if(selon==1){
   apenda='<option value="'+key+'">'+esteT.toUpperCase()+'</option>';
   $('#'+cual+'_nivel').append(apenda);
  
  }
  });
  
  
  <? 
  $nivelN="";
  if($camposPido['nivel']['c']==1){ 
  if($nivel=="BA"){$nivelN="bachillerato";}
  if($nivel=="LI"){$nivelN="licenciatura";}
  if($nivel=="MA"){$nivelN="maestria";}
  if($nivel=="ES"){$nivelN="especialidad";}
  if($nivel=="DO"){$nivelN="doctorado";}
  if($nivel=="ID"){$nivelN="idiomas";}
  ?>
  //console.log('cc<?=$nivelN?>');
  $('#<?=$ales?>_nivel').val('<?=$nivelN?>');
  crm_nivel('<?=$ales?>','<?=$nivelN?>');
  <? } ?>
  
  crm_como(cual)
 
}





function crm_como(cual){
var losComos=dataCRM['como'];
$.each(losComos, function(key, val) {
apenda='<option value="'+key+'">'+val.t+'</option>';
  $('#'+cual+'_como').append(apenda);
  });
}


function crm_nivel(cual,valon){


var puedoN;
if(campusPido['programa']){
puedoN=campusPido['programa']['c']
};

//console.log(valon)

  $('#'+cual+'_programa').html('<option selected   value="">'+defaults['programa']['t']+'</option>');
  $('#'+cual+'_inicio').html('<option selected   value="">'+defaults['inicio']['t']+'</option>');

var losNives=dataCRM['campus'][elCampus][valon]['programas'];
$.each(losNives, function(key, val) {
  selon="1";
  if(puedoN && puedoN>1){
  	selon="";
	if(campusPido['programa']['e'][val.id]==1){selon=1;}
  }
  
  esteT=val.t;
  if(selon==1){
   apenda='<option value="'+val.id+'">'+esteT.toUpperCase()+'</option>';
   $('#'+cual+'_programa').append(apenda);
   }
  });
  
  
 
  
}

//cambia los programas
function crm_programa(cual,valon){
	$('#'+cual+'_inicio').html('<option selected   value="">'+defaults['inicio']['t']+'</option>');
	$('#'+cual+'_inicio').html('<option value="">Fecha de inicio</option>');
	var losNives=dataCRM['programas'][valon]['per'];
		$.each(losNives, function(key, val) {
		   apenda='<option value="'+key+'">'+val+'</option>';
		   $('#'+cual+'_inicio').append(apenda);

		  });
}


//cambia los estados
 

//cambia las ciudades
function crm_pais(cual,valon){
	var losNives=dataCRM['estados'];
	// al reves los valores
	$.each(losNives, function(key, val) {
	   apenda='<option value="'+val+'">'+val+'</option>';
	   $('.crmestado').append(apenda);
	  });
}

 
 function crm_estado(){
 
 }
 

//
var teston="";

$(function(){

teston=localStorage['teston'];
if(teston){console.log('soytest');}

<? 
$arregloUtm=array();
$arregloUtm["google_userid"]=1;
$arregloUtm["referral_path"]=1;
$arregloUtm["utm_source"]=1;
$arregloUtm["utm_medium"]=1;
$arregloUtm["utm_campaign"]=1;
$arregloUtm["ad_content"]=1;
$arregloUtm["utm_keyword"]=1;
$arregloUtm["social_network"]=1;
$arregloUtm["social_source_referral"]=1;
?>
var utms=<?=json_encode($arregloUtm);?>

setTimeout(function() {
$.each(utms, function(i, item) {
    es=localStorage[i];
	//console.log(es);
	if(es){$('#'+i).val(es); }
});

	linkoG=localStorage['maboUTM'];
	if(linkoG){
	linkoG=linkoG.split('&');	
	for (let i = 0; i < linkoG.length; i++) {
		este=linkoG[i];
		este=este.split('=');
		sou=este[0];
		souV=este[1];
			souV=decodeURI(souV).trim();
		//console.log('mu '+sou+ ' '+souV)
		//solo si no esta vacio recargamos la utm
		if(sou=="utm_source" && souV) {
		
			$('#utm_source').val(souV);
		}
		if(sou=="utm_medium" && souV) {
			$('#utm_medium').val(souV);
		}
		if(sou=="utm_campaign" && souV) {
			$('#utm_campaign').val(souV);
		}
		if(sou=="utm_keyword" && souV) {
			$('#utm_keyword').val(souV);
		}
	}
	}
	
}, 2000);


 

 $(".telefono<?=$ales?>").keydown(function (e) {
 /*
	console.log(e.keyCode)
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
  
				
				
				 
				 return;
				 
				
		
	 
				 
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
		*/
    });
 
    $(".telefono<?=$ales?>").blur(function(e){
	var esteT=this.value;
	var text = esteT.replace(/\D/g,'');
	var text2=	text.substring(0, paisLargoMax); 
    $(this).val(text2); 
 
    });  
	
	$(".telefono<?=$ales?>").keyup(function(e){
	var esteT=this.value;
	var text = esteT.replace(/\D/g,'');
	var text2=	text.substring(0, paisLargoMax); 
    $(this).val(text2); 
 
    }); 
	
	}); 
	
var miCorreo="";	
function validateEmail<?=$ales?>(email) {
	
	$('.inputShow').show().removeClass('inputShow');
	
  var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;;
   
   emailString=email.toLowerCase();


correoOK="";
 if (re.test(emailString)) {
 correoOK="1";
 console.log('ok correo');
 } else {
 alert('El correo contiene cáracteres no válidos');
 }


   
      
	$('.botonEnviar<?=$ales?>').hide();
	$('.botonEnviarNo<?=$ales?>').hide();
	 $('.correo<?=$ales?>').addClass('formaErrorApiFix');
 var url='https://www.uag.mx/api/formas/emailValidacion?email='+email;

 if(email && email!=miCorreo && correoOK==1){
		$.getJSON(url, function(data) {
			vali=parseInt(data.valido);
			if(vali<1){
			$('.correo<?=$ales?>').after('<span class="material-icons absoluteV erroritosC rojo"  >warning</span>');
			$('.botonEnviar<?=$ales?>').hide();
			$('.botonEnviarNo<?=$ales?>').show();
			 $('.correo<?=$ales?>').addClass('formaErrorApiFix');
			} else {
			$('.botonEnviar<?=$ales?>').show();
			$('.botonEnviarNo<?=$ales?>').hide();
	 $('.correo<?=$ales?>').removeClass('formaErrorApiFix');
	 $('.erroritosC').remove();
			}
		});
		
		}
	 return re.test(email);
	
}
function validaTelefono<?=$ales?>(telefonon){
//alert(telefonon.length);
var regreso="0";
telefonon=telefonon.replaceAll(' ','');
var mensajitoTel=$('#msg-telefono').html();

 

if(telefonon.length>=paisLargoMin && telefonon.length<=paisLargoMax){regreso=1;}
if(mensajitoTel!="check"){regreso="";}

if(regreso==1){ return true;} else {return false;}
}


function validaForma(cual){		
var puedo="";
$( ".f"+cual+"requerido" ).each(function( index ) {

$(this).removeClass('formaErrorApi');

  esteid=(this.id);
  vals=$(this).val();
  tipon=$(this).data('tipo');
 // console.log(vals+tipon);
  
  if(tipon=="email" || tipon=="correo"){
  if(validateEmail<?=$ales?>(vals)!=true){vals=""; }
  
  }
  
  if(tipon=="telefono" || tipon=="phone" || tipon=="celular"){
     if(validaTelefono<?=$ales?>(vals)!=true){vals=""; }
  }
  //console.log(esteid+' '+vals)
  if(vals==""){
   	puedo="no";
	console.log();
    $(this).addClass('formaErrorApi');
	$(this).after('<span class="material-icons absoluteV erroritos rojo"  >warning</span>');
	

	
  }
  
  	setTimeout(function() {
 $( ".f"+cual+"requerido" ).removeClass('formaErrorApi');
 $('.erroritos').remove();
}, 3000);
  
});
if(puedo=="no"){return false;} else {return true;}
}

function enviarForma(cual){
if(validaForma(cual)==true){

 $('.loadForm'+cual).show();
 $('.botonEnviar'+cual).remove();
 
var posis=$('#posicion'+cual).val();
if(posis=="1"){posis="DT";}
if(!posis){posis="Footer";}

window.dataLayer = window.dataLayer || [];  
dataLayer.push(
 {
'event': 'formulario-contacto',
'nivel': $('#'+cual+'_nivel').val(),
'programa': $('#'+cual+'_programa').val(),
'ubicación': posis,
'pagina': $('#vengo'+cual).val(),
 });


//console.log(posis+'close');
//tester="";
//if(teston){tester="_V2";}
tester="_V2";

var esta=$('#forma'+cual).serialize();
console.log(cual+esta);
$.ajax({
    type: "POST",
    url: "https://www.uag.mx/api/formasP/procesarApi"+tester,
    data: "idRegistro="+idRegistro+esta,
    success: 
		function(msg){
			$('#crmRespuesta<?=$ales?>').html(msg);
		}
    });
	
	


//$('.load').show();
//creaAlerta();
//$('#alerta').append( '<div class="clear20"></div><div class="tituloSeccion tintoUag centrado">GRACIAS</div>');
 //$('#alerta').append( '<div class="centrado padd10">Tus datos fueron enviados exitosamente.</div>');

	console.log('forma'+cual)
	//document.getElementById('forma'+cual).reset();  
	  
  } console.log('faltan');
}

var hashRefere = window.location.hash;
if(hashRefere){
$('.refer').val(hashRefere);
}


$( ".f"+idRegistro+"requerido" ).change(function() {
  //validaForma(idRegistro);
});

 

</script>