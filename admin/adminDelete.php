<?php
require ('../config/function.php');


    $parameterResult = checkPeramiterId('id');

    if(is_numeric($parameterResult)){

        $adminId = validate($parameterResult);
        
        $admin = getById('admindata', $adminId);
                        
              if($admin['status'] == 200){

                $adminDelete = delete('admindata', $adminId);
                if($adminDelete){

                    redirect('admin.php', 'Admin Deleted Successfully!');

                }else{
                    redirect('admin.php', 'Something Went Wrong!');
                }

              }else{
                redirect('admin.php',$admin['message'] );
              }

    }else{
        redirect('admin.php', 'Something Went Wrong!');
    }










?>