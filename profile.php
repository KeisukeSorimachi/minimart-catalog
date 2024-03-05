<?php 

  session_start();
  include "connection.php";
  $user_details = getUser($_SESSION['id']);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minimart Catalog</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light">
    <?php
        include 'main-nav.php';
    ?>
    <div class="container py-5">
          <?php

          if(isset($_POST['btn_upload']))
           {
            //input
            var_dump($_FILES['photo']);
            $filename = $_FILES['photo']['name'];
            $tmp_name = $_FILES['photo']['tmp_name'];

            //process
            uploadPhoto($user_details["id"],$filename,$tmp_name);
           }

          ?>
      <div class="card w-25 mx-auto">
        <?php
            $filename = "default.jpeg";

            if($user_details["photo"] != NULL) //check if photo g=from the database is not empty
            {
                  //if the phto is not empty, assign photo to the $filename
                  $filename = $user_details['photo'];
            }

        ?>
        <img src="assets/images/<?= $filename ?>" alt=""class="card-img-top">
        <div class="card-body">
          <h1 class="card-title display-5"><?= $user_details["first_name"]. " ".$user_details["last_name"] ?></h1>
          <h2 class="card-subtitle display-6 text-muted fst-italic mb-4">@<?= $user_details["username"] ?></h2>
          <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="photo" id="photo" class="form-control mb-3">
            <input type="submit" value="Upload" class="btn btn-primary w-100" name="btn_upload">
          </form>
        </div>
      </div>
    </div>
</body>
</html>

<?php 
function getUser($user_id)
  {
    $conn = dbConnect();
    $sql = "SELECT * FROM users WHERE id= $user_id";

    return $conn->query($sql)->fetch_assoc();
    //$conn->query($sql)->fetch_assoc() runs the sql staemant and return 1 row from the resilt set as an associate array
  }

  function uploadPhoto($user_id,$filename,$tmp_name)
  {
    $conn =dbConnect();
    $sql = "UPDATE users SET photo ='$filename' WHERE id= $user_id";

    if($conn->query($sql))
    {
      $destination = "assets/images/".$filename;
        //move uploaded_file(origin, destination) ; moves the upoloaded file from the temporary storage to the permanent storage
        
        move_uploaded_file($tmp_name, $destination);
        header("Refresh:0"); //reload page

    }
    else 
    {
      //error message
      echo "<div class='alert altert-danger w-50 mx-auto my-3 text-center'> Fail to Upload photo.
      <br> <small>".$conn->error."</small></div>";
    }
  }

?>