<?php
include 'koneksi.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $query = "SELECT * FROM siswa WHERE nis = $nis";
    $result = mysqli_query($conn, $query);
    $siswa = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_tanggal_lahir = $_POST['tempat_tanggal_lahir'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];

    // Cek apakah foto diubah
    if ($_FILES['foto']['name']) {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "uploads/" . $foto);
    } else {
        $foto = $siswa['foto']; // Gunakan foto lama jika tidak ada upload baru
    }

    $sql = "UPDATE siswa SET 
            nama='$nama', 
            jenis_kelamin='$jenis_kelamin', 
            tempat_tanggal_lahir='$tempat_tanggal_lahir',
            kelas='$kelas',
            jurusan='$jurusan',
            foto='$foto'
            WHERE nis='$nis'";
            
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Edit Siswa</title>
</head>
<body>
<div class="container mt-4">
    <h1>Edit Data Siswa</h1>
    <form action="edit.php?nis=<?php echo $siswa['nis']; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="nis" value="<?php echo $siswa['nis']; ?>">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $siswa['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="Laki-Laki" <?php if($siswa['jenis_kelamin'] == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
                <option value="Perempuan" <?php if($siswa['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Tempat, Tanggal Lahir</label>
            <input type="text" name="tempat_tanggal_lahir" class="form-control" value="<?php echo $siswa['tempat_tanggal_lahir']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" value="<?php echo $siswa['kelas']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="<?php echo $siswa['jurusan']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
            <img src="uploads/<?php echo $siswa['foto']; ?>" width="100" class="mt-3">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>