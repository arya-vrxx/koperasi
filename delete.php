<?php

require_once "database.php";
require_once "products.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$db = new Database();
$produk = new Products($db->getConnection());
$produk->deleteProducts((int) $_GET['id']);

header("Location: index.php");
exit;