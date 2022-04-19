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
           
            $secret_key = "akash4444";

            $decoded_data = JWT::decode($authorization, new Key($secret_key, "HS256"));

            if ($decoded_data->aud === "admin" || $decoded_data->aud === "principal" || $decoded_data->aud === "teacher") {

                $result = $user->admission_requests();

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    $stu_data = array(
                        "phone_no" => $row["phone_no"],
                        "student_name" => $row["name"],
                        "dob" => $row["dob"],
                        "gender" => $row["gender"],
                        "blood_group" => $row["blood_group"],
                        "nationality" => $row["nationality"],
                        "caste" => $row["caste"],
                        "religion" => $row["religion"],
                        "aadhar_no " => $row["aadhar_no"],
                        "class" => $row["class"],
                        "distance" => $row["distance"],
                        "previous_school" => $row["previous_school"],
                        "image" => $row["image"],
                        "address" => $row["address"],
                        "school_branch" => $row["s_branch"],
                        "father_name" => $row["father_name"],
                        "father_aadhar_no" => $row["father_aadhar_no"],
                        "father_education" => $row["father_edu_qualification"],
                        "father_occupation" => $row["father_occupation"],
                        "father_annual_income" => $row["father_annual_income"],
                        "mother_name" => $row["mother_name"],
                        "mother_aadhar_no" => $row["mother_aadhar_no"],
                        "mother_education" => $row["mother_edu_qualification"],
                        "mother_occupation" => $row["mother_occupation"],
                        "mother_annual_income" => $row["mother_annual_income"]
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
