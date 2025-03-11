
<?php include('../include/header.php');?>

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0 float-start">Edit Product</h4>
                        <a href="products.php" class="btn btn-primary float-end">Back</a>
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

                            $productId = getById('products', $paramResult);
                            if ($productId['status'] == 200) {
                            ?>
                        <input type="hidden" name="productId" value="<?= $productId['data']['id']; ?>">    
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label >Select Category</label>
                                <select name="categoryId" class="form-select">
                                    <option value="">Select</option>
                                    <?php
                                        $categories = getAll('categories');
                                        if($categories){
                                            if(mysqli_num_rows($categories) > 0){
                                                foreach($categories as $categoriesItem){
                                                    ?>
                                                    <option value="<?= $categoriesItem['id']; ?>"
                                                    <?= $productId['data']['category_id'] == $categoriesItem['id'] ? 'selected' : ''; ?>
                                                    >

                                                        

                                                        <?= $categoriesItem['name']; ?>
                                                    </option>

                                                    <?php
                                                }
                                            }else{
                                                echo '<option value="">No categories found</option>';
                                            }

                                        }else{
                                            echo '<option value="">Something went wrong!</option>';
                                        }
                                    ?>
                                </select>

                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Product Name*</label>
                                <input type="text" name="name" value="<?= $productId['data']['name']; ?>" required class="form-control"/>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" rows="3"><?= $productId['data']['description']; ?></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Price*</label>
                                <input type="text" name="price" value="<?= $productId['data']['price']; ?>" required class="form-control"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Quantity*</label>
                                <input type="text" name="quantity" value="<?= $productId['data']['quantity']; ?>" required class="form-control"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Status: </label>
                                <br>
                                <input type="checkbox" name="status" value="<?= $productId['data']['status'] == true ? 'checked' : ''; ?>" style="width:20px; height: 20px;"; />
                            </div>

                            <div class="col-md-12 text-end mb-3">
                                <br>
                                <button type="submit" name="updateProduct" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <?php
                            } else {
                                echo '<h5>' . $productId['message'] . '</h5>';
                            }
                            ?>
                       </form>

                    </div>
                </div>

            </div>

<?php include('../include/footer.php');?>