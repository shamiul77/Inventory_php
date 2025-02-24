<?php include('../include/header.php');?>

<div class="container-fluid px-4">

    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0 float-start">Edit Category</h4>
            <a href="categories.php" class="btn btn-primary float-end">Back</a>
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

                $categoryId = getById('categories', $paramResult);
                if ($categoryId['status'] == 200) {
                ?>

                    <input type="hidden" name="idCategory" value="<?= $categoryId['data']['id']; ?>">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="">Name*</label>
                            <input type="text" name="name" value="<?= $categoryId['data']['name']; ?>" required class="form-control" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="3"><?= $categoryId['data']['description']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Status: </label>
                            <br>
                            <input type="checkbox" name="status" <?= $categoryId['data']['status'] ? 'checked' : ''; ?> style="width:20px; height: 20px;">
                        </div>

                        <div class="col-md-6 text-end mb-3">
                            <br>
                            <button type="submit" name="updateCategory" class="btn btn-primary">Update</button>
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

<?php include('../include/footer.php'); ?>
