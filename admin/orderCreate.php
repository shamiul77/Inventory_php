<?php 
session_start();
include('../include/header.php'); 
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0 float-start">Create Order</h4>
            <a href="#" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <?php message(); ?>
        
            <form action="ordersBackend.php" method="POST">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Select Product</label>
                        <select name="productId" class="form-select mySelect2">
                            <option value="">-- Select Product --</option>
                            <?php
                                include('../config/db.php');
                                $products = getAll('products');
                                if ($products && mysqli_num_rows($products) > 0) {
                                    foreach ($products as $productsItem) {
                                        echo '<option value="' . $productsItem['id'] . '">' . $productsItem['name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No product found</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" value="1" class="form-control" min="1" />
                    </div>

                    <div class="col-md-3 text-end mb-3">
                        <br>
                        <button type="submit" name="addItem" class="btn btn-primary">Add Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0">Products</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($_SESSION['productItem'])): ?>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1; 
                            foreach ($_SESSION['productItem'] as $key => $item): ?>
                                <tr>
                                    <td><?= $item['productId']; ?></td>
                                    <td><?= $item['name']; ?></td>
                                    <td><?= number_format($item['price'], 2); ?></td>
                                    <td>
                                        <div class="input-group qtyBox">
                                            <input type="hidden" value="<?= $item['productId']; ?>">
                                            <button class="input-group-text decrement " >-</button>
                                            <input type="text" value="<?= $item['quantity']; ?>" class="qty text-center quantityInput form-control" />
                                            <button class="input-group-text increment" >+</button>
                                        </div>
                                    </td>
                                    <td><?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                                    <td>
                                        <a href="orderItemDelete.php?index=<?= $key; ?>" class="btn btn-danger">Remove</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <h5>No Item Added!</h5>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-decrease').forEach(button => {
        button.addEventListener('click', function () {
            let productId = this.getAttribute('data-id');
            window.location.href = "updateOrderQuantity.php?action=decrease&index=" + productId;
        });
    });

    document.querySelectorAll('.btn-increase').forEach(button => {
        button.addEventListener('click', function () {
            let productId = this.getAttribute('data-id');
            window.location.href = "updateOrderQuantity.php?action=increase&index=" + productId;
        });
    });
</script>

<?php include('../include/footer.php'); ?>
