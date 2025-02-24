<?php include('../include/header.php');?>
   

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Add Admin</h4>
                        <a href="admin.php" class="btn btn-primary float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <?php message(); ?>
                    <form action="adminBackend.php" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name*</label>
                                <input type="text" name="name" required class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email*</label>
                                <input type="text" name="email" required class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Password*</label>
                                <input type="text" name="password" required class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone Number *</label>
                                <input type="text" name="phone" required class="form-control"/>
                            </div>
                            <div class="col-md-12 text-end mb-3">
                                <button type="submit" name="save" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                       </form>
                    </div>
                </div>

            </div>

<?php include('../include/footer.php');?>