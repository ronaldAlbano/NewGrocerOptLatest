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
            <h4 class="mb-0">Admins | Staff
                <a href="admins-create.php" class="btn btn-primary float-end">Add Staff</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <?php 
            $admins = getAll('admins');
            if(!$admins){
                echo '<h4>Something Went Wrong!</h4>';
                return false;
            }
            
            if(mysqli_num_rows($admins) > 0)
            {

            
            ?>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is_Ban</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($admins as $adminItem) : ?>
                        <tr>
                            <td><?= $adminItem['name']?></td>
                            <td><?= $adminItem['email']?></td>
                            <td>
                                <?php   
                                    if($adminItem['is_ban'] == 1){
                                        echo '<span class="badge bg-danger">Ban</span>';
                                    }else{
                                        echo '<span class="badge bg-primary">Active</span>';
                                    }
                                ?>
                            </td>
                            <td><?= $adminItem['role']?></td>
                            <td>
                                <a href="admins-edit.php?id=<?=$adminItem['id'];?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="admins-delete.php?id=<?=$adminItem['id'];?>" class="btn btn-danger btn-sm">Delete</a>
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