<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../includes/config.php");
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk=$id");
            echo json_encode(mysqli_fetch_assoc($query));
        } else {
            $query = mysqli_query($conn, "SELECT * FROM produk");
            $data = [];
            while($row = mysqli_fetch_assoc($query)) $data[] = $row;
            echo json_encode($data);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $nama = $data->nama_produk;
        $harga = $data->harga;
        $stok = $data->stok;
        $kategori = $data->kategori;

        $insert = mysqli_query($conn, "INSERT INTO produk (nama_produk, harga, stok, kategori) VALUES ('$nama','$harga','$stok','$kategori')");
        echo json_encode(["success" => $insert]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id_produk;
        $nama = $data->nama_produk;
        $harga = $data->harga;
        $stok = $data->stok;
        $kategori = $data->kategori;

        $update = mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok', kategori='$kategori' WHERE id_produk=$id");
        echo json_encode(["success" => $update]);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id_produk;

        $delete = mysqli_query($conn, "DELETE FROM produk WHERE id_produk=$id");
        echo json_encode(["success" => $delete]);
        break;

    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>

