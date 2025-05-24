<?php
session_start();
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    http_response_code(401); // Unauthorized
    echo json_encode(["message" => "Akses ditolak. Silakan login terlebih dahulu."]);
    exit();
}

include '../dbconfig.php';
$method = $_SERVER['REQUEST_METHOD'];

// (Kode switch GET, POST, PUT, DELETE dari tutorial sebelumnya dimasukkan di sini)
// Pastikan nama kolom (nama, email, jabatan) sesuai dengan tabel baru
switch ($method) {
    case 'GET':
        $sql = "SELECT ID, nama, email, jabatan FROM users";
        $stmt = sqlsrv_query($conn, $sql);
        $users = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $users[] = $row;
        }
        echo json_encode($users);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $sql = "INSERT INTO users (nama, email, jabatan) VALUES (?, ?, ?)";
        $params = array($data->nama, $data->email, $data->jabatan);
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt) {
            http_response_code(201);
            echo json_encode(["message" => "Pengguna berhasil ditambahkan."]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        $sql = "UPDATE users SET nama = ?, email = ?, jabatan = ? WHERE ID = ?";
        $params = array($data->nama, $data->email, $data->jabatan, $data->ID);
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt) {
            echo json_encode(["message" => "Data pengguna berhasil diubah."]);
        }
        break;

    case 'DELETE':
        $id = intval($_GET['id']);
        $sql = "DELETE FROM users WHERE ID = ?";
        $params = array($id);
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt) {
            echo json_encode(["message" => "Pengguna berhasil dihapus."]);
        }
        break;
}

sqlsrv_close($conn);
?>