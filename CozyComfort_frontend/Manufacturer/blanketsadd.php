<?php
session_start();

$distributorId = isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) ? (int)$_SESSION["user_id"] : null; 


if ($distributorId === null) { 
    header("Location: login.php"); 
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blanket | Cozy Comfort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #5D4037;
            --primary-light: #8D6E63;
            --accent: #FF7043;
            --accent-light: #FFAB91;
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
            justify-content: center;
            padding: 2rem;
            background-image: linear-gradient(135deg, rgba(255,248,240,0.9), rgba(255,248,240,0.9)),
                                 url('https://plus.unsplash.com/premium_photo-1674940578913-ccd2300c505d?q=80&w=690&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .form-container {
            max-width: 650px;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(93, 64, 55, 0.25);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                to bottom right,
                rgba(255,255,255,0.3),
                rgba(255,255,255,0)
            );
            z-index: -1;
            border-radius: 16px;
            pointer-events: none;
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 1.75rem 2.5rem;
            text-align: center;
            border-radius: 16px 16px 0 0;
            margin: -2.5rem -2.5rem 2.5rem -2.5rem;
            box-shadow: 0 4px 20px rgba(93, 64, 55, 0.3);
        }

        .form-header h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.15);
            letter-spacing: 0.5px;
        }

        .form-header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .form-control, .form-select {
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.12);
            transition: var(--transition);
            background-color: rgba(255,255,255,0.9);
            font-size: 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(255, 112, 67, 0.2);
            background-color: white;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--primary);
            font-size: 0.95rem;
        }

        .btn-submit {
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
            letter-spacing: 0.5px;
            font-size: 1rem;
            text-transform: uppercase;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 112, 67, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            background: var(--text-light);
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none;
        }

        .btn-submit::after {
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

        .btn-submit:hover::after {
            left: 100%;
        }

        .spinner {
            display: inline-block;
            width: 1.25rem;
            height: 1.25rem;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-left: 8px;
            vertical-align: middle;
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 1rem 1.25rem;
        }

        
        .image-upload-container {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .image-preview-wrapper {
            width: 100%;
            max-width: 280px;
            height: 160px;
            border: 2px dashed var(--text-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0 auto 1rem auto;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            background-color: rgba(255,255,255,0.7);
        }

        .image-preview-wrapper:hover {
            border-color: var(--accent);
            background-color: rgba(255, 112, 67, 0.05);
            transform: translateY(-2px);
        }

        .image-preview-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            display: none;
        }

        .image-preview-text {
            color: var(--text-light);
            font-size: 0.9rem;
            text-align: center;
            display: block;
            padding: 0 1rem;
        }

        .image-preview-icon {
            font-size: 2.25rem;
            color: var(--accent);
            margin-bottom: 0.75rem;
            opacity: 0.8;
        }

        #blanketImageUpload {
            display: none;
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
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }


        @media (max-width: 768px) {
            body {
                padding: 1rem;
                background-attachment: scroll;
            }

            .form-container {
                padding: 1.75rem;
                max-width: 95%;
            }

            .form-header {
                margin: -1.75rem -1.75rem 1.75rem -1.75rem;
                padding: 1.5rem;
            }

            .image-preview-wrapper {
                max-width: 240px;
                height: 140px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-header">
            <h2>Add New Blanket Model</h2>
            <p>Enter details for a new Cozy Comfort blanket model</p>
        </div>

        <form id="addBlanketForm">
            <div class="mb-3">
                <label for="ModelName" class="form-label">Model Name</label>
                <input type="text" id="ModelName" class="form-control" placeholder="e.g., Arctic Cloud Blanket" required>
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <textarea id="Description" class="form-control" rows="3" placeholder="A cozy, soft blanket perfect for winter nights..." required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="UnitCost" class="form-label">Unit Cost (LKR)</label>
                    <input type="number" id="UnitCost" class="form-control" placeholder="Ex: 5000.00" step="0.01" min="0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="StockQuantity" class="form-label">Stock Quantity</label>
                    <input type="number" id="StockQuantity" class="form-control" placeholder="Ex: 100" min="0" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="Material" class="form-label">Material</label>
                <input type="text" id="Material" class="form-control" placeholder="e.g., Fleece, Cotton, Wool" required>
            </div>
            <div class="mb-3">
                <label for="ProductionDate" class="form-label">Production Date</label>
                <input type="date" id="ProductionDate" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Blanket Image</label>
                <div class="image-upload-container">
                    <label for="blanketImageUpload" class="image-preview-wrapper">
                        <img id="blanketImagePreview" src="#" alt="Blanket Image Preview">
                        <span id="blanketImagePlaceholder">
                            <i class="fas fa-cloud-upload-alt image-preview-icon"></i>
                            <span class="image-preview-text">Click to upload image<br><small>(JPG, PNG, GIF, max 5MB)</small></span>
                        </span>
                    </label>
                    <input type="file" id="blanketImageUpload" accept="image/*" required>
                </div>
            </div>

            <button type="submit" class="btn btn-submit mt-2" id="submitBtn">
                <span id="btnText">Add Blanket Model</span>
                <span id="btnSpinner" class="spinner" style="display: none;"></span>
            </button>

            <div id="alertBox" class="mt-3"></div>
        </form>
    </div>

    <script>
    
        const manufacturerIDFromPHP = <?php echo json_encode($distributorId); ?>; 

        document.addEventListener('DOMContentLoaded', function() {
      
            const addBlanketForm = document.getElementById('addBlanketForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const alertBox = document.getElementById('alertBox');
            const blanketImageUpload = document.getElementById('blanketImageUpload');
            const blanketImagePreview = document.getElementById('blanketImagePreview');
            const blanketImagePlaceholder = document.getElementById('blanketImagePlaceholder');

          
            document.getElementById('ProductionDate').max = new Date().toISOString().split('T')[0];

           
            blanketImageUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) {
                    resetImagePreview();
                    return;
                }

            
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    showAlert('Please upload a valid image (JPG, PNG, GIF)', 'error');
                    resetImagePreview();
                    return;
                }

             
                if (file.size > 5 * 1024 * 1024) {
                    showAlert('Image size should be less than 5MB', 'error');
                    resetImagePreview();
                    return;
                }

           
                const reader = new FileReader();
                reader.onload = function(event) {
                    blanketImagePreview.src = event.target.result;
                    blanketImagePreview.style.display = 'block';
                    blanketImagePlaceholder.style.display = 'none';
                }
                reader.onerror = function() {
                    showAlert('Error reading image file', 'error');
                    resetImagePreview();
                };
                reader.readAsDataURL(file);
            });

            function resetImagePreview() {
                blanketImageUpload.value = ''; 
                blanketImagePreview.style.display = 'none';
                blanketImagePreview.src = '#'; 
                blanketImagePlaceholder.style.display = 'block';
            }

          
            addBlanketForm.addEventListener('submit', async function(e) {
                e.preventDefault();

            
                if (!validateForm()) {
                    showAlert('Please fill in all required fields and upload a valid image.', 'error');
                    return;
                }

             
                setLoadingState(true);

                try {
              
                    const base64Image = await convertToBase64(blanketImageUpload.files[0]);

                 
                    const formData = {
                        ModelName: document.getElementById('ModelName').value.trim(),
                        Description: document.getElementById('Description').value.trim(),
                        UnitCost: parseFloat(document.getElementById('UnitCost').value),
                        CurrentStock: parseInt(document.getElementById('StockQuantity').value),
                        Material: document.getElementById('Material').value.trim(),
                        ProductionDate: document.getElementById('ProductionDate').value,
                        ManufacturerID: manufacturerIDFromPHP, 
                        Base64Image: base64Image.split(',')[1], 
                        IsActive: true 
                    };

                   
                    if (manufacturerIDFromPHP === null || isNaN(manufacturerIDFromPHP) || manufacturerIDFromPHP <= 0) {
                        throw new Error('Manufacturer ID is missing or invalid. Please ensure you are logged in correctly.');
                    }


                   
                    const response = await fetch('https://localhost:7033/api/BlanketModels/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            
                            'Authorization': `Bearer ${getAuthToken()}`
                        },
                        body: JSON.stringify(formData)
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        let errorMessage = errorData.message || 'Failed to add blanket model';
                        if (errorData.errors) {
                            errorMessage += ": " + Object.values(errorData.errors).flat().join('; ');
                        }
                        throw new Error(errorMessage);
                    }

                   
                    showAlert('✅ Blanket model added successfully! Redirecting...', 'success');
                    addBlanketForm.reset();
                    resetImagePreview();

                   
                    submitBtn.classList.add('pulse');
                    setTimeout(() => submitBtn.classList.remove('pulse'), 1000);

                  
                    setTimeout(() => {
                        window.location.href = 'blanketmanage.php';
                    }, 2000); 
                   

                } catch (error) {
                    console.error('Submission error:', error);
                    showAlert(error.message || 'An error occurred. Please try again.', 'error');
                } finally {
                    setLoadingState(false);
                }
            });

            
            function validateForm() {
                let isValid = true;

               
                document.querySelectorAll('#addBlanketForm input[required], #addBlanketForm textarea[required]').forEach(input => {
                    if (input.type === 'number') {
                        if (input.value === '' || parseFloat(input.value) < parseFloat(input.min || 0)) {
                            input.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    } else if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                
                if (!blanketImageUpload.files[0]) {
                    
                    isValid = false;
                }

                
                if (manufacturerIDFromPHP === null || isNaN(manufacturerIDFromPHP) || manufacturerIDFromPHP <= 0) {
                    showAlert('Error: Manufacturer ID is missing or invalid. Please ensure you are logged in.', 'error');
                    isValid = false;
                }

                return isValid;
            }

            function setLoadingState(isLoading) {
                submitBtn.disabled = isLoading;
                btnText.textContent = isLoading ? 'Processing...' : 'Add Blanket Model';
                btnSpinner.style.display = isLoading ? 'inline-block' : 'none';
            }

            async function convertToBase64(file) {
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
                        <div class="d-flex align-items-center">
                            <i class="fas ${type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle'} me-2"></i>
                            <span>${message}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;

                const alertElement = alertBox.querySelector('.alert');
                if (alertElement) {
                    
                    if (type === 'error') {
                        setTimeout(() => {
                            const alert = bootstrap.Alert.getOrCreateInstance(alertElement);
                            alert.close();
                        }, 5000); 
                    }
                }
            }

           
            function getAuthToken() {
               
                return ''; 
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>