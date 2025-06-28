<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cozy Comfort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #5D4037;
            --accent: #FF7043; 
            --secondary: #26A69A; 
            --light-bg: #FFF8F0; 
            --text-dark: #3E2723; 
            --text-light: #8D6E63; 
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            --shadow-sm: 0 2px 8px rgba(93, 64, 55, 0.1);
            --shadow-md: 0 4px 20px rgba(93, 64, 55, 0.15);
            --shadow-lg: 0 8px 30px rgba(93, 64, 55, 0.2);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
            text-decoration: none;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            transition: var(--transition);
            filter: drop-shadow(var(--shadow-sm));
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.5px;
            transition: var(--transition);
        }

        .logo-text span {
            color: var(--accent);
            font-weight: 600;
        }

        .logo:hover .logo-img {
            transform: rotate(-5deg) scale(1.05);
        }

        .logo:hover .logo-text {
            transform: translateX(3px);
            color: var(--accent);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(255, 248, 240, 0.95);
            padding: 1rem 5%;
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(93, 64, 55, 0.1);
        }

        .navbar.scrolled {
            padding: 0.8rem 5%;
            box-shadow: var(--shadow-md);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-link {
            color: var(--text-dark);
            font-weight: 500;
            text-decoration: none;
            position: relative;
            padding: 0.5rem 0;
            transition: var(--transition);
            font-size: 1.05rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--accent);
            transition: var(--transition);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent);
        }

        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.75rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--primary));
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .btn-primary:active {
            transform: translateY(1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255,255,255,0.3),
                rgba(255,255,255,0)
            );
            transform: rotate(30deg);
            transition: var(--transition);
        }

        .btn-primary:hover::after {
            left: 100%;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary);
            cursor: pointer;
            z-index: 1001;
            transition: var(--transition);
            padding: 0.5rem;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            align-items: center;
            justify-content: center;
        }

        .mobile-menu-btn:hover {
            background-color: rgba(255, 112, 67, 0.1);
            color: var(--accent);
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 320px;
            height: 100vh;
            background-color: var(--light-bg);
            z-index: 1000;
            padding: 6rem 1.5rem 2rem;
            transition: var(--transition);
            box-shadow: -5px 0 30px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .mobile-nav.active {
            right: 0;
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .mobile-nav-link {
            color: var(--text-dark);
            font-size: 1.1rem;
            font-weight: 500;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .mobile-nav-link i {
            width: 24px;
            text-align: center;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            background-color: rgba(255, 112, 67, 0.1);
            color: var(--accent);
            transform: translateX(5px);
        }

        .mobile-nav-actions {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding-top: 1.5rem;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        
        .user-dropdown {
            position: relative;
            display: inline-block;
            margin-left: 1rem;
        }

        .dropdown-toggle {
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent);
            transition: var(--transition);
        }

        .user-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--light-bg);
            min-width: 280px;
            box-shadow: var(--shadow-lg);
            border-radius: 0.5rem;
            z-index: 1001;
            padding: 1rem;
            transition: var(--transition);
        }

        .user-dropdown:hover .user-dropdown-content {
            display: block;
        }

        .user-info {
            display: flex;
            align-items: center;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(93, 64, 55, 0.1);
        }

        .user-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 1rem;
            border: 2px solid var(--accent);
        }

        .user-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .user-email {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .user-dropdown-content a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: var(--text-dark);
            transition: var(--transition);
            border-radius: 0.25rem;
            gap: 0.75rem;
        }

        .user-dropdown-content a:hover {
            background-color: rgba(255, 112, 67, 0.1);
            color: var(--accent);
        }

        .user-dropdown-content a i {
            width: 20px;
            text-align: center;
        }

        .logout {
            color: #e74c3c !important;
        }

       
        @media (max-width: 1024px) {
            .nav-links {
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .nav-links,
            .nav-actions,
            .user-dropdown {
                display: none;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .logo-img {
                width: 50px;
                height: 50px;
            }

            .logo-text {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .logo-text {
                display: none;
            }

            .mobile-nav {
                width: 85%;
                padding: 5rem 1rem 1.5rem;
            }
        }

     
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-8px);
            }
        }

        .btn-float {
            animation: float 3s ease-in-out infinite;
        }

        .btn-float:hover {
            animation: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <a href="./dashboard.php" class="logo">
            <img src="./src/logo12.png" alt="Cozy Comfort Logo" class="logo-img">
            <span class="logo-text">Cozy<span>Comfort</span></span>
        </a>

        <div class="nav-links">
            <a href="./dashboard.php" class="nav-link">Home</a>
            <a href="./blanketmanage.php" class="nav-link">Blankets Store</a>
            <a href="./pendingorders.php" class="nav-link">Orders</a>
            <a href="./contactusdetails.php" class="nav-link">Messages</a>
           
            <a href="./ourmaterials.php" class="nav-link">Our Materials</a>
            <a href="./aboutus.php" class="nav-link">About Us</a>
        </div>

        <div class="nav-actions">
            <a href="./blanketsadd.php" class="btn btn-primary btn-float">
                <i class="fas fa-shopping-cart"></i>
                Add Blankets
            </a>
            
            <div class="user-dropdown">
                <div class="dropdown-toggle">
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <?php if (!empty($_SESSION['image'])) : ?>
                            <img src="data:image/png;base64,<?php echo htmlspecialchars($_SESSION['image']); ?>" alt="User Avatar" class="user-avatar">
                        <?php else : ?>
                            <div class="user-avatar" style="background-color: var(--primary); color: white; display: flex; align-items: center; justify-content: center;">
                                <?php echo strtoupper(substr($_SESSION['fullname'], 0, 1)); ?>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <img src="src/user-avatar.jpg" alt="User Avatar" class="user-avatar">
                    <?php endif; ?>
                </div>
                <div class="user-dropdown-content">
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <div class="user-info">
                            <?php if (!empty($_SESSION['image'])) : ?>
                                <img src="data:image/png;base64,<?= $_SESSION["image"] ?>" alt="User Avatar">
                            <?php else : ?>
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: var(--primary); color: white; display: flex; align-items: center; justify-content: center; margin-right: 10px; border: 2px solid var(--accent);">
                                    <?php echo strtoupper(substr($_SESSION['fullname'], 0, 1)); ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <div class="user-name"><?php echo htmlspecialchars($_SESSION['fullname']); ?></div>
                                <div class="user-email"><?php echo htmlspecialchars($_SESSION['email']); ?></div>
                            </div>
                        </div>
                        <a href="profile.php"><i class="fas fa-user"></i> My Profile</a>
                        <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                        <a href="orders.php"><i class="fas fa-shopping-bag"></i> My Orders</a>
                        <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <?php else : ?>
                        <div class="user-info">
                            <img src="src/user-avatar.jpg" alt="User Avatar">
                            <div>
                                <div class="user-name">Guest User</div>
                                <div class="user-email">guest@example.com</div>
                            </div>
                        </div>
                        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                        <a href="signup.php"><i class="fas fa-user-plus"></i> Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>

        <div class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-links">
                <a href="./dashboard.php" class="mobile-nav-link">
                    <i class="fas fa-home"></i>
                    Home
                </a>
                <a href="Shop.php" class="mobile-nav-link">
                    <i class="fas fa-blanket"></i>
                    Blankets
                </a>
                <a href="AboutUs.php" class="mobile-nav-link">
                    <i class="fas fa-info-circle"></i>
                    About Us
                </a>
                <a href="ContactUs.php" class="mobile-nav-link">
                    <i class="fas fa-envelope"></i>
                    Contact Us
                </a>
                <a href="Freelancer/freelanceregister.php" class="mobile-nav-link">
                    <i class="fas fa-fabric"></i>
                    Our Materials
                </a>
            </div>

            <div class="mobile-nav-actions">
                <a href="OrderNow.php" class="btn btn-primary">
                    <i class="fas fa-shopping-cart"></i>
                    Order Now
                </a>
            </div>
            
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="profile.php" class="mobile-nav-link">
                    <i class="fas fa-user"></i>
                    My Profile
                </a>
                <a href="logout.php" class="mobile-nav-link logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            <?php else : ?>
                <a href="login.php" class="mobile-nav-link">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>
                <a href="signup.php" class="mobile-nav-link">
                    <i class="fas fa-user-plus"></i>
                    Register
                </a>
            <?php endif; ?>
        </div>

        <div class="overlay" id="overlay"></div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            class Navigation {
                constructor() {
                    this.navbar = document.querySelector('.navbar');
                    this.mobileMenuBtn = document.getElementById('mobileMenuBtn');
                    this.mobileNav = document.getElementById('mobileNav');
                    this.overlay = document.getElementById('overlay');
                    this.navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
                    
                    this.currentPage = window.location.pathname.split('/').pop() || 'dashboard.php';
                    
                    this.init();
                }
                
                init() {
               
                    window.addEventListener('scroll', this.handleScroll.bind(this));
                    
                
                    this.mobileMenuBtn.addEventListener('click', this.toggleMobileMenu.bind(this));
                    this.overlay.addEventListener('click', this.closeMobileMenu.bind(this));
                    
               
                    this.highlightActiveLink();
                    
                  
                    document.querySelectorAll('.mobile-nav-link, .mobile-nav-actions a').forEach(link => {
                        link.addEventListener('click', this.closeMobileMenu.bind(this));
                    });

                 
                    this.handleScroll();
                }
                
                handleScroll() {
                    if (window.scrollY > 20) {
                        this.navbar.classList.add('scrolled');
                    } else {
                        this.navbar.classList.remove('scrolled');
                    }
                }
                
                toggleMobileMenu() {
                    this.mobileNav.classList.toggle('active');
                    this.overlay.classList.toggle('active');
                    document.body.style.overflow = this.mobileNav.classList.contains('active') ? 'hidden' : 'auto';
                    
               
                    const icon = this.mobileMenuBtn.querySelector('i');
                    icon.classList.toggle('fa-bars');
                    icon.classList.toggle('fa-times');
                }
                
                closeMobileMenu() {
                    this.mobileNav.classList.remove('active');
                    this.overlay.classList.remove('active');
                    document.body.style.overflow = 'auto';
          
                    const icon = this.mobileMenuBtn.querySelector('i');
                    if (icon.classList.contains('fa-times')) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
                
                highlightActiveLink() {
                    this.navLinks.forEach(link => {
                        
                        const linkPage = link.getAttribute('href').split('/').pop();
                        
                       
                        link.classList.remove('active');

                       
                        if (this.currentPage === 'dashboard.php' && linkPage === 'dashboard.php') {
                            link.classList.add('active');
                        } 
                        
                        else if (this.currentPage === linkPage && this.currentPage !== 'dashboard.php') {
                            link.classList.add('active');
                        }
                    });
                }
            }
            
            
            new Navigation();
            
            
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

           
            const animateElements = () => {
                document.querySelectorAll('.logo, .nav-links, .nav-actions').forEach(el => {
                    el.classList.add('fade-in');
                });
            };

            
            setTimeout(animateElements, 100);
        });
    </script>
</body>
</html>