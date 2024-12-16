<?php
require 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM siswa WHERE id = $id";

if ($conn->query($query)) {
    header("Location: index.php");
} else {
    echo "Gagal menghapus data: " . $conn->error;
}
?>