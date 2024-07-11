<? header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Content-Type: application/json; charset=utf-8');
set_time_limit(2);

$email=$_GET['email'];


$dominiosNo=['gail.com'];


$dominio=explode('@',$email)[1];
$dominio="http://".$dominio;

$respuesta=array();
 
function is_valid_domain($url){
$error="";
    $validation = FALSE;
    /*Parse URL*/
    $urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));
    /*Check host exist else path assign to host*/
    if(!isset($urlparts['host'])){
        $urlparts['host'] = $urlparts['path'];
    }

    if($urlparts['host']!=''){
       /*Add scheme if not found*/
        if (!isset($urlparts['scheme'])){
            $urlparts['scheme'] = 'http';
        }
        /*Validation*/
        if(checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'],array('http','https')) && ip2long($urlparts['host']) === FALSE){ 
            $urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
            $url = $urlparts['scheme'].'://'.$urlparts['host']. "/";            
            
            if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($url)) {
                $validation = TRUE;
            }
        }
    }

if(!$validation){
 $error="error";
}else{
   $error="ok";
}
return $error;
}

function urlExists($url)  
{  
    if($url == NULL) return false;  
    $ch = curl_init($url);  
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);  
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    $data = curl_exec($ch);  
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
    curl_close($ch);  
    return $httpcode ;
}  


//Function Call
$respuesta['email']=$email;
$respuesta['dominio']=$dominio;
$respuesta['valido']=urlExists($dominio);
if(in_array($dominio,$dominiosNo)){
	$respuesta['valido']=0;
}


if($dominio=="http://alumnos.udg.mx"){
$respuesta['valido']=2;
}

echo json_encode($respuesta);
?>