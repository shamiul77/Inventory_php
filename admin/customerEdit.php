
<?php include('../include/header.php');?>
   

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0 float-start">Edit Customer</h4>
                        <a href="customers.php" class="btn btn-primary float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <?php message(); ?>
                    
                        <form action="Backend.php" method="POST">

                             <?php
                                $paramResult = checkPeramiterId('id');
                                if (!is_numeric($paramResult)) {
                                    echo '<h5>' . $paramResult . '</h5>';
                                    return false;
                                }

                                $customerId = getById('customers', $paramResult);
                                if ($customerId['status'] == 200) {
                                ?>
                        <input type="hidden" name="customerId" value="<?= $customerId['data']['id']; ?>">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name*</label>
                                <input type="text" name="name" value="<?= $customerId['data']['name']; ?>" required class="form-control"/>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Email</label>
                                <input type="email" name="email" value="<?= $customerId['data']['email']; ?>"  class="form-control"/>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Phone</label>
                                <input type="number" name="phone" value="<?= $customerId['data']['phone']; ?>" class="form-control"/>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="">Status: </label>
                                <br>
                                <input type="checkbox" name="status" <?= $customerId['data']['status'] ? 'checked' : ''; ?> style="width:20px; height: 20px;"; />
                            </div>

                            <div class="col-md-6 text-end mb-3">
                                <br>
                                <button type="submit" name="updateCustomer" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <?php
                        } else {
                            echo '<h5>' . $categoryId['message'] . '</h5>';
                        }
                        ?>
                       </form>

                    </div>
                </div>

            </div>

<?php include('../include/footer.php');?>