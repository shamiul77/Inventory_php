<?php
session_start();
include('../config/function.php');
include('../config/db.php'); // Ensure database connection is available

if (!isset($_SESSION['productItem'])) {
    $_SESSION['productItem'] = [];
}

if (isset($_POST['addItem'])) {
    $productId = validate($_POST['productId']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
    if ($checkProduct && mysqli_num_rows($checkProduct) > 0) {
        $row = mysqli_fetch_assoc($checkProduct);

        if ($row['quantity'] < $quantity) {
            redirect('orderCreate.php', 'Only ' . $row['quantity'] . ' Quantity Available!');
        }

        $productData = [
            'productId' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'quantity' => $quantity
        ];

        // Check if the product already exists in session
        $found = false;
        foreach ($_SESSION['productItem'] as $key => $productSessionItem) {
            if ($productSessionItem['productId'] == $row['id']) {
                $_SESSION['productItem'][$key]['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // If not found, add new product
        if (!$found) {
            $_SESSION['productItem'][] = $productData;
        }

        redirect('orderCreate.php', 'Item Added: ' . $row['name']);
    } else {
        redirect('orderCreate.php', 'No Product Found!');
    }
}
?>
