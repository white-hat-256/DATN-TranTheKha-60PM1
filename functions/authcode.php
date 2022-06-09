<?php
session_start();
include("../config/dbcon.php");
include("../functions/myfunctions.php");
if(isset($_POST['register-btn']))
{
    $name= mysqli_real_escape_string($conn,$_POST['name']);
    $phone= mysqli_real_escape_string($conn,$_POST['phone']);
    $email= mysqli_real_escape_string($conn,$_POST['email']);
    $password= mysqli_real_escape_string($conn,$_POST['password']);
    $cpassword= mysqli_real_escape_string($conn,$_POST['cpassword']);


    //Check email already 
    $check_email_query="SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run= mysqli_query($conn, $check_email_query);
    if(mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['message'] = "Email already registered";
        header('Location:../register.php');
    }
    //Check password no match
    else
    {
        if($password == $cpassword)
        {
            //Inser user data
            $insert_query= "INSERT INTO users (name,email,phone,password) VALUES ('$name','$email','$phone','$password')";
            $insert_query_run=mysqli_query($conn,$insert_query);
            if($insert_query_run){
                $_SESSION['message']="Registered Successfully";
                header('Location: ../login.php');
            }else
            {
                $_SESSION['message']="Something went wrong";
                header('Location: ../register.php');
            }
        }else{
            $_SESSION['message'] = "Password do not match";
            header('Location: ../register.php');
        }
    }  
}
else if(isset($_POST['login_btn']))
{
    $email= mysqli_real_escape_string($conn, $_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    $login_query="SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $login_query_run=mysqli_query($conn,$login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        $_SESSION['auth']=true;

        $userdata   =   mysqli_fetch_array($login_query_run);
        $userid     =   $userdata['id'];
        $username   =   $userdata['name'];
        $useremail  =   $userdata['email'];
        $role_as    =   $userdata['role_as'];
        
        $_SESSION['auth_user']=[
            'id'    =>  $userid,
            'name'  =>  $username,
            'email' =>  $useremail
        ];
        
        $_SESSION['role_as']= $role_as;
        if($role_as == 1)
        {   
            redirect("../admin/index.php", "Welcome to dashboard");
        }else
        {
            redirect("../index.php", "successfull");
        }
    }else
    {
        redirect("../login.php", "Invaid Credentials");
    }
}
else if(isset($_POST['update_user_btn']))
{
    $id=$_SESSION['auth_user']['id'];
    $name= $_POST['name'];

    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $address= $_POST['address'];
   
    $update_query= "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$id' ";
    $update_query_run=mysqli_query($conn,$update_query);
    if($update_query_run)
    {
        redirect("../user-profile.php","User Update Successflly");
    }
    else
    {
        redirect("../user-profile.php","Something Wrong");
    }
}
?>