<?php
require ('../config/function.php');


    $parameterResult = checkPeramiterId('id');

    if(is_numeric($parameterResult)){

        $productId = validate($parameterResult);
        
        $product = getById('products', $productId);
                        
              if($product['status'] == 200){

                $productDeleteResponse = delete('products', $productId);
                if($productDeleteResponse){

                    redirect('products.php', 'Product Deleted Successfully!');

                }else{
                    redirect('products.php', 'Something Went Wrong!');
                }

              }else{
                redirect('products.php',$product['message'] );
              }

    }else{
        redirect('products.php', 'Something Went Wrong!');
    }










?>