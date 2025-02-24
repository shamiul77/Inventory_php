<!-- 



   

<div class="py-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Inventory Management System</h1>

                <a href="login.php" class="btn btn-primary mt-4">Login</a>
            </div>
        </div>
    </div>
</div>


   -->

<?php
    $filePath = "./include/header.php";

if (file_exists($filePath)) {
    // The file exists, so include it
    require($filePath);
    echo "File exists and is included.";
} else {
    echo "File does not exist.";
}


?>