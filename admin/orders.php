<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Orders</h4>
        </div>

        <?php
            $query = "SELECT * FROM orders";
            $orders = mysqli_query($conn, $query);
            if($orders){

                if(mysqli_num_rows($orders) > 0)
                {
                    ?>
                    <table class="table table-striped table-bordered align-items-center justify-content-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice No</th>
                                <th>Total Amount</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $orderItem) : ?>
                            <tr>
                                <td class="fw-bold"><?= $orderItem['id']; ?></td>
                                <td class="fw-bold"><?= $orderItem['invoice_no']; ?></td>
                                <td class="fw-bold"><?= $orderItem['total_amount']; ?></td>
                                <td class="fw-bold"><?= date('d M, Y', strtotime($orderItem['order_date'])); ?></td>
                                <td>
                                    <a href="orders-view.php?id=<?= $orderItem['id']; ?>" class="btn btn-info mb-0 px-2 btn-sm">View</a>
                                    <a href="" class="btn btn-primary mb-0 px-2 btn-sm">Print</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>



                    </table>

                    <?php


                }
                else
                {
                    echo "<h5>NO Record Available</h5>";
                }
            }
            else
            {
                echo "Something Went Wrong</h5>";
            }
        ?>




    </div>
</div>        



<?php include('includes/footer.php'); ?>