<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Laporan Siswa</title>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Laporan Data Siswa</h1>

    <a href="index.php" class="btn btn-primary mb-3">Kembali</a>
    <button onclick="window.print();" class="btn btn-info mb-3">Cetak Laporan</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM siswa";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['nis']}</td>";
                echo "<td>{$row['nama']}</td>";
                echo "<td>{$row['jenis_kelamin']}</td>";
                echo "<td>{$row['tempat_tanggal_lahir']}</td>";
                echo "<td>{$row['kelas']}</td>";
                echo "<td>{$row['jurusan']}</td>";
                echo "<td><img src='uploads/{$row['foto']}' width='100'></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>