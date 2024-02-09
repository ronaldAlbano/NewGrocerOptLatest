<?php 
include('includes/header.php'); 
if(!isset($_SESSION['productItems'])){
    echo '<script> window.location.href = "order-create.php"; </script>';
}
?>



<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Order Summary
                        <a href="order-create.php" class="btn btn-danger float-end">Back to create order</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php alertMessage(); ?>

                    <div id="myBillingArea">

                        <?php
                            $invoiceNo = validate($_SESSION['invoice_no']);
                 

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
                                            <p style="font-size: 14px; line-height: 20px; margin: 2px; padding: 0;">Invoice No: <?= $invoiceNo; ?></p>
                                            <p style="font-size: 14px; line-height: 20px; margin: 2px; padding: 0;">Invoice Date: <?= date('d M Y'); ?></p>
                                        </td>
                                    </tr>
                                </tbody>


                            </table>

                            <?php

                        ?>

                        <?php
                        if(isset($_SESSION['productItems']))
                        {
                            $sessionProducts = $_SESSION['productItems'];
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
                                                $totalAmount = 0;
                                                foreach($sessionProducts as $key => $row) :
                                                $totalAmount += $row['price'] * $row['quantity']
                                            ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['price'],0); ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['quantity'] ?></td>
                                                <td style="border-bottom: 1px solid #ccc;" class="fw-bold">
                                                    <?= number_format($row['price'] * $row['quantity'], 0) ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="4" align="end" style="font-weight: bold;">Grand Total: </td>
                                                <td colspan="1" style="font-weight: bold;"><?= number_format($totalAmount, 0); ?> </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div
                            <?php
                        }
                        else
                        {
                            echo '<h5 class="text-center">No Items added</h5>';
                        }


                        ?>

                    </div>

                    <?php if(isset($_SESSION['productItems'])) : ?>
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-primary px-4 mx-1" id="saveOrder">Save</button>     
                    </div>

                    <?php   endif; ?>


                </div>
                </div>
            </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
document.getElementById('saveOrder').addEventListener('click', function() {
    setTimeout(function() {
        window.location.href = 'orders.php';
    }, 3000); // Redirect after 2 seconds
});
</script>