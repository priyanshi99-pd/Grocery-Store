<?php
session_start();
include "config.php"; // DB connection

// Redirect if already logged in
if (isset($_SESSION['ebcuser'])) {
    header("Location: index.php");
    exit();
}

// Handle login form
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = "SELECT * FROM customer WHERE cuname='$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['cpass'] === $password || $row['cpass'] === md5($password)) {
            $_SESSION['ebcuser'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - E-Basket Grocery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(135deg, #2e8b47 0%, #1f5f32 50%, #134d22 100%);
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
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

    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      position: relative;
      z-index: 10;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(19, 77, 34, 0.3);
      width: 100%;
      max-width: 420px;
      position: relative;
      overflow: hidden;
      animation: slideInUp 0.8s ease-out;
      border: 1px solid rgba(46, 139, 71, 0.1);
    }

    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-box::before {
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

    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .login-header {
      text-align: center;
      margin-bottom: 40px;
      animation: fadeInDown 0.8s ease-out 0.3s both;
    }

    .login-box h2 {
      font-size: 2.2rem;
      font-weight: 700;
      color: #1f5f32;
      margin-bottom: 10px;
      position: relative;
    }

    .login-box h2::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 3px;
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      border-radius: 2px;
    }

    .welcome-text {
      color: #2e8b47;
      font-size: 1rem;
      margin-top: 15px;
    }

    .form-group {
      position: relative;
      margin-bottom: 30px;
      animation: slideInLeft 0.6s ease-out both;
    }

    .form-group:nth-child(1) { animation-delay: 0.4s; }
    .form-group:nth-child(2) { animation-delay: 0.6s; }

    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .form-label {
      font-weight: 600;
      color: #1f5f32;
      margin-bottom: 8px;
      display: block;
      font-size: 0.95rem;
    }

    .input-container {
      position: relative;
    }

    .form-control {
      width: 100%;
      padding: 15px 20px 15px 50px;
      border: 2px solid #a8d5ba;
      border-radius: 12px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.9);
    }

    .form-control:focus {
      outline: none;
      border-color: #2e8b47;
      box-shadow: 0 0 20px rgba(46, 139, 71, 0.25);
      background: white;
      transform: translateY(-2px);
    }

    .input-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #27ae60;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      z-index: 10;
    }

    .form-control:focus + .input-icon {
      color: #2e8b47;
      transform: translateY(-50%) scale(1.1);
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

    .btn-login {
      width: 100%;
      padding: 15px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1.1rem;
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      border: none;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 20px;
      position: relative;
      overflow: hidden;
      animation: fadeIn 0.6s ease-out 0.8s both;
      box-shadow: 0 8px 25px rgba(46, 139, 71, 0.3);
    }

    .btn-login::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.6s ease;
    }

    .btn-login:hover::before {
      left: 100%;
    }

    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(46, 139, 71, 0.4);
      background: linear-gradient(135deg, #27ae60, #2ecc71);
    }

    .btn-login:active {
      transform: translateY(-1px);
    }

    .btn-login.loading {
      pointer-events: none;
      opacity: 0.8;
    }

    .btn-login.loading::after {
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

    .error-msg {
      background: linear-gradient(135deg, #ff6b6b, #ee5a52);
      color: white;
      padding: 15px;
      border-radius: 10px;
      margin-top: 20px;
      text-align: center;
      font-weight: 500;
      animation: errorSlide 0.5s ease-out;
      box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
    }

    @keyframes errorSlide {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .register-link {
      margin-top: 30px;
      text-align: center;
      font-size: 0.95rem;
      animation: fadeIn 0.6s ease-out 1s both;
    }

    .register-link a {
      color: #2e8b47;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      position: relative;
    }

    .register-link a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      transition: width 0.3s ease;
    }

    .register-link a:hover::after {
      width: 100%;
    }

    .register-link a:hover {
      color: #1f5f32;
    }

    .forgot-password {
      text-align: right;
      margin-top: 15px;
      animation: fadeIn 0.6s ease-out 0.9s both;
    }

    .forgot-password a {
      color: #27ae60;
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s ease;
    }

    .forgot-password a:hover {
      color: #2e8b47;
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
      .login-box {
        padding: 30px 25px;
        margin: 0 15px;
      }
      
      .login-box h2 {
        font-size: 1.8rem;
      }
      
      .form-control {
        padding: 12px 15px 12px 45px;
      }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* Password visibility toggle */
    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #27ae60;
      font-size: 1.1rem;
      transition: color 0.3s ease;
      z-index: 10;
    }

    .password-toggle:hover {
      color: #2e8b47;
    }

    .remember-me {
      display: flex;
      align-items: center;
      margin-top: 15px;
      font-size: 0.9rem;
      color: #1f5f32;
    }

    .remember-me input[type="checkbox"] {
      margin-right: 8px;
      transform: scale(1.1);
      accent-color: #2e8b47;
    }

    /* Additional green accents */
    .login-box h2 i {
      color: #27ae60;
      margin-right: 10px;
    }

    .form-label i {
      color: #2e8b47;
      margin-right: 5px;
    }

    /* Focus states for better accessibility */
    .form-control:focus {
      outline: 2px solid #2e8b47;
      outline-offset: 2px;
    }

    .btn-login:focus {
      outline: 2px solid #fff;
      outline-offset: 2px;
    }

    /* Enhanced hover effects for green theme */
    .login-box:hover {
      box-shadow: 0 20px 40px rgba(46, 139, 71, 0.2);
    }

    /* Green gradient for input focus */
    .form-control:focus {
      background: linear-gradient(135deg, #ffffff 0%, #f0f9f3 100%);
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
      <h3 style="color: #2e8b47;">Login Successful!</h3>
      <p style="color: #1f5f32;">Welcome back! Redirecting...</p>
    </div>
  </div>

  <?php include("header.php"); ?>
  
  <div class="form-container">
    <div class="login-box">
      <div class="login-header">
        <h2><i class="fas fa-user-circle"></i> Login</h2>
        <p class="welcome-text">Welcome back! Please sign in to your account</p>
      </div>

      <form id="loginForm" action="login.php" method="POST">
        <div class="form-group">
          <label for="username" class="form-label">
            <i class="fas fa-user"></i> Username
          </label>
          <div class="input-container">
            <input type="text" name="username" id="username" class="form-control" 
                   placeholder="Enter your username" required>
            <i class="fas fa-user input-icon"></i>
          </div>
          <div class="error-message" id="usernameError"></div>
        </div>

        <div class="form-group">
          <label for="password" class="form-label">
            <i class="fas fa-lock"></i> Password
          </label>
          <div class="input-container">
            <input type="password" name="password" id="password" class="form-control" 
                   placeholder="Enter your password" required>
            <i class="fas fa-lock input-icon"></i>
            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
          </div>
          <div class="error-message" id="passwordError"></div>
        </div>

        <div class="remember-me">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">Remember me</label>
        </div>

        <div class="forgot-password">
          <a href="#" onclick="showForgotPassword()">Forgot Password?</a>
        </div>

        <button type="submit" class="btn-login" id="loginBtn">
          <i class="fas fa-sign-in-alt"></i> Login
        </button>
      </form>

      <?php if ($error): ?>
        <div class="error-msg" id="serverError">
          <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
        </div>
      <?php endif; ?>

      <div class="register-link">
        New user? <a href="register.php">Create an account</a>
      </div>
    </div>
  </div>

  <script>
    // DOM Elements
    const form = document.getElementById('loginForm');
    const usernameField = document.getElementById('username');
    const passwordField = document.getElementById('password');
    const loginBtn = document.getElementById('loginBtn');
    const togglePassword = document.getElementById('togglePassword');
    const successOverlay = document.getElementById('successOverlay');

    // Password visibility toggle
    togglePassword.addEventListener('click', function() {
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      
      // Toggle icon
      if (type === 'password') {
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
      } else {
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
      }
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

    // Real-time validation
    usernameField.addEventListener('blur', validateUsername);
    passwordField.addEventListener('blur', validatePassword);

    // Input focus effects
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
      });
      
      input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
      });

      // Typing animation effect
      input.addEventListener('input', function() {
        this.style.transform = 'scale(1.01)';
        setTimeout(() => {
          this.style.transform = 'scale(1)';
        }, 100);
      });
    });

    // Form submission with animation
    form.addEventListener('submit', function(e) {
      // Client-side validation
      const isUsernameValid = validateUsername();
      const isPasswordValid = validatePassword();

      if (!isUsernameValid || !isPasswordValid) {
        e.preventDefault();
        
        // Shake form if validation fails
        form.style.animation = 'shake 0.6s ease-in-out';
        setTimeout(() => {
          form.style.animation = '';
        }, 600);
        return;
      }

      // Show loading state
      loginBtn.classList.add('loading');
      loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
      loginBtn.disabled = true;

      // If no PHP errors, show success animation
      <?php if (!$error && $_SERVER["REQUEST_METHOD"] == "POST"): ?>
      e.preventDefault();
      setTimeout(() => {
        successOverlay.style.display = 'flex';
        setTimeout(() => {
          window.location.href = 'index.php';
        }, 2000);
      }, 1000);
      <?php endif; ?>
    });

    // Auto-hide server error after 5 seconds
    const serverError = document.getElementById('serverError');
    if (serverError) {
      setTimeout(() => {
        serverError.style.opacity = '0';
        serverError.style.transform = 'translateY(-20px)';
      }, 5000);
    }

    // Remember me functionality
    const rememberCheckbox = document.getElementById('remember');
    const savedUsername = localStorage.getItem('rememberedUsername');
    
    if (savedUsername) {
      usernameField.value = savedUsername;
      rememberCheckbox.checked = true;
    }

    rememberCheckbox.addEventListener('change', function() {
      if (this.checked) {
        localStorage.setItem('rememberedUsername', usernameField.value);
      } else {
        localStorage.removeItem('rememberedUsername');
      }
    });

    // Save username when typing if remember is checked
    usernameField.addEventListener('input', function() {
      if (rememberCheckbox.checked) {
        localStorage.setItem('rememberedUsername', this.value);
      }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
      // Enter to submit
      if (e.key === 'Enter' && document.activeElement.tagName !== 'BUTTON') {
        e.preventDefault();
        loginBtn.click();
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
        }
      }
    });

    // Forgot password function
    function showForgotPassword() {
      const email = prompt('Please enter your email address:');
      if (email && email.includes('@')) {
        alert('Password reset instructions have been sent to your email.');
      } else if (email) {
        alert('Please enter a valid email address.');
      }
    }

    // Add page entrance animation
    document.addEventListener('DOMContentLoaded', function() {
      // Remove any loading states on page load
      loginBtn.classList.remove('loading');
      loginBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Login';
      loginBtn.disabled = false;

      // Auto-focus first empty field
      if (!usernameField.value) {
        setTimeout(() => usernameField.focus(), 500);
      } else if (!passwordField.value) {
        setTimeout(() => passwordField.focus(), 500);
      }
    });

    // Add smooth transitions for all interactive elements
    const animatedElements = document.querySelectorAll('.form-group, .register-link, .forgot-password');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.animationPlayState = 'running';
        }
      });
    });

    animatedElements.forEach(el => observer.observe(el));
  </script>
</body>
</html>
