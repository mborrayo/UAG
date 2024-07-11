<? header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json; charset=utf-8');
include_once "../../AdminUAG/sesion/arriba.php";
$json = file_get_contents('php://input');
http_response_code(200);
$data = array("a" => "Apple", "b" => "Ball", "c" => "Cat");
header("Content-Type: application/json");
echo json_encode($data);

?>