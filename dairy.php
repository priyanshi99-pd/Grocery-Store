<?php
session_start();
include("../config.php");

// Redirect if user is not logged in
if (!isset($_SESSION['ebcuser'])) {
    header("Location: ../login.php");
    exit();
}

$cuname = $_SESSION['ebcuser'];
$category = "dairy"; // Table name
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dairy Products | EBC Grocery</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .product-card {
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      border-radius: 12px;
      padding: 15px;
      text-align: center;
      background-color: #fff;
    }
    .product-card img {
      height: 150px;
      object-fit: cover;
      margin-bottom: 10px;
      border-radius: 8px;
    }
    .cart-btn {
      background: #2d6a4f;
      color: white;
      border: none;
      padding: 8px 14px;
      border-radius: 6px;
    }
    .cart-btn:hover {
      background: #1b4332;
    }
    .logout-btn {
      float: right;
    }
  </style>
</head>
<body>
<?php include("../header.php"); ?>

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Welcome, <span style="color:#2d6a4f"><?= htmlspecialchars($cuname) ?></span> 🥛</h2>
  </div>

  <h3 class="mb-4 text-center">Available Dairy Products</h3>

  <div class="row g-4">
    <?php
      $sql = "SELECT * FROM dairy";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0):
        while ($product = $result->fetch_assoc()):
    ?>
      <div class="col-md-4">
        <div class="product-card">
          <img src="<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
          <h5><?= htmlspecialchars($product['name']) ?></h5>
          <p>Price: ₹<?= htmlspecialchars($product['price']) ?>/unit</p>
          <form method="POST" action="../addtocart_process.php">
              <input type="hidden" name="pid" value="<?= $product['id']; ?>">
              <input type="hidden" name="pname" value="<?= htmlspecialchars($product['name']); ?>">
              <input type="hidden" name="pprice" value="<?= $product['price']; ?>">
              <input type="number" name="pqty" value="1" min="1" class="form-control mb-2" required>
              <button type="submit" class="cart-btn">Add to Cart</button>
          </form>
        </div>
      </div>
    <?php
        endwhile;
      else:
        echo "<div class='col-12'><p class='text-danger text-center'>No dairy products found in stock.</p></div>";
      endif;
    ?>
  </div>
</div>

</body>
</html>
