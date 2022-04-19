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

    // Get Header Data
    $all_headers_data = getallheaders();
    $authorization = $all_headers_data['Authorization'];

    if (!empty($authorization) && !empty($data->phone_no) && !empty($data->teacher_name)) {

        try {
            $secret_key = "akash4444";

            $decoded_data = JWT::decode($authorization, new Key($secret_key, "HS256"));

            if ($decoded_data->aud === "admin" || $decoded_data->aud === "principal") {
                $user->phone_no = $data->phone_no;
                $user->teacher_name = $data->teacher_name;
                $user->teacher_dob =  DateTime::createFromFormat('m-d-Y', $data->dob)->format('Y-m-d');
                $user->teacher_gender = $data->gender;
                $user->subjects_offered = $data->subjects_offered;
                $user->qualifications = $data->qualifications;
                $user->image = $data->image;
                $user->name = $data->teacher_name;
                $user->role = "teacher";

                $result = $user->check_teacher_info();
                $user_data = $result->fetch(PDO::FETCH_ASSOC);

                if (empty($user_data)) {
                    if ($user->create() && $user->add_teacher_info()) {
                        http_response_code(200);
                        echo json_encode(array("status" => 1, "message" => "User Details added successfully"));
                    } else {
                        http_response_code(500);
                        echo json_encode(array("status" => 0, "message" => "Fail to added!"));
                    }
                } else {
                    http_response_code(500);
                    echo json_encode(array("status" => 0, "message" => "Already exist!"));
                }
            } else {
                http_response_code(404);
                echo json_encode(array("status" => 0, "message" => "Access denied"));
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
