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

    if (!empty($authorization) && !empty($data->phone_no) && !empty($data->name)) {

        try {
            $secret_key = "akash4444";

            $decoded_data = JWT::decode($authorization, new Key($secret_key, "HS256"));

            if ($decoded_data->aud === "admin" || $decoded_data->aud === "principal") {
                $user->phone_no = $data->phone_no;
                $user->name = $data->name;
                $user->role = "student";
                $user->dob = DateTime::createFromFormat('m-d-Y', $data->dob)->format('Y-m-d');
                $user->gender = $data->gender;
                $user->blood_group = $data->blood_group;
                $user->nationality = $data->nationality;
                $user->caste = $data->caste;
                $user->relogion = $data->religion;
                $user->aadhar_no = $data->aadhar_no;
                $user->class = $data->class;
                $user->distance = $data->distance;
                $user->previous_school = $data->previous_school;
                $user->image = $data->image;
                $user->address = $data->address;
                $user->s_branch = $data->school_branch;
                $user->father_name = $data->father_name;
                $user->father_aadhar_no = $data->father_aadhar_no;
                $user->father_edu = $data->father_education;
                $user->father_occupation = $data->father_occupation;
                $user->father_annual_income = $data->father_annual_income;
                $user->mother_name = $data->mother_name;
                $user->mother_aadhar_no = $data->mother_aadhar_no;
                $user->mother_edu = $data->mother_education;
                $user->mother_occupation = $data->mother_occupation;
                $user->mother_annual_income = $data->mother_annual_income;


                $result = $user->check_user();
                $user_data = $result->fetch(PDO::FETCH_ASSOC);

                $result2 = $user->check_student();
                $user_data2 = $result->fetch(PDO::FETCH_ASSOC);

                $result3 = $user->check_student_fam_info();
                $user_data3 = $result->fetch(PDO::FETCH_ASSOC);


                if (empty($user_data)) {
                    if ($user->create() && $user->create_details() && $user->create_family_info()) {
                        http_response_code(200);
                        echo json_encode(array("status" => 1, "message" => "User Details added successfully"));
                    } else {
                        http_response_code(500);
                        echo json_encode(array("status" => 0, "message" => "Fail to added!"));
                    }
                } else if (!empty($user_data) && empty($user_data2) && empty($user_data3)) {
                    if ($user->create_details() && $user->create_family_info()) {
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
