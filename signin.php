<?php

header("Access-control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'Database.php';
include_once 'Member.php';


$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$member = new Member($db);

$member->username = $data->username;
$member->passwords = $data->passwords;

$stmt = $member->signin();

$num = $stmt->rowCount();

$row = $stmt->fetch(PDO::FETCH_ASSOC);


if($num >0){
    http_response_code(200);
    $user_arr=array(
        "status" => true,
        "message" => "Successfully signin!",
        "id" => $row['id'],
        "username" => $row['username']
    );
}else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username of Password !",
       
    );  
}

print_r(json_encode($user_arr));