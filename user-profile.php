<?php 
session_start();


if (!isset($_SESSION['auth'])){
    include("./functions/userfunctions.php");
    redirect("./login.php", "you need login first");
}

include("./includes/header.php");

$id = $_SESSION['auth_user']['id'];

$users = getByID("users",$id);                              
$data= mysqli_fetch_array($users);

?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>

    <!-- header -->
 
    <!-- end header -->
    <?php if(isset($_SESSION['message']))
            {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong><?= $_SESSION['message']; ?>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['message']);
            }
                
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h1 >Profile</h1>
            </div>
            <div class="col-md-8">
                <form action="./functions/authcode.php" method="POST">
                        <label class="mb-0" for=""><b>Name</b></label>
                        <input class="form-control" type="text" name="name" value="<?= $data['name']?>" ><br>
                        <label class="mb-0" for=""><b>Email</b></label>
                        <input class="form-control" type="text" name="email" value="<?= $data['email']?>" ><br>
                        <label class="mb-0" for=""><b>Phone Number</b></label>
                        <input class="form-control" type="text" name="phone" value="<?= $data['phone']?>"><br>
                        <label class="mb-0" for=""><b>Address</b></label>
                        <input class="form-control" type="text" name="address" value="<?= $data['address']?>" ><br>
                        <label class="mb-0" for=""><b>Password</b></label>
                        <input class="form-control" type="password" name="password" value="<?= $data['password']?>" ><br>
                        <label class="mb-0" for=""><b>Confirm Password</b></label>
                        <input class="form-control" type="password" name="cpassword" value="<?= $data['password']?>" ><br> 
                        <input type="hidden" name="update_user_btn" value="true">   
                        <button type="submit" class="btn btn-primary" >Save</button>
                </form>         
            </div>           
        </div>
    </div>
</body>
</html>