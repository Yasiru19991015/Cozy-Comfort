
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
         
            <div class="footer-col">
                <div class="footer-brand">
                    <img src="src/logo12.png" alt="Cozy Comfort Logo" class="footer-logo">
                    <span class="company-name">Cozy Comfort</span>
                </div>
                <p class="footer-about">
                    Premium manufacturer of high-quality blankets and textiles for ultimate relaxation and comfort.
                </p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
        
            <div class="footer-col">
                <h5 class="footer-title">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="AboutUs.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="Shop.php"><i class="fas fa-chevron-right"></i> Our Products</a></li>
                    <li><a href="Freelancer/freelanceregister.php"><i class="fas fa-chevron-right"></i> Materials</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Sustainability</a></li>
                    <li><a href="ContactUs.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
                </ul>
            </div>
            
      
            <div class="footer-col">
                <h5 class="footer-title">Customer Service</h5>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right"></i> FAQ</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Shipping Policy</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Returns & Exchanges</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Care Instructions</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Size Guide</a></li>
                </ul>
            </div>
            
     
            <div class="footer-col">
                <h5 class="footer-title">Stay Cozy</h5>
                <div class="footer-newsletter">
                    <p>Subscribe for exclusive offers, new collections, and cozy tips.</p>
                    <form class="newsletter-form" id="newsletterForm">
                        <input type="email" class="newsletter-input" placeholder="Your email address" required>
                        <button type="submit" class="newsletter-btn">
                            <i class="fas fa-paper-plane"></i> Subscribe
                        </button>
                    </form>
                    <p class="privacy-note">We respect your privacy. Unsubscribe at any time.</p>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="copyright">&copy; <span id="current-year"></span> Cozy Comfort. All rights reserved.</div>
            <div class="legal-links">
                <a href="#">Terms of Service</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>

<style>

    :root {
        --footer-bg: #5D4037;
        --footer-text: #D7CCC8;
        --footer-light: #8D6E63;
        --footer-dark: #3E2723;
        --footer-accent: #FF7043;
        --footer-primary: #5D4037;
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .footer {
        background-color: var(--footer-bg);
        color: var(--footer-text);
        padding: 4rem 0 1.5rem;
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
        position: relative;
        overflow: hidden;
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--footer-accent), var(--footer-primary));
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 1;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2.5rem;
        margin-bottom: 3rem;
    }

    .footer-col {
        padding: 0 1rem;
    }

    .footer-brand {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        gap: 0.75rem;
    }

    .footer-logo {
        width: 50px;
        height: 50px;
        object-fit: contain;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        transition: var(--transition);
    }

    .footer-brand:hover .footer-logo {
        transform: rotate(-5deg) scale(1.05);
    }

    .company-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        letter-spacing: -0.5px;
    }

    .footer-about {
        color: var(--footer-light);
        line-height: 1.7;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .footer-social {
        display: flex;
        gap: 0.75rem;
    }

    .footer-social a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.1);
        color: white;
        transition: var(--transition);
    }

    .footer-social a:hover {
        background-color: var(--footer-accent);
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .footer-title {
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, var(--footer-accent), var(--footer-primary));
    }

    .footer-links {
        list-style: none;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .footer-links a {
        color: var(--footer-light);
        text-decoration: none;
        transition: var(--transition);
        display: flex;
        align-items: center;
        font-size: 0.95rem;
        padding: 0.25rem 0;
    }

    .footer-links a:hover {
        color: white;
        transform: translateX(5px);
    }

    .footer-links i {
        margin-right: 0.5rem;
        font-size: 0.7rem;
        color: var(--footer-accent);
        transition: var(--transition);
    }

    .footer-links a:hover i {
        transform: rotate(90deg);
    }

    .footer-newsletter p {
        color: var(--footer-light);
        margin-bottom: 1rem;
        line-height: 1.7;
        font-size: 0.95rem;
    }

    .newsletter-form {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .newsletter-input {
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 8px;
        background-color: rgba(255,255,255,0.1);
        color: white;
        font-family: inherit;
        transition: var(--transition);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .newsletter-input:focus {
        outline: none;
        border-color: var(--footer-accent);
        background-color: rgba(255,255,255,0.15);
        box-shadow: 0 0 0 3px rgba(255, 112, 67, 0.2);
    }

    .newsletter-input::placeholder {
        color: rgba(255,255,255,0.5);
    }

    .newsletter-btn {
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, var(--footer-accent), var(--footer-primary));
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-weight: 500;
        font-family: inherit;
    }

    .newsletter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }

    .privacy-note {
        font-size: 0.75rem;
        color: var(--footer-light);
        margin-top: 0.5rem;
        opacity: 0.7;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        text-align: center;
    }

    .copyright {
        color: var(--footer-light);
        font-size: 0.85rem;
    }

    .legal-links {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .legal-links a {
        color: var(--footer-light);
        text-decoration: none;
        font-size: 0.85rem;
        transition: var(--transition);
        position: relative;
    }

    .legal-links a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background-color: var(--footer-accent);
        transition: var(--transition);
    }

    .legal-links a:hover {
        color: white;
    }

    .legal-links a:hover::after {
        width: 100%;
    }


    @media (min-width: 768px) {
        .footer-bottom {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            text-align: left;
        }

        .newsletter-form {
            flex-direction: row;
        }

        .newsletter-input {
            flex: 1;
            min-width: 200px;
        }

        .newsletter-btn {
            width: auto;
        }
    }

    @media (max-width: 480px) {
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .footer-col {
            padding: 0;
        }

        .footer-title {
            margin-bottom: 1rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
   
        document.getElementById('current-year').textContent = new Date().getFullYear();

 
        const newsletterForm = document.getElementById('newsletterForm');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const emailInput = this.querySelector('input[type="email"]');
       
                if (emailInput.value && emailInput.value.includes('@')) {
                  
                    alert('Thank you for subscribing to our newsletter!');
                    emailInput.value = '';
                } else {
                    alert('Please enter a valid email address.');
                }
            });
        }

        
        const footerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                    footerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.footer-col').forEach(col => {
            footerObserver.observe(col);
        });
    });
</script>