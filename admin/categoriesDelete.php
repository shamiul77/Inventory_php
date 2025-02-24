<?php
require ('../config/function.php');


    $parameterResult = checkPeramiterId('id');

    if(is_numeric($parameterResult)){

        $categoryId = validate($parameterResult);
        
        $category = getById('categories', $categoryId);
                        
              if($category['status'] == 200){

                $categoryDeleteResponse = delete('categories', $categoryId);
                if($categoryDeleteResponse){

                    redirect('categories.php', 'Category Deleted Successfully!');

                }else{
                    redirect('categories.php', 'Something Went Wrong!');
                }

              }else{
                redirect('categories.php',$category['message'] );
              }

    }else{
        redirect('categories.php', 'Something Went Wrong!');
    }










?>