
<?php
require ('../config/function.php');


    $parameterResult = checkPeramiterId('id');

    if(is_numeric($parameterResult)){

        $customerId = validate($parameterResult);
        
        $customer = getById('customers', $customerId);
                        
              if($customer['status'] == 200){

                $customerDeleteResponse = delete('customers', $customerId);
                if($customerDeleteResponse){

                    redirect('customers.php', 'Customer Deleted Successfully!');

                }else{
                    redirect('customers.php', 'Something Went Wrong!');
                }

              }else{
                redirect('customers.php',$customer['message'] );
              }

    }else{
        redirect('customers.php', 'Something Went Wrong!');
    }










?>