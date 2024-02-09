<?php include('includes/header.php'); 

// Retrieve the role of the logged-in user from the database
$query = "SELECT role FROM admins WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $query);

if($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $role = $row['role'];

    // Check if the role is "Cashier"
    if($role == "Cashier") {
        // Use JavaScript to redirect the user to order-create.php
        echo "<script>window.location.href = 'order-create.php';</script>";
        exit(); // Stop further execution
    }
} else {
    // Handle database error or invalid result
    echo "Error: Unable to fetch user role.";
    // Optionally, you can display an error message to the user
    // echo "Error: Unable to fetch user role. Please try again later.";
}?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Categories
                <a href="categories-create.php" class="btn btn-primary float-end">Add Category</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage(); ?>

            <?php 
            $categories = getAll('categories');
            if(!$categories){
                echo '<h4>Something Went Wrong!</h4>';
                return false;
            }
            
            if(mysqli_num_rows($categories) > 0)
            {     
            ?>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
 
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($categories as $item) : ?>
                        <tr>

                            <td><?= $item['name']?></td>
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
                                <a href="categories-edit.php?id=<?=$item['id'];?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="categories-delete.php?id=<?=$item['id'];?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                            
                        </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>
            </div>

            <?php
            }
            else
            {
                ?>
                    <h4 class="mb-0">No Record Found</h4>
                <?php

            }
            ?>

        </div>
   </div>
</div>

<?php include('includes/footer.php'); ?>