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

?>
