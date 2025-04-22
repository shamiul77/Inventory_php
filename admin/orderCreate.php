<?php 
session_start();
include('../include/header.php'); 

?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label >Enter Customer Name</label>
            <input type="text" class="form-control" id="customerName"/>
        </div>
        <div class="mb-3">
            <label >Enter Phone Number</label>
            <input type="number" class="form-control" id="customerPhone"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary saveCustomer" >Save</button>
      </div>
    </div>
  </div>
</div>


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

                <div class="mt-2">
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Select Payment Mode</label>
                            <select id="payment_method" class="form-select">
                                <option value="">-- Select Payment --</option>
                                <option value="Cash">Cash</option>
                                <option value="Bkash">Bkash</option>
                                <option value="Rocket">Rocket</option>
                                <option value="Nagad">Nagad</option>
                                <option value="Card">Card</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Customer phone Number</label>
                            <input type="number" id="customerPhone" class="form-control" value=""/>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <button type="button" class="btn btn-warning w-100 placeOrder">Place Order</button>
                        </div>
                    </div>
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
