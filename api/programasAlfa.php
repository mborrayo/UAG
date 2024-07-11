<? include "../AdminUAG/sesion/arriba.php"; 

$miJson=file_get_contents('https://admision.uag.mx/api/ws/programasAlfa');
$miJson=json_decode($miJson,true);


$lasCuotas=file_get_contents('https://tubeca.uag.mx/api/programas/cuotas');
$lasCuotas=json_decode($lasCuotas,true);

$query="update programasAlfa set activo='0'     where id!=''";
$mysqli->query($query);


$estamos=array();



$selas="SELECT * FROM programasAlfa WHERE activo='1'";
$res6 = $mysqli->query($selas);
$res6->data_seek(0);
 while ($fila = $res6->fetch_assoc()) 
	{
	$idU= $fila['id'];
	$estamos[$idU]= unserialize($fila['nivelT']);
 }


foreach($miJson['programas'] as $prog=>$ads){

	$query="INSERT IGNORE INTO  programasAlfa (id, creado, activo) VALUES ('$prog','$hoy','1')";
	$mysqli->query($query);
	
	
	$tit=$ads['t'];
	$niv=$ads['n'];
	$ct=$ads['ct'];
	$nivT=$ads['nt'];
	$periodos=serialize($ads['per'] ?? '');
	$fechas=serialize($ads['fec'] ?? '');
	
	$cuotas=serialize($lasCuotas[$prog] ?? '');
	
	
 
	$estamos[$prog]['nivelA']=$nivT;
	$estamos[$prog]['campus']=$ct;
	$soy=serialize($estamos[$prog]);
	
	
	$query="update programasAlfa
	set
	titulo='$tit'
	,periodos='$periodos'
	,fechas='$fechas'
	,cuotas='$cuotas'
	,nivelT='$soy'
	,activo='1'
	where id='$prog'";
	$mysqli->query($query);
	 

}

foreach($miJson['campus'] as $camp=>$niv){
foreach($niv as $nivi=>$nivo){
	
	$elNivel=$nivo['id'];
	$elNivelT=$nivo['t'];
	
	foreach($nivo['programas'] as $tis=>$progi){
		
	$prog= $progi['id'];
		
		
	$estamos[$prog]['nivel']=$elNivelT;
	$soy=serialize($estamos[$prog]);	
		
		//echo "$soy<br>";
		
	$query="update programasAlfa
	set
	campus='$camp'
	,nivel='$elNivel'
	,nivelT='$soy'
	,modificado='$hoy'
	where id='$prog'";
	$mysqli->query($query);
		
		
	}
	
}
}
	
	
$arregloMete=array();
$selas="SELECT * FROM programasAlfa ";

$res6 = $mysqli->query($selas);
$res6->data_seek(0);
 while ($fila = $res6->fetch_assoc()) 
	{
	$idU= $fila['id'];
	$titulo= $fila['titulo'];
	$nivel= $fila['nivel'];
	$campus= $fila['campus'];
	$nivelA= $fila['nivelA'];
	$nivelT= unserialize($fila['nivelT']);
 
	 $periodos= unserialize($fila['periodos']);
	 $descargas= unserialize($fila['descargas']);
	 
	 
$arregloMete['campus'][$campus]=$nivelT['campus'];


$campusT=$nivelT['campus'];
$query="INSERT IGNORE INTO  nivelesAlfa (id, tipo, titulo, nivel, campus, nivelA) VALUES ('$campus','campus','$campusT','','','')";
$mysqli->query($query);
	

$tituloT=$nivelT['nivel'];
$arregloMete['nivel'][$nivel]['t']=$nivelT['nivel'];

$query="INSERT IGNORE INTO  nivelesAlfa (id, tipo, titulo, nivel, campus, nivelA) VALUES ('$nivel','nivel','$tituloT','','','')";
$mysqli->query($query);

$arregloMete['nivel'][$nivel]['campus'][$campus]=$nivelT['campus'];


$esteT=$tituloT. " ".$campus;
$mete=$nivel."_".$campus;
$query="INSERT IGNORE INTO  nivelesAlfa (id, tipo, titulo, nivel, campus, nivelA) VALUES ('$mete','nivelCampus','$esteT','$nivel','$campus','')";
$mysqli->query($query);



}

	
?>