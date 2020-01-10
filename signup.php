<?php

header("Access-control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'Database.php';
include_once 'Member.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$member = new Member($db);

$member->firstname = $data->firstname;
$member->lastname = $data->lastname;
$member->username = $data->username;
$member->passwords = $data->passwords;
$member->email = $data->email;
$member->contact = $data->contact;
$member->birth = $data->birth;


//$stmt = $member->signup();

//$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($member->signup()) {
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Signup",
        "id" => $member->id,
        "username" => $member->username
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "Username or Email already exists!"
    );
}

print_r(json_encode($user_arr));
