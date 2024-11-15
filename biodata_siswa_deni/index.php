<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Biodata Siswa</title>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Daftar Biodata Siswa</h1>
    
    <!-- Form pencarian -->
    <form method="GET" action="index.php" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Siswa...">
            <button class="btn btn-primary">Cari</button>
        </div>
    </form>
    
    <!-- Tombol tambah -->
    <a href="tambah.php" class="btn btn-success mb-3">Tambah Siswa</a>
    
    <!-- Tabel data siswa -->
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $query = "SELECT * FROM siswa WHERE nama LIKE '%$search%'";
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
                echo "<td>
                        <a href='edit.php?nis={$row['nis']}' class='btn btn-warning'>Edit</a>
                        <a href='hapus.php?nis={$row['nis']}' class='btn btn-danger'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    
    <!-- Tombol laporan -->
    <a href="report.php" class="btn btn-info">Laporan Siswa</a>
</div>
</body>
</html>