<?php

class Products
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        return $this->pdo->query("SELECT * FROM products ORDER BY id")->fetchAll();
    }

    public function searchId($id)
    {

        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();

    }

    public function addProducts($productName, $buyPrice, $quantityInStock)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO products (productName, buyPrice, quantityInStock) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$productName, $buyPrice, $quantityInStock]);

    }

    public function changeProducts($id, $productName, $buyPrice, $quantityInStock)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE products SET productName = ?, buyPrice = ?, quantityInStock = ? WHERE id = ?"
        );
        return $stmt->execute([$productName, $buyPrice, $quantityInStock, $id]);
    }

    public function deleteProducts($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }










}