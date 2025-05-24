<?php
session_start();
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo json_encode(["loggedin" => true, "username" => $_SESSION['username']]);
} else {
    echo json_encode(["loggedin" => false]);
}
?>