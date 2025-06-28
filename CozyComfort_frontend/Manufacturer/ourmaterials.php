<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Materials | Cozy Comfort</title>
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

      
        .materials-header {
            position: relative;
            height: 50vh;
            min-height: 400px;
            background-image: linear-gradient(rgba(93, 64, 55, 0.7), rgba(93, 64, 55, 0.7)), 
                              url('https://images.unsplash.com/photo-1600547125744-31bdc11dfa2a?ixlib=rb-4.1.0&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            margin-bottom: 60px;
        }

        .materials-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .materials-header p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
        }

       
        .materials-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .materials-section {
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

        .material-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(93, 64, 55, 0.1);
            padding: 30px;
            margin-bottom: 40px;
            transition: var(--transition);
            overflow: hidden;
        }

        .material-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(93, 64, 55, 0.15);
        }

        .material-card h3 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .material-card p {
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .material-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .material-card:hover .material-img {
            transform: scale(1.03);
        }

        .material-icon {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 20px;
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .feature-icon {
            font-size: 1.8rem;
            color: var(--accent);
            margin-top: 5px;
        }

        .feature-content h4 {
            color: var(--primary);
            margin-bottom: 10px;
        }

        .feature-content p {
            color: var(--text-light);
        }

        
        @media (max-width: 768px) {
            .materials-header {
                height: 40vh;
                min-height: 300px;
            }
            
            .material-card {
                padding: 25px;
            }
            
            .material-img {
                height: 250px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .materials-header {
                height: 35vh;
            }
            
            .materials-header h1 {
                font-size: 2rem;
            }
            
            .materials-header p {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .material-img {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <?php include "component/header.php"; ?>
    
    <header class="materials-header">
        <div class="container">
            <h1>Our Premium Materials</h1>
            <p>Discover the natural fibers and ethical sources behind Cozy Comfort's luxurious blankets</p>
        </div>
    </header>

    <div class="materials-container">
        <section class="materials-section">
            <h2 class="section-title">Material Selection</h2>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="material-card">
                        <img src="https://images.unsplash.com/photo-1554967651-3997ad1c43b0?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fG9yZ2FuaWMlMjBjb3R0b258ZW58MHx8MHx8fDA%3D" 
                             alt="Organic Cotton Blanket" 
                             class="material-img">
                        <h3>Organic Cotton</h3>
                        <p>Our organic cotton blankets are woven from pesticide-free fibers, creating breathable fabrics that are gentle on sensitive skin. Sourced from certified organic farms in India.</p>
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fas fa-leaf feature-icon"></i>
                                <div class="feature-content">
                                    <h4>Hypoallergenic</h4>
                                    <p>Naturally resistant to dust mites and mold, perfect for allergy sufferers</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-tint feature-icon"></i>
                                <div class="feature-content">
                                    <h4>Moisture Wicking</h4>
                                    <p>Absorbs and releases moisture quickly to keep you comfortable</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="material-card">
                        <img src="https://images.unsplash.com/photo-1636716018019-569382b46111?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8d29vbCUyMGZhYnJpY3xlbnwwfHwwfHx8MA%3D%3D" 
                             alt="Merino Wool Blanket" 
                             class="material-img">
                        <h3>Merino Wool</h3>
                        <p>Our merino wool blankets provide natural temperature regulation, keeping you warm in winter and cool in summer. Ethically sourced from New Zealand farms.</p>
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fas fa-thermometer-half feature-icon"></i>
                                <div class="feature-content">
                                    <h4>Temperature Control</h4>
                                    <p>Naturally regulates body temperature in all seasons</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-bacteria feature-icon"></i>
                                <div class="feature-content">
                                    <h4>Odor Resistant</h4>
                                    <p>Naturally resists bacteria growth that causes odors</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="material-card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBaSrYQB-kUWleo-66FfttbKSZknlk6klgbg&s" 
                             alt="Bamboo Fiber Blanket" 
                             class="material-img">
                        <h3>Bamboo Fiber</h3>
                        <p>Our bamboo fiber blankets are luxuriously soft with natural antibacterial properties. The sustainable bamboo is grown without pesticides in controlled forests.</p>
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fas fa-recycle feature-icon"></i>
                                <div class="feature-content">
                                    <h4>Sustainable</h4>
                                    <p>Bamboo grows rapidly without need for replanting</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-shield-alt feature-icon"></i>
                                <div class="feature-content">
                                    <h4>Antibacterial</h4>
                                    <p>Naturally resists bacteria and fungi growth</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="material-card">
                        <img src="https://images.unsplash.com/photo-1636716018019-569382b46111?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8d29vbCUyMGZhYnJpY3xlbnwwfHwwfHx8MA%3D%3D" 
                             alt="Alpaca Wool Blanket" 
                             class="material-img">
                        <h3>Alpaca Wool</h3>
                        <p>Our alpaca wool blankets are exceptionally soft and lightweight, providing superior warmth without bulk. Harvested from humanely treated alpacas in Peru.</p>
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="fas fa-feather feature-icon"></i>
                                <div class="feature-content">
                                    <h4>Lightweight Warmth</h4>
                                    <p>Provides more warmth per ounce than sheep wool</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-allergies feature-icon"></i>
                                <div class="feature-content">
                                    <h4>Hypoallergenic</h4>
                                    <p>Contains no lanolin, making it ideal for sensitive skin</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="materials-section">
            <h2 class="section-title">Why Our Materials Matter</h2>
            <div class="material-card">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3>Ethical & Sustainable Sourcing</h3>
                        <p>At Cozy Comfort, we believe luxury shouldn't come at the expense of the environment or workers' rights. That's why we:</p>
                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Partner only with certified ethical suppliers</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Use natural dyes and low-impact processing</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Implement water recycling in our production</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Support fair trade initiatives</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1593671186131-d58817e7dee0?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8dGV4dGlsZXN8ZW58MHx8MHx8fDA%3D" 
                             alt="Ethical Blanket Production" 
                             class="img-fluid rounded-3 shadow">
                    </div>
                </div>
            </div>
        </section>

        <section class="materials-section">
            <h2 class="section-title">Material Care Guide</h2>
            <div class="material-card">
                <div class="features-grid">
                    <div class="feature-item">
                        <i class="fas fa-water feature-icon"></i>
                        <div class="feature-content">
                            <h4>Washing</h4>
                            <p>Machine wash cold with similar colors. Use mild detergent. Avoid fabric softeners which can reduce absorbency.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-sun feature-icon"></i>
                        <div class="feature-content">
                            <h4>Drying</h4>
                            <p>Tumble dry low or lay flat to dry. Avoid direct sunlight which can fade colors over time.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-tshirt feature-icon"></i>
                        <div class="feature-content">
                            <h4>Storage</h4>
                            <p>Store in a cool, dry place. Use cedar blocks instead of mothballs for natural fiber blankets.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-fire feature-icon"></i>
                        <div class="feature-content">
                            <h4>Stain Removal</h4>
                            <p>Blot (don't rub) spills immediately. For tough stains, use a mixture of baking soda and water.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include "component/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            const materialCards = document.querySelectorAll('.material-card');
            
            materialCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `all 0.6s cubic-bezier(0.16, 1, 0.3, 1) ${index * 0.1}s`;
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            });

            
            const materialImages = document.querySelectorAll('.material-img');
            materialImages.forEach(img => {
                img.parentElement.addEventListener('mouseenter', () => {
                    img.style.transform = 'scale(1.03)';
                });
                img.parentElement.addEventListener('mouseleave', () => {
                    img.style.transform = 'scale(1)';
                });
            });
        });
    </script>
    <?php include "component/footer.php"; ?>
</body>
</html>