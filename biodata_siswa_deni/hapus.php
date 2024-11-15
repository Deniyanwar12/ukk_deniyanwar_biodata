<?php
include 'koneksi.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];

    // Hapus foto dari folder uploads
    $query = "SELECT foto FROM siswa WHERE nis = $nis";
    $result = mysqli_query($conn, $query);
    $siswa = mysqli_fetch_assoc($result);
    $foto = $siswa['foto'];
    unlink("uploads/" . $foto);

    // Hapus data dari database
    $sql = "DELETE FROM siswa WHERE nis = $nis";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>