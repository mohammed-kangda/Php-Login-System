 <!-- Account Creation Phase -->

<?php
    $showAlert = false;
    $showError = false;
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
        //connecting database :

        include 'partials/_dbconnect.php';

        //storing in variable :
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        

        // Check whether this username exists in DB:

       $existSql = "SELECT * FROM `userstbl`
                    WHERE Username = '$username'";
       $result = mysqli_query($connect,$existSql);   
       
       // finding no. of rows :

       $numRows = mysqli_num_rows($result);

       if($numRows > 0){
           $showError = "Username Already Exist";
       }else{

        // Sql query for checking both the password are same :

        if(($password == $cpassword)){
            // $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `userstbl`(`Username`,`Password`,`Date`)
                    VALUES('$username' , '$password' , current_timestamp())";
            $result = mysqli_query($connect , $sql);
            
            if($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Password Doesn't Match";
        }  
    }   
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP SignUp</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
    crossorigin="anonymous">
</head>
<body>
    <?php require 'partials/_nav.php'?>

    <?php
       if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your account is now created and you can login
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div> ';
         }

       if($showError){
           echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> '. $showError.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div> ';
         }
    ?>
    <div class="container">
        <h2 class="text-center mt-3">Sign Up To Our Website</h2>
        <form action="/PHP Login System/signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" name="cpassword" class="form-control" id="cpassword">
                <div id="emailHelp" class="form-text">Make Sure to Enter Same Password</div>
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>


 <!-- Bootstrap Javascrip-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>