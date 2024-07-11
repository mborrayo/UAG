<? include_once "../../AdminUAG/sesion/arriba.php"; 
header('Content-Type: application/javascript');

$origin_url =   $_SERVER['HTTP_REFERER'];

$origin_url=str_replace('http://','',$origin_url);
$origin_url=str_replace('https://','',$origin_url);
$origin_url=explode('/',$origin_url)[0];
$f=mataMalos($_GET['f']);
$campus=mataMalos($_GET['campus']);
$nivel=mataMalos($_GET['nivel']);
$programa=mataMalos($_GET['programa']);
$t=mataMalos($_GET['t']);
$o=mataMalos($_GET['o']);
$bgCI=mataMalos($_GET['bgCI']);
$colI=mataMalos($_GET['colI']);
$colL=mataMalos($_GET['colL']);
$colB=mataMalos($_GET['colB']);
$colBT=mataMalos($_GET['colBT']);
$width=mataMalos($_GET['width'] ?? '');
$set=mataMalos($_GET['set'] ?? '');
if($t==""){die('alert("Target not defined")');}
if($f==""){die('$("#'.$t.'").html("Please include form");');}

$idRegistro="";
$selas="SELECT * FROM registros WHERE id='$f' AND dominios like '%$origin_url%'";
if($origin_url=="uag.mx" || $origin_url=="www.uag.mx"){
$selas="SELECT * FROM registros WHERE id='$f'  ";
}
$res6 = $mysqli->query($selas);
 $res6->data_seek(0);
 while ($fila = $res6->fetch_assoc()) 
	{
	$idRegistro= $fila['id'];
	$tituloM= $fila['titulo'];
	$urlRegistroM= $fila['url'];
	$dominios= $fila['dominios'];
	$idProveedorM= $fila['idProveedor'];
	$gracias= unserialize($fila['gracias']);
	$correos= $fila['correos'];
	}

$ales=aleatorio(3);
if($idRegistro==""){die('console.log(".");');}

$rando= rand(1, 3);
$rando=500*$rando;
$wait=0;

if($origin_url=="conecta.uag.mx"){
$wait=1500;
}



?>
console.log('ancho *<?=$width?>*');
$('#<?=$t?>').html('<div class="div100" style="text-align: center; font-size: 11px; color:#<?=$colL?>">Cargando formulario  <br><img src="https://www.uag.mx/img/load.gif" style="width: auto;" width="16" height="11"></div>');
var t<?=$ales?>="<?=$t?>";
var f="<?=$idRegistro?>";
var campus="<?=$campus?>";
var nivel="<?=$nivel?>";
var programa="<?=$programa?>";
var o="<?=$o?>";
var v="<?=$origin_url?>";
var bgCI="<?=$bgCI?>";
var colI="<?=$colI?>";
var colL="<?=$colL?>";
var colL="<?=$colL?>";
var colB="<?=$colB?>";
var colBT="<?=$colBT?>";
var width="<?=$width?>";
var set="<?=$set?>";


function aa<?=$ales?>(){
$.ajax({
    type: "POST",
    url: "https://www.uag.mx/api/formas/formaApi_v2",
    data: "idRegistro="+f+"&campus="+campus+"&nivel="+nivel+"&programa="+programa+"&bgCI="+bgCI+"&colI="+colI+"&vengode="+v+"&origen="+o+"&colL="+colL+"&colB="+colB+"&colBT="+colBT+"&width="+width+"&set="+set,
    success: 
		function(msg){
		console.log('ok <?=$ales?>')
					$('#'+t<?=$ales?>).html(msg).addClass('div100');
		},
		error: function (request, status, error) {
        console.log(request.responseText);
    }
    });

	}
 
 
 console.log('<?=$origin_url?>')
console.log('v2');
console.log( '<?=$idRegistro?> ' )
console.log( '#<?=$t?> ' )

 
 
  timeW=<?=$wait?>;
 setTimeout(
  function() 
  {
  aa<?=$ales?>();
  }, timeW);
 