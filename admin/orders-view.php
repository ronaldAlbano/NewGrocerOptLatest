<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Orders view
                <a href="orders.php" class="btn btn-danger mx-2 btn-sm float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

        <?php alertMessage(); ?>

        <?php
            if(isset($_GET['id']))
            {
                $orderId = validate($_GET['id']);

                $query = "SELECT * FROM orders WHERE id = '$orderId'";
                $orders = mysqli_query($conn, $query);

                if($orders)
                {
                    if(mysqli_num_rows($orders) > 0){

                        $orderData = mysqli_fetch_assoc($orders);

                        ?>
                        <div class="card card-body shadow border-1 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <label class="mb-1">
                                        Invoice No:
                                        <span class="fw-bold"><?= $orderData['invoice_no']; ?></span>
                                    </label>
                                    <br/>
                                    <label class="mb-1">
                                        Order Date:
                                        <span class="fw-bold"><?= $orderData['order_date']; ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <?php
                            $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.*
                                FROM orders as o, order_items as oi, products as p
                                WHERE oi.order_id = o.id AND p.id = oi.product_id AND o.id='$orderId'";

                            $orderItemsRes = mysqli_query($conn, $orderItemQuery);
                            if($orderItemsRes)
                            {
                                if(mysqli_num_rows($orderItemsRes) > 0)
                                {
                                    ?>
                                        <h4 class="my-3"> Order Items Details</h4>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($orderItemsRes as $orderItemRow) : ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?= $orderItemRow['image'] != '' ? '../'.$orderItemRow['image']: '../assets/images/no-img.jpg'; ?>"
                                                                style="width:50px;height:50px;"
                                                                alt="Img" />
                                                            <?= $orderItemRow['name']; ?>
                                                        </td>
                                                        <td width="15%" class="fw-bold text-center">
                                                            <?= number_format($orderItemRow['orderItemPrice'],0) ?>
                                                        </td>
                                                        <td width="15%" class="fw-bold text-center">
                                                            <?= $orderItemRow['orderItemQuantity']; ?>
                                                        </td>
                                                        <td width="15%" class="fw-bold text-center">
                                                            <?= number_format($orderItemRow['orderItemPrice'] * $orderItemRow['orderItemQuantity']) ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <tr>
                                                    <td class="text-end fw-bold">Total Price: </td>
                                                    <td colspan="3" class="text-end fw-bold" style="padding-right: 100px;"><?= number_format($orderItemRow['total_amount'],0); ?></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    <?php


                                }else{
                                    echo '<h5>Something Went Wrong</h5>';
                                    return false;
                                }

                            }
                            else
                            {
                                echo '<h5>Something Went Wrong!</h5>';
                                return false;
                            }

                        ?>


                        <?php


                    }else{
                        echo '<h5>No Record Found!</h5>';
                        return false;
                    }

                }
                else
                {
                    echo '<h5>Something Went Wrong!</h5>';
                }
            }

        ?>



        </div>



    </div>
</div>        



<?php include('includes/footer.php'); ?>