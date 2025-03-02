<?php

include('../config/function.php');

if(isset($_POST['save'])){
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);

    if($name !='' && $email !='' && $password !=''){
        
        $emailCheckQuery = "SELECT * FROM adminData WHERE email='$email'"; 
        $emailCheck = mysqli_query($conn, $emailCheckQuery); 
        
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0 ){ 
                redirect('adminCreate.php', 'This email already used.');
            }
        } else {
            redirect('adminCreate.php', 'Database query failed.');
        }

        $passwordCheck = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name'=> $name,
            'email'=> $email,
            'password'=> $passwordCheck,
            'phone'=> $phone
        ];
        $result = insert('adminData', $data);

        if($result){
            redirect('admin.php', 'Admin Created Successfully!');
        }else{
            redirect('adminCreate.php', 'Something went wrong!');
        }
         
    }else{
        redirect('adminCreate.php', 'Please fill the required fields.');
    }

}

if(isset($_POST['updateSave'])){
    $adminId = validate($_POST['adminId']); 

    $adminData = getById('admindata', $adminId);
                        
    if($adminData['status'] !== 200){
        redirect('adminEdit.php?id='.$adminId, 'Please fill the required fields.');
    }

    $name = validate($_POST['name']); 
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);

    $emailCheckQuery = "SELECT * FROM adminData WHERE email='$email' AND id != '$adminId'"; 
    $emailCheck = mysqli_query($conn, $emailCheckQuery); 
    
    if($emailCheck){
        if(mysqli_num_rows($emailCheck) > 0 ){ 
            redirect('adminEdit.php?id='.$adminId, 'This email already used.');
        }
    } else {
        redirect('adminEdit.php?id='.$adminId, 'Database query failed.');
    }

    if($password != ''){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $hashedPassword = $adminData['data']['password'];
    }

    if($name !='' && $email !='' ){
        $data = [
            'name'=> $name,
            'email'=> $email,
            'password'=> $hashedPassword,
            'phone'=> $phone
        ];
        $result = update('adminData', $adminId, $data);

        if($result){
            redirect('admin.php', 'Admin Updated Successfully!');
        }else{
            redirect('admin.php', 'Something went wrong!');
        }    

    }else{
        redirect('adminCreate.php', 'Please fill the required fields.');
    }
}

if(isset($_POST['saveCategory'])){
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1:0;

    $data = [
            'name'=> $name,
            'description'=> $description,
            'status'=> $status
   
        ];
        $result = insert('categories', $data);

        if($result){
            redirect('categories.php', 'Category Created Successfully!');
        }else{
            redirect('categoryCreate.php', 'Something went wrong!');
        }
}

if(isset($_POST['updateCategory'])){  

    $idCategory = validate($_POST['idCategory']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) ? 1 : 0; 

    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status
    ];
    
    $result = update('categories', $idCategory, $data);

    if($result){
    redirect('categories.php', 'Category Updated Successfully!');
        }else{
            redirect('categories.php', 'Something went wrong!');
        }
}

if(isset($_POST['saveProduct'])){
    $categoryId = validate($_POST['categoryId']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1:0;

    $data = [
            'category_id'=> $categoryId,
            'name'=> $name,
            'description'=> $description,
            'price'=> $price,
            'quantity'=> $quantity,
            'status'=> $status

   
        ];
        $result = insert('products', $data);

        if($result){
            redirect('products.php', 'Product Created Successfully!');
        }else{
            redirect('productsCreate.php', 'Something went wrong!');
        }
}


if(isset($_POST['updateProduct'])){  

    $productId = validate($_POST['productId']);
    $productData = getById('products', $productId);
    if(!$productData){
        redirect ('products.php', 'No product found!');

    }

    $categoryId = validate($_POST['categoryId']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1:0;

    $data = [
            'category_id'=> $categoryId,
            'name'=> $name,
            'description'=> $description,
            'price'=> $price,
            'quantity'=> $quantity,
            'status'=> $status

   
        ];
        $result = update('products',$productId, $data);

        if($result){
            redirect('productEdit.php?id='.$productId, 'Product Updated Successfully!');
        }else{
            redirect('productEdit.php?id='.$productId, 'Something went wrong!');
        }
}




?>
