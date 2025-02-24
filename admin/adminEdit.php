<?php include('../include/header.php');?>
   

            <div class="container-fluid px-4">
                
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0 float-start">Edit Admin</h4>
                        <a href="admin.php" class="btn btn-danger float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <?php message(); ?>
                    <form action="Backend.php" method="POST">

                    <?php 
                        if(isset($_GET['id'])){
                            if($_GET['id'] != ''){
                                $adminId = $_GET['id'];

                            }else{
                                echo "<h5>No Id Found </h5>";
                                return false;
                            }
                        }else{
                            echo "<h5>No Id Given In URL </h5>";
                                return false;
                        }

                        $adminData = getById('admindata', $adminId);
                        
                        if($adminData){
                            if($adminData['status'] == 200){
                                
                                ?>
                                  <input type="hidden" name="adminId" value="<?= $adminData['data']['id'];?>" >  
                                    <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name*</label>
                                <input type="text" name="name" value="<?= $adminData['data']['name'];?>" required class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email*</label>
                                <input type="text" name="email" value="<?= $adminData['data']['email'];?>"  required class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Password*</label>
                                <input type="text" name="password"  class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone Number *</label>
                                <input type="text" name="phone" value="<?= $adminData['data']['phone'];?>"  required class="form-control"/>
                            </div>
                            <div class="col-md-12 text-end mb-3">
                                <button type="submit" name="updateSave" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                                <?php

                            }else{
                                echo '<h5>'.$adminData['message'].'</h5>';
                            }

                        }else{
                            echo "Something went wrong";
                            return false;
                        }


                    ?>


                        
                       </form>
                    </div>
                </div>

            </div>

<?php include('../include/footer.php');?>