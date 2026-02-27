<?php
  include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - E-Basket Grocery</title>
  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f9fdf9;
      color: #333;
    }
    h2 {
      color: #117a2f;
      margin-bottom: 10px;
      text-align: center;
    }
    .about-header {
      text-align: center;
      padding: 30px 20px;   
      margin-bottom: 30px; 
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.8s ease-out;
    }
    .about-header.animate {
      opacity: 1;
      transform: translateY(0);
    }
    .about-header h2 {
      font-size: 36px;
      margin-bottom: 10px;
    }
    .about-header p {
      font-size: 18px;
      max-width: 600px;
      margin: 0 auto;
      opacity: 0.95;
    }
    .section {
      padding: 60px 20px;
      max-width: 1200px;
      margin: auto;
    }
    .about-section {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      justify-content: center;
      max-width: 1000px;
      margin: 0 auto;
    }
    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      flex: 1;
      min-width: 280px;
      max-width: 340px;
      padding: 25px;
      text-align: center;
      border-top: 4px solid #117a2f;
      transition: transform 0.3s, box-shadow 0.3s, opacity 0.6s ease-out;
      opacity: 0;
      transform: translateY(50px);
    }
    .card.animate {
      opacity: 1;
      transform: translateY(0);
    }
    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 18px rgba(0,0,0,0.15);
    }
    .card h3 { color: #117a2f; margin-bottom: 12px; }
    .card ul { list-style: none; padding: 0; text-align: left; }
    .card ul li::before {
      content: "✔ ";
      color: #117a2f;
    }
    .stats {
      background: linear-gradient(to right, #e8f5e9, #f1f8e9);
      display: flex;
      justify-content: center;
      gap: 60px;
      text-align: center;
      flex-wrap: wrap;
      padding: 50px 20px;
      border-radius: 10px;
      opacity: 0;
      transform: scale(0.9);
      transition: all 0.8s ease-out;
    }
    .stats.animate {
      opacity: 1;
      transform: scale(1);
    }
    .stats div {
      flex: 1;
      min-width: 180px;
    }
    .stats h3 {
      font-size: 34px;
      color: #117a2f;
      counter-reset: num var(--num);
    }
    .stats h3::before {
      content: counter(num);
      animation: countUp 2s ease-out forwards;
    }
    @keyframes countUp {
      from { --num: 0; }
      to { --num: var(--target); }
    }
    /* --- TIMELINE STYLE --- */
    .timeline {
      position: relative;
      max-width: 900px;
      margin: 50px auto;
      padding: 40px 0;
    }
    .timeline::before {
      content: '';
      position: absolute;
      left: 50%;
      top: 0;
      transform: translateX(-50%);
      width: 4px;
      height: 100%;
      background: #117a2f;
      border-radius: 2px;
      opacity: 0;
      animation: drawLine 1s ease-out forwards;
    }
    @keyframes drawLine {
      to { opacity: 1; }
    }
    .timeline-item {
      padding: 0 40px;
      position: relative;
      width: 50%;
      box-sizing: border-box;
      margin-bottom: 50px;
      opacity: 0;
      transform: translateX(-50px);
      transition: all 0.6s ease-out;
    }
    .timeline-item.animate {
      opacity: 1;
      transform: translateX(0);
    }
    .timeline-item.left {
      left: 0;
      text-align: right;
    }
    .timeline-item.right {
      left: 50%;
      text-align: left;
      transform: translateX(50px);
    }
    .timeline-item.right.animate {
      transform: translateX(0);
    }
    .timeline-dot {
      position: absolute;
      top: 15px;
      left: 100%;
      transform: translate(-50%, -50%);
      width: 20px;
      height: 20px;
      background: #fff;
      border: 4px solid #117a2f;
      border-radius: 50%;
      z-index: 1;
      transition: all 0.3s ease;
    }
    .timeline-item:hover .timeline-dot {
      transform: translate(-50%, -50%) scale(1.2);
      box-shadow: 0 0 20px rgba(17, 122, 47, 0.5);
    }
    .timeline-item.right .timeline-dot {
      left: 0;
      transform: translate(-50%, -50%);
    }
    .timeline-item.right:hover .timeline-dot {
      transform: translate(-50%, -50%) scale(1.2);
    }
    .timeline-date {
      font-weight: bold;
      color: #117a2f;
      margin-bottom: 5px;
      font-size: 18px;
    }
    .timeline-content {
      background: #fff;
      padding: 15px 20px;
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.11);
      display: inline-block;
      max-width: 320px;
      transition: transform 0.3s ease;
    }
    .timeline-item:hover .timeline-content {
      transform: scale(1.05);
    }
    @media (max-width: 700px) {
      .about-section { flex-direction: column; }
      .timeline::before {
        left: 25px;
      }
      .timeline-item, .timeline-item.left, .timeline-item.right {
        width: 100%;
        padding-left: 55px;
        padding-right: 10px;
        text-align: left;
        left: 0;
      }
      .timeline-dot, .timeline-item.right .timeline-dot {
        left: 25px;
        top: 15px;
        transform: translate(0, -50%);
      }
    }
    .team {
      display: flex;
      gap: 25px;
      flex-wrap: wrap;
      justify-content: center;
    }
    .team-member {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      padding: 20px;
      text-align: center;
      width: 220px;
      transition: transform 0.3s, box-shadow 0.3s, opacity 0.6s ease-out;
      opacity: 0;
      transform: translateY(30px);
    }
    .team-member.animate {
      opacity: 1;
      transform: translateY(0);
    }
    .team-member:hover {
      transform: translateY(-10px) scale(1.05);
      box-shadow: 0 8px 18px rgba(0,0,0,0.15);
    }
    .team-member img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      border: 4px solid #117a2f;
      object-fit: cover;
      margin-bottom: 10px;
      transition: transform 0.3s ease;
    }
    .team-member:hover img {
      transform: rotate(5deg);
    }
    .team-member h4 { color: #117a2f; margin: 5px 0; }
    .testimonials {
      background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
      padding: 50px 20px;
      text-align: center;
      border-radius: 12px;
      margin: 50px auto;
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.8s ease-out;
    }
    .testimonials.animate {
      opacity: 1;
      transform: translateY(0);
    }
    .testimonial {
      max-width: 600px;
      margin: auto;
      font-style: italic;
      position: relative;
      color: #333;
    }
    .testimonial::before,
    .testimonial::after {
      font-size: 40px;
      color: #117a2f;
      position: absolute;
      opacity: 0;
      animation: fadeIn 1s ease-out 0.5s forwards;
    }
    @keyframes fadeIn {
      to { opacity: 1; }
    }
    .testimonial::before {
      /* content: """; */
      left: -25px;
      top: -10px;
    }
    .testimonial::after {
      /* content: """; */
      right: -25px;
      bottom: -10px;
    }
    .testimonial strong {
      display: block;
      margin-top: 12px;
      font-weight: bold;
      color: #117a2f;
    }
    footer {
      background: #117a2f;
      color: #fff;
      text-align: center;
      padding: 15px;
    }
    
    /* Scroll Progress Bar */
    .scroll-progress {
      position: fixed;
      top: 0;
      left: 0;
      width: 0%;
      height: 4px;
      background: linear-gradient(to right, #117a2f, #4caf50);
      z-index: 1000;
      transition: width 0.1s ease;
    }
  </style>
</head>
<body>
  <!-- Scroll Progress Bar -->
  <div class="scroll-progress" id="scrollProgress"></div>

  <!-- Top Intro -->
  <div class="about-header" id="aboutHeader">
    <h2>About E-Basket Grocery</h2>
    <p>Freshness, Quality, and Care – Bringing the marketplace to your doorstep since 2010.</p>
  </div>
  
  <!-- Who We Are / Mission / Why Choose Us -->
  <div class="section about-section" id="aboutSection">
    <div class="card" data-delay="0">
      <h3>Who We Are</h3>
      <p>E-Basket Grocery is your trusted neighborhood supermarket with farm-fresh produce, dairy, and essentials.</p>
    </div>
    <div class="card" data-delay="200">
      <h3>Our Mission</h3>
      <p>Deliver quality groceries affordably while supporting local farmers & promoting eco-friendly living.</p>
    </div>
    <div class="card" data-delay="400">
      <h3>Why Choose Us?</h3>
      <ul>
        <li>Fresh & organic products</li>
        <li>Affordable prices & offers</li>
        <li>Free delivery above ₹500</li>
        <li>24/7 customer support</li>
      </ul>
    </div>
  </div>
  
  <!-- Stats -->
  <div class="stats" id="statsSection">
    <div><h3 data-target="1000">0</h3><p>Fresh Products</p></div>
    <div><h3 data-target="50">0</h3><p>Daily Deliveries</p></div>
    <div><h3 data-target="2000">0</h3><p>Happy Customers</p></div>
  </div>
  
  <!-- Journey Timeline -->
  <div class="section">
    <h2>Our Journey</h2>
    <div class="timeline" id="timelineSection">
      <div class="timeline-item left" data-delay="0">
        <div class="timeline-dot"></div>
        <div class="timeline-date">2010</div>
        <div class="timeline-content">Started as a small family-run grocery shop.</div>
      </div>
      <div class="timeline-item right" data-delay="300">
        <div class="timeline-dot"></div>
        <div class="timeline-date">2015</div>
        <div class="timeline-content">Expanded to an online delivery service.</div>
      </div>
      <div class="timeline-item left" data-delay="600">
        <div class="timeline-dot"></div>
        <div class="timeline-date">2020</div>
        <div class="timeline-content">Launched mobile app for easy ordering.</div>
      </div>
      <div class="timeline-item right" data-delay="900">
        <div class="timeline-dot"></div>
        <div class="timeline-date">2023</div>
        <div class="timeline-content">Serving 20,000+ happy families daily.</div>
      </div>
    </div>
  </div>
  
  <!-- Team -->
  <div class="section">
    <h2>Meet Our Team</h2>
    <div class="team" id="teamSection">
      <div class="team-member" data-delay="0">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Founder">
        <h4>Rajesh Kumar</h4>
        <p>Founder & CEO</p>
      </div>
      <div class="team-member" data-delay="200">
        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Manager">
        <h4>Priya Singh</h4>
        <p>Store Manager</p>
      </div>
      <div class="team-member" data-delay="400">
        <img src="https://randomuser.me/api/portraits/men/56.jpg" alt="Delivery Head">
        <h4>Amit Sharma</h4>
        <p>Delivery Head</p>
      </div>
    </div>
  </div>
  
  <!-- Testimonials -->
  <div class="testimonials" id="testimonialsSection">
    <h2>What Our Customers Say</h2>
    <div class="testimonial">
      <p>"E-Basket always delivers fresh vegetables and fruits on time. The quality is excellent and prices are affordable!"</p>
      <strong>- Neha Patel</strong>
    </div>
  </div>
  
  <!-- Footer -->
  <?php include "footer.php"?>

  <script>
    // Scroll Progress Bar
    function updateScrollProgress() {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
      const scrollProgress = (scrollTop / scrollHeight) * 100;
      document.getElementById('scrollProgress').style.width = scrollProgress + '%';
    }

    // Intersection Observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const element = entry.target;
          const delay = element.dataset.delay || 0;
          
          setTimeout(() => {
            element.classList.add('animate');
          }, delay);
          
          // Counter animation for stats
          if (element.id === 'statsSection') {
            animateCounters();
          }
        }
      });
    }, observerOptions);

    // Counter Animation
    function animateCounters() {
      const counters = document.querySelectorAll('.stats h3');
      counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60 FPS
        let current = 0;
        
        const updateCounter = () => {
          current += increment;
          if (current < target) {
            counter.textContent = Math.floor(current);
            requestAnimationFrame(updateCounter);
          } else {
            counter.textContent = target + (target === 2000 ? '+' : '');
          }
        };
        
        updateCounter();
      });
    }

    // Smooth scroll for internal links
    function smoothScroll(targetId) {
      const target = document.getElementById(targetId);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    }

    // Initialize animations on page load
    document.addEventListener('DOMContentLoaded', function() {
      // Observe elements for scroll animations
      const elementsToObserve = [
        document.getElementById('aboutHeader'),
        document.getElementById('statsSection'),
        document.getElementById('testimonialsSection'),
        ...document.querySelectorAll('.card'),
        ...document.querySelectorAll('.timeline-item'),
        ...document.querySelectorAll('.team-member')
      ];

      elementsToObserve.forEach(el => {
        if (el) observer.observe(el);
      });

      // Scroll progress bar
      window.addEventListener('scroll', updateScrollProgress);

      // Add hover effects to timeline items
      const timelineItems = document.querySelectorAll('.timeline-item');
      timelineItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
          this.style.transform += ' scale(1.02)';
        });
        
        item.addEventListener('mouseleave', function() {
          this.style.transform = this.style.transform.replace(' scale(1.02)', '');
        });
      });

      // Parallax effect for header
      window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const header = document.getElementById('aboutHeader');
        if (header) {
          header.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
      });
    });

    // Add click animations to cards
    document.querySelectorAll('.card').forEach(card => {
      card.addEventListener('click', function() {
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
          this.style.transform = '';
        }, 150);
      });
    });
  </script>
</body>
</html>
