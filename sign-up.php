<?php
    require 'connection.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-Up Minimart Catalog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-light">
  <div class="container py-5">
      <?php 
          if(isset($_POST['btn_sign_up'])){
            
              //Input
                  $first_name = $_POST['first_name'];
                  $last_name = $_POST['last_name'];
                  $username = $_POST['username'];
                  $password = $_POST['password'];
                  $confirm_password = $_POST['confirm_password'];

              //Proccess

                if($password ==$confirm_password) //checks if password match
                {
                  signUp($first_name, $last_name,$username,$password);
                }
                else 
                {
              //display error message
                echo "<div class='alert alert-damger w-50 mx-auto my-3 text-center'> Password do not match. Kindly try again</div>";
                }
            }
        ?>
    <div class="card w-25 mx-auto my-3">
        <div class="card-header">
          <h1 class="display-6">Sign-Up</h1>
        </div>
        <div class="card-body">
          <form action="" method="post">
            <label for="first-name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control form-conrol-sm mb-3" placeholder="John" required>
            
            <label for="last-name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control form-conrol-sm mb-3" placeholder="Doe" required>
            
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control form-conrol-sm mb-3" placeholder="Jdoe_123" required>
            
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control form-conrol-sm mb-3"required>

            <label for="confirm-password" class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm-password" class="form-control form-control-sm mb-3" required>

            <input type="submit" value="Sign-up" name="btn_sign_up" class="btn btn-primary w-100">
          </form>
        </div>
    </div>
  </div>
</body>
</html>

<?php
     function signUP($first_name,$last_name,$username,$password)
     {
      $conn = dbConnect(); //connect to the database
      $encrypted_password = password_hash($password, PASSWORD_DEFAULT); //encrypt the password
      //password_hash (<password>,<aligorith>);
      //password_hash() return a 60-character long encrytpted password
      $sql = "INSERT INTO users(first_name, last_name, username,password) VALUES('$first_name','$last_name','$username','$encrypted_password')";

      $result = $conn->query($sql); //runs the sql staement

      if($result)
      {
          header("Location: login.php"); //redirct to login
      }
      else 
      {
          //display an error message
          echo "<div class='alert alert-danger w-50 mx-auto my-3 text-center'>Sigh UP unccessful. Kindly try again. <br><small>".$conn->error."</small></div>";
          //$conn->error ==> gives the actual error message from the database 
      }


     }

?>