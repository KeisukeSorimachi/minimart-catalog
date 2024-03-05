<?php
session_start();

if (!$_SESSION['id']) {
  header("location: logout.php");
  exit;
}

require "connection.php";

function getAllProducts() {
  $conn = dbConnect();
  // SQL Query for SELECTING WITH TWO TABLES USING INNER JOIN
  $sql = "SELECT products.id AS id, products.name AS `name`,`description`, price, sections.name AS section
         FROM products
         INNER JOIN sections
         ON products.section_id = sections.id
         ORDER BY products.id DESC";
         
  if($result = $conn->query($sql)){
          return $result;
      } else {
          die("Error retrieving all products: " . $conn->error);
      }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php 
  include 'main-nav.php';
  ?>
  <main class="container">
    <div class="row mb-4">
      <div class="col">
        <h2 class="fw-light">Products</h2>
      </div>
      <div class="col text-end">
      <!-- //VS Code shortcut for adding button: a.btn.btn-success>i.fa-solid.fa-plus-circle -->
        <a href="add-product.php" class="btn btn-success"><i class="fa-solid fa-plus-circle"></i> New Product</a>
      </div>
    </div>
    <table class="table table-hover align-middle border">
      <thead class="small table-success">
          <th>ID</th>
          <th style="width: 250px">NAME</th>
          <th>Description</th>
          <th>PRICE</th>
          <th>SECTION</th>
          <th style="width: 95px"></th>
      </thead>
      <tbody>
        <?php
        $all_products = getAllProducts();
        while($products = $all_products->fetch_assoc()){
          ?>
          <tr>
            <td><?= $products['id'] ?></td>
            <td><?= $products['name'] ?></td>
            <td><?= $products['description'] ?></td>
            <td><?= $products['price'] ?></td>
            <td><?= $products['section'] ?></td>
          

          <td>
            <a href="edit-product.php?id=<?= $products['id']?>" 
            class="btn btn-outline-secondary btn-sm" title= "Edit">
              <i class="fa-solid fa-pencil-alt"></i>  
            </a>
            <a href="delete-product.php?id=<?= $products['id']?>" 
            class="btmn-btn-outline-danger btn-sm" title="Delete">
              <i class="fa-solid fa-trash-can"></i>  
          </a>
          </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </main>
</body>
</html>