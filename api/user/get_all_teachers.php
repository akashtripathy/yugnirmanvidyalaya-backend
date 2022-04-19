<?php
ini_set("display_errors", 1);
// include vendor
require '../../vendor/autoload.php';

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Headers
header('Access-Conrol-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow_Methods: GET');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow_Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Users object
$user = new Users($db);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    // Get Header Data
    $all_headers_data = getallheaders();
    $authorization = $all_headers_data['Authorization'];

    if (!empty($authorization)) {

        try {
            $teac_arr = array();

            $secret_key = "akash4444";

            $decoded_data = JWT::decode($authorization, new Key($secret_key, "HS256"));

            if ($decoded_data->aud === "admin" || $decoded_data->aud === "principal") {
                // $user->phone_no = $decoded_data->data->phone_no;
                $result = $user->get_all_teachers();

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $teac_data = array(
                        "phone_no" => $row["phone_no"],
                        "teacher_name" => $row["teacher_name"],
                        "dob" => $row["dob"],
                        "gender" => $row["gender"],
                        "subjects_offered" => $row["subjects_offered"],
                        "qualifications" => $row["qualifications"],
                        "image" => $row["image"],
                        "role" => $row["role"],
                        "account" => $row["account"],
                    );

                    // Push to "data"
                    array_push($teac_arr, $teac_data);
                }
                http_response_code(200);
                echo json_encode(array("status" => 1, "data" => $teac_arr));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => 0, "data" => $teac_arr));
            }
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
