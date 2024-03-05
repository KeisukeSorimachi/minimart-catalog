<?php
require "connection.php";

function login($username,  $password){
    $conn = dbConnect();
    $sql = "SELECT * FROM users WHERE username = '$username'";

    if($result = $conn->query($sql)){
     
         # Check if the username exists
         if($result->num_rows == 1){
            $user = $result->fetch_assoc();

            # Check if the password is correct
            if(password_verify($password, $user['password'])){
               /****** SESSION ******/
               session_start();

               $_SESSION['id']         = $user['id'];
               $_SESSION['username']   = $user['username'];
               $_SESSION['full_name']  = $user['first_name'] . " " . $user['last_name'];

               header("location: products.php");
              header("location: sections.php");
               exit;
            } else {
               echo "<div class='alert alert-danger'>Incorrect password.</div>";
            }
        } else {
            echo "<div class='aler alert-danger'>Username not found.</div>";
        }
    } else {
        die("Error retrieving the user: " . $conn->error);
    }
}

if(isset($_POST['btn_log_in'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    login($username,  $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <title>Login</title>
</head>
<body class="bg-light">
   <div style="height: 100vh;">
      <div class="row h-100 m-0">
         <div class="card w-25 my-auto mx-auto px-0">
            <div class="card-header text-primary bg-white">
               <h1 class="card-title text-center mb-0">Minimart Catalog</h1>
            </div>
            <div class="card-body">
               <form action="" method="post">
                  <div class="mb-3">
                     <label for="username" class="form-label small fw-bold">Username</label>
                     <input type="text" name="username" id="username" class="form-control" autofocus required>
                  </div>

                  <div class="mb-5">
                     <label for="password" class="form-label small fw-bold">Password</label>
                     <input type="password" name="password" id="password" class="form-control">
                  </div>

                  <button type="submit" name="btn_log_in" class="btn btn-primary w-100">Log in</button>
               </form>

               <div class="text-center mt-3">
                  <a href="sign-up.php" class="small">Create Account</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>
</html>