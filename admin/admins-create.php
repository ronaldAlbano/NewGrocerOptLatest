<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Admin
                <a href="admins.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST">

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email *</label>
                        <input type="email" name="email" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Password *</label>
                        <input type="password" name="password" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone Number *</label>
                        <input type="number" name="phone" required class="form-control" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Role *</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="roleDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Role
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="roleDropdown">
                                <li><a class="dropdown-item" href="#" onclick="selectRole('Admin')">Admin</a></li>
                                <li><a class="dropdown-item" href="#" onclick="selectRole('Cashier')">Cashier</a></li>
                            </ul>
                            <input type="hidden" name="role" id="selectedRole">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Is Ban</label>
                        <br/>
                        <input type="checkbox" name="is_ban" style="width:30px;height:30px;" />
                    </div>
                    <div class="col-md-12 mb-3 text-end">
                        <button type="submit" name="saveAdmin" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
        </div>
   </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
    function selectRole(role) {
        document.getElementById('selectedRole').value = role;
        document.getElementById('roleDropdown').innerText = role;
    }
</script>
