<?php
session_start();
include "connect.php"; // Database connection

// Check if user is logged in
if (!isset($_SESSION['ebcuser'])) {
    header("Location: login.php");
    exit();
}

$cuname = $_SESSION['ebcuser'];

// Handle AJAX requests for quantity updates and item removal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    switch ($_POST['action']) {
        case 'update_quantity':
            $item_id = $_POST['item_id'];
            $new_quantity = max(1, intval($_POST['quantity']));
            
            $update_sql = "UPDATE temp_cart SET pqty = ? WHERE cuname = ? AND pid = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("isi", $new_quantity, $cuname, $item_id);
            $result = $stmt->execute();
            
            if ($result) {
                // Get updated totals
                $total_sql = "SELECT SUM(pprice * pqty) as grand_total FROM temp_cart WHERE cuname = ?";
                $total_stmt = $conn->prepare($total_sql);
                $total_stmt->bind_param("s", $cuname);
                $total_stmt->execute();
                $total_result = $total_stmt->get_result();
                $grand_total = $total_result->fetch_assoc()['grand_total'];
                
                echo json_encode(['success' => true, 'grand_total' => $grand_total]);
            } else {
                echo json_encode(['success' => false]);
            }
            exit();
            
        case 'remove_item':
            $item_id = $_POST['item_id'];
            
            $delete_sql = "DELETE FROM temp_cart WHERE cuname = ? AND pid = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("si", $cuname, $item_id);
            $result = $stmt->execute();
            
            if ($result) {
                // Get updated totals
                $total_sql = "SELECT SUM(pprice * pqty) as grand_total FROM temp_cart WHERE cuname = ?";
                $total_stmt = $conn->prepare($total_sql);
                $total_stmt->bind_param("s", $cuname);
                $total_stmt->execute();
                $total_result = $total_stmt->get_result();
                $grand_total = $total_result->fetch_assoc()['grand_total'] ?: 0;
                
                echo json_encode(['success' => true, 'grand_total' => $grand_total]);
            } else {
                echo json_encode(['success' => false]);
            }
            exit();
    }
}

// Fetch cart items
$sql = "SELECT * FROM temp_cart WHERE cuname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cuname);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Your Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      padding: 20px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .cart-container {
      max-width: 1000px;
      margin: auto;
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      position: relative;
      overflow: hidden;
    }
    
    .cart-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
      transition: left 0.5s;
    }
    
    .cart-container:hover::before {
      left: 100%;
    }
    
    .cart-header {
      display: flex;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 2px solid #e9ecef;
    }
    
    .cart-icon {
      font-size: 2rem;
      color: #28a745;
      margin-right: 15px;
      animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
      40% { transform: translateY(-10px); }
      60% { transform: translateY(-5px); }
    }
    
    .table th, .table td {
      vertical-align: middle;
      padding: 15px;
    }
    
    .table th {
      background: linear-gradient(135deg, #28a745, #20c997);
      color: white;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .cart-item-row {
      transition: all 0.3s ease;
      position: relative;
    }
    
    .cart-item-row:hover {
      background-color: #f8f9fa;
      transform: scale(1.01);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .qty-btn {
      background: #28a745;
      color: white;
      border: none;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: bold;
    }
    
    .qty-btn:hover {
      background: #218838;
      transform: scale(1.1);
      box-shadow: 0 3px 10px rgba(40, 167, 69, 0.3);
    }
    
    .qty-btn:active {
      transform: scale(0.95);
    }
    
    .qty-input {
      width: 60px;
      text-align: center;
      border: 2px solid #e9ecef;
      border-radius: 8px;
      font-weight: bold;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }
    
    .qty-input:focus {
      border-color: #28a745;
      box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    
    .remove-btn {
      background: #dc3545;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 8px 15px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    .remove-btn:hover {
      background: #c82333;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }
    
    .total-section {
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      border-radius: 10px;
      padding: 20px;
      margin-top: 20px;
      text-align: right;
      position: relative;
      overflow: hidden;
    }
    
    .total-amount {
      font-size: 1.5rem;
      font-weight: bold;
      color: #28a745;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
      animation: pulse 2s infinite;
    }
    
    .action-buttons {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 30px;
      gap: 15px;
    }
    
    .btn-animated {
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
      text-decoration: none;
    }
    
    .btn-animated::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    
    .btn-animated:hover::before {
      left: 100%;
    }
    
    .btn-animated:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    .empty-cart {
      text-align: center;
      padding: 60px 20px;
      color: #6c757d;
    }
    
    .empty-cart i {
      font-size: 4rem;
      margin-bottom: 20px;
      color: #dee2e6;
    }
    
    .loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    
    .loading-spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #f3f3f3;
      border-top: 5px solid #28a745;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .fade-out {
      opacity: 0;
      transform: translateX(100px);
      transition: all 0.5s ease;
    }
    
    .shake {
      animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }
    
    .success-message {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #28a745;
      color: white;
      padding: 15px 25px;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      z-index: 1001;
      opacity: 0;
      transform: translateX(100px);
      transition: all 0.3s ease;
    }
    
    .success-message.show {
      opacity: 1;
      transform: translateX(0);
    }
  </style>
</head>
<body>

<div class="loading-overlay" id="loadingOverlay">
  <div class="loading-spinner"></div>
</div>

<div class="success-message" id="successMessage">
  <i class="fas fa-check-circle"></i> Cart updated successfully!
</div>

<div class="cart-container">
  <div class="cart-header">
    <i class="fas fa-shopping-cart cart-icon"></i>
    <h2 class="mb-0">Your Shopping Cart</h2>
  </div>

  <?php if ($result->num_rows > 0): ?>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Product</th>
          <th>Price (₹)</th>
          <th>Quantity</th>
          <th>Total (₹)</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="cartTableBody">
        <?php 
          $count = 1;
          $grand_total = 0;
          while ($row = $result->fetch_assoc()): 
              $item_total = $row['pprice'] * $row['pqty'];
              $grand_total += $item_total;
        ?>
        <tr class="cart-item-row" data-item-id="<?= $row['pid']; ?>">
          <td><?= $count++; ?></td>
          <td>
            <strong><?= htmlspecialchars($row['pname']); ?></strong>
          </td>
          <td class="item-price">₹<?= number_format($row['pprice'], 2); ?></td>
          <td>
            <div class="quantity-controls">
              <button class="qty-btn" onclick="updateQuantity(<?= $row['pid']; ?>, -1)">
                <i class="fas fa-minus"></i>
              </button>
              <input type="number" class="qty-input" value="<?= $row['pqty']; ?>" 
                     min="1" max="99" onchange="updateQuantityDirect(<?= $row['pid']; ?>, this.value)"
                     data-original-value="<?= $row['pqty']; ?>">
              <button class="qty-btn" onclick="updateQuantity(<?= $row['pid']; ?>, 1)">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </td>
          <td class="item-total">₹<?= number_format($item_total, 2); ?></td>
          <td>
            <button class="remove-btn" onclick="removeItem(<?= $row['pid']; ?>)">
              <i class="fas fa-trash"></i> Remove
            </button>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <div class="total-section">
    <div class="total-amount" id="grandTotal">
      Grand Total: ₹<?= number_format($grand_total, 2); ?>
    </div>
  </div>

  <?php else: ?>
    <div class="empty-cart">
      <i class="fas fa-shopping-cart"></i>
      <h3>Your cart is empty</h3>
      <p>Start adding some items to see them here!</p>
    </div>
  <?php endif; ?>

  <div class="action-buttons">
    <a href="index.php" class="btn btn-success btn-lg btn-animated">
      <i class="fas fa-arrow-left"></i> Continue Shopping
    </a>
    <?php if ($result->num_rows > 0): ?>
    <a href="checkout.php" class="btn btn-primary btn-lg btn-animated">
      Proceed to Checkout <i class="fas fa-arrow-right"></i>
    </a>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Show loading overlay
function showLoading() {
    document.getElementById('loadingOverlay').style.display = 'flex';
}

// Hide loading overlay
function hideLoading() {
    document.getElementById('loadingOverlay').style.display = 'none';
}

// Show success message
function showSuccess(message = 'Cart updated successfully!') {
    const successEl = document.getElementById('successMessage');
    successEl.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
    successEl.classList.add('show');
    
    setTimeout(() => {
        successEl.classList.remove('show');
    }, 3000);
}

// Update quantity with +/- buttons
function updateQuantity(itemId, change) {
    const row = document.querySelector(`tr[data-item-id="${itemId}"]`);
    const qtyInput = row.querySelector('.qty-input');
    const currentQty = parseInt(qtyInput.value);
    const newQty = Math.max(1, currentQty + change);
    
    if (newQty !== currentQty) {
        qtyInput.value = newQty;
        updateQuantityDirect(itemId, newQty);
    }
}

// Update quantity directly from input
function updateQuantityDirect(itemId, newQuantity) {
    const qty = Math.max(1, parseInt(newQuantity));
    
    showLoading();
    
    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=update_quantity&item_id=${itemId}&quantity=${qty}`
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        
        if (data.success) {
            updateCartDisplay(itemId, qty, data.grand_total);
            showSuccess('Quantity updated!');
            
            // Add shake effect to the row
            const row = document.querySelector(`tr[data-item-id="${itemId}"]`);
            row.classList.add('shake');
            setTimeout(() => row.classList.remove('shake'), 500);
        } else {
            showError('Failed to update quantity');
        }
    })
    .catch(error => {
        hideLoading();
        console.error('Error:', error);
        showError('Something went wrong');
    });
}

// Remove item from cart
function removeItem(itemId) {
    if (!confirm('Are you sure you want to remove this item from your cart?')) {
        return;
    }
    
    const row = document.querySelector(`tr[data-item-id="${itemId}"]`);
    showLoading();
    
    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=remove_item&item_id=${itemId}`
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        
        if (data.success) {
            // Animate row removal
            row.classList.add('fade-out');
            setTimeout(() => {
                row.remove();
                updateGrandTotal(data.grand_total);
                
                // Check if cart is empty
                const remainingRows = document.querySelectorAll('.cart-item-row');
                if (remainingRows.length === 0) {
                    location.reload(); // Reload to show empty cart message
                }
            }, 500);
            
            showSuccess('Item removed from cart!');
        } else {
            showError('Failed to remove item');
        }
    })
    .catch(error => {
        hideLoading();
        console.error('Error:', error);
        showError('Something went wrong');
    });
}

// Update cart display after quantity change
function updateCartDisplay(itemId, newQty, grandTotal) {
    const row = document.querySelector(`tr[data-item-id="${itemId}"]`);
    const priceText = row.querySelector('.item-price').textContent;
    const price = parseFloat(priceText.replace('₹', '').replace(',', ''));
    const newTotal = price * newQty;
    
    // Update item total
    row.querySelector('.item-total').textContent = `₹${newTotal.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    
    // Update quantity input
    row.querySelector('.qty-input').value = newQty;
    
    // Update grand total
    updateGrandTotal(grandTotal);
}

// Update grand total display
function updateGrandTotal(grandTotal) {
    const totalEl = document.getElementById('grandTotal');
    totalEl.textContent = `Grand Total: ₹${parseFloat(grandTotal).toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    
    // Add pulse animation
    totalEl.classList.add('pulse');
    setTimeout(() => totalEl.classList.remove('pulse'), 1000);
}

// Show error message
function showError(message) {
    const successEl = document.getElementById('successMessage');
    successEl.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
    successEl.style.background = '#dc3545';
    successEl.classList.add('show');
    
    setTimeout(() => {
        successEl.classList.remove('show');
        successEl.style.background = '#28a745'; // Reset to success color
    }, 3000);
}

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'Enter') {
        // Ctrl+Enter to proceed to checkout
        const checkoutBtn = document.querySelector('a[href="checkout.php"]');
        if (checkoutBtn) {
            checkoutBtn.click();
        }
    }
});

// Add smooth animations on page load
document.addEventListener('DOMContentLoaded', function() {
    // Animate cart items on load
    const rows = document.querySelectorAll('.cart-item-row');
    rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            row.style.transition = 'all 0.5s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Auto-save quantity changes (debounced)
let quantityUpdateTimeout;
function debounceQuantityUpdate(itemId, quantity) {
    clearTimeout(quantityUpdateTimeout);
    quantityUpdateTimeout = setTimeout(() => {
        updateQuantityDirect(itemId, quantity);
    }, 1000);
}

// Add input validation
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('qty-input')) {
        const value = parseInt(e.target.value);
        const itemId = e.target.closest('tr').dataset.itemId;
        
        if (value >= 1 && value <= 99) {
            e.target.style.borderColor = '#28a745';
            debounceQuantityUpdate(itemId, value);
        } else {
            e.target.style.borderColor = '#dc3545';
        }
    }
});
</script>

</body>
</html>
