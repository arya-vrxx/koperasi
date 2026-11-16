<?php
// edit.php
require_once "database.php";
require_once "products.php";

$db = new Database();
$produk = new Products($db->getConnection());

// Proses simpan perubahan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produk->changeProducts(
        (int) $_POST['id'],
        $_POST['nama'],
        $_POST['harga'],
        $_POST['stok']
    );
    header("Location: index.php");
    exit;
}

// Ambil data produk yang akan diedit
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$p = $produk->searchId((int) $_GET['id']);

if (!$p) {
    echo "Produk tidak ditemukan. <a href='index.php'>Kembali</a>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>🏫 Koperasi Sekolah</h1>
        <p>Perbarui data produk</p>
    </div>

    <div class="container narrow">
        <div class="card">
            <h2 class="title">Edit Produk</h2>
            <form method="post">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($p['productName']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" id="harga" name="harga" min="0" value="<?= $p['buyPrice'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" min="0" value="<?= $p['quantityInStock'] ?>" required>
                </div>
                <div class="form-actions">
                    <a class="btn btn-ghost" href="index.php">Batal</a>
                    <button class="btn" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>