<?php

require 'config/function.php';


if(isset($_POST['loginBtn'])){

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if($email != '' && $password != ''){
        $query = "SELECT * FROM admindata WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if($result){
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $hasedPassword = $row['password'];

                if(!password_verify($password, $hasedPassword)){
                    redirect('login.php', 'Invalid Password');
                }
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'userId' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone']
                ];
                        redirect('admin/index.php', 'Logged In Successfully');


            }else{
                redirect('login.php', 'Invalid Email');

            }
        }else{
             redirect('login.php', 'Something Went Wrong!');

        }
    }else{
        redirect('login.php', 'Please fill all the field!');
    }
}





?>