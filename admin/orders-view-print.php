<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Print Orders
                <a href="orders.php" class="btn btn-danger btn-sm float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php
                if(isset($_GET['id']))
                {   
                    $idNo = validate($_GET['id']);

                    if($idNo == '')                        
                    {
                        ?>
                        <div class="text-center py-5">
                            <h5>Please provide ID Number</h5>
                            <div>
                                <a href="orders.php" class="btn btn-primary mt-4 w-25">Go back to orders</a>
                            </div>
                         </div>
                         <?php
                    }

                    $orderQuery = "SELECT * FROM orders WHERE id = '$idNo'";
                    $orderQueryRes = mysqli_query($conn, $orderQuery);

                    if(!$orderQueryRes){
                        echo '<h5>Something Went Wrong</h5>';
                        return false;
                    }

                    if(mysqli_num_rows($orderQueryRes) > 0)
                    {
                        $orderDataRow = mysqli_fetch_assoc($orderQueryRes);

                        ?>
                            <table style="width: 100%; margin-bottom: 20px;">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;" colspan="2">
                                            <h4 style="font-size: 30px; line-height: 30px; margin: 2px; padding: 0;">GrocerOpt</h4>
                                            <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">
                                            A. Mabini Campus, Anonas Street, <br/>Sta. Mesa Manila, Philippines 1016</p>
                                            <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">
                                            GrocerOpt pvt ld.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="end">
                                            <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0;">Invoice Details</h5>
                                            <p style="font-size: 14px; line-height: 20px; margin: 2px; padding: 0;">Invoice No: <?= $orderDataRow['invoice_no']; ?></p>
                                            <p style="font-size: 14px; line-height: 20px; margin: 2px; padding: 0;">Invoice Date: <?= date('d M Y'); ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php

                    }
                    else
                    {
                        echo "<h5>No data found</h5>";
                        return false;
                    }

                    $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.*
                    FROM orders as o, order_items as oi, products as p
                    WHERE oi.order_id = o.id AND p.id = oi.product_id AND o.id='$idNo'";

                    $orderItemsRes = mysqli_query($conn, $orderItemQuery);
                    if($orderItemsRes)
                    {
                        if(mysqli_num_rows($orderItemsRes) > 0)
                        {
                            ?>
                                <div class="table-responsive mb-3">
                                    <table style="width:100%;" cellpadding="5">
                                        <thead>
                                            <tr>
                                                <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">ID</th>
                                                <th align="start" style="border-bottom: 1px solid #ccc;">Product Name</th>
                                                <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Price</th>
                                                <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Quantity</th>
                                                <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Total Price</th>
                                            </tr>                                
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;

                                                foreach($orderItemsRes as $key => $row) :

                                            ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['orderItemPrice'],0); ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['orderItemQuantity'] ?></td>
                                                <td style="border-bottom: 1px solid #ccc;" class="fw-bold">
                                                    <?= number_format($row['orderItemPrice'] * $row['orderItemQuantity'], 0) ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="4" align="end" style="font-weight: bold;">Grand Total: </td>
                                                <td colspan="1" style="font-weight: bold;"><?= number_format($row['total_amount'], 0); ?> </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div
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

                }
                else
                {
                    ?>
                        <div class="text-center py-5">
                            <h5>No ID Number Parameter Found</h5>
                            <div>
                                <a href="orders.php" class="btn btn-primary mt-4 w-25">Go back to orders</a>
                            </div>
                        </div>
                    <?php
                }
            ?>

        </div>


    </div>
</div>        



<?php include('includes/footer.php'); ?>