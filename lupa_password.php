<?php
require 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pertanyaan = mysqli_real_escape_string($koneksi, $_POST['pertanyaan']);
    $jawaban = mysqli_real_escape_string($koneksi, $_POST['jawaban']);

    $query = "SELECT * FROM user WHERE username = ? AND pertanyaan = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $pertanyaan);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user['jawaban'] === $jawaban) {
            header("Location: ganti_password.php?username=$username");
            exit();
        } else {
            $error = "Jawaban pertanyaan salah.";
        }
    } else {
        $error = "User tidak ditemukan atau pertanyaan keamanan tidak cocok.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="row justify-content-center pt-4">
        <div class="col-md-4">
            <div class="card text-white" id="card1">
                <div class="card-header text-center" id="card2">
                    <h5 class="text-light">Lupa Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?= $error; ?></div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="username">Username :</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="pertanyaan">Pertanyaan :</label>
                                <select name="pertanyaan" id="pertanyaan" class="form-control" required>
                                    <option>Pilih Pertanyaan</option>
                                    <option value="Apa warna favoritmu?">Apa warna favoritmu?</option>
                                    <option value="Apa makanan kesukaanmu?">Apa makanan kesukaanmu?</option>
                                    <option value="Apa minuman kesukaanmu?">Apa minuman favoritmu?</option>
                                    <option value="Apa film favoritmu?">Apa film favoritmu?</option>
                                    <option value="Siapa nama hewan peliharaanmu??">Siapa nama hewan peliharaanmu?</option>
                                </select>
                            </div>
                            <div class="mb-3">
                            <label for="jawaban">Jawaban :</label>
                            <input type="text" name="jawaban" id="jawaban" class="form-control" placeholder="Jawaban" required>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                            <button type="submit" name="submit" class="btn btn-primary" id="btn">Submit</button>
                            </div>
                        </form>  
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="login.php" id="klikdisini">Kembali ke login.</a>
        </div>
</body>
</html>