<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Cozy Comfort</title>
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

        .signup-container {
            max-width: 700px;
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

        .signup-header {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 2.5rem;
            text-align: center;
            position: relative;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }

        .signup-header h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .signup-body {
            padding: 2.5rem;
        }

        .form-control {
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.1);
            transition: var(--transition);
            background-color: rgba(255,255,255,0.8);
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(255, 112, 67, 0.25);
            background-color: white;
        }

        .btn-signup {
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

        .btn-signup:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 112, 67, 0.4);
        }

        .btn-signup:disabled {
            background: var(--text-light);
            cursor: not-allowed;
            transform: none !important;
        }

        .btn-signup::after {
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

        .btn-signup:hover::after {
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

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-light);
        }

        .login-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .login-link a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        /* Image Upload Styles */
        .image-upload-container {
            margin-bottom: 1.5rem;
        }

        .image-upload-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .image-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: none;
            transition: var(--transition);
        }

        .image-upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .image-upload-icon {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 0.5rem;
            transition: var(--transition);
        }

        .image-upload-text {
            color: var(--text-dark);
            font-weight: 500;
            text-align: center;
        }

        .image-upload-label:hover .image-upload-icon {
            transform: scale(1.1);
            color: var(--primary);
        }

        #imageUpload {
            display: none;
        }

        /* Animations */
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

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
                background-attachment: scroll;
            }
            
            .signup-header,
            .signup-body {
                padding: 1.5rem;
            }
            
            .signup-header {
                clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%);
            }
        }

        @media (max-width: 576px) {
            .signup-container {
                border-radius: 12px;
            }
            
            .image-preview {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-header">
            <h2>Join Our Family</h2>
            <p>Become a Cozy Comfort distributor today</p>
        </div>
        
        <div class="signup-body">
            <form id="signupForm" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" id="fullName" placeholder="Full Name" required class="form-control mb-3">
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="address" placeholder="Address" required class="form-control mb-3">
                    </div>
                    <div class="col-md-6">
                        <input type="tel" id="mobileNo" placeholder="Mobile Number" required class="form-control mb-3">
                    </div>
                    <div class="col-md-6">
                        <input type="date" id="dateOfBirth" placeholder="Date Of Birth" required class="form-control mb-3">
                    </div>
                    <div class="col-12">
                        <input type="email" id="email" placeholder="Email" required class="form-control mb-3">
                    </div>
                    <div class="col-12">
                        <input type="password" id="password" placeholder="Password (min 6 characters)" required class="form-control mb-3">
                    </div>
                    <div class="col-12">
                        <select id="role" class="form-control mb-3" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="Distributor">Distributor</option>
                        </select>
                    </div>
                    
                    <div class="col-12">
                        <div class="image-upload-container">
                            <div class="image-upload-wrapper">
                                <img id="imagePreview" class="image-preview" alt="Profile preview">
                                <label for="imageUpload" class="image-upload-label">
                                    <div class="image-upload-icon">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="image-upload-text">
                                        Click to upload profile photo<br>
                                        <small>(JPG or PNG, max 5MB)</small>
                                    </div>
                                </label>
                                <input type="file" id="imageUpload" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-signup mt-4" id="submitBtn">
                    <span id="btnText">Complete Sign Up</span>
                    <span id="btnSpinner" class="spinner" style="display: none;"></span>
                </button>
                
                <div id="alertBox" class="mt-3"></div>
                
                <div class="login-link">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signupForm = document.getElementById('signupForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const alertBox = document.getElementById('alertBox');
            const imageUpload = document.getElementById('imageUpload');
            const imagePreview = document.getElementById('imagePreview');
            
       
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
            
        
            imageUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) { 
                        showAlert('Image size should be less than 5MB', 'error');
                        imageUpload.value = '';
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.src = event.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
            
       
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('dateOfBirth').max = today;
            
            signupForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
          
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const imageFile = imageUpload.files[0];
                
                if (!emailPattern.test(email)) {
                    showAlert('Please enter a valid email address', 'error');
                    return;
                }
                
                if (!passwordPattern.test(password)) {
                    showAlert('Password must be at least 6 characters and include at least 1 letter and 1 number', 'error');
                    return;
                }
                
                if (!imageFile) {
                    showAlert('Please upload a profile photo', 'error');
                    return;
                }
                
            
                submitBtn.disabled = true;
                btnText.textContent = 'Creating Account...';
                btnSpinner.style.display = 'inline-block';
                
                try {
                
                    const base64Image = await convertToBase64(imageFile);
           
                    const data = {
                        FullName: document.getElementById('fullName').value,
                        Address: document.getElementById('address').value,
                        MobileNo: document.getElementById('mobileNo').value,
                        DateOfBirth: document.getElementById('dateOfBirth').value,
                        Email: email,
                        Password: password,
                        Role: document.getElementById('role').value,
                        Base64Image: base64Image.split(',')[1]
                    };
                    
             
                    const response = await fetch('https://localhost:7033/api/Distributor/signup', {
                        method: 'POST',
                        headers: { 
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });
                    
                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'Signup failed. Please try again.');
                    }
                    
            
                    showAlert('🎉 Account created successfully! Redirecting...', 'success');
                    
                
                    submitBtn.classList.add('pulse');
                    setTimeout(() => {
                        submitBtn.classList.remove('pulse');
                    }, 1000);
                    
                 
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 2000);
                    
                } catch (error) {
                    console.error('Signup error:', error);
                    showAlert(error.message || 'An error occurred during signup. Please try again.', 'error');
                    
                   
                    if (!imageUpload.files[0]) {
                        imagePreview.style.display = 'none';
                    }
                    
                } finally {
                   
                    submitBtn.disabled = false;
                    btnText.textContent = 'Complete Sign Up';
                    btnSpinner.style.display = 'none';
                }
            });
            
            function convertToBase64(file) {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader.result);
                    reader.onerror = error => reject(error);
                });
            }
            
            function showAlert(message, type) {
                alertBox.innerHTML = `
                    <div class="alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                
                
                if (type === 'error') {
                    setTimeout(() => {
                        const alert = bootstrap.Alert.getOrCreateInstance(alertBox.querySelector('.alert'));
                        alert.close();
                    }, 5000);
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>