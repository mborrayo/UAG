<? include "../AdminUAG/sesion/arriba.php"; 

$losPaises=array();
$est=file_get_contents('https://gitlab.com/-/snippets/2537337/raw/main/countries_phone_number_length.json');
$est=json_decode($est,true);

foreach($est as $pa=>$pas){
$pais=$pas['code'];
$phoneLength=$pas['phoneLength'];

//echo $pais." ".$phoneLength."<br>"; 

$losPaises[$pais]['min']=$phoneLength;
$losPaises[$pais]['max']=$phoneLength;

if(is_array($phoneLength)){

$losPaises[$pais]['min']=min($phoneLength);
$losPaises[$pais]['max']=max($phoneLength);
}

};

echo json_encode($losPaises);

?>