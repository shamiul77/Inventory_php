<?php include('../include/header.php');?>
   

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Add Category</h4>
                        <a href="categories.php" class="btn btn-primary float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <?php message(); ?>
                    
                        <form action="Backend.php" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name*</label>
                                <input type="text" name="name" required class="form-control"/>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status: </label>
                                <br>
                                <input type="checkbox" name="status" style="width:20px; height: 20px;"; />
                            </div>

                            <div class="col-md-6 text-end mb-3">
                                <br>
                                <button type="submit" name="saveCategory" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                       </form>

                    </div>
                </div>

            </div>

<?php include('../include/footer.php');?>