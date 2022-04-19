<?php
ini_set("display_errors", 1);

// include vendor
require '../../vendor/autoload.php';

use \Firebase\JWT\JWT;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


// Headers
header('Access-Conrol-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow_Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow_Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Users object
$user = new Users($db);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->phone_no)) {
        $user->phone_no = $data->phone_no;

        $result = $user->login();
        $user_data = $result->fetch(PDO::FETCH_ASSOC);

        if (!empty($user_data) && $data->phone_no === $user_data['phone_no']) {
            // $name = $user_data['name'];
            // $phone_no = $user_data['name'];
            // $role = $user_data['role'];


            $iss = "localhost";
            $iat = time();
            // $nbf = $iat + 10;
            $aud = $user_data['role'];
            $user_arr_data = array(
                "id" => $user_data['id'],
                "name" => $user_data['name'],
                "phone_no" => $user_data['phone_no']
            );

            $payload_info = array(
                "iss" => $iss,
                "iat" => $iat,
                // "nbf" => $nbf,
                // "exp" => $exp,
                "aud" => $aud,
                "data" => $user_arr_data
            );

            $secret_key = "akash4444";

            $jwt = JWT::encode($payload_info, $secret_key, 'HS256');

            http_response_code(200);
            echo json_encode(array("status" => 1, "jwt" => $jwt, "message" => "login successful"));
        } else {
            http_response_code(404);
            echo json_encode(array("status" => 0, "message" => "Invalid Cradential"));
        }
    } else {
        http_response_code(404);
        echo json_encode(array("status" => 0, "message" => "Fill the data"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}
