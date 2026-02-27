<?php
session_start();
include "connect.php";

if (!isset($_SESSION['ebcuser'])) {
    header("location: login.php");
    exit();
}

$cuname = $_SESSION['ebcuser'];

// Handle form submission first
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {

    $shippingAddress = trim($_POST['shipping_address']);
    if (strlen($shippingAddress) < 10) {
        echo "<script>alert('Please enter a valid shipping address (at least 10 characters).'); window.history.back();</script>";
        exit();
    }

    $insertSQL = "INSERT INTO bill (cuname, product_name, quantity, price, total) VALUES (?, ?, ?, ?, ?)";
    $insertBill = $conn->prepare($insertSQL);
    if ($insertBill === false) {
        die("Prepare failed for INSERT: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt = $conn->prepare("SELECT pname, pqty, pprice FROM temp_cart WHERE cuname = ?");
    $stmt->bind_param("s", $cuname);
    $stmt->execute();
    $resultInsert = $stmt->get_result();

    if ($resultInsert->num_rows == 0) {
        echo "<script>alert('Your cart is empty.'); window.location='cart_item.php';</script>";
        exit();
    }

    while ($row = $resultInsert->fetch_assoc()) {
        $pname = $row['pname'];
        $pqty = $row['pqty'];
        $pprice = $row['pprice'];
        $total = $pqty * $pprice;

        if (!$insertBill->bind_param("ssidd", $cuname, $pname, $pqty, $pprice, $total)) {
            die("bind_param failed: (" . $insertBill->errno . ") " . $insertBill->error);
        }
        if (!$insertBill->execute()) {
            die("Execute failed for INSERT: (" . $insertBill->errno . ") " . $insertBill->error);
        }
    }
    $insertBill->close();

    $clearCart = $conn->prepare("DELETE FROM temp_cart WHERE cuname = ?");
    if ($clearCart === false) {
        die("Prepare failed for DELETE: (" . $conn->errno . ") " . $conn->error);
    }
    $clearCart->bind_param("s", $cuname);
    if (!$clearCart->execute()) {
        die("Execute failed for DELETE: (" . $clearCart->errno . ") " . $clearCart->error);
    }
    $clearCart->close();

    $conn->close();

    echo "<script>alert('Checkout successful! Your order has been placed.'); window.location='cart_item.php';</script>";
    exit();
}

// Show checkout page if not POST
$sql = "SELECT pid, pname, pprice, pqty FROM temp_cart WHERE cuname = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed for SELECT: (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("s", $cuname);

if (!$stmt->execute()) {
    die("Execute failed for SELECT: (" . $stmt->errno . ") " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Your cart is empty.'); window.location='cart_item.php';</script>";
    exit();
}

$subtotal = 0;
$gstPercentage = 0.05;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Checkout</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #e6f2e6; /* soft green background */
    margin: 0;
    padding: 0;
}
.checkout-container {
    max-width: 750px;
    background: #f9fff9; /* very light green */
    margin: 40px auto;
    padding: 30px 40px;
    box-shadow: 0 6px 20px rgba(23, 122, 47, 0.3);
    border-radius: 12px;
}
h1 {
    text-align: center;
    color: #176a25; /* darker green */
    margin-bottom: 1.8rem;
}
.user-info {
    font-size: 18px;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #a6d8a8; /* pale green line */
    color: #2a5d21;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
}
th, td {
    padding: 12px 10px;
    border-bottom: 1px solid #c0ddb0; /* soft green border */
    text-align: left;
    font-size: 15px;
    color: #3b5e20;
}
th {
    background-color: #117a2f; /* medium green */
    color: white;
    font-weight: bold;
}
tfoot tr td {
    font-weight: 700;
    font-size: 18px;
    color: #145214;
}
label {
    display: block;
    margin: 15px 0 6px 0;
    font-weight: 600;
    color: #2e652e;
}
input[type="text"], textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #9ed99e;
    border-radius: 8px;
    font-size: 16px;
    resize: vertical;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}
input[type="text"]:focus, textarea:focus {
    border-color: #117a2f;
    outline: none;
}
.btn {
    width: 100%;
    max-width: 320px;
    background-color: #117a2f;
    color: #fff;
    padding: 15px;
    font-size: 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin: 25px auto 0;
    display: block;
    box-shadow: 0 4px 12px rgba(23, 122, 47, 0.5);
    transition: background-color 0.3s, color 0.3s;
    text-align: center;
}
.btn:hover {
    background-color: #fff;
    color: #117a2f;
    border: 2px solid #117a2f;
}
</style>
<script>
function confirmCheckout() {
    const addr = document.getElementById('shipping_address').value.trim();
    if(addr.length < 10) {
        alert("Please enter a valid shipping address (at least 10 characters).");
        return false;
    }
    return confirm("Are you sure you want to place the order?");
}
</script>
</head>
<body>
<div class="checkout-container">
    <h1>Checkout</h1>
    <div class="user-info">Logged in as: <strong><?php echo htmlspecialchars($cuname); ?></strong></div>
    <form method="post" onsubmit="return confirmCheckout()">
        <table>
            <thead>
                <tr><th>Product</th><th>Quantity</th><th>Price per Unit</th><th>Total</th></tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $pname = $row['pname'];
                    $pqty = $row['pqty'];
                    $pprice = $row['pprice'];
                    $total = $pqty * $pprice;
                    $subtotal += $total;
                    echo "<tr>
                    <td>" . htmlspecialchars($pname) . "</td>
                    <td>$pqty</td>
                    <td>₹" . number_format($pprice, 2) . "</td>
                    <td>₹" . number_format($total, 2) . "</td>
                    </tr>";
                }
                $gst = $subtotal * $gstPercentage;
                $grandtotal = $subtotal + $gst;
                ?>
            </tbody>
            <tfoot>
                <tr><td colspan="3" style="text-align:right;">Subtotal:</td><td>₹<?php echo number_format($subtotal, 2); ?></td></tr>
                <tr><td colspan="3" style="text-align:right;">GST (5%):</td><td>₹<?php echo number_format($gst, 2); ?></td></tr>
                <tr><td colspan="3" style="text-align:right; font-weight: 700;">Grand Total:</td><td>₹<?php echo number_format($grandtotal, 2); ?></td></tr>
            </tfoot>
        </table>
        <label for="shipping_address">Shipping Address</label>
        <textarea id="shipping_address" name="shipping_address" rows="4" placeholder="Enter your full shipping address" required></textarea>
        <button class="btn" type="submit" name="place_order">Place Order</button>
    </form>
</div>
</body>
</html>
