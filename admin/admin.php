<?php include('../include/header.php');?>
   

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mt-2 float-start">Admin</h4>
                        <a href="adminCreate.php" class="btn btn-primary float-end">Add Admin</a>
                    </div>
                    <div class="card-body">
                        <?php message(); ?>

                        <?php
                                    $admin = getAll('adminData');
                                    if(!$admin){
                                        echo "<h4>Something Wrong!</h4>";
                                        return false;
                                    }
                                    if(mysqli_num_rows($admin) > 0)
                                    {
                                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach($admin as $adminItem) : ?>
                                    <tr>
                                        <td ><?= $adminItem['id'] ?></td>
                                        <td ><?= $adminItem['name'] ?></td>
                                        <td ><?= $adminItem['email'] ?></td>
                                        <td>
                                            <a href="adminEdit.php?id=<?= $adminItem['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="adminDelete.php?id=<?= $adminItem['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                        <?php
                                    }
                                    else{
                                        ?>
                                        <h4 class="mb-0">No Record Found!</h4>
                                    <?php
                                    }
                                    ?>
                    </div>
                </div>

            </div>

<?php include('../include/footer.php');?>