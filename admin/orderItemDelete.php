<?php
session_start();

require '../config/function.php';


$paramResult = checkPeramiterId('index');

if(is_numeric($paramResult)){

    $indexValue = validate($paramResult);

    if(isset($_SESSION['productItem']) && isset($_SESSION['productItemsId'])){

        unset($_SESSION['productItem'][$indexValue]);
        unset($_SESSION['productItemsId'][$indexValue]);

        redirect('orderCreate.php','Item Removed');

    }else{
        redirect('orderCreate.php','There is no item');

    }

}else{
    redirect('orderCreate.php','Parameter is not numeric');

}




?>