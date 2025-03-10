<?php

require '../config/function.php';


$paramResult = checkParamId('index');

if(is_numeric($paramResult)){

    $indexValue = validate($paramResult);

}else{
    redirect('orderCreate.php','Parameter is not numeric');

}




?>