<?php
ini_set("display_errors", 1);
// include vendor
require '../../vendor/autoload.php';

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Headers
header('Access-Conrol-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow_Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow_Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Users object
$user = new Users($db);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Get raw posted data
    // $data = json_decode(file_get_contents("php://input"));

    // Get Header Data
    $all_headers_data = getallheaders();
    $authorization = $all_headers_data['Authorization'];

    if (!empty($authorization)) {

        try {
            $secret_key = "akash4444";

            $decoded_data = JWT::decode($authorization, new Key($secret_key, "HS256"));

            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "We got JWT", "User_data" => $decoded_data));
        } catch (Exception $e) {
            http_response_code(503);
            echo json_encode(array("status" => 0, "message" => $e->getMessage()));
        }
    } else {
        http_response_code(404);
        echo json_encode(array("status" => 0, "message" => "Access denied"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 0, "message" => "Access denied"));
}
