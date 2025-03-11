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
                        <select name="product_id" class="form-select mySelect2">
                            <option value="">-- Select Product --</option>
                            <?php
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
                        <input type="number" name="quantity" value="1" class="form-control"  />
                    </div>

                    <div class="col-md-3 text-end mb-3 mt-3">
                        
                        <button type="submit" name="addItem" class="btn btn-primary ">Add Item</button>
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
            <?php 
            if (isset($_SESSION['productItem'])){

                $sessionProducts = $_SESSION['productItem'];
                ?>
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
                            foreach ($sessionProducts as $key => $item): 
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $item['name']; ?></td>
                                    <td><?= $item['price']; ?></td>
                                    <td>
                                        <div class="input-group qtyBox">
                                            <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId"/>
                                            <button class="input-group-text decrement " >-</button>
                                            <input type="text" value="<?= $item['quantity']; ?>" class="qty text-center quantityInput form-control" />
                                            <button class="input-group-text increment" >+</button>
                                        </div>
                                    </td>

                                    <td><?= number_format($item['price'] * $item['quantity'], 0); ?></td>
                                    <td>
                                        <a href="orderItemDelete.php?index=<?= $key; ?>" class="btn btn-danger">Remove</a>
                                    </td>
                                </tr>
                                    <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                }
                else{
                    echo '<h5>No Items Added!</h5>';
                }
                ?>
            
        </div>
    </div>
</div>



<?php include('../include/footer.php'); ?>
