<nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px">
    <div class="container">
      <!-- Brand -->
      <a href="products.php" class="navbar-brand">
        <h1 class="h4 mb-0 text-uppercase">Minimart Catalog</h1>
      </a>

      <!-- Links -->
      <ul class="navbar-nav">
          <!-- VS shortcut code for multiplying elements and elements inside: 
            li.nav-item*2>a.nav-link li.nav-item*2>a.nav-link -->
          <li class="nav-item"><a href="products.php" class="nav-link">Products</a></li>
          <li class="nav-item"><a href="sections.php" class="nav-link">Sections</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
            <!-- PHP shorthand code where it means < ?php echo $a?> ; < ?=$_SESSION['full_name'] ?> -->
          <li class="nav-item fw-bold"><a href="profile.php" class="nav-link"><?= $_SESSION['full_name'] ?></a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link">Log out</a></li>
      </ul>
    </div>
</nav>