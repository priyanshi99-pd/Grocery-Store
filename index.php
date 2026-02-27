<?php
session_start();
include "../connect.php";

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Redirect if already logged in
if (isset($_SESSION['ebauser'])) {
    header("Location: admindashboard.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['txtUser']);
    $password = trim($_POST['txtPass']);
    
    // Simple direct query (for debugging)
    $query = "SELECT * FROM admin WHERE TRIM(uname) = '" . mysqli_real_escape_string($conn, $username) . "' AND TRIM(upass) = '" . mysqli_real_escape_string($conn, $password) . "'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['ebauser'] = $username;
        echo "<script>alert('Login Successful!'); window.location='admindashboard.php';</script>";
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center" style="margin-top: 150px;">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Admin Login</h4>
                    
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($error_message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- IMPORTANT: Make sure form action is correct -->
                    <form method="POST" action="index.php">
                        <div class="mb-3">
                            <label for="txtUser" class="form-label">Username</label>
                            <input type="text" class="form-control" id="txtUser" name="txtUser" 
                                   value="<?php echo isset($_POST['txtUser']) ? htmlspecialchars($_POST['txtUser']) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="txtPass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="txtPass" name="txtPass" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>