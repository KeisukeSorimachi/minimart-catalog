<?php
session_start();
require 'connection.php';

function getAllSections() {
  $conn = dbconnect();
  // sql syntax :"action" which-items FROM table_name";
  $sql = "SELECT * FROM sections";

  if ($result = $conn->query($sql)) {
      return $result;
  } else {
       die("Error retrieving all sections: " . $conn->error);
  }
}

function createSection($name){
  //Connection
  $conn = dbConnect();

  //SQL
  $sql = "INSERT INTO sections(name) VALUE('$name')";

  //Execute
  if($conn->query($sql)){
    //success
    header('refresh: 0');
  } else {
        die('Error Adding New Section: '.$conn->error);
  }
}

function deleteSection($section_id){
  $conn = dbConnect();
  $sql = "Delete FROM sections WHERE id =$section_id";

  if($conn->query($sql)){
    header('refesh;0');
  } else {
    die ('Error deleting the product section:' . $conn->error);
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Section</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php 
  include "main-nav.php";
  ?>
  <main class="container">
    <div class="row justify-content-center">
      <div class="col-3">
        <h2 class="fw-light mb-3 text-center">Sections</h2>

        <!--FORM-->
        <div class="mb-3">
          <form action="" method="post">
            <div class="row gx-2">
              <div class="col">
                <input type="text" name="name" placeholder="Add a New Section Here.."
                class="form-control" max="50" required>
              </div>
                <div class="col-auto">
                  <button type="submit" name="btn_add" class="btn btn-info w-100 fw-bold">
                    <i class="fa-solid fa-plus"></i> Add
                  </button>
                </div>
              </div>
          </form>
            <?php
            if(isset($_POST['btn_add'])){
              $name = $_POST['name'];
              createSection($name);
            } 

            if(isset($_POST['btn_delete'])){
              $section_id = $_POST['btn_delete'];
              deleteSection($section_id);
            }
            ?>


        </div>

        <!--TABLE-->
        <table class="table table-sm align-middle text-center">
          <thead class="table-info">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
                  $all_sections = getAllSections();

                  while($section = $all_sections->fetch_assoc()){
                  // fetch_assoc() --> trasforms all the result from $all_sections into associative arrays
                  // $section is an associative array
                  // $section = ["id" => 1, "name" => "Snacks"];
            ?>

                    <tr>
                      <td> <?= $section['id'] ?></td>
                      <td> <?= $section['name'] ?></td>
                      <td>
                        <form action="" method="post">
                          <button type="submit" class="btn btn-outline-danger border-0" name="btn_delete" value="<?= $section['id'] ?>">
                          <i class="fa-solid fa-trash-can"></i>
                          </button>
                        </form>
                      </td>
                    </tr>

            <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
  <!-- <a href="logout.php" class="nav-link">Log out</a> -->
</body>
</html>