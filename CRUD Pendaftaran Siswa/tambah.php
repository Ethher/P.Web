<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $pegawai_id = $_POST['pegawai_id'];

    // Proses upload file
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = time() . '_' . $_FILES['foto']['name'];
        $targetDir = 'uploads/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        move_uploaded_file($_FILES['foto']['tmp_name'], $targetDir . $foto);
    }

    // Simpan data ke database
    $query = "INSERT INTO siswa (nama, email, alamat, tanggal_lahir, pegawai_id, foto)
              VALUES ('$nama', '$email', '$alamat', '$tanggal_lahir', $pegawai_id, '$foto')";
    if ($conn->query($query)) {
        header("Location: index.php");
    } else {
        echo "Gagal menambahkan data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
</head>
<body>
    <h1>Tambah Siswa</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <label>Tanggal Lahir:</label><br>
        <input type="date" name="tanggal_lahir" required><br><br>

        <label>Pegawai Pendaftar:</label><br>
        <select name="pegawai_id" required>
            <option value="">Pilih Pegawai</option>
            <?php
            $pegawaiResult = $conn->query("SELECT * FROM pegawai");
            while ($pegawai = $pegawaiResult->fetch_assoc()): ?>
                <option value="<?= $pegawai['id'] ?>"><?= $pegawai['nama'] ?> (<?= $pegawai['jabatan'] ?>)</option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Foto:</label><br>
        <input type="file" name="foto" accept="image/*"><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
