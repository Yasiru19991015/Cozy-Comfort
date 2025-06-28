<?php

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;


if ($id <= 0) {
    header('Location: dashboard.php?error=invalid_id'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blanket | Cozy Comfort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OerSvFpmPUILQdEWIwJcGUQd2g3k2B4c5f3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
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
            justify-content: center; 
        }

        .container {
            max-width: 800px; 
            width: 100%;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(93, 64, 55, 0.2);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2.5rem; 
        }

        h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary);
            text-align: center;
            text-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .form-label {
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.1);
            transition: var(--transition);
            background-color: rgba(255,255,255,0.8);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(255, 112, 67, 0.25);
            background-color: white;
        }

        .btn-primary,
        .btn-secondary {
            border: none;
            padding: 14px 25px;
            font-weight: 600;
            transition: var(--transition);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--primary));
            color: white;
            box-shadow: 0 4px 15px rgba(255, 112, 67, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 112, 67, 0.4);
            background: linear-gradient(135deg, var(--primary), var(--accent));
        }

        .btn-secondary {
            background-color: var(--text-light);
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            background-color: var(--text-dark);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .alert {
            border-radius: 10px;
            border: none;
            font-weight: 500;
        }

       
        .img-thumbnail {
            border-radius: 10px;
            border: 2px solid var(--light-bg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
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

       
        @media (max-width: 768px) {
            body {
                padding: 1rem;
                background-attachment: scroll;
                align-items: flex-start;
            }
            
            .container {
                padding: 1.5rem;
                border-radius: 12px;
            }

            h2 {
                margin-bottom: 1rem;
                font-size: 1.75rem;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 1rem;
            }
            .btn-primary, .btn-secondary {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body class="p-4">
    <div class="container">
        <div id="alertBox" class="mb-3"></div>
        <h2>Edit Blanket Model (ID: <?= htmlspecialchars($id) ?>)</h2>
        <form id="editForm" class="needs-validation" novalidate>
            <input type="hidden" id="modelId" name="ModelID" value="<?= htmlspecialchars($id) ?>">
            <div class="mb-3">
                <label for="modelName" class="form-label">Model Name</label>
                <input class="form-control" id="modelName" name="ModelName" placeholder="Model Name" required>
                <div class="invalid-feedback">Please provide a model name.</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="Description" placeholder="Description"></textarea>
                <div class="invalid-feedback">Please provide a description.</div>
            </div>
            <div class="mb-3">
                <label for="material" class="form-label">Material</label>
                <input class="form-control" id="material" name="Material" placeholder="Material" required>
                <div class="invalid-feedback">Please provide the material.</div>
            </div>

            <div class="mb-3">
                <label for="manufacturerId" class="form-label">Manufacturer</label>
                <select class="form-select" id="manufacturerId" name="ManufacturerID" required>
                    <option value="">Select a Manufacturer</option>
                    <?php 
                      $sampleManufacturers = [
                        ['Id' => 1, 'ManufacturerName' => 'Cozy Textiles Inc.'],
                        ['Id' => 2, 'ManufacturerName' => 'Dream Weavers Co.'],
                        ['Id' => 3, 'ManufacturerName' => 'Comfort Zone Ltd.']
                    ];
                    foreach ($sampleManufacturers as $manufacturer) {
                        echo "<option value=\"" . htmlspecialchars($manufacturer['Id']) . "\">" . htmlspecialchars($manufacturer['ManufacturerName']) . "</option>";
                    }
                     ?>
                </select>
                <div class="invalid-feedback">Please select a manufacturer.</div>
            </div>
            <div class="mb-3">
                <label for="productionDate" class="form-label">Production Date</label>
                <input class="form-control" id="productionDate" name="ProductionDate" type="date" required>
                <div class="invalid-feedback">Please select a production date.</div>
            </div>
            <div class="mb-3">
                <label for="unitCost" class="form-label">Unit Cost (LKR)</label>
                <input class="form-control" id="unitCost" name="UnitCost" type="number" step="0.01" placeholder="Unit Cost" required min="0">
                <div class="invalid-feedback">Please provide a valid unit cost.</div>
            </div>
            <div class="mb-3">
                <label for="currentStock" class="form-label">Current Stock</label>
                <input class="form-control" id="currentStock" name="CurrentStock" type="number" placeholder="Current Stock" required min="0">
                <div class="invalid-feedback">Please provide the current stock quantity.</div>
            </div>
            <div class="mb-3">
                <label for="blanketImage" class="form-label">Blanket Image</label>
                <input class="form-control" id="blanketImage" name="BlanketImage" type="file" accept="image/*">
                <div class="invalid-feedback">Please select an image.</div>
                <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail mt-2" style="max-width: 200px; display: none;">
            </div>
            <button type="submit" class="btn btn-primary me-2">Update Blanket</button>
            <a href="blanketmanage.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcgaFwQxLpvRvYnfuX" crossorigin="anonymous"></script>
    <script>
        const modelId = <?= json_encode($id) ?>;
       
        const API_BASE_URL = "https://localhost:7033/api/BlanketModels"; 
        const form = document.getElementById("editForm");
        const alertBox = document.getElementById("alertBox");
        const fileInput = document.getElementById('blanketImage');
        const imagePreview = document.getElementById('imagePreview');
        const manufacturerSelect = document.getElementById('manufacturerId');

       
        function showAlert(message, type = 'danger') {
            alertBox.innerHTML = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;
          
            if (type === 'danger' || type === 'success') {
                setTimeout(() => {
                    const alertElement = alertBox.querySelector('.alert');
                    if (alertElement) {
                        const bsAlert = bootstrap.Alert.getInstance(alertElement) || new bootstrap.Alert(alertElement);
                        bsAlert.close();
                    }
                }, 5000);
            }
        }

        
        async function loadBlanketData() {
            console.log("Attempting to load blanket data for Model ID:", modelId); 
            if (!modelId) {
                showAlert('Invalid Model ID provided in URL. Cannot load data.', 'danger');
                console.error("Model ID is invalid or missing.");
                return;
            }
            try {
                const url = `${API_BASE_URL}/get/${modelId}`;
                console.log("Fetching existing data from URL:", url); 
                const response = await fetch(url);
                console.log("Fetch response object:", response); 

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error(`API response not OK: ${response.status} - ${response.statusText}`, errorText); 
                    throw new Error(`Failed to load blanket data: ${response.status} - ${errorText}`);
                }

                const blanket = await response.json();
                console.log("Blanket data received:", blanket); 

                
                for (const key in blanket) {
                     const formFieldName = key.charAt(0).toUpperCase() + key.slice(1);
                    const input = form.querySelector(`[name="${formFieldName}"]`);
                    
                    if (input) {
                        if (formFieldName === "ProductionDate" && blanket[key]) {
                            input.value = new Date(blanket[key]).toISOString().split('T')[0];
                        } else if (formFieldName === "UnitCost" && blanket[key] !== null && blanket[key] !== undefined) {
                            input.value = parseFloat(blanket[key]).toFixed(2);
                        } else if (formFieldName === "CurrentStock" && blanket[key] !== null && blanket[key] !== undefined) {
                            input.value = parseInt(blanket[key]);
                        } else if (formFieldName === "ManufacturerID" && blanket[key] !== null && blanket[key] !== undefined) {
                            
                            manufacturerSelect.value = blanket[key];
                        }
                        else {
                            input.value = blanket[key];
                        }
                    } else {
                        
                        console.warn(`No form input found for API field: ${key} (looking for name="${formFieldName}")`);
                    }
                }

                if (blanket.base64Image) {
                    imagePreview.src = `data:image/jpeg;base64,${blanket.base64Image}`;
                    imagePreview.style.display = 'block';
                    console.log("Image preview loaded from base64 data.");
                } else {
                    imagePreview.style.display = 'none';
                    console.log("No base64 image found for this blanket model.");
                }

            } catch (error) {
                showAlert(`Error loading blanket details: ${error.message}`, 'danger');
                console.error("Error loading blanket data:", error);
            }
        }

       
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '#';
                imagePreview.style.display = 'none';
            }
        });

        
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            e.stopPropagation();

           
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            form.classList.remove('was-validated');

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            
            data.ModelID = parseInt(data.ModelID);
            data.UnitCost = parseFloat(data.UnitCost);
            data.CurrentStock = parseInt(data.CurrentStock);
            data.ManufacturerID = parseInt(data.ManufacturerID); 

            
            const imageFile = fileInput.files[0];
            if (imageFile) {
                const reader = new FileReader();
                reader.readAsDataURL(imageFile);
                await new Promise((resolve, reject) => {
                    reader.onload = () => {
                        data.Base64Image = reader.result.split(',')[1];
                        resolve();
                    };
                    reader.onerror = error => reject(error);
                });
            } else {
               
                try {
                    const existingBlanketRes = await fetch(`${API_BASE_URL}/get/${modelId}`);
                    if (existingBlanketRes.ok) {
                        const existingBlanket = await existingBlanketRes.json();
                        data.Base64Image = existingBlanket.base64Image || existingBlanket.Base64Image || null; 
                        console.log("Re-using existing Base64Image for update.");
                    } else {
                        console.warn("Could not fetch existing blanket data to retain Base64Image during update. Sending null for image.");
                        data.Base64Image = null; 
                    }
                } catch (fetchError) {
                    console.warn("Error fetching existing image for re-submission:", fetchError);
                    data.Base64Image = null; 
                }
            }
            
            console.log("Data being sent for update:", data);

            try {
                
                const response = await fetch(`${API_BASE_URL}/update/${data.ModelID}`, {
                    method: "PUT",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    let msg = 'Blanket updated successfully!';
                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        const result = await response.json();
                        msg = result.message || msg;
                    } else {
                        const textResponse = await response.text();
                        msg = textResponse || msg;
                    }
                    showAlert(msg, 'success');
                    setTimeout(() => location.href = "blanketmanage.php", 1500); 
                } else {
                   
                    let errorMsg = 'Failed to update blanket.';
                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        const errorData = await response.json();
                        errorMsg = errorData.message || errorData.title || JSON.stringify(errorData);
                    } else {
                        errorMsg = await response.text();
                    }
                    showAlert(`Update error: ${response.status} - ${errorMsg}`, 'danger');
                    console.error("Update error details:", response.status, errorMsg);
                }
            } catch (error) {
                showAlert(`Network error: ${error.message}`, 'danger');
                console.error("Fetch error:", error);
            }
        });

       
        document.addEventListener('DOMContentLoaded', loadBlanketData);
    </script>
</body>
</html>
