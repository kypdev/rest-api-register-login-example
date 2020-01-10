<?php

header("Access-control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Content-type: application/json; charset=utf-8");

include_once 'Database.php';
include_once 'Member.php';

$database = new Database();
$db = $database->getConnection();

$member = new Member($db);

$stmt = $member->getAllUser();

$num = $stmt->rowCount();

if ($num > 0) {
    $user_arr = array();

    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($rows);
        $user_item = array(
            "id" => $id,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "usernme" => $username,
            "password" => $passwords,
            "email" => $email,
            "contact" => $contact,
            "birth" => $birth
        );

        array_push($user_arr, $user_item);
    }
    http_response_code(200);
    //echo json_encode($user_arr);
} else if ($num == 0) {
    http_response_code(200);
    //echo json_encode(array("message" => "no data !"));
} else {
    http_response_code(200);
    //echo json_encode(array("message" => "500"));
}
print_r(json_encode($user_arr));
