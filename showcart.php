<?php
session_start();
include "connect.php";

if (!isset($_SESSION['ebcuser'])) {
    header("location: login.php");
    exit();
}

$uname = $_SESSION['ebcuser'];
$uname = $_SESSION['ebcuser'];
$res = mysqli_query($con, "SELECT temp_cart.pid, pname, pprice, pdesc, pimage 
                           FROM product, temp_cart 
                           WHERE temp_cart.USER = '$uname' 
                           AND temp_cart.pid = product.pid 
                           AND STATUS = 'AddedInCart'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Custom Cart Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">🛒 Grocery Shop</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCart" aria-controls="navbarCart" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCart">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Home Button -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
      </ul>

      <!-- Search Form -->
      <form class="d-flex" action="searchproduct.php" method="GET">
        <input class="form-control me-2" type="search" name="query" placeholder="Search products..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <!-- Optional: User greeting -->
      <ul class="navbar-nav ms-3">
        <li class="nav-item">
          <span class="nav-link disabled text-light">Hello, <?php echo $_SESSION['ebcuser']; ?></span>
        </li>
      </ul>

    </div>
  </div>
</nav>

<!-- Add some top margin to avoid overlap -->
<br><br><br><br>

<div class="container my-4">
  <div class="row my-4">
    <div class="col-12">
      <center><h2>Your Cart is Having Following Items</h2></center>
      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">Product No</th>
            <th scope="col">Product Name</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Price (in ₹)</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total = 0;
          while ($row = mysqli_fetch_array($res)) {
              $imgname = basename($row[4]); // Clean image path
              echo "<tr>";
              echo "<th scope='row'>{$row[0]}</th>";
              echo "<td>{$row[1]}</td>";
              echo "<td>{$row[3]}</td>";
              echo "<td><img src='uploads/$imgname' height='40px' width='40px'></td>";
              echo "<td>₹{$row[2]}</td>";
              echo "<td><a href='deleteproduct.php?pid={$row[0]}' class='btn btn-danger btn-sm'>Delete</a></td>";
              echo "</tr>";
              $total += $row[2];
          }

          $gst = $total * 0.18;
          $grandTotal = $total + $gst;

          echo "<tr><td colspan='4' class='text-end'><strong>Sub Total ₹</strong></td><td colspan='2'>₹" . number_format($total, 2) . "</td></tr>";
          echo "<tr><td colspan='4' class='text-end'><strong>GST (18%) ₹</strong></td><td colspan='2'>₹" . number_format($gst, 2) . "</td></tr>";
          echo "<tr><td colspan='4' class='text-end'><strong>Grand Total ₹</strong></td><td colspan='2'>₹" . number_format($grandTotal, 2) . "</td></tr>";
          ?>
          <tr>
            <td colspan="6" class="text-center">
              <a onclick="window.print()" href="checkout.php?st=<?php echo $total; ?>" class="btn btn-success btn-lg">🖨️ Print & Checkout</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>

<?php



?>
