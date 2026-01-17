<?php
session_start();
require_once "includes/config.php"; 


if(isset($_SESSION['admin_logged_in'])){
    header("Location: index.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $pesan = "";

    $sql = "SELECT id_admin, username, password, nama_lengkap FROM admin WHERE username = ?";
    if($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    

        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password']) || $row['password'] === md5($password)) {

                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $row['id_admin'];
                $_SESSION['admin_username'] = $row['username'];
                $_SESSION['admin_nama_lengkap'] = $row['nama_lengkap'];
                $_SESSION['admin'] = $row['username']; 

                header("Location: index.php");
                exit;
            } else {
                $pesan = "❌ Password salah!";
            }
        } else {
            $pesan = "❌ Username tidak ditemukan!";
        }
    } else {
        $pesan = "Terjadi kesalahan pada server.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Login Aplikasi Kasir Mini" />
        <meta name="author" content="KasirMini Team" />
        <title>Login - Kasir Mini</title>
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header bg-dark text-white text-center">
                                        <h3 class="font-weight-light my-4">Login Admin Kasir Mini</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php if(!empty($pesan)) : ?>
                                            <div class="alert alert-danger text-center" role="alert">
                                                <?= $pesan ?>
                                            </div>
                                        <?php endif; ?>

                                        <form action="login.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="Masukkan Username" required />
                                                <label for="username">Username</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan Password" required />
                                                <label for="password">Password</label>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small text-muted">© Kasir Mini <?= date('Y') ?></a>
                                                <button class="btn btn-primary" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>

