<?php
include "connect.php"; // Database connection
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Check if username already exists
        $checkQuery = mysqli_query($conn, "SELECT * FROM customer WHERE cuname = '$username'");
        if (mysqli_num_rows($checkQuery) > 0) {
            $error = "Username already exists. Please choose another.";
        } else {
            $hashed_password = md5($password); // Use md5 to match your current storage
            $default_name = $username; // Use username as name
            $insertQuery = "INSERT INTO customer (cuname, cpass, cname, cemail) VALUES ('$username', '$hashed_password', '$default_name', '$email')";
            if (mysqli_query($conn, $insertQuery)) {
                $success = "Registration successful. Redirecting to login...";
                echo "<script>
                    alert('Registration successful!');
                    window.location.href = 'login.php';
                </script>";
                exit();
            } else {
                $error = "Error occurred during registration. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - E-Basket Grocery</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #2e8b47 0%, #1f5f32 50%, #134d22 100%);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Floating Background Shapes */
    .floating-shapes {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }

    .shape {
      position: absolute;
      background: rgba(46, 139, 71, 0.2);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .shape:nth-child(1) {
      width: 80px;
      height: 80px;
      left: 10%;
      top: 20%;
      animation-delay: 0s;
      background: rgba(39, 174, 96, 0.15);
    }

    .shape:nth-child(2) {
      width: 120px;
      height: 120px;
      right: 10%;
      top: 60%;
      animation-delay: 2s;
      background: rgba(52, 152, 219, 0.1);
    }

    .shape:nth-child(3) {
      width: 60px;
      height: 60px;
      left: 60%;
      bottom: 20%;
      animation-delay: 4s;
      background: rgba(46, 139, 71, 0.25);
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0px) rotate(0deg);
      }
      50% {
        transform: translateY(-20px) rotate(180deg);
      }
    }

    .header {
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      padding: 25px 0;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(46, 139, 71, 0.3);
      z-index: 100;
    }

    .header::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      animation: rotate 15s linear infinite;
      z-index: 1;
    }

    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .header h1 {
      margin: 0;
      font-size: 2.2rem;
      font-weight: bold;
      position: relative;
      z-index: 2;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
      animation: slideInDown 0.8s ease-out;
    }

    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .header p {
      margin: 8px 0 0;
      font-size: 1.1rem;
      position: relative;
      z-index: 2;
      opacity: 0.95;
      animation: fadeInUp 0.8s ease-out 0.3s both;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .navbar {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      display: flex;
      justify-content: center;
      padding: 15px 0;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 200;
      animation: slideInUp 0.8s ease-out 0.6s both;
    }

    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .navbar a {
      text-decoration: none;
      color: #2e8b47;
      font-weight: 600;
      margin: 0 25px;
      font-size: 1.1rem;
      padding: 10px 20px;
      border-radius: 25px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar a::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      transition: left 0.4s ease;
      z-index: -1;
    }

    .navbar a:hover::before {
      left: 0;
    }

    .navbar a:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(46, 139, 71, 0.3);
    }

    .container {
      max-width: 450px;
      margin: 40px auto;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(19, 77, 34, 0.3);
      position: relative;
      z-index: 10;
      animation: scaleIn 0.6s ease-out 0.8s both;
      border: 1px solid rgba(46, 139, 71, 0.1);
    }

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .container::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(46, 139, 71, 0.08) 0%, transparent 70%);
      animation: rotate 20s linear infinite;
      z-index: -1;
    }

    h2 {
      text-align: center;
      color: #1f5f32;
      margin-bottom: 35px;
      font-size: 2rem;
      font-weight: 700;
      position: relative;
      animation: bounceIn 1s ease-out 1s both;
    }

    @keyframes bounceIn {
      0% {
        opacity: 0;
        transform: scale(0.3);
      }
      50% {
        opacity: 1;
        transform: scale(1.05);
      }
      70% {
        transform: scale(0.9);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

    h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      border-radius: 2px;
    }

    .form-group {
      position: relative;
      margin-bottom: 25px;
      animation: slideInRight 0.6s ease-out both;
    }

    .form-group:nth-child(1) { animation-delay: 1.2s; }
    .form-group:nth-child(2) { animation-delay: 1.3s; }
    .form-group:nth-child(3) { animation-delay: 1.4s; }
    .form-group:nth-child(4) { animation-delay: 1.5s; }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .input-container {
      position: relative;
      overflow: hidden;
      border-radius: 12px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 15px 20px 15px 50px;
      border: 2px solid #a8d5ba;
      border-radius: 12px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.9);
      position: relative;
      z-index: 2;
    }

    input:focus {
      outline: none;
      border-color: #2e8b47;
      box-shadow: 0 0 20px rgba(46, 139, 71, 0.25);
      background: white;
      transform: translateY(-2px);
    }

    input:focus + .input-icon {
      color: #2e8b47;
      transform: scale(1.1);
    }

    .input-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #27ae60;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      z-index: 3;
    }

    .input-line {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      transform: scaleX(0);
      transition: transform 0.3s ease;
      z-index: 3;
    }

    input:focus ~ .input-line {
      transform: scaleX(1);
    }

    .input-error {
      border-color: #e74c3c !important;
      box-shadow: 0 0 20px rgba(231, 76, 60, 0.2) !important;
      animation: shake 0.6s ease-in-out;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-10px); }
      75% { transform: translateX(10px); }
    }

    .error-message {
      color: #e74c3c;
      font-size: 0.9rem;
      margin-top: 8px;
      opacity: 0;
      transform: translateY(-10px);
      transition: all 0.3s ease;
    }

    .error-message.show {
      opacity: 1;
      transform: translateY(0);
    }

    .password-strength {
      margin-top: 8px;
      height: 4px;
      background: #e0e0e0;
      border-radius: 2px;
      overflow: hidden;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .password-strength.show {
      opacity: 1;
    }

    .strength-bar {
      height: 100%;
      width: 0%;
      background: #e74c3c;
      transition: all 0.3s ease;
      border-radius: 2px;
    }

    .strength-weak { width: 33%; background: #e74c3c; }
    .strength-medium { width: 66%; background: #f39c12; }
    .strength-strong { width: 100%; background: #27ae60; }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #27ae60;
      font-size: 1.1rem;
      transition: color 0.3s ease;
      z-index: 3;
    }

    .password-toggle:hover {
      color: #2e8b47;
    }

    button {
      width: 100%;
      padding: 18px;
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 20px;
      position: relative;
      overflow: hidden;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 8px 25px rgba(46, 139, 71, 0.3);
      animation: fadeIn 0.6s ease-out 1.6s both;
    }

    button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.6s ease;
    }

    button:hover::before {
      left: 100%;
    }

    button:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(46, 139, 71, 0.4);
      background: linear-gradient(135deg, #27ae60, #2ecc71);
    }

    button:active {
      transform: translateY(-1px);
    }

    button.loading {
      pointer-events: none;
      opacity: 0.8;
    }

    button.loading::after {
      content: '';
      position: absolute;
      width: 20px;
      height: 20px;
      margin: auto;
      border: 2px solid transparent;
      border-top-color: #ffffff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    @keyframes spin {
      0% { transform: translate(-50%, -50%) rotate(0deg); }
      100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .message {
      text-align: center;
      margin-top: 20px;
      font-size: 0.95rem;
      padding: 15px;
      border-radius: 10px;
      animation: messageSlide 0.5s ease-out;
      font-weight: 500;
    }

    @keyframes messageSlide {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .message.error {
      color: #721c24;
      background: linear-gradient(135deg, #f8d7da, #f5c6cb);
      border: 2px solid #f5c6cb;
    }

    .message.success {
      color: #155724;
      background: linear-gradient(135deg, #d4edda, #c3e6cb);
      border: 2px solid #c3e6cb;
    }

    .login-link {
      text-align: center;
      margin-top: 25px;
      animation: fadeIn 0.6s ease-out 1.7s both;
    }

    .login-link a {
      text-decoration: none;
      color: #2e8b47;
      font-weight: 600;
      transition: all 0.3s ease;
      position: relative;
    }

    .login-link a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      transition: width 0.3s ease;
    }

    .login-link a:hover::after {
      width: 100%;
    }

    .login-link a:hover {
      color: #1f5f32;
    }

    /* Success animation */
    .success-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(19, 77, 34, 0.8);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .success-animation {
      background: white;
      padding: 40px;
      border-radius: 15px;
      text-align: center;
      animation: successPop 0.6s ease-out;
      border: 3px solid #27ae60;
    }

    @keyframes successPop {
      0% {
        opacity: 0;
        transform: scale(0.5);
      }
      50% {
        transform: scale(1.1);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

    .success-icon {
      font-size: 3rem;
      color: #27ae60;
      margin-bottom: 15px;
      animation: checkmark 0.8s ease-out 0.3s both;
    }

    @keyframes checkmark {
      0% {
        opacity: 0;
        transform: rotate(-45deg) scale(0);
      }
      50% {
        opacity: 1;
        transform: rotate(-45deg) scale(1.2);
      }
      100% {
        opacity: 1;
        transform: rotate(0deg) scale(1);
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        margin: 20px;
        padding: 30px 25px;
      }
      
      .header h1 {
        font-size: 1.8rem;
      }
      
      .navbar {
        flex-wrap: wrap;
        gap: 10px;
      }
      
      .navbar a {
        margin: 5px 10px;
        font-size: 1rem;
        padding: 8px 16px;
      }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>
  <div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
  </div>

  <div class="success-overlay" id="successOverlay">
    <div class="success-animation">
      <div class="success-icon">
        <i class="fas fa-check-circle"></i>
      </div>
      <h3 style="color: #2e8b47;">Registration Successful!</h3>
      <p style="color: #1f5f32;">Welcome to E-Basket Grocery! Redirecting to login...</p>
    </div>
  </div>

  <!-- Header -->
  <div class="header">
    <h1><i class="fas fa-leaf"></i> Welcome to E-Basket Grocery</h1>
    <p>Select a category to explore products</p>
  </div>

  <!-- Navigation -->
  <div class="navbar">
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a href="cart.php"><i class="fas fa-shopping-cart"></i> View Cart</a>
    <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
  </div>

  <!-- Registration Form -->
  <div class="container">
    <h2><i class="fas fa-user-plus"></i> Create Account</h2>
    <form method="POST" id="registrationForm">
      <div class="form-group">
        <div class="input-container">
          <input type="text" name="username" id="username" placeholder="Enter username" required>
          <i class="fas fa-user input-icon"></i>
          <div class="input-line"></div>
        </div>
        <div class="error-message" id="usernameError"></div>
      </div>

      <div class="form-group">
        <div class="input-container">
          <input type="email" name="email" id="email" placeholder="Enter email address" required>
          <i class="fas fa-envelope input-icon"></i>
          <div class="input-line"></div>
        </div>
        <div class="error-message" id="emailError"></div>
      </div>

      <div class="form-group">
        <div class="input-container">
          <input type="password" name="password" id="password" placeholder="Enter password" required>
          <i class="fas fa-lock input-icon"></i>
          <i class="fas fa-eye password-toggle" id="togglePassword"></i>
          <div class="input-line"></div>
        </div>
        <div class="password-strength" id="passwordStrength">
          <div class="strength-bar" id="strengthBar"></div>
        </div>
        <div class="error-message" id="passwordError"></div>
      </div>

      <div class="form-group">
        <div class="input-container">
          <input type="password" name="confirm" id="confirm" placeholder="Confirm password" required>
          <i class="fas fa-lock input-icon"></i>
          <i class="fas fa-eye password-toggle" id="toggleConfirm"></i>
          <div class="input-line"></div>
        </div>
        <div class="error-message" id="confirmError"></div>
      </div>

      <button type="submit" id="submitBtn">
        <i class="fas fa-user-plus"></i> Create Account
      </button>

      <div class="login-link">
        <a href="login.php">Already have an account? Sign In</a>
      </div>
    </form>

    <?php if (!empty($error)): ?>
      <div class="message error"><?= $error ?></div>
    <?php elseif (!empty($success)): ?>
      <div class="message success"><?= $success ?></div>
    <?php endif; ?>
  </div>

  <script>
    // DOM Elements
    const form = document.getElementById('registrationForm');
    const usernameField = document.getElementById('username');
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');
    const confirmField = document.getElementById('confirm');
    const submitBtn = document.getElementById('submitBtn');
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirm = document.getElementById('toggleConfirm');
    const successOverlay = document.getElementById('successOverlay');

    // Password visibility toggles
    togglePassword.addEventListener('click', function() {
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });

    toggleConfirm.addEventListener('click', function() {
      const type = confirmField.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmField.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });

    // Password strength checker
    passwordField.addEventListener('input', function() {
      const password = this.value;
      const strengthIndicator = document.getElementById('passwordStrength');
      const strengthBar = document.getElementById('strengthBar');
      
      if (password.length > 0) {
        strengthIndicator.classList.add('show');
        
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        strengthBar.className = 'strength-bar';
        if (strength >= 1) strengthBar.classList.add('strength-weak');
        if (strength >= 2) strengthBar.classList.add('strength-medium');
        if (strength >= 3) strengthBar.classList.add('strength-strong');
      } else {
        strengthIndicator.classList.remove('show');
      }
      
      validatePassword();
    });

    // Form validation functions
    function validateUsername() {
      const username = usernameField.value.trim();
      const usernameError = document.getElementById('usernameError');
      
      if (username.length < 3) {
        usernameError.textContent = 'Username must be at least 3 characters long';
        usernameError.classList.add('show');
        usernameField.classList.add('input-error');
        return false;
      } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
        usernameError.textContent = 'Username can only contain letters, numbers, and underscores';
        usernameError.classList.add('show');
        usernameField.classList.add('input-error');
        return false;
      } else {
        usernameError.classList.remove('show');
        usernameField.classList.remove('input-error');
        return true;
      }
    }

    function validateEmail() {
      const email = emailField.value.trim();
      const emailError = document.getElementById('emailError');
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      
      if (!emailRegex.test(email)) {
        emailError.textContent = 'Please enter a valid email address';
        emailError.classList.add('show');
        emailField.classList.add('input-error');
        return false;
      } else {
        emailError.classList.remove('show');
        emailField.classList.remove('input-error');
        return true;
      }
    }

    function validatePassword() {
      const password = passwordField.value;
      const passwordError = document.getElementById('passwordError');
      
      if (password.length < 6) {
        passwordError.textContent = 'Password must be at least 6 characters long';
        passwordError.classList.add('show');
        passwordField.classList.add('input-error');
        return false;
      } else {
        passwordError.classList.remove('show');
        passwordField.classList.remove('input-error');
        return true;
      }
    }

    function validateConfirm() {
      const password = passwordField.value;
      const confirm = confirmField.value;
      const confirmError = document.getElementById('confirmError');
      
      if (password !== confirm) {
        confirmError.textContent = 'Passwords do not match';
        confirmError.classList.add('show');
        confirmField.classList.add('input-error');
        return false;
      } else {
        confirmError.classList.remove('show');
        confirmField.classList.remove('input-error');
        return true;
      }
    }

    // Real-time validation
    usernameField.addEventListener('blur', validateUsername);
    emailField.addEventListener('blur', validateEmail);
    passwordField.addEventListener('blur', validatePassword);
    confirmField.addEventListener('blur', validateConfirm);
    confirmField.addEventListener('input', validateConfirm);

    // Input focus effects
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
      input.addEventListener('focus', function() {
        this.closest('.input-container').classList.add('focused');
      });
      
      input.addEventListener('blur', function() {
        this.closest('.input-container').classList.remove('focused');
      });

      // Typing animation effect
      input.addEventListener('input', function() {
        this.style.transform = 'scale(1.01)';
        setTimeout(() => {
          this.style.transform = 'scale(1)';
        }, 100);
      });
    });

    // Enhanced form validation
    function validateForm() {
      const isUsernameValid = validateUsername();
      const isEmailValid = validateEmail();
      const isPasswordValid = validatePassword();
      const isConfirmValid = validateConfirm();

      return isUsernameValid && isEmailValid && isPasswordValid && isConfirmValid;
    }

    // Form submission with animations
    form.addEventListener('submit', function(e) {
      if (!validateForm()) {
        e.preventDefault();
        
        // Shake form if validation fails
        form.style.animation = 'shake 0.6s ease-in-out';
        setTimeout(() => {
          form.style.animation = '';
        }, 600);
        return;
      }

      // Show loading state
      submitBtn.classList.add('loading');
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
      submitBtn.disabled = true;

      // If no PHP errors, show success animation
      <?php if (!$error && $_SERVER["REQUEST_METHOD"] == "POST"): ?>
      e.preventDefault();
      setTimeout(() => {
        successOverlay.style.display = 'flex';
        setTimeout(() => {
          window.location.href = 'login.php';
        }, 2000);
      }, 1000);
      <?php endif; ?>
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
      // Enter to submit
      if (e.key === 'Enter' && document.activeElement.tagName !== 'BUTTON') {
        e.preventDefault();
        submitBtn.click();
      }
      
      // Escape to clear form
      if (e.key === 'Escape') {
        if (confirm('Clear the form?')) {
          form.reset();
          document.querySelectorAll('.error-message').forEach(error => {
            error.classList.remove('show');
          });
          document.querySelectorAll('.input-error').forEach(input => {
            input.classList.remove('input-error');
          });
          document.getElementById('passwordStrength').classList.remove('show');
        }
      }
    });

    // Add page entrance animation
    document.addEventListener('DOMContentLoaded', function() {
      // Remove any loading states on page load
      submitBtn.classList.remove('loading');
      submitBtn.innerHTML = '<i class="fas fa-user-plus"></i> Create Account';
      submitBtn.disabled = false;

      // Auto-focus first field
      setTimeout(() => usernameField.focus(), 1000);
    });
  </script>
</body>
</html>
