<?php
session_start();
include('../config/function.php');
include('../config/db.php'); 

// Handle Add Item to Order
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

// Handle Increment / Decrement Quantity Update via AJAX
if (isset($_POST['productIncDec'])) {
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $flag = false;
    $newTotalPrice = 0;
    
    // Loop through the session items to find the product and update the quantity
    foreach ($_SESSION['productItem'] as $key => $item) {
        if ($item['productId'] == $productId) {
            $flag = true;
            $_SESSION['productItem'][$key]['quantity'] = $quantity;
            
            // Calculate the new total price
            $newTotalPrice = $_SESSION['productItem'][$key]['price'] * $_SESSION['productItem'][$key]['quantity'];
        }
    }

    // If updated successfully, return the new total price
    if ($flag) {
        $response = [
            'status' => 200,
            'status_type' => 'success',
            'message' => 'Quantity Updated',
            'newTotalPrice' => number_format($newTotalPrice, 2)
        ];
    } else {
        $response = [
            'status' => 500,
            'status_type' => 'error',
            'message' => 'Something Went Wrong!'
        ];
    }

    // Return JSON response
    echo json_encode($response);
    exit();
}
?>
