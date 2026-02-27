<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>E-Basket Grocery</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
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
      background: rgba(46, 139, 71, 0.08);
      border-radius: 50%;
      animation: float 8s ease-in-out infinite;
    }

    .shape:nth-child(1) {
      width: 60px;
      height: 60px;
      left: 5%;
      top: 15%;
      animation-delay: 0s;
    }

    .shape:nth-child(2) {
      width: 80px;
      height: 80px;
      right: 8%;
      top: 60%;
      animation-delay: 3s;
    }

    .shape:nth-child(3) {
      width: 40px;
      height: 40px;
      left: 70%;
      bottom: 25%;
      animation-delay: 6s;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0px) rotate(0deg);
      }
      50% {
        transform: translateY(-15px) rotate(180deg);
      }
    }

    .top-header {
      background: linear-gradient(135deg, #2e8b47, #27ae60);
      padding: 25px 0 15px;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(46, 139, 71, 0.3);
      z-index: 100;
    }

    .top-header::before {
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

    .top-header h1 {
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

    .top-header p {
      margin: 8px 0 15px;
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

    .header-icon {
      font-size: 1.5rem;
      margin-right: 10px;
      animation: bounce 2s infinite;
    }

    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
      40% { transform: translateY(-8px); }
      60% { transform: translateY(-4px); }
    }

    .nav-bar {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
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

    .nav-left, .nav-right {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .nav-bar a {
      text-decoration: none;
      color: #2e8b47;
      font-weight: 600;
      font-size: 1rem;
      padding: 10px 18px;
      border-radius: 25px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .nav-bar a::before {
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

    .nav-bar a:hover::before {
      left: 0;
    }

    .nav-bar a:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(46, 139, 71, 0.3);
    }

    .nav-bar a i {
      font-size: 1rem;
      transition: transform 0.3s ease;
    }

    .nav-bar a:hover i {
      transform: scale(1.2);
    }

    .nav-bar span {
      color: #2e8b47;
      font-weight: bold;
      font-size: 1rem;
      padding: 10px 15px;
      background: rgba(46, 139, 71, 0.1);
      border-radius: 20px;
      border: 2px solid #a8d5ba;
      animation: welcomePulse 2s infinite;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    @keyframes welcomePulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    .user-icon {
      color: #2e8b47;
      font-size: 1.1rem;
    }

    /* Mobile Navigation */
    .mobile-menu-toggle {
      display: none;
      flex-direction: column;
      cursor: pointer;
      padding: 5px;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .mobile-menu-toggle:hover {
      background: rgba(46, 139, 71, 0.1);
    }

    .mobile-menu-toggle span {
      width: 25px;
      height: 3px;
      background: #2e8b47;
      margin: 3px 0;
      transition: all 0.3s ease;
      border-radius: 2px;
    }

    .mobile-menu-toggle.active span:nth-child(1) {
      transform: rotate(-45deg) translate(-5px, 6px);
    }

    .mobile-menu-toggle.active span:nth-child(2) {
      opacity: 0;
    }

    .mobile-menu-toggle.active span:nth-child(3) {
      transform: rotate(45deg) translate(-5px, -6px);
    }

    .mobile-nav {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(15px);
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      padding: 20px;
      flex-direction: column;
      gap: 15px;
      animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .mobile-nav a {
      padding: 12px 20px !important;
      text-align: center;
      border: 1px solid rgba(46, 139, 71, 0.2);
      border-radius: 10px;
      margin: 0 !important;
    }

    .mobile-nav .user-greeting {
      background: rgba(46, 139, 71, 0.1);
      padding: 15px;
      border-radius: 10px;
      text-align: center;
      color: #2e8b47;
      font-weight: bold;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .top-header h1 {
        font-size: 1.8rem;
      }
      
      .top-header p {
        font-size: 1rem;
      }
      
      .nav-bar {
        padding: 12px 20px;
        position: relative;
      }
      
      .nav-left, .nav-right {
        display: none;
      }
      
      .mobile-menu-toggle {
        display: flex;
      }
      
      .mobile-nav.active {
        display: flex;
      }
    }

    @media (max-width: 480px) {
      .nav-bar {
        padding: 10px 15px;
      }
      
      .top-header {
        padding: 20px 10px 12px;
      }
      
      .top-header h1 {
        font-size: 1.6rem;
      }
    }

    /* Loading animation for page transitions */
    .page-loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.9);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .loader-spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #f3f3f3;
      border-top: 5px solid #2e8b47;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Notification system */
    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #2e8b47;
      color: white;
      padding: 15px 25px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      transform: translateX(400px);
      transition: transform 0.3s ease;
      z-index: 1000;
    }

    .notification.show {
      transform: translateX(0);
    }

    .notification.error {
      background: #dc3545;
    }

    .notification.success {
      background: #28a745;
    }
  </style>
</head>
<body>
  <!-- Floating Background Shapes -->
  <div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
  </div>

  <!-- Page Loader -->
  <div class="page-loader" id="pageLoader">
    <div class="loader-spinner"></div>
  </div>

  <!-- Notification -->
  <div class="notification" id="notification"></div>

  <!-- Header -->
  <div class="top-header">
    <h1>
      <i class="fas fa-shopping-basket header-icon"></i>
      Welcome to E-Basket Grocery
    </h1>
    <p>Select a category to explore products</p>
  </div>

  <!-- Navigation Menu -->
  <div class="nav-bar">
    <div class="nav-left">
      <a href="/grocery_1/grocery/index.php">
        <i class="fas fa-home"></i> Home
      </a>
      <a href="/grocery_1/grocery/cart_item.php">
        <i class="fas fa-shopping-cart"></i> View Cart
      </a>
      <a href="/grocery_1/grocery/about.php">
        <i class="fas fa-info-circle"></i> About Us
      </a>
      <a href="/grocery_1/grocery/contact.php">
        <i class="fas fa-envelope"></i> Contact
      </a>
    </div>
    
    <div class="nav-right">
      <?php if (isset($_SESSION['ebcuser'])): ?>
        <span>
          <i class="fas fa-user user-icon"></i>
          Hi, <?php echo htmlspecialchars($_SESSION['ebcuser']); ?>
        </span>
        <a href="logout.php">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      <?php else: ?>
        <a href="login.php">
          <i class="fas fa-sign-in-alt"></i> Login
        </a>
        <a href="register.php">
          <i class="fas fa-user-plus"></i> Register
        </a>
      <?php endif; ?>
    </div>

    <!-- Mobile Menu Toggle -->
    <div class="mobile-menu-toggle" id="mobileMenuToggle">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <!-- Mobile Navigation -->
    <div class="mobile-nav" id="mobileNav">
      <a href="/grocery_1/grocery/index.php">
        <i class="fas fa-home"></i> Home
      </a>
      <a href="/grocery_1/grocery/cart_item.php">
        <i class="fas fa-shopping-cart"></i> View Cart
      </a>
      <a href="/grocery_1/grocery/about.php">
        <i class="fas fa-info-circle"></i> About Us
      </a>
      <a href="/grocery_1/grocery/contact.php">
        <i class="fas fa-envelope"></i> Contact
      </a>
      
      <?php if (isset($_SESSION['ebcuser'])): ?>
        <div class="user-greeting">
          <i class="fas fa-user"></i>
          Hi, <?php echo htmlspecialchars($_SESSION['ebcuser']); ?>
        </div>
        <a href="logout.php">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      <?php else: ?>
        <a href="login.php">
          <i class="fas fa-sign-in-alt"></i> Login
        </a>
        <a href="register.php">
          <i class="fas fa-user-plus"></i> Register
        </a>
      <?php endif; ?>
    </div>
  </div>

  <script>
    // DOM Elements
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileNav = document.getElementById('mobileNav');
    const pageLoader = document.getElementById('pageLoader');
    const notification = document.getElementById('notification');

    // Mobile menu functionality
    mobileMenuToggle.addEventListener('click', function() {
      this.classList.toggle('active');
      mobileNav.classList.toggle('active');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
      if (!mobileMenuToggle.contains(e.target) && !mobileNav.contains(e.target)) {
        mobileMenuToggle.classList.remove('active');
        mobileNav.classList.remove('active');
      }
    });

    // Page transition loading
    const navLinks = document.querySelectorAll('.nav-bar a, .mobile-nav a');
    navLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        // Don't show loader for logout or same page
        if (this.href.includes('logout.php') || this.href === window.location.href) {
          return;
        }

        // Show loading animation
        pageLoader.style.display = 'flex';
        
        // Add click animation
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
          this.style.transform = '';
        }, 150);
      });
    });

    // Hide loader when page loads
    window.addEventListener('load', function() {
      pageLoader.style.display = 'none';
    });

    // Notification system
    function showNotification(message, type = 'success') {
      notification.textContent = message;
      notification.className = `notification ${type}`;
      notification.classList.add('show');
      
      setTimeout(() => {
        notification.classList.remove('show');
      }, 3000);
    }

    // Enhanced hover effects for navigation
    navLinks.forEach(link => {
      link.addEventListener('mouseenter', function() {
        const icon = this.querySelector('i');
        if (icon) {
          icon.style.transform = 'scale(1.2) rotate(10deg)';
        }
      });
      
      link.addEventListener('mouseleave', function() {
        const icon = this.querySelector('i');
        if (icon) {
          icon.style.transform = '';
        }
      });
    });

    // Smooth scroll for same-page links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // Add ripple effect to navigation links
    navLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = 30;
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
          position: absolute;
          border-radius: 50%;
          transform: scale(0);
          animation: ripple 0.6s linear;
          background-color: rgba(255, 255, 255, 0.6);
          width: ${size}px;
          height: ${size}px;
          left: ${x}px;
          top: ${y}px;
          pointer-events: none;
          z-index: 999;
        `;
        
        this.appendChild(ripple);
        
        setTimeout(() => {
          ripple.remove();
        }, 600);
      });
    });

    // Add ripple animation keyframes
    const style = document.createElement('style');
    style.textContent = `
      @keyframes ripple {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
      // Alt + H for Home
      if (e.altKey && e.key === 'h') {
        e.preventDefault();
        window.location.href = '/grocery_1/grocery/index.php';
      }
      
      // Alt + C for Cart
      if (e.altKey && e.key === 'c') {
        e.preventDefault();
        window.location.href = '/grocery_1/grocery/cart_item.php';
      }
      
      // Alt + M to toggle mobile menu
      if (e.altKey && e.key === 'm') {
        e.preventDefault();
        mobileMenuToggle.click();
      }
      
      // Escape to close mobile menu
      if (e.key === 'Escape') {
        mobileMenuToggle.classList.remove('active');
        mobileNav.classList.remove('active');
      }
    });

    // Add scroll effects to navigation
    let lastScrollTop = 0;
    window.addEventListener('scroll', function() {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const navBar = document.querySelector('.nav-bar');
      
      if (scrollTop > lastScrollTop) {
        // Scrolling down
        navBar.style.transform = 'translateY(-5px)';
        navBar.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
      } else {
        // Scrolling up
        navBar.style.transform = 'translateY(0)';
        navBar.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
      }
      
      lastScrollTop = scrollTop;
    });

    // Add entrance animations on page load
    document.addEventListener('DOMContentLoaded', function() {
      // Animate navigation items
      const navItems = document.querySelectorAll('.nav-left a, .nav-right a, .nav-right span');
      navItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
          item.style.transition = 'all 0.5s ease';
          item.style.opacity = '1';
          item.style.transform = 'translateY(0)';
        }, 100 * index);
      });
    });

  </script>
</body>
</html>
