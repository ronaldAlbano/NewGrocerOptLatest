<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Products
                <a href="products-create.php" class="btn btn-primary float-end">Add Product</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage(); ?>

            <?php 
            // Retrieve all products from the database
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id'; // Default sorting by product ID
            $products_query = "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY $sort";
            $products = mysqli_query($conn, $products_query);

            if(!$products || mysqli_num_rows($products) === 0){
                echo '<h4>Something Went Wrong!</h4>';
                return false;
            }
            
            ?>

            <div class="mb-3">
                <label for="sort">Sort by:</label>
                <select id="sort" class="form-select" onchange="location = this.value;">
                    <option value="?sort=id">-----</option>
                    <option value="?sort=name">Product Name</option>
                    <option value="?sort=price">Price</option>
                    <option value="?sort=quantity">Quantity</option>
                </select>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while($item = mysqli_fetch_assoc($products)) : ?>
                        <tr>
                            <td>
                                <img src="../<?= $item['image']; ?>" style="width:50px;height:50px;" alt="Img" />
                                <?= $item['name']?>
                            </td>
                            <td><?= $item['category_name'];?></td>
                            <td><?= $item['price'];?></td>
                            <td>
                                <?php
                                $quantity = (int)$item['quantity'];
                                $btnClass = $quantity < 10 ? 'btn-danger' : 'btn-success';
                                ?>
                                <button class="btn <?= $btnClass ?>"><?= $quantity ?></button>
                            </td>
                            <td>
                                <?php   
                                    if($item['status'] == 1){
                                        echo '<span class="badge bg-danger">Hidden</span>';
                                    }else{
                                        echo '<span class="badge bg-primary">Visible</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="products-edit.php?id=<?=$item['id'];?>" class="btn btn-primary btn-sm">Edit</a>
                                <a 
                                    href="products-delete.php?id=<?=$item['id'];?>" 
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this product. ')"
                                >
                                    Delete
                                </a>
                            </td>
                            
                        </tr>
                        <?php endwhile; ?>


                    </tbody>
                </table>
            </div>


        </div>
   </div>
</div>

<?php include('includes/footer.php'); ?>
