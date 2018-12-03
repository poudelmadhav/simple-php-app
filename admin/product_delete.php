<?php
    include "../config.php";
    checkLogin();

    $productId = (int) $_GET['id'];
    $result = $db->query("SELECT * FROM products WHERE id=$productId");
    $product = $result->fetch(PDO::FETCH_ASSOC);

    // Deleting image if it has image
    $imageName = $product['product_image'];
    if (file_exists("../uploads/products/$imageName")) {
        unlink("../uploads/products/$imageName");
    }

    // Delete Product
    $db->query("DELETE FROM products where id=$productId");

    header("Location: products.php?message=Product successfully deleted!");
    die;
?>
