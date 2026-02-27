<footer class="grocery-footer">
  <div class="grocery-contact-strip">
    <div class="contact-item">
      <span class="contact-icon phone">&#128222;</span>
      <span>
        <strong>Phone</strong><br>
        +91 98765-43210
      </span>
    </div>
    <div class="contact-item">
      <span class="contact-icon email">&#9993;</span>
      <span>
        <strong>Email</strong><br>
        ebasket2@gmail.com
      </span>
    </div>
    <div class="contact-item">
      <span class="contact-icon loc">&#128205;</span>
      <span>
        <strong>Location</strong><br>
        VVNagar, Anand, Gujarat
      </span>
    </div>
  </div>

  <div class="grocery-footer-main" align="center">
    <div class="footer-section social-section">
      <h3>SOCIAL PAGES</h3>
      <div class="footer-divider"></div>
      <!-- Font Awesome CDN -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
      <div class="social-icons">
        <a href="https://instagram.com/yourpage" target="_blank" aria-label="Instagram">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="https://facebook.com/yourpage" target="_blank" aria-label="Facebook">
          <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="https://twitter.com/yourpage" target="_blank" aria-label="Twitter">
          <i class="fa-brands fa-twitter"></i>
        </a>
      </div>
    </div>
    <div class="footer-section links">
      <h3>USEFUL LINKS</h3>
      <div class="footer-divider"></div>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="viewcart.php">View Cart</a></li>
      </ul>
    </div>
    <div class="footer-section contact-info">
      <h3>CONTACT INFORMATION</h3>
      <div class="footer-divider"></div>
      <p>
        VVNagar, Anand, Gujarat<br>
        +91 98765-43210<br>
        ebasket2@gmail.com
      </p>
    </div>
  </div>
</footer>

<style>
.grocery-footer {
  background: #fff;
  color: #232e19;
  font-family: "Segoe UI", Arial, sans-serif;
  letter-spacing: .01em;
  border-top: 2px solid #b8f3c7;
  font-size: 20px;
}
.grocery-contact-strip {
  background: linear-gradient(90deg, #2ebf64 0%, #2d6a4f 100%);
  color: #fff;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  border-radius: 0 0 52px 52px / 0 0 44px 44px;
  box-shadow: 0 4px 24px rgba(45, 69, 37, 0.08);
  padding: 36px 0 24px 0;
  gap: 46px;
  font-size: 18px;
}
.contact-item {
  display: flex;
  align-items: center;
  gap: 15px;
  min-width: 210px;
  font-size: 1.03em;
}
.contact-icon {
  background: #f2ffe8;
  color: #2f6e14;
  border-radius: 12px;
  padding: 13px;
  font-size: 2em;
  box-shadow: 0 2px 12px rgba(45, 69, 37, 0.09);
  display: flex;
  align-items: center;
  justify-content: center;
}
.grocery-footer-main {
  display: flex;
  max-width: 1280px;
  margin: 38px auto 0 auto;
  gap: 32px;
  padding: 0 36px 24px 36px;
  justify-content: flex-start;
  flex-wrap: wrap;
  border-bottom: 1px solid #b8f3c7;
}
.footer-section {
  flex: 1 1 270px;
  min-width: 240px;
  margin-bottom: 20px;
}
.footer-section h3 {
  font-size: 1.2rem;
  margin-bottom: 5px;
  color: #297734;
  letter-spacing: .06em;
  text-transform: uppercase;
}
.footer-divider {
  width: 40px;
  border-top: 2px solid #57c95a;
  margin-bottom: 13px;
}
.footer-section ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
.footer-section ul li {
  margin-bottom: 8px;
  font-size: 1em;
}
.footer-section a {
  color: #297734;
  text-decoration: none;
  border-bottom: 1px dotted #85e899cc;
  transition: color .2s;
  font-size: 20px;
}
.footer-section a:hover {
  color: #226d20;
  border-bottom: 1px solid #000000ff;
}
.footer-section p {
  color: #297734;
  font-size: 1rem;
  margin: 0;
  margin-bottom: 8px;
  font-size: 20px;
}
.footer-section.social-section {
  display: flex;
  flex-direction: column;
  align-items: center;
}
/* --- SOCIAL ICONS VERTICAL --- */
.social-icons {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 15px;
  margin: 20px 0 0 0;
  align-items: flex-start;
}
.social-icons a {
  text-decoration: none;
}
.social-icons i {
  font-size: 1.8rem;
  color: #297734;
  transition: color 0.2s, transform 0.2s;
  padding: 12px;
  border-radius: 50%;
  background: #eafce7;
  box-shadow: 0 2px 8px rgba(46,191,100,0.07);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 0px;
  border-bottom: 2px dotted #eafce7;
}
.social-icons i:hover {
  color: #fff;
  background: #2ebf64;
  transform: scale(1.14);
}

.grocery-footer-bottom {
  text-align: center;
  background: #f8fff7;
  color: #297734;
  font-size: 1rem;
  letter-spacing: .05em;
  padding: 16px 0 9px 0;
  border-top: 1.5px solid #b8f3c7;
  font-weight: 500;
}

/* Responsive Design */
@media (max-width: 1080px) {
  .grocery-footer-main { flex-direction: column; gap: 24px; padding: 0 16px 24px 16px; }
  .footer-section { min-width: 100%; }
  .social-icons { align-items: flex-start; }
}
</style>
