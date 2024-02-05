<?php
include "../connection.php";

$name = $_POST["name"];
$email = $_POST["email"];
$password = md5($_POST["password"]);
$created_at = isset($_POST["created_at"]) ? $_POST["created_at"] : null;
$updated_at = isset($_POST["updated_at"]) ? $_POST["updated_at"] : null;
// $created_at = $_POST["created_at"];
// $updated_at = $_POST["updated_at"];

$sql_check = "SELECT * FROM users WHERE email = '$email' ";

$result_check = $connect->query($sql_check);

if ($result_check->num_rows > 0) {
    echo json_encode(
        array("success" => false, "message" => " $email",)
    );
} else {
    $sqlResult = "INSERT INTO users SET name = '$name', 
                    email = '$email', password = '$password', 
                    created_at = '$created_at', 
                    updated_at = '$updated_at'";

    $result = $connect->query($sqlResult);
    if ($result) {
        echo json_encode(
            array(
                "success" => true,
            )
        );
    } else {
        echo json_encode(
            array(
                "success" => false,
                "message" => "Gagal menyimpan data",
            )
        );
    }
}
