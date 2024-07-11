<? 
  $zen="https://uag.zendesk.com/api/v2";
  $tok="e2eb14b4589a991dfae5bf688e15c23d6922ac89af468a12fdfa531d4c313b86";
  
  /*
 

$cadena="query=type:ticket requester:".$correo." custom_field_5329521386765:".$elNivelZ." custom_field_5327438874253:".$elProgramaZ." custom_field_5214120504589:".$inicioZ;
$cadena=str_replace (' ','%20',$cadena);
$test= $zen."/search.json?".$cadena;
 $ch = curl_init($test);
		$authorization = "Authorization: Bearer ".$tok; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3); //timeout after 30 seconds
		$result = curl_exec($ch);
		curl_close($ch);

		$result=json_decode($result,true);
		$result=$result['results'];


foreach($result  as $res=>$reson){
if( $reson['status'] =='new'){$hayEstatus=1;}
if( $reson['status'] =='pending'){$hayEstatus=1;}
if( $reson['status'] =='open'){$hayEstatus=1;}
}
*/
 
  /* super validacion */
 if($hayEstatus==0) {
  
  $etiCEC="";
  	if($callCen==1){
	$etiCEC=" CEC";
	}
  
if($wService!=""){
	$etiCEC=" ".$vengoUrl;
}
	 
  $dataZend=array();
  $dataZend['user']['tags']="landings uagmx".$etiCEC;
  $dataZend['user']['name']=$nombre." ".$apellidoP." ".$apellidoM;
  $dataZend['user']['email']=$correo;
  $dataZend['user']['phone']=$lada.$telefono;
  $dataZend['user']['details']="";
  
  

$dataZend=json_encode($dataZend);

//print_r($dataZend);


	$elCampus="guadalajara_campus";
	if($campus=="TAB"){$elCampus="tabasco_campus";}

  
  		$ch = curl_init($zen."/users/create_or_update");
		$authorization = "Authorization: Bearer ".$tok; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
		curl_setopt($ch, CURLOPT_TIMEOUT, 3); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataZend);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		//echo "$result<br><br>";
		
		curl_close($ch);
		$result=json_decode($result,true);
		
		$idZen=$result['user']['id'];
		
	//ticket
		
	
	$dataZend=array();
	$dataZend['ticket']['description']="Solicitud de Información";
	$dataZend['ticket']['requester_id']=$idZen;
	$dataZend['ticket']['tags']="uagmx";
	
	//googleUserID
	$dataZend['ticket']['fields'][5158162007565]=$google_userid;
	//referralPath
	$dataZend['ticket']['fields'][5158185414541]=$referral_path;
	//source
	$dataZend['ticket']['fields'][5158191865101]=$source;
	//medium
	$dataZend['ticket']['fields'][5158206221965]=$medium;
	//campaign
	$dataZend['ticket']['fields'][5158186773517]=$campaign;
	//keyword
	$dataZend['ticket']['fields'][5158199756429]=$keyword;
	//socialNetwork
	$dataZend['ticket']['fields'][5158223351565]=$social_network;
	//adContent
	$dataZend['ticket']['fields'][5158223755661]=$ad_content;
	//socialSourceReferral
	$dataZend['ticket']['fields'][5158337957901]=$social_source_referral;
	//origenDelaSolicitud
	$dataZend['ticket']['fields'][5158359530509]=$tituloR;
	//campus

	$dataZend['ticket']['fields'][5158428615181]=$elCampus;
	//periodo
	$dataZend['ticket']['fields'][5214120504589]=$inicioT;
	//programa
	$dataZend['ticket']['fields'][5327438874253]=$programa;
	//nivel 
	$dataZend['ticket']['fields'][5329521386765]=$nivelT;

	 //nivel 
	$dataZend['ticket']['fields'][10274738178189]=$estado;
	
	
	//cotnactos
	if(isset($contactoMedio)){
	$dataZend['ticket']['fields'][22369429553933]=$contactoMedio;
	}
	if(isset($contactoHora)){
	$dataZend['ticket']['fields'][22369543274381]=$contactoHora;
	}

	
	//nivel 
	if($ciudad!=""){
	$dataZend['ticket']['fields'][22092367175053]=$ciudad;
	}
	
	//actividad
	if(isset($actividad)){
	$dataZend['ticket']['fields'][10387611187085]=$actividad;
	}

	if(isset($promotor)){
	$dataZend['ticket']['fields'][10387278827277]=$promotor;
	}
	
	if(isset($escuelaProcedencia)){
	$dataZend['ticket']['fields'][10387218301069]=$escuelaProcedencia;
	}


	 if(isset($origenRegistro)){
	$dataZend['ticket']['fields'][18419633211533]=$origenRegistro;
	}
	
	//para feeder
	if(isset($origenFeeder)){
	$dataZend['ticket']['fields'][18419633211533]=$origenFeeder;
	}


	 if($callon!=""){
		 $dataZend['ticket']['fields'][23742114890125]=$callon;
	 }

	
	$dataZend=json_encode($dataZend);
// echo $dataZend;

//die();

		$ch = curl_init($zen."/tickets");
		$authorization = "Authorization: Bearer ".$tok; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataZend);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		//echo $result."<br><br><br>";
		curl_close($ch);
		$result=json_decode($result,true);
		
		$idticketZD=$result['ticket']['id'];
	
	
	if($callCen==4441){
		$tagsones='{ "tags": "test" }';
		$ch = curl_init($zen."/tickets/".$idticketZD."/tags.json	");
		$authorization = "Authorization: Bearer ".$tok; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
		curl_setopt($ch, CURLOPT_POSTFIELDS, $tagsones);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$resultT = curl_exec($ch);
		//echo $resultT."<br><br><br>";
		curl_close($ch);
		?>
		<script>
		console.log('tagas <?=$resultT?>')</script>
		<?
		//$resultT=json_decode($resultT,true);
	}
		

 // print_r($result);
 }