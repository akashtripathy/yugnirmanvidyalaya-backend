<?php
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

    if (!empty($data->phone_no) && !empty($data->name) && !empty($data->role)) {
        $user->phone_no = $data->phone_no;
        $user->name = $data->name;
        $user->role = $data->role;

        // Check user already exist or not
        $result = $user->check_user();
        $row = $result->rowCount();

        if ($row > 0) {
            http_response_code(200);
            echo json_encode(array("status" => 0, "message" => "User already exist"));
        } else {
            if ($user->create()) {
                http_response_code(200);
                echo json_encode(array("status" => 1, "message" => "User successfully added"));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => 0, "message" => "Something Went Wrong"));
            }
        }
    } else {
        http_response_code(503);
        echo json_encode(array("status" => 0, "message" => "Something Went Wrong"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}
