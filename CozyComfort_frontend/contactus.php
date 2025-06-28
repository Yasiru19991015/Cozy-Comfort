<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
       
        :root {
            --primary: #007bff; 
            --primary-dark: #0056b3; 
            --primary-light: #66b5ff; 
            --accent: #28a745; 
            --background-light: #f8f9fa; 
            --text-dark: #343a40; 
            --text-muted: #6c757d;
            --card-background: #ffffff; 
            --transition-speed: 0.3s; 
        }

        body {
            background-color: var(--background-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
        }

        .container {
            padding-top: 50px;
            padding-bottom: 50px;
            max-width: 700px;
        }

        .contact-form-card {
            background-color: var(--card-background);
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            padding: 40px;
        }

        .contact-form-card h2 {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.2rem;
            text-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn-submit {
            background-color: var(--primary);
            border: none;
            color: white;
            font-weight: 700;
            padding: 12px 25px;
            border-radius: 8px;
            transition: all var(--transition-speed) ease-in-out;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
        }

        .btn-submit:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-submit:active {
            background-color: #004085;
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 123, 255, 0.2);
        }

        .btn-submit:disabled {
            background-color: #cccccc;
            color: #666666;
            cursor: not-allowed;
            opacity: 0.8;
            transform: none;
            box-shadow: none;
        }

       
        .alert-container {
            position: fixed;
            top: 20px; 
            right: 20px;
            z-index: 1050;
            max-width: 350px;
        }
        
        .alert {
            margin-bottom: 10px;
            animation: fadeInOut 5s forwards;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <?php include "component/header.php";  ?>

    <div class="container">
        <div class="contact-form-card">
            <h2>Get In Touch</h2>
            <form id="contactForm">
                <div class="mb-4">
                    <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="fullName" name="FullName" placeholder="Your Full Name" required>
                </div>
                <div class="mb-4">
                    <label for="mobileNo" class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control" id="mobileNo" name="MobileNo" placeholder="e.g., +94771234567">
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="Email" placeholder="you@example.com" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="form-label">Your Message <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="message" name="Message" rows="5" placeholder="Enter your message here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-submit" id="submitBtn">
                    <i class="fas fa-paper-plane me-2"></i> Send Message
                </button>
            </form>
        </div>
    </div>

    <div class="alert-container" id="customAlertContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        
        const API_URL_CONTACT_US = 'https://localhost:7033/api/contactus/add'; 

       
        function showCustomAlert(title, message, type = 'danger') {
            const alertContainer = document.getElementById('customAlertContainer');
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.role = 'alert';
            alertDiv.innerHTML = `
                <strong>${title}:</strong> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            
            alertContainer.prepend(alertDiv);
            
           
            setTimeout(() => {
                const bsAlert = bootstrap.Alert.getInstance(alertDiv);
                if (bsAlert) bsAlert.close();
                else alertDiv.remove(); 
            }, 5000);
        }

        document.getElementById('contactForm').addEventListener('submit', async function(event) {
            event.preventDefault(); 

            const submitBtn = document.getElementById('submitBtn');
            const originalButtonText = submitBtn.innerHTML;

           
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';

           
            const formData = new FormData(this);
            const payload = {};
            for (const [key, value] of formData.entries()) {
                payload[key] = value;
            }

           
            if (!payload.FullName || !payload.Email || !payload.Message) {
                showCustomAlert('Validation Error', 'Please fill in all required fields (Full Name, Email, Message).', 'warning');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalButtonText;
                return;
            }
            if (payload.Email && !/\S+@\S+\.\S+/.test(payload.Email)) {
                showCustomAlert('Validation Error', 'Please enter a valid email address.', 'warning');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalButtonText;
                return;
            }

            try {
                const response = await fetch(API_URL_CONTACT_US, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload), 
                });

                let result;
              
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    
                    result = await response.json();
                } else {
                  
                    const messageText = await response.text();
                    result = {
                        success: response.ok, 
                        message: messageText 
                    };
                }

              
                if (result.success) {
                    showCustomAlert('Success', result.message || 'Message sent successfully!', 'success');
                    this.reset(); 
                } else {
                    const errorMessage = result.message || 'Failed to send message.';
                    showCustomAlert('Error', errorMessage, 'danger');
                    console.error('Submission Error:', result);
                }
            } catch (error) {
                console.error('Fetch Error:', error);
                showCustomAlert('Error', `An unexpected error occurred: ${error.message || 'Please try again later.'}`, 'danger');
            } finally {
                
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalButtonText;
            }
        });
    </script>
    <?php include "component/footer.php"; ?>
</body>
</html>
