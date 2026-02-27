<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us - E-Basket Grocery</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding-top: 20px;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
    }

    .floating-shapes {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .shape {
      position: absolute;
      background: rgba(39, 174, 96, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .shape:nth-child(1) {
      width: 80px;
      height: 80px;
      left: 10%;
      animation-delay: 0s;
    }

    .shape:nth-child(2) {
      width: 120px;
      height: 120px;
      right: 10%;
      animation-delay: 2s;
    }

    .shape:nth-child(3) {
      width: 60px;
      height: 60px;
      left: 50%;
      bottom: 20%;
      animation-delay: 4s;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-20px);
      }
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, #2c3e50, #34495e);
      color: white;
      padding: 40px 20px;
      text-align: center;
      border-radius: 15px;
      max-width: 900px;
      margin: 30px auto;
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
      position: relative;
      overflow: hidden;
      animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      animation: rotate 20s linear infinite;
      z-index: 1;
    }

    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .hero h1 {
      font-size: 2.5rem;
      margin-bottom: 15px;
      position: relative;
      z-index: 2;
      animation: bounceIn 1s ease-out 0.3s both;
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

    .hero p {
      font-size: 1.3rem;
      color: #ecf0f1;
      position: relative;
      z-index: 2;
      animation: fadeInLeft 0.8s ease-out 0.6s both;
    }

    @keyframes fadeInLeft {
      from {
        opacity: 0;
        transform: translateX(-30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Main Container */
    .container-main {
      max-width: 900px;
      background: white;
      margin: 0 auto 60px;
      padding: 50px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.1);
      border-radius: 20px;
      position: relative;
      overflow: hidden;
      animation: scaleIn 0.6s ease-out 0.4s both;
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

    .container-main::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(46, 139, 71, 0.05), transparent);
      transition: left 0.6s ease;
    }

    .container-main:hover::before {
      left: 100%;
    }

    .container-main h2 {
      color: #2c3e50;
      font-size: 2rem;
      margin-bottom: 30px;
      text-align: center;
      position: relative;
    }

    .container-main h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: linear-gradient(135deg, #27ae60, #2e8b47);
      border-radius: 2px;
    }

    /* Form Styling */
    .form-group {
      position: relative;
      margin-bottom: 30px;
      animation: slideInRight 0.6s ease-out both;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }

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

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #2c3e50;
      font-size: 1rem;
      transition: color 0.3s ease;
      position: relative;
    }

    .input-container {
      position: relative;
      overflow: hidden;
      border-radius: 10px;
    }

    input, textarea {
      width: 100%;
      padding: 15px 20px;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      font-family: inherit;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: rgba(255,255,255,0.8);
      position: relative;
      z-index: 2;
    }

    input:focus, textarea:focus {
      outline: none;
      border-color: #27ae60;
      background: white;
      box-shadow: 0 0 20px rgba(39, 174, 96, 0.2);
      transform: translateY(-2px);
    }

    input:focus + .input-line, textarea:focus + .input-line {
      transform: scaleX(1);
    }

    .input-line {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background: linear-gradient(135deg, #27ae60, #2e8b47);
      transform: scaleX(0);
      transition: transform 0.3s ease;
      z-index: 3;
    }

    .input-icon {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #ccc;
      transition: all 0.3s ease;
      z-index: 4;
    }

    input:focus + .input-line + .input-icon,
    textarea:focus + .input-line + .input-icon {
      color: #27ae60;
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
      margin-top: 5px;
      opacity: 0;
      transform: translateY(-10px);
      transition: all 0.3s ease;
    }

    .error-message.show {
      opacity: 1;
      transform: translateY(0);
    }

    .char-count {
      text-align: right;
      font-size: 12px;
      color: #666;
      margin-top: 8px;
      transition: color 0.3s ease;
    }

    .char-count.warning {
      color: #f39c12;
    }

    .char-count.danger {
      color: #e74c3c;
    }

    /* Button Styling */
    .btn-container {
      text-align: center;
      margin-top: 40px;
      animation: fadeIn 0.6s ease-out 0.8s both;
    }

    button {
      position: relative;
      background: linear-gradient(135deg, #27ae60, #2e8b47);
      color: white;
      border: none;
      padding: 18px 40px;
      cursor: pointer;
      border-radius: 50px;
      font-size: 18px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
      transition: all 0.3s ease;
      overflow: hidden;
      min-width: 200px;
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
      box-shadow: 0 15px 35px rgba(39, 174, 96, 0.4);
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

    /* Success Message */
    #formMessage {
      margin-top: 30px;
      padding: 20px;
      border-radius: 10px;
      font-weight: 600;
      text-align: center;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.5s ease;
      position: relative;
      overflow: hidden;
    }

    #formMessage.success {
      background: linear-gradient(135deg, #d4edda, #c3e6cb);
      color: #155724;
      border: 2px solid #b8daff;
    }

    #formMessage.error {
      background: linear-gradient(135deg, #f8d7da, #f5c6cb);
      color: #721c24;
      border: 2px solid #f5c6cb;
    }

    #formMessage.show {
      opacity: 1;
      transform: translateY(0);
      animation: messageSlide 0.5s ease-out;
    }

    @keyframes messageSlide {
      from {
        opacity: 0;
        transform: scale(0.8) translateY(20px);
      }
      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    /* Info Section */
    .info {
      margin-top: 50px;
      animation: fadeInUp 0.8s ease-out 1s both;
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .info h2 {
      color: #2c3e50;
      margin-bottom: 20px;
      font-size: 1.8rem;
      text-align: center;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .info-item {
      padding: 15px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .info-item:hover {
      transform: translateY(-5px);
    }

    .info-icon {
      font-size: 1.5rem;
      color: #27ae60;
      width: 40px;
      text-align: center;
    }

    footer {
      text-align: center;
      margin-top: 50px;
      font-size: 14px;
      color: #666;
      padding: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container-main {
        margin: 0 20px 60px;
        padding: 30px 20px;
      }
      
      .hero h1 {
        font-size: 2rem;
      }
      
      .info-grid {
        grid-template-columns: 1fr;
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

  <!-- Hero Banner -->
  <header class="hero">
    <h1><i class="fas fa-envelope"></i> Get in Touch with E-Basket Grocery</h1>
    <p>We're here to help. Whether you have a question or just want to say hi!</p>
  </header>

  <!-- Main Contact Form -->
  <div class="container-main">
    <h2>Contact Us</h2>
    <form id="contactForm">
      <div class="form-group">
        <label for="name"><i class="fas fa-user"></i> Name</label>
        <div class="input-container">
          <input type="text" id="name" name="name" placeholder="Enter your full name..." required>
          <div class="input-line"></div>
          <div class="input-icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="error-message" id="nameError"></div>
      </div>

      <div class="form-group">
        <label for="email"><i class="fas fa-envelope"></i> Email</label>
        <div class="input-container">
          <input type="email" id="email" name="email" placeholder="Enter your email address..." required>
          <div class="input-line"></div>
          <div class="input-icon"><i class="fas fa-envelope"></i></div>
        </div>
        <div class="error-message" id="emailError"></div>
      </div>

      <div class="form-group">
        <label for="message"><i class="fas fa-comment"></i> Message</label>
        <div class="input-container">
          <textarea id="message" name="message" rows="6" placeholder="Tell us what's on your mind..." maxlength="500" required></textarea>
          <div class="input-line"></div>
          <div class="input-icon"><i class="fas fa-comment"></i></div>
        </div>
        <div class="char-count" id="charCount">0 / 500</div>
        <div class="error-message" id="messageError"></div>
      </div>

      <div class="btn-container">
        <button type="submit" id="submitBtn">
          <i class="fas fa-paper-plane"></i> Send Message
        </button>
      </div>
    </form>

    <div id="formMessage"></div>

    <div class="info">
      <h2><i class="fas fa-store"></i> Our Store Information</h2>
      <div class="info-grid">
        <div class="info-item">
          <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
          <div>
            <strong>Address</strong><br>
            VVNagar, Anand, Gujarat
          </div>
        </div>
        <div class="info-item">
          <div class="info-icon"><i class="fas fa-phone"></i></div>
          <div>
            <strong>Phone</strong><br>
            +91 98765-43210
          </div>
        </div>
        <div class="info-item">
          <div class="info-icon"><i class="fas fa-envelope"></i></div>
          <div>
            <strong>Email</strong><br>
            ebasket2@gmail.com
          </div>
        </div>
        <div class="info-item">
          <div class="info-icon"><i class="fas fa-clock"></i></div>
          <div>
            <strong>Hours</strong><br>
            Mon–Sat: 8am – 9pm<br>
            Sun: 9am – 6pm
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // DOM Elements
    const form = document.getElementById('contactForm');
    const messageBox = document.getElementById('formMessage');
    const messageField = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    const submitBtn = document.getElementById('submitBtn');
    const nameField = document.getElementById('name');
    const emailField = document.getElementById('email');

    // Character counter with enhanced feedback
    messageField.addEventListener('input', function() {
      const length = this.value.length;
      const maxLength = 500;
      
      charCount.textContent = `${length} / ${maxLength}`;
      
      // Color coding based on character count
      charCount.classList.remove('warning', 'danger');
      if (length > maxLength * 0.8) {
        charCount.classList.add('warning');
      }
      if (length > maxLength * 0.95) {
        charCount.classList.add('danger');
      }
      
      // Real-time validation
      validateMessage();
    });

    // Enhanced form validation functions
    function validateName() {
      const name = nameField.value.trim();
      const nameError = document.getElementById('nameError');
      
      if (name.length < 2) {
        nameError.textContent = 'Name must be at least 2 characters long';
        nameError.classList.add('show');
        nameField.classList.add('input-error');
        return false;
      } else if (!/^[a-zA-Z\s]+$/.test(name)) {
        nameError.textContent = 'Name should only contain letters and spaces';
        nameError.classList.add('show');
        nameField.classList.add('input-error');
        return false;
      } else {
        nameError.classList.remove('show');
        nameField.classList.remove('input-error');
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

    function validateMessage() {
      const message = messageField.value.trim();
      const messageError = document.getElementById('messageError');
      
      if (message.length < 10) {
        messageError.textContent = 'Message must be at least 10 characters long';
        messageError.classList.add('show');
        messageField.classList.add('input-error');
        return false;
      } else {
        messageError.classList.remove('show');
        messageField.classList.remove('input-error');
        return true;
      }
    }

    // Real-time validation on input
    nameField.addEventListener('blur', validateName);
    emailField.addEventListener('blur', validateEmail);
    messageField.addEventListener('blur', validateMessage);

    // Input focus animations
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
        this.closest('.form-group').querySelector('label').style.color = '#27ae60';
      });
      
      input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
        this.closest('.form-group').querySelector('label').style.color = '#2c3e50';
      });
    });

    // Form submission with enhanced animations
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      // Validate all fields
      const isNameValid = validateName();
      const isEmailValid = validateEmail();
      const isMessageValid = validateMessage();

      if (!isNameValid || !isEmailValid || !isMessageValid) {
        // Shake form if validation fails
        form.style.animation = 'shake 0.6s ease-in-out';
        setTimeout(() => {
          form.style.animation = '';
        }, 600);

        showMessage('Please fix the errors above', 'error');
        return;
      }

      // Show loading state
      submitBtn.classList.add('loading');
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
      submitBtn.disabled = true;

      // Simulate sending (replace with actual AJAX call)
      setTimeout(() => {
        // Success animation
        submitBtn.classList.remove('loading');
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Message Sent!';
        submitBtn.style.background = 'linear-gradient(135deg, #27ae60, #2ecc71)';

        showMessage('🎉 Thank you! Your message has been sent successfully!', 'success');
        
        // Reset form with animation
        setTimeout(() => {
          form.reset();
          charCount.textContent = '0 / 500';
          submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
          submitBtn.style.background = 'linear-gradient(135deg, #27ae60, #2e8b47)';
          submitBtn.disabled = false;
        }, 2000);

      }, 2000);
    });

    // Enhanced message display function
    function showMessage(text, type) {
      messageBox.textContent = text;
      messageBox.className = `${type} show`;
      
      // Auto-hide after 5 seconds
      setTimeout(() => {
        messageBox.classList.remove('show');
      }, 5000);
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
      // Ctrl + Enter to submit form
      if (e.ctrlKey && e.key === 'Enter') {
        e.preventDefault();
        submitBtn.click();
      }
      
      // Escape to clear form
      if (e.key === 'Escape') {
        if (confirm('Are you sure you want to clear the form?')) {
          form.reset();
          charCount.textContent = '0 / 500';
          
          // Clear all error states
          document.querySelectorAll('.error-message').forEach(error => {
            error.classList.remove('show');
          });
          document.querySelectorAll('.input-error').forEach(input => {
            input.classList.remove('input-error');
          });
        }
      }
    });

    // Auto-save draft functionality
    function saveFormData() {
      const formData = {
        name: nameField.value,
        email: emailField.value,
        message: messageField.value
      };
      localStorage.setItem('contactFormDraft', JSON.stringify(formData));
    }

    function loadFormData() {
      const savedData = localStorage.getItem('contactFormDraft');
      if (savedData) {
        const formData = JSON.parse(savedData);
        nameField.value = formData.name || '';
        emailField.value = formData.email || '';
        messageField.value = formData.message || '';
        charCount.textContent = `${messageField.value.length} / 500`;
      }
    }

    // Auto-save on input
    inputs.forEach(input => {
      input.addEventListener('input', saveFormData);
    });

    // Load saved data on page load
    document.addEventListener('DOMContentLoaded', loadFormData);

    // Clear draft on successful submission
    form.addEventListener('submit', function() {
      localStorage.removeItem('contactFormDraft');
    });
  </script>

<?php
// End output buffer and flush content
ob_end_flush();
?>
</body>
</html>
