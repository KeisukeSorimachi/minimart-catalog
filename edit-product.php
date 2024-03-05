<?php
session_start();


require "connection.php";

$id = $_GET ['id']; //FROM the URL
$product = getProduct('id');

function getProduct($id) {
  $conn = dbConnect();
  $sql = "SELECT * FROM products WHERE id = $id";

  if ($result = $conn->query($sql)){
    return $result->fetch_assoc();
    //result only contain 1 row
    // transform it to associate arry 
  } else {
    die("Error retrieving the product:" .$conn->error);
  }
}

function getALLsections (){
  $conn = dbConnect();
  $sql = "SELECT * FROM sections";

  if($result = $conn->query($sql)) {
    return $result;
  } else {
    die ("Error retrieving all sections:" .$conn->error);
  }
}

function updateProduct($id, $name, $description, $price, $section_id){
  $conn = dbConnect();
  $sql = "UPDATE products
          SET NAME = '$name',
            description = '$description',
            price = $price,
            section_id = $section_id
          WHERE id = $id";

if ($conn->query($sql)){
  header("location: products.php");
  exit;
} else {
    die ("Error updating the product:" .$conn->error);
}
}

if (isset($_POST['btn_update'])){
  $id = $_GET['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $section_id = $_POST['section_id'];

  updateProduct ($id, $name, $description, $price, $section_id);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit Product</title>
</head>
<body>
    <?php
    include 'main-nav.php';
    ?>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
            <h2 class="fw-light mb-3">Edit Product</h2>

<form action="" method="post">
    <div class="mb-3">
        <label for="name" class="form-label small fw-bold">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= $product['name'] ?>" maxlength="50" required autofocus>

    </div>

    <div class="mb-3">
        <label for="description" class="form-label small fw-bold">Description</label>
        <textarea name="description" id="description" rows="5" class="form-control" required><?= $product['description'] ?></textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label small fw-bold">Price</label>
        <div class="input-group">
            <div class="input-group-text">$</div>
            <input type="number" name="price" id="price" class="form-control" value="<?= $product['price'] ?>" step="any" required>
        </div>
    </div>

    <div class="mb-4">
        <label for="section-id" class="form-label small fw-bold">Section</label>
        <select name="section_id" id="section-id" class="form-select" required>
            <option value="" hidden>Select Section</option>
            <?php 
            $all_sections = getALLsections();

            while ($section = $all_sections->fetch_assoc()){
              if ($section['id'] == $product['section_id']){
                echo
                    "<option value='" . $section['id']."'selected>"
                        .$section['name'] .
                    "</option>";
                   } else {
                    echo "<option value = '" . $section['id'] . "'>"
                        .$section['name'] . 
                    "<?optiomn>";
                   }
            }
            ?>
        </select>
    </div>

    <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" name="btn_update" class="btn btn-secondary fw-bold">
        <i class="fa-solid fa-check"></i> Save changes
    </button>
</form>
</div>
</div>
</main>
</body>
</html>