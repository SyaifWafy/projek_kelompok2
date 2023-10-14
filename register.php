<?php

require 'koneksi.php';

if(isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $name = mysqli_real_escape_string($koneksi, $_POST['fullname']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
    $pass2 = mysqli_real_escape_string($koneksi, $_POST['password2']);
    $question = mysqli_real_escape_string($koneksi, $_POST['pertanyaan']);
    $answer = mysqli_real_escape_string($koneksi, $_POST['jawaban']);
    if ($pass === $pass2) {
        $query = "INSERT INTO user (`username`, `fullname`, `password`, `pertanyaan`, `jawaban`)
            VALUES ('$username', '$name', '$pass', '$question', '$answer')";
        $result = mysqli_query($koneksi, $query);
        if ($result) {
            header('Location: login.php');
        } else {
            $error = "Gagal menambahkan pengguna. Silakan coba lagi.";
        }
    } else {
        $error = "Password tidak cocok. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="row justify-content-center pt-4">
        <div class="col-md-4">
            <div class="card text-white" id="card1">
                <div class="card-header text-center" id="card2">
                    <h5 class="text-light">Register</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullname">Nama Lengkap</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password2">Konfirmasi Password</label>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="pertanyaan">Pertanyaan :</label>
                            <br>
                            <select name="pertanyaan" id="pertanyaan" class="form-control">
                                <option>Pilih Pertanyaan</option>
                                <option value="Apa warna favoritmu?">Apa warna favoritmu?</option>
                                <option value="Apa makanan kesukaanmu?">Apa makanan kesukaanmu?</option>
                                <option value="Apa minuman kesukaanmu?">Apa minuman favoritmu?</option>
                                <option value="Apa film favoritmu?">Apa film favoritmu?</option>
                                <option value="Siapa nama hewan peliharaanmu??">Siapa nama hewan peliharaanmu?</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jawaban">Jawaban</label>
                            <input type="text" name="jawaban" id="jawaban" class="form-control" placeholder="Jawaban" required>
                        </div>
                            <br>
                        <div class="text-center">
                            <button type="submit" name="register" class="btn btn-primary" id="btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <p id="text">Sudah punya akun? <a href="login.php" id="klikdisini">Login disini.</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>