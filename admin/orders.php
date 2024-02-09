<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-0">Orders</h4>
                </div>
                <div class="col-md-8">
                    <form action="" method="GET" id="searchForm">
                        <div class="row g-1">
                            <div class="col-md-4">
                                <input type="date" 
                                    name="date"
                                    class="form-control"
                                    value="<?= isset($_GET['date']) ? $_GET['date'] : ''; ?>"
                                    onchange="clearSearch('invoice_no')"
                                />
                            </div>
                            <div class="col-md-3">
                            <input type="text" 
                            id="invoiceInput"
                            name="invoice_no"
                            class="form-control"
                            placeholder="Search by Invoice No"
                            value="<?= isset($_GET['invoice_no']) ? $_GET['invoice_no'] : ''; ?>"
                            oninput="clearSearch('date')"
                            />

                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="orders.php" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
            $query = "SELECT * FROM orders ORDER BY id DESC";

            if(isset($_GET['date'])){
                $orderDate = validate($_GET['date']);

                if($orderDate != ''){
                    $query = "SELECT * FROM orders WHERE order_date='$orderDate' ORDER BY id DESC";
                }
            }

            if(isset($_GET['invoice_no'])){
                $invoiceNo = validate($_GET['invoice_no']);

                if($invoiceNo != ''){
                    $query = "SELECT * FROM orders WHERE invoice_no='$invoiceNo'";
                }
            }

            $orders = mysqli_query($conn, $query);
            if($orders){
                if(mysqli_num_rows($orders) > 0)
                {
                    ?>
                    <table class="table table-striped table-bordered align-items-center justify-content-center">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Total Amount</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $orderItem) : ?>
                            <tr>
                                <td><?= $orderItem['invoice_no']; ?></td>
                                <td><?= $orderItem['total_amount']; ?></td>
                                <td><?= date('d M, Y', strtotime($orderItem['order_date'])); ?></td>
                                <td>
                                    <a href="orders-view.php?id=<?= $orderItem['id']; ?>" class="btn btn-info mb-0 px-2 btn-sm">View</a>
                                    <a href="orders-view-print.php?id=<?= $orderItem['id']; ?>" class="btn btn-primary mb-0 px-2 btn-sm">Print</a>
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

<script>
    function clearSearch(inputName) {
        document.getElementsByName(inputName)[0].value = '';
    }

</script>
