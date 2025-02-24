<?php include('../include/header.php');?>
   

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mt-2 float-start">Categories</h4>
                        <a href="categoryCreate.php" class="btn btn-primary float-end">Add Category</a>
                    </div>
                    <div class="card-body">

                        <?php message(); ?>

                        <?php
                                    $categories = getAll('categories');
                                    if(!$categories){
                                        echo "<h4>Something Wrong!</h4>";
                                        return false;
                                    }
                                    if(mysqli_num_rows($categories) > 0)
                                    {
                                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach($categories as $categoriesItem) : ?>
                                    <tr>
                                        <td ><?= $categoriesItem['id'] ?></td>
                                        <td ><?= $categoriesItem['name'] ?></td>
                                        <td >
                                            <?php
                                                if($categoriesItem['status']==1){
                                                    echo '<span class="badge bg-danger">Hidden</span>';
                                                }else{
                                                    echo '<span class="badge bg-primary">Visible</span>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="categoryEdit.php?id=<?= $categoriesItem['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="categoriesDelete.php?id=<?= $categoriesItem['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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