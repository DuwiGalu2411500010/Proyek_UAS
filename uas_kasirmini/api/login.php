<?php
header("Content-Type: application/json");
require_once(__DIR__ . '/../includes/config.php');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    echo json_encode([
        "success" => false,
        "message" => "Username dan password wajib diisi"
    ]);
    exit;
}

$sql = "SELECT id_admin, username, password, nama_lengkap FROM admin WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo json_encode([
        "success" => false,
        "message" => "Username tidak ditemukan"
    ]);
    exit;
}

$row = $result->fetch_assoc();

if (
    password_verify($password, $row['password']) ||
    $row['password'] === md5($password)
) {
    echo json_encode([
        "success" => true,
        "message" => "Login berhasil",
        'data' => [
            'id_admin' => (int)$row['id_admin'],
            'username' => $row['username'],
            'nama_lengkap' => $row['nama_lengkap']
        ]
    ]);
    
} else {
    echo json_encode([
        "success" => false,
        "message" => "Password salah"
    ]);
}
