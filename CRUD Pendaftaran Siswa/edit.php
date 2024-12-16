<?php
require 'config.php';

$id = $_GET['id'];
$siswa = $conn->query("SELECT * FROM siswa WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $pegawai_id = $_POST['pegawai_id'];

    // Proses upload file
    $foto = $siswa['foto'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Hapus foto lama jika ada
        if ($foto) {
            unlink('uploads/' . $foto);
        }
        $foto = time() . '_' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $foto);
    }

    $query = "UPDATE siswa SET 
              nama = '$nama', email = '$email', alamat = '$alamat', 
              tanggal_lahir = '$tanggal_lahir', pegawai_id = $pegawai_id, foto = '$foto'
              WHERE id = $id";
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
    <form method="POST" enctype="multipart/form-data">
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= $siswa['nama'] ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $siswa['email'] ?>" required>

        <label>Alamat:</label>
        <textarea name="alamat" required><?= $siswa['alamat'] ?></textarea>

        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="<?= $siswa['tanggal_lahir'] ?>" required>

        <label>Pegawai Pendaftar:</label>
        <select name="pegawai_id" required>
            <option value="">Pilih Pegawai</option>
            <?php
            $pegawaiResult = $conn->query("SELECT * FROM pegawai");
            while ($pegawai = $pegawaiResult->fetch_assoc()): ?>
                <option value="<?= $pegawai['id'] ?>" <?= $pegawai['id'] == $siswa['pegawai_id'] ? 'selected' : '' ?>>
                    <?= $pegawai['nama'] ?> (<?= $pegawai['jabatan'] ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <label>Foto:</label>
        <input type="file" name="foto" accept="image/*">
        <?php if ($siswa['foto']): ?>
            <p><img src="uploads/<?= $siswa['foto'] ?>" width="100" alt="Foto Siswa"></p>
        <?php endif; ?>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
