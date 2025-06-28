<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cozy Comfort | Distributor Login</title>
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
            background-color: var(--light-bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem;
            background-image: url('https://bearaby.com/cdn/shop/files/hero-alt-1.png?v=1731484793');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .login-card {
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(93, 64, 55, 0.2);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 2.5rem;
            text-align: center;
            position: relative;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }

        .login-header h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .login-body {
            padding: 2.5rem;
        }

        .form-control {
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.1);
            transition: var(--transition);
            background-color: rgba(255,255,255,0.8);
            margin-bottom: 1rem;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(255, 112, 67, 0.25);
            background-color: white;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--accent), var(--primary));
            border: none;
            padding: 14px;
            font-weight: 600;
            width: 100%;
            transition: var(--transition);
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(255, 112, 67, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 112, 67, 0.4);
        }

        .btn-login:disabled {
            background: var(--text-light);
            cursor: not-allowed;
            transform: none !important;
        }

        .btn-login::after {
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

        .btn-login:hover::after {
            left: 100%;
        }

        .spinner {
            display: inline-block;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-left: 8px;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .registerlink {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-light);
        }

        .registerlink a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .registerlink a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-dark);
        }

        .alert-invalid {
            background-color: rgba(211, 47, 47, 0.1);
            color: var(--error);
            border: 1px solid rgba(211, 47, 47, 0.2);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 1rem;
            display: none;
        }

        .shake {
            animation: shake 0.5s linear;
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

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

     
        @media (max-width: 768px) {
            body {
                padding: 1rem;
                background-attachment: scroll;
            }
            
            .login-header,
            .login-body {
                padding: 1.5rem;
            }
            
            .login-header {
                clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%);
            }
        }

        @media (max-width: 576px) {
            .login-card {
                border-radius: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <img src="src/logo12.png" alt="Cozy Comfort Logo" width="80">
            <h2 class="mt-3">Distributor Portal</h2>
            <p class="mb-0">Secure Access Only</p>
        </div>
        
        <div class="login-body">
            <div id="invalidAlert" class="alert-invalid">
                <i class="fas fa-exclamation-circle me-2"></i>
                <span id="errorMessage">Invalid credentials. Please try again.</span>
            </div>
            
            <form id="loginForm">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="admin@cozycomfort.com" required>
                </div>
                
                <div class="mb-3 password-container">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>
                
                <button type="submit" class="btn btn-login mt-3" id="loginBtn">
                    <span id="loginText">Login</span>
                    <span id="loginSpinner" class="spinner" style="display: none;"></span>
                </button>
                <div class="registerlink">
                    <p>Don't have an account? <a href="signup.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loginForm = document.getElementById("loginForm");
            const emailInput = document.getElementById("email");
            const passwordInput = document.getElementById("password");
            const togglePassword = document.getElementById("togglePassword");
            const loginBtn = document.getElementById("loginBtn");
            const loginText = document.getElementById("loginText");
            const loginSpinner = document.getElementById("loginSpinner");
            const invalidAlert = document.getElementById("invalidAlert");
            const errorMessage = document.getElementById("errorMessage");
            
          
            togglePassword.addEventListener("click", function() {
                const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);
                this.classList.toggle("fa-eye-slash");
            });
           
            loginForm.addEventListener("submit", async function(e) {
                e.preventDefault();
                
            
                loginBtn.disabled = true;
                loginText.textContent = "Authenticating...";
                loginSpinner.style.display = "inline-block";
                invalidAlert.style.display = "none";
                
                try {
                    const response = await fetch("https://localhost:7033/api/Distributor/login", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({
                            email: emailInput.value,
                            password: passwordInput.value
                        })
                    });
                    
                    if (response.ok) {
                        const user = await response.json();
                        await fetch("set-session.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify(user)
                        });
                        
                     
                        loginBtn.classList.add('pulse');
                        setTimeout(() => {
                            loginBtn.classList.remove('pulse');
                        }, 1000);
                        
                      
                        setTimeout(() => {
                            window.location.href = "dashboard.php";
                        }, 1000);
                    } else {
                       
                        const errorData = await response.json();
                        let errorMsg = "Login failed";
                        
                        if (response.status === 401) {
                            errorMsg = "Invalid email or password";
                        } else if (response.status === 403) {
                            errorMsg = "Account disabled or locked";
                        } else if (response.status === 429) {
                            errorMsg = "Too many attempts. Please try again later.";
                        }
                        
                        showError(errorMsg);
                    }
                } catch (error) {
                    console.error("Login error:", error);
                    showError("Email or password is invalid.");
                } finally {
                   
                    loginBtn.disabled = false;
                    loginText.textContent = "Login";
                    loginSpinner.style.display = "none";
                }
            });
            
            function showError(message) {
                errorMessage.textContent = message;
                invalidAlert.style.display = "block";
                loginForm.classList.add("shake");
                
                setTimeout(() => {
                    loginForm.classList.remove("shake");
                }, 500);
                
                
                passwordInput.value = "";
                passwordInput.focus();
            }
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>