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
            $role = "null";
            $user_data = array();
            $secret_key = "akash4444";

            $decoded_data = JWT::decode($authorization, new Key($secret_key, "HS256"));

            if ($decoded_data->aud === "student") {
                $user->phone_no = $decoded_data->data->phone_no;
                $result = $user->get_student();
                $u_data = $result->fetch(PDO::FETCH_ASSOC);
                $role = $decoded_data->aud;


                $user_data = array(
                    "phone_no" => $u_data["phone_no"],
                    "student_name" => $u_data["student_name"],
                    "dob" => $u_data["dob"],
                    "gender" => $u_data["gender"],
                    "blood_group" => $u_data["blood_group"],
                    "class" => $u_data["class"],
                    "image" => $u_data["image"],
                    "address" => $u_data["address"],
                    "father_name" => $u_data["father_name"],
                    "mother_name" => $u_data["mother_name"]
                );
            } else if ($decoded_data->aud === "teacher") {
                $user->phone_no = $decoded_data->data->phone_no;
                $result = $user->get_teacher();
                $u_data = $result->fetch(PDO::FETCH_ASSOC);
                $role = $decoded_data->aud;


                $user_data = array(
                    "phone_no" => $u_data["phone_no"],
                    "name" => $u_data["name"],
                    "dob" => $u_data["dob"],
                    "gender" => $u_data["gender"],
                    "subjects_offered" => $u_data["subjects_offered"],
                    "image" => $u_data["image"],
                );
            }else if ($decoded_data->aud === "principal" || $decoded_data->aud === "admin") {
                $user->phone_no = $decoded_data->data->phone_no;
                $result = $user->login();
                $u_data = $result->fetch(PDO::FETCH_ASSOC);
                $role = $decoded_data->aud;

                $user_data = array(
                    "phone_no" => $u_data["phone_no"],
                    "name" => $u_data["name"],
                    "image" => "https://yugnirmanvidyalaya.in/img/profile_avatar.png"
                );
            }

            http_response_code(200);
            echo json_encode(array("status" => 1, "role" => $role, "user_data" => $user_data));
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
