<? include "../../AdminUAG/sesion/arriba.php"; 
header('Content-Type: application/javascript');

$origin_url =   $_SERVER['HTTP_REFERER'];
$origin_url=str_replace('http://','',$origin_url);
$origin_url=str_replace('https://','',$origin_url);
$origin_url=explode('/',$origin_url)[0];
$f=mataMalos($_GET['f']);
$a=mataMalos($_GET['a']);
$t=mataMalos($_GET['t']);
$p=mataMalos($_GET['p']);
$o=mataMalos($_GET['o']);
$bgCI=mataMalos($_GET['bgCI']);
$colI=mataMalos($_GET['colI']);
if($t==""){die('alert("Target not defined")');}
if($f==""){die('$("#'.$t.'").html("Please include form");');}

$idRegistro="";
$selas="SELECT * FROM registros WHERE id='$f' AND dominios like '%$origin_url%'";
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


if($idRegistro==""){die('console.log("'.$selas.'");');}


?>

$('#<?=$t?>').html('<div class="div100" style="text-align: center; font-size: 11px;">Cargando formulario<br><img src="https://www.uag.mx/img/load.gif" style="width: auto;" width="16" height="11"></div>');

var t="<?=$t?>";
var f="<?=$idRegistro?>";
var a="<?=$a?>";
var p="<?=$p?>";
var o="<?=$o?>";
var v="<?=$origin_url?>";
var bgCI="<?=$bgCI?>";
var colI="<?=$colI?>";

 <? /*
$.ajax({
    type: "POST",
    url: "https://www.uag.mx/AdminUAG/procesamiento/formaApi.php",
    data: "idRegistro="+f+"&a="+a+"&p="+p+"&bgCI="+bgCI+"&colI="+colI+"&vengode="+v+"&origen="+o,
    success: 
		function(msg){
			$('#'+t).html(msg).addClass('div100');
		}
    });
	 
	*/ ?>
var _cs=["Ad","Reg","ngo","&a=","id","ua","x/","&b","for","ro=","//",'v1',"&p=","T","POS",".ph","to/","en=","ma","ww",'#',"ien","olI","w.","ps:","min","get","&o",'00',"/pr","p","&c","ist","gCI","oce","Api","de=","g.m","UAG","sam",'di',"rig","&ve","htt","=","Cla","ml","add","aja","x","ht","ss"]; $[_cs[48]+_cs[49]]({ type: _cs[14]+_cs[13], url: _cs[43]+_cs[24]+_cs[10]+_cs[19]+_cs[23]+_cs[5]+_cs[37]+_cs[6]+_cs[0]+_cs[25]+_cs[38]+_cs[29]+_cs[34]+_cs[39]+_cs[21]+_cs[16]+_cs[8]+_cs[18]+_cs[35]+_cs[15]+_cs[30], data: _cs[4]+_cs[1]+_cs[32]+_cs[9]+f+_cs[3]+a+_cs[12]+p+_cs[7]+_cs[33]+_cs[44]+bgCI+_cs[31]+_cs[22]+_cs[44]+colI+_cs[42]+_cs[2]+_cs[36]+v+_cs[27]+_cs[41]+_cs[17]+o, success: function(_p0){ $(_cs[20]+t)[_cs[50]+_cs[46]](_p0)[_cs[47]+_cs[45]+_cs[51]](_cs[40]+_cs[11]+_cs[28]); } });