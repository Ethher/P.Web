<?php
require 'config.php';

// Ambil data siswa beserta pegawai pendaftar
$siswaQuery = "SELECT siswa.*, pegawai.nama AS pegawai_pendaftar 
               FROM siswa
               LEFT JOIN pegawai ON siswa.pegawai_id = pegawai.id";
$siswaResult = $conn->query($siswaQuery);

// Ambil data pegawai
$pegawaiQuery = "SELECT * FROM pegawai";
$pegawaiResult = $conn->query($pegawaiQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa dan Pegawai</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        .btn-tambah {
            background-color: #007bff; color: white; text-decoration: none;
            padding: 8px 12px; border-radius: 5px; margin-bottom: 20px; display: inline-block;
        }
        .btn-edit { background-color: #ffc107; color: black; text-decoration: none; padding: 5px 10px; border-radius: 5px; }
        .btn-hapus { background-color: #dc3545; color: white; text-decoration: none; padding: 5px 10px; border-radius: 5px; }
        a:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <h1>Data Siswa</h1>
    <a href="tambah.php" class="btn-tambah">Tambah Siswa</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Pegawai Pendaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($siswaResult->num_rows > 0): ?>
                <?php $no = 1; while ($row = $siswaResult->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['tanggal_lahir'] ?></td>
                        <td><?= $row['pegawai_pendaftar'] ?? 'Belum Terdaftar' ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data siswa.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h1>Data Pegawai</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($pegawaiResult->num_rows > 0): ?>
                <?php $no = 1; while ($row = $pegawaiResult->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['jabatan'] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data pegawai.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
