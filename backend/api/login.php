<?php
session_start();

header("Content-Type: application/json");

$raw_body = file_get_contents("php://input");

// Hilangkan backslash yang mungkin ditambahkan otomatis oleh server
$stripped_body = stripslashes($raw_body);

// Sekarang, decode body yang SUDAH BERSIH
$data = json_decode($stripped_body);
// ******************************************************


// Pengecekan jika decode masih gagal (untuk jaga-jaga)
if ($data === null) {
    http_response_code(500);
    die(json_encode([
        "success" => false, 
        "message" => "Gagal memproses data. Error: " . json_last_error_msg() . ". Raw body: " . $raw_body
    ]));
}

// Kode Anda selanjutnya sekarang akan berjalan dengan benar
$username = $data->username;
$password = $data->password;

include '../dbconfig.php';

$sql = "SELECT id, username, password_hash FROM admins WHERE username = ?";
$params = array($username);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    http_response_code(500);
    // Tambahkan detail error SQL untuk debugging
    echo json_encode(["success" => false, "message" => "Server error pada query SQL.", "details" => sqlsrv_errors()]);
    exit();
}

$admin = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if ($admin && $password === $admin['password_hash']) {
    // Password benar, buat sesi
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $admin['id'];
    $_SESSION['username'] = $admin['username'];
    
    echo json_encode(["success" => true, "message" => "Login berhasil"]);
} else {
    // Password atau username salah
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "Username atau password salah"]);
}
?>