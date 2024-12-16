<?php
require 'config.php';

// Ambil data siswa
$query = "SELECT * FROM siswa";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .btn-tambah {
            background-color: #007bff;
            color: #fff;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }

        .btn-hapus {
            background-color: #dc3545;
            color: #fff;
        }
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['tanggal_lahir'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>