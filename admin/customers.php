<?php include('../include/header.php');?>
   

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mt-2 float-start">Customers</h4>
                        <a href="customerCreate.php" class="btn btn-primary float-end">Add Customer</a>
                    </div>
                    <div class="card-body">

                        <?php message(); ?>

                        <?php
                                    $customers = getAll('customers');
                                    if(!$customers){
                                        echo "<h4>Something Wrong!</h4>";
                                        return false;
                                    }
                                    if(mysqli_num_rows($customers) > 0)
                                    {
                                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach($customers as $customersItem) : ?>
                                    <tr>
                                        <td ><?= $customersItem['id'] ?></td>
                                        <td ><?= $customersItem['name'] ?></td>
                                        <td ><?= $customersItem['email'] ?></td>
                                        <td ><?= $customersItem['phone'] ?></td>
                                        <td >
                                            <?php
                                                if($customersItem['status']==1){
                                                    echo '<span class="badge bg-danger">Hidden</span>';
                                                }else{
                                                    echo '<span class="badge bg-primary">Visible</span>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="customerEdit.php?id=<?= $customersItem['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="customerDelete.php?id=<?= $customersItem['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm ('Are you sure to delete this customer?')">Delete</a>
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