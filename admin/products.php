<?php include('../include/header.php');?>
   

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mt-2 float-start">Products</h4>
                        <a href="productsCreate.php" class="btn btn-primary float-end">Add Product</a>
                    </div>
                    <div class="card-body">

                        <?php message(); ?>

                        <?php
                                    $products = getAll('products');
                                    if(!$products){
                                        echo "<h4>Something Wrong!</h4>";
                                        return false;
                                    }
                                    if(mysqli_num_rows($products) > 0)
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
                                    
                                    <?php foreach($products as $productsItem) : ?>
                                    <tr>
                                        <td ><?= $productsItem['id'] ?></td>
                                        <td ><?= $productsItem['name'] ?></td>
                                        <td >
                                            <?php
                                                if($productsItem['status']==1){
                                                    echo '<span class="badge bg-danger">Hidden</span>';
                                                }else{
                                                    echo '<span class="badge bg-primary">Visible</span>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="productEdit.php?id=<?= $productsItem['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="productDelete.php?id=<?= $productsItem['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm ('Are you sure to delete this product?')">Delete</a>
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