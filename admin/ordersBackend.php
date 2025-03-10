<?php
session_start();
include('../config/function.php');

if(!isset($_SESSION['productItem'])){
    $_SESSION['productItem'] = [];

}
if(!isset($_SESSION['productItemsId'])){
    $_SESSION['productItemsId'] = [];

}


if (isset($_POST['addItem'])) {

        $productId = validate($_POST['product_id']);
        $quantity = validate($_POST['quantity']);

        $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");

        if($checkProduct){

            if ( mysqli_num_rows($checkProduct) > 0) {

            $row = mysqli_fetch_assoc($checkProduct);

            if ($row['quantity'] < $quantity) {
            redirect('orderCreate.php', 'Only ' . $row['quantity'] . ' Quantity Available!');
            }

            $productData = [
            'product_id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'quantity' => $quantity,
        ];

        if(!in_array($row['id'], $_SESSION['productItemsId'])){

            array_push($_SESSION['productItemsId'],$row['id']);
            array_push($_SESSION['productItem'],$productData);

        }else{
            foreach ($_SESSION['productItem'] as $key => $prodSessionItem) {
            if ($prodSessionItem['product_id'] == $row['id']) {
                $newQuantity = $prodSessionItem['quantity'] + $quantity;

            $productData = [
                'product_id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'quantity' => $newQuantity,
            ];
            $_SESSION['productItem'][$key] = $productData;
            }
        }
    }
    redirect('orderCreate.php', 'Item Added '.$row['name']);



            }else{
                redirect('orderCreate.php', 'No Product Found!');
            }


        }else{
            redirect('orderCreate.php', 'Something Went Wrong');
        }

    }
 




if (isset($_POST['productIncDec'])) {
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']) ;

    $flag = false;
    foreach ($_SESSION['productItem'] as $key => $item) {
        if($item['product_id'] == $productId){
            $flag = true;
            $_SESSION['productItem'][$key]['quantity'] = $quantity;
        }
    }

    if($flag){
        jsonResponse(200,'success', 'Quantity Updated' );
    }else{
        jsonResponse(500,'error', 'Something Went Wrong!' );

    }
}



?>
