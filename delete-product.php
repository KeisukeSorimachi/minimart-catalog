<?php
session_start();

require "connection.php";

$id = $_GET['id'];
$product = getProduct($id);

function getProduct($id){
    $conn = dbConnect();
    $sql = "SELECT `name` FROM products WHERE id = $id";

    if ($result = $conn->query($sql)) {
        return $result->fetch_assoc();
    } else {
        die("Error retrieving the product: " . $conn->error);
    }
}

function deleteProduct($id){
  $conn = dbConnect();
  $sql = "DELETE FROM products WHERE id = $id";

  if($conn->query($sql)) {
    header ("location: products.php ");
    exit;
  } else {
    die ("Error deleting the product: " . $conn->error);
  }
}

if(isset($_POST['btn_delete'])){
  $id = $_GET['id'];

  deleteProduct($id);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Delete Product</title>
</head>
<body>
    <?php
    include 'main-nav.php';
    ?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-triangle-exclamation text-warning display-4"></i>
                    <h2 class="fw-light mb-3 text-danger">Delete Product</h2>
                    <p class="fw-bold mb-0">
                      Are you sure you want to delete "<?= $product['name'] ?>" ?
                    </p>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="products.php" class="btn btn-secondary w-100">Cancel</a>
                    </div>
                    <div class="col">
                        <form action="" method="post">
                            <button type="submit" class="btn btn-outline-secondary w-100" name="btn_delete">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>