<?php
// addProducts.php
require_once "database.php";
require_once "products.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $produk = new Products($db->getConnection());
    $produk->addProducts($_POST['nama'], $_POST['harga'], $_POST['stok']);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>🏫 Koperasi Sekolah</h1>
        <p>Tambah produk baru</p>
    </div>

    <div class="container narrow">
        <div class="card">
            <h2 class="title">Tambah Produk</h2>
            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" id="nama" name="nama" placeholder="Contoh: Buku Tulis" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" id="harga" name="harga" min="0" placeholder="3000" required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" min="0" placeholder="50" required>
                </div>
                <div class="form-actions">
                    <a class="btn btn-ghost" href="index.php">Batal</a>
                    <button class="btn" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>