<? include "../AdminUAG/sesion/arriba.php"; 
$miJson=file_get_contents('https://admision.uag.mx/api/ws/programas');
file_put_contents($rutaServer.'/api/programas.json', $miJson);

//file_get_contents('https://www.uag.mx/api/traeProgramas');


$miJson=file_get_contents('https://admision.uag.mx/api/ws/programasExcel');
file_put_contents($rutaServer.'/api/programasExcel.json', $miJson);
?>