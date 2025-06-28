
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Cozy Comfort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5D4037;
            --primary-light: #8D6E63;
            --accent: #FF7043;
            --accent-light: #FFAB91;
            --light-bg: #FFF8F0;
            --text-dark: #3E2723;
            --text-light: #8D6E63;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .about-header {
            position: relative;
            height: 60vh;
            min-height: 400px;
            background-image: linear-gradient(rgba(93, 64, 55, 0.7), rgba(93, 64, 55, 0.7)), 
                              url('https://images.unsplash.com/photo-1600369672890-ac00f1907858?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            margin-bottom: 60px;
        }

        .about-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .about-header p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
        }

     
        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .about-section {
            margin-bottom: 80px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 2.2rem;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--accent);
        }

        .about-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(93, 64, 55, 0.1);
            padding: 40px;
            margin-bottom: 40px;
            transition: var(--transition);
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(93, 64, 55, 0.15);
        }

        .about-card h3 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .about-card p {
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 20px;
        }

      
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .team-member {
            text-align: center;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(93, 64, 55, 0.1);
            transition: var(--transition);
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(93, 64, 55, 0.15);
        }

        .member-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--light-bg);
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .member-name {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .member-position {
            color: var(--accent);
            font-weight: 500;
            margin-bottom: 15px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-links a {
            color: var(--primary-light);
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--accent);
            transform: translateY(-3px);
        }

        /* Values Section */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .value-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .value-icon {
            font-size: 1.8rem;
            color: var(--accent);
            margin-top: 5px;
        }

        .value-content h4 {
            color: var(--primary);
            margin-bottom: 10px;
        }

        .value-content p {
            color: var(--text-light);
        }

       
        @media (max-width: 768px) {
            .about-header {
                height: 50vh;
                min-height: 300px;
            }
            
            .about-card {
                padding: 30px;
            }
            
            .team-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .about-header {
                height: 40vh;
            }
            
            .about-header h1 {
                font-size: 2rem;
            }
            
            .about-header p {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .team-grid {
                grid-template-columns: 1fr;
            }
            
            .values-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
   <?php include "component/header.php";?>
    <header class="about-header">
        <div class="container">
            <h1>Our Story</h1>
            <p>Discover the passion and craftsmanship behind Cozy Comfort's premium blankets</p>
        </div>
    </header>

    <div class="about-container">
        <section class="about-section">
            <h2 class="section-title">Who We Are</h2>
            <div class="about-card">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3>Crafting Comfort Since 2010</h3>
                        <p>Founded in the heart of Sri Lanka, Cozy Comfort began with a simple mission: to create the world's most comfortable blankets using traditional craftsmanship and premium materials.</p>
                        <p>What started as a small family workshop has grown into a respected manufacturer supplying high-quality blankets to distributors worldwide, while maintaining our commitment to ethical production and artisanal quality.</p>
                    </div>
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1602872030490-4a484a7b3ba6?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Cozy Comfort Workshop" 
                             class="img-fluid rounded-3 shadow">
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section">
            <h2 class="section-title">Our Values</h2>
            <div class="values-grid">
                <div class="value-item">
                    <i class="fas fa-hands-helping value-icon"></i>
                    <div class="value-content">
                        <h4>Ethical Production</h4>
                        <p>We ensure fair wages and safe working conditions for all our artisans, supporting local communities with sustainable employment.</p>
                    </div>
                </div>
                <div class="value-item">
                    <i class="fas fa-leaf value-icon"></i>
                    <div class="value-content">
                        <h4>Sustainable Materials</h4>
                        <p>We source natural, eco-friendly materials and minimize waste in our production process to reduce environmental impact.</p>
                    </div>
                </div>
                <div class="value-item">
                    <i class="fas fa-award value-icon"></i>
                    <div class="value-content">
                        <h4>Quality Craftsmanship</h4>
                        <p>Each blanket is carefully inspected to meet our high standards, combining traditional techniques with modern innovation.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section">
            <h2 class="section-title">Our Process</h2>
            <div class="about-card">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <i class="fas fa-wool value-icon"></i>
                        <h3>Material Selection</h3>
                        <p>We carefully source the finest natural fibers from trusted suppliers, ensuring premium quality from the very beginning.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-cut value-icon"></i>
                        <h3>Precision Crafting</h3>
                        <p>Skilled artisans handcraft each blanket using time-honored techniques passed down through generations.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-check-circle value-icon"></i>
                        <h3>Quality Assurance</h3>
                        <p>Every blanket undergoes rigorous inspection before being packaged for delivery to our partners.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section">
            <h2 class="section-title">Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Team Member" class="member-img">
                    <h4 class="member-name">Sarah Johnson</h4>
                    <p class="member-position">Founder & CEO</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="team-member">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Team Member" class="member-img">
                    <h4 class="member-name">David Chen</h4>
                    <p class="member-position">Production Manager</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="team-member">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Team Member" class="member-img">
                    <h4 class="member-name">Maria Rodriguez</h4>
                    <p class="member-position">Design Director</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="team-member">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Team Member" class="member-img">
                    <h4 class="member-name">James Wilson</h4>
                    <p class="member-position">Quality Control</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include "component/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
     
        document.addEventListener('DOMContentLoaded', function() {
            const teamMembers = document.querySelectorAll('.team-member');
            
            teamMembers.forEach((member, index) => {
                member.style.opacity = '0';
                member.style.transform = 'translateY(20px)';
                member.style.transition = `all 0.5s ease ${index * 0.1}s`;
                
                setTimeout(() => {
                    member.style.opacity = '1';
                    member.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
    
</body>
</html>