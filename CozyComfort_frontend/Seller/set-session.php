<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);

$_SESSION["user_id"] = $data["id"];
$_SESSION["fullname"] = $data["fullName"];
$_SESSION["email"] = $data["email"];
$_SESSION["role"] = $data["role"];
$_SESSION["image"] = $data["base64Image"];

echo json_encode(["status" => "session set"]);
?>
