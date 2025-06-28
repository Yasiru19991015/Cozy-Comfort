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
    <title>Cozy Comfort | Premium Blanket Distributor</title>
    <meta name="description" content="Cozy Comfort - Manufacturer of high-quality blankets and textiles">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #5D4037;
            --accent: #FF7043;
            --light-bg: #FFF8F0;
            --text-dark: #3E2723;
            --text-light: #8D6E63;
            --success: #388E3C;
            --error: #D32F2F;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background-color: var(--light-bg);
            overflow-x: hidden;
        }

        
        .header-container {
            position: relative;
            height: 100vh;
            min-height: 600px;
            max-height: 800px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('https://images.unsplash.com/photo-1674475760615-73cb0da3796a?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .video-background video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.6);
        }

        .logo-container {
            position: relative;
            text-align: center;
            z-index: 10;
            padding: 0 10px;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100%;
            animation: fadeInUp 0.8s ease-out;
        }

        .logo {
            max-width: 220px;
            height: auto;
            margin-bottom: 5px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
            transition: var(--transition);
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .company-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 600;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .company-tagline {
            font-size: clamp(1rem, 2vw, 1.5rem);
            color: white;
            font-weight: 300;
            letter-spacing: 1px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
            max-width: 700px;
            margin: 0 auto;
        }

        .main-content {
            max-width: 1200px;
            margin: -100px auto 0;
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }

        .access-panel {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(93, 64, 55, 0.2);
            padding: 50px 40px;
            text-align: center;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .panel-subtitle {
            color: var(--text-light);
            margin-bottom: 40px;
            font-weight: 400;
            font-size: clamp(0.9rem, 1.5vw, 1.1rem);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        
        .button-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            max-width: 900px;
            margin: 0 auto;
        }

        .access-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            background: linear-gradient(135deg, var(--light-bg) 0%, #ffffff 100%);
            border-radius: 10px;
            text-decoration: none;
            color: var(--primary);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
        }

        .access-button:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            border-color: var(--accent);
            background: linear-gradient(135deg, #ffffff 0%, var(--light-bg) 100%);
        }

        .access-button i {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--accent);
            transition: var(--transition);
        }

        .access-button:hover i {
            transform: scale(1.1);
            color: var(--primary);
        }

        .access-button span {
            font-weight: 600;
            font-size: 1.2rem;
            position: relative;
        }

        .access-button span::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--accent);
            transition: var(--transition);
        }

        .access-button:hover span::after {
            width: 100%;
        }

        .access-button::after {
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

        .access-button:hover::after {
            left: 100%;
        }

        
        .footer {
            text-align: center;
            padding: 60px 20px 40px;
            color: var(--text-light);
            font-size: 0.9rem;
            margin-top: 60px;
            background-color: #fff;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0,0,0,0.1), transparent);
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

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        
        @media (max-width: 768px) {
            .header-container {
                min-height: 500px;
                background-attachment: scroll;
            }
            
            .main-content {
                margin-top: -80px;
            }
            
            .access-panel {
                padding: 40px 25px;
                border-radius: 12px;
            }
            
            .button-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .header-container {
                min-height: 400px;
            }
            
            .logo {
                max-width: 140px;
                margin-bottom: 20px;
            }
            
            .main-content {
                margin-top: -60px;
            }
            
            .access-panel {
                padding: 30px 20px;
                border-radius: 12px;
            }
            
            .button-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .access-button {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>
    <?php include "component/header.php"; ?>

    <header class="header-container">
        <div class="video-background">
            <video autoplay muted loop>
                <source src="src/bg.mp4" type="video/mp4">
               
                <img src="src/loggo.png" alt="Background">
            </video>
        </div>
        <div class="logo-container">
            <img src="src/logo12.png" class="logo" alt="Cozy Comfort Logo">
            <h1 class="company-name">Cozy Comfort</h1>
            <p class="company-tagline">Premium Blankets for Ultimate Relaxation</p>
        </div>
    </header>

    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const logo = document.querySelector('.logo');
            if (logo) {
                logo.style.opacity = '0';
                logo.style.transition = 'opacity 1s ease, transform 0.5s ease';
                
                setTimeout(() => {
                    logo.style.opacity = '1';
                }, 300);
            }

           
            const video = document.querySelector('.video-background video');
            if (video) {
                video.play().catch(error => {
                    
                    const videoContainer = document.querySelector('.video-background');
                    if (videoContainer) {
                        videoContainer.innerHTML = '<img src="src/loggo.png" alt="Background" style="width:100%;height:100%;object-fit:cover;">';
                    }
                });
            }

            
            const buttons = document.querySelectorAll('.access-button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.classList.add('pulse');
                });
                button.addEventListener('mouseleave', function() {
                    this.classList.remove('pulse');
                });
            });

           
            const yearElement = document.getElementById('year');
            if (yearElement) {
                yearElement.textContent = new Date().getFullYear();
            }
        });
    </script>
    <?php include "component/footer.php"; ?>
</body>
</html>