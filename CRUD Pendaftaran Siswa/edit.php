<?php
require 'config.php';

$id = $_GET['id'];
$query = "SELECT * FROM siswa WHERE id = $id";
$result = $conn->query($query);
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $query = "UPDATE siswa SET nama = '$nama', email = '$email', alamat = '$alamat', tanggal_lahir = '$tanggal_lahir' WHERE id = $id";
    if ($conn->query($query)) {
        header("Location: index.php");
    } else {
        echo "Gagal mengupdate data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
</head>
<body>
    <h1>Edit Siswa</h1>
    <form method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $data['email'] ?>" required><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required><?= $data['alamat'] ?></textarea><br><br>

        <label>Tanggal Lahir:</label><br>
        <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>