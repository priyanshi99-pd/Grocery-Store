<?php
session_start();
include "connect.php";

// Step 1: Check if user is logged in
if (!isset($_SESSION['ebcuser'])) {
    echo "Please log in to add items to your cart.";
    exit;
}

$cuname = $_SESSION['ebcuser'];

// Step 2: Validate POST input
if (
    isset($_POST['pid'], $_POST['pname'], $_POST['pprice'], $_POST['pqty']) &&
    is_numeric($_POST['pid']) &&
    is_numeric($_POST['pprice']) &&
    is_numeric($_POST['pqty']) &&
    !empty(trim($_POST['pname']))
) {
    $pid = (int)$_POST['pid'];
    $pname = trim($_POST['pname']);
    $pprice = (float)$_POST['pprice'];
    $pqty = (int)$_POST['pqty'];

    // Get referrer
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';

    // Step 3: Check if product already in cart
    $check_sql = "SELECT * FROM temp_cart WHERE cuname = ? AND pid = ?";
    $stmt = $conn->prepare($check_sql);
    if (!$stmt) {
        die("Check Query Failed: " . $conn->error);
    }
    $stmt->bind_param("si", $cuname, $pid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Product already in cart — update quantity
        $update_sql = "UPDATE temp_cart SET pqty = pqty + ? WHERE cuname = ? AND pid = ?";
        $update_stmt = $conn->prepare($update_sql);
        if (!$update_stmt) {
            die("Update Query Failed: " . $conn->error);
        }
        $update_stmt->bind_param("isi", $pqty, $cuname, $pid);

        if ($update_stmt->execute()) {
            $update_stmt->close();
            $stmt->close();
            $conn->close();
            header("Location: $referrer"); // Go back to the calling page (e.g., vegetable.php)
            exit;
        } else {
            die("Error updating cart: " . $update_stmt->error);
        }
    } else {
        // Product not in cart — insert new entry
        $insert_sql = "INSERT INTO temp_cart (cuname, pid, pname, pprice, pqty)
                       VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        if (!$insert_stmt) {
            die("Insert Query Failed: " . $conn->error);
        }
        $insert_stmt->bind_param("sisdi", $cuname, $pid, $pname, $pprice, $pqty);

        if ($insert_stmt->execute()) {
            $insert_stmt->close();
            $stmt->close();
            $conn->close();
            header("Location: $referrer"); // Redirect back after adding
            exit;
        } else {
            die("Error adding item to cart: " . $insert_stmt->error);
        }
    }

    // Step 4: Cleanup
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid input data.";
}
?>
