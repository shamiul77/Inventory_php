<?php
require 'connection.php';


function validate($data){
    global $conn;
    if ($conn) {
        $validatedData = mysqli_real_escape_string($conn, $data);
        return trim($validatedData);
    } else {
        die("Database connection failed");
    }
}



// Redirect with message in page
function redirect($url, $message = '') {
    if (!empty($message)) {
        session_start();
        $_SESSION['status'] = $message; 
    }
    header("Location: $url");
    exit();
}


// Display messages 
function message(){
    if (isset($_SESSION['status'])){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             '.$_SESSION['status'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']); 
    }
}



// Insert function
function insert($tableName, $data){
    global $conn;


    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'".implode("', '",$values)."'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Update function
function update($tableName, $id, $data){
    global $conn;
     
    $table = validate($tableName);
    $id = validate($id);

    $updateData = "";

    foreach($data as $column=>$value){
        $updateData.= $column.'='."'$value',";
    }

    $finalUpdateData = substr(trim($updateData),0,-1);
    $query = "UPDATE $table SET $finalUpdateData WHERE id= '$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getALL($tableName, $status=NULL){
    global $conn;

    $table = validate($tableName);
    $status = validate($status);

    if($status == 'status'){
        $query = "SELECT *FROM $table WHERE status='0'";
    }else
    {
        $query = "SELECT * FROM $table";
    }
    return mysqli_query($conn, $query);

}

function getById($tableName, $id){
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result){

        if(mysqli_num_rows($result)==1){

            $row = mysqli_fetch_assoc($result);
            $response= [
            'status'=> 200,
            'data'=> $row,
            'message'=> 'Data found'
                        ];
                        return $response;

        }else{
             $response= [
            'status'=> 404,
            'message'=> 'No data found'
                        ];
        return $response;
        }
    }else{
        $response= [
            'status'=> 500,
            'message'=> 'Something wrong'
        ];
        return $response;
    }
}

// Delete function
function delete($tableName, $id){
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = " DELETE  FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}


function checkPeramiterId($type){

    if($_GET[$type]){
        if($_GET[$type] != ''){
           return$_GET[$type];
        }else{
            echo '<h5>No Id Found</h5>';
        }

    }else{
        echo '<h5>No Id Given</h5>';
    }
}


function logout(){
    unset ($_SESSION['loggedIn']);
    unset ($_SESSION['loggedInUser']);
}


function jsonResponse($status,$status_type, $message ){
    $response = [
            'status' => $status,
            'status_type' => $status_type,
            'message' => $message
    ];
        print_r (json_encode($response));
        return;
}



?>