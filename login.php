<?php include('includes/header.php'); 

if(isset($_SESSION['loggedIn'])){
    ?>
    <script>window.location.href = 'index.php';</script>
    <?php
}

?>

<div class="py-5 bg-light" style="height: 100vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-4">
                    <div class="hover-effect">
                        <img src="GrocerOpt.png" class="card-img-top" alt="Image">
                    </div>
                    
                    <div class="justify-content-center align-items-center" >
                        <div class="text-center">
                            <?php alertMessage(); ?>
                        </div>
                    </div>
       
                    <div class="p-5">
 
                        
                             
                        <form action="login-code.php" method="POST">

                        <div class="mb-3">
                            <label>Email <span style="color: red;">*</span></label>
                            <input type="email" name="email" class="form-control" required/>
                        </div>

                        <div class="mb-3">
                            <label>Password <span style="color: red;">*</span></label>
                            <input type="password" name="password" class="form-control" required/>
                        </div>

                        <div class="m-3">
                            <button type="submit" name="loginBtn" class="btn btn-primary w-100 mt-2">
                                Sign In
                            </button>
                        </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
