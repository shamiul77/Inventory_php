<?php include('../include/header.php');?>
   

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0 float-start">Add Product</h4>
                        <a href="products.php" class="btn btn-primary float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <?php message(); ?>
                    
                        <form action="Backend.php" method="POST">
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
                                                    echo'<option value="'.$categoriesItem['id'].'">'.$categoriesItem['name'].'</option>';

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
                                <input type="text" name="name" required class="form-control"/>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Price*</label>
                                <input type="text" name="price" required class="form-control"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Quantity*</label>
                                <input type="text" name="quantity" required class="form-control"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Status: </label>
                                <br>
                                <input type="checkbox" name="status" style="width:20px; height: 20px;"; />
                            </div>

                            <div class="col-md-12 text-end mb-3">
                                <br>
                                <button type="submit" name="saveProduct" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                       </form>

                    </div>
                </div>

            </div>

<?php include('../include/footer.php');?>