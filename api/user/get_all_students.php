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
            $stu_arr = array();
            // $stu_arr['data'] = array();

            $secret_key = "akash4444";

            $decoded_data = JWT::decode($authorization, new Key($secret_key, "HS256"));

            if ($decoded_data->aud === "admin" || $decoded_data->aud === "principal" || $decoded_data->aud === "teacher") {
                // $user->phone_no = $decoded_data->data->phone_no;
                $result = $user->get_all_students();

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $stu_data = array(
                        "phone_no" => $row["phone_no"],
                        "student_name" => $row["student_name"],
                        "dob" => $row["dob"],
                        "gender" => $row["gender"],
                        "blood_group" => $row["blood_group"],
                        "class" => $row["class"],
                        "image" => $row["image"],
                        "address" => $row["address"],
                        "school_branch" => $row["s_branch"],
                        "father_name" => $row["father_name"],
                        "mother_name" => $row["mother_name"],
                        "father_occupation" => $row["father_occupation"],
                        "mother_occupation" => $row["mother_occupation"]
                    );

                    // Push to "data"
                    array_push($stu_arr, $stu_data);
                }
                http_response_code(200);
                echo json_encode(array("status" => 1, "data" => $stu_arr));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => 0, "data" => $stu_arr));
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
