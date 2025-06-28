<?php
session_start();
$distributorId = isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) ? (int)$_SESSION["user_id"] : 1; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributor Blanket Order</title>
    <style>
       
        :root {
            --primary: #007bff; 
            --primary-dark: #0056b3;
            --primary-light: #66b5ff; 
            --accent: #dc3545; 
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

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
        }

        .container {
            padding-top: 20px;
            padding-bottom: 40px;
        }

        h1 {
            color: var(--text-dark);
            border-bottom: 2px solid var(--primary);
            padding-bottom: 10px;
            margin-bottom: 30px;
            text-align: center;
        }

       
        .product-card {
            background-color: var(--card-background);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform var(--transition-speed) ease-in-out, box-shadow var(--transition-speed) ease-in-out;
            display: flex;
            flex-direction: column;
            height: 100%; 
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px; 
            overflow: hidden;
            background-color: #e9ecef; 
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
        }

        .product-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 10px;
            font-weight: bold;
        }

        .product-description {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 10px;
            height: 60px; 
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; 
            -webkit-box-orient: vertical;
        }

        .product-material {
            font-size: 0.85rem;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .product-cost {
            font-size: 1.35rem;
            color: #28a745;
            font-weight: 700; 
            margin-top: 10px;
            margin-bottom: 15px; 
        }

        .product-stock {
            margin-top: 10px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .stock-badge {
            padding: .35em .65em;
            border-radius: .25rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap; 
        }

        .in-stock {
            background-color: #28a745; 
        }

        .low-stock {
            background-color: #ffc107; 
            color: #343a40;
        }

        .out-of-stock {
            background-color: #dc3545; 
        }

        
        .order-section {
            display: flex;
            align-items: center;
            margin-top: 20px;
            gap: 15px; 
            flex-wrap: wrap;
        }

        .quantity-input-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
            flex-basis: 120px;
            flex-grow: 0; 
            flex-shrink: 1; 
        }

        .quantity-label {
            font-size: 0.9rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .quantity-input {
            width: 100px; 
            text-align: center;
            padding: 0.6rem 0.8rem; 
            border: 2px solid var(--primary);
            border-radius: 8px; 
            font-size: 1.1rem; 
            color: var(--text-dark);
            transition: all var(--transition-speed) ease-in-out;
            -moz-appearance: textfield; 
        }

       
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-input:focus {
            border-color: var(--primary-dark); 
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            outline: none; 
        }

        .btn-place-order {
            flex-grow: 1; 
            min-width: 150px; 
            background-color: var(--primary);
            border: none; 
            color: white;
            font-weight: 700; 
            padding: 0.8rem 1.25rem; 
            border-radius: 8px;
            transition: all var(--transition-speed) ease-in-out;
            font-size: 1rem;
            text-transform: uppercase; 
            letter-spacing: 0.5px;
            cursor: pointer;
            display: flex; 
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 2px 5px rgba(0, 123, 255, 0.2); 
        }

        .btn-place-order:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px); 
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3); 
        }

        .btn-place-order:active {
            background-color: #004085; 
            transform: translateY(0); 
            box-shadow: 0 1px 3px rgba(0, 123, 255, 0.2);
        }

        .btn-place-order:disabled {
            background-color: #cccccc; 
            color: #666666;
            cursor: not-allowed;
            opacity: 0.8;
            transform: none; 
            box-shadow: none;
        }
        
        
        .alert-container {
            position: fixed;
            top: 70px; 
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

        
        @media (max-width: 767.98px) {
            .product-image {
                height: 180px;
            }
            .product-title {
                font-size: 1.3rem;
            }
            .product-cost {
                font-size: 1.2rem;
            }
            .order-section {
                flex-direction: column;
                align-items: stretch; 
                gap: 10px;
            }
            .quantity-input-wrapper {
                width: 100%; 
                align-items: center; 
                flex-basis: auto; 
            }
            .quantity-input {
                width: 100%;
                max-width: 150px; 
            }
            .btn-place-order {
                width: 100%; 
                min-width: auto; 
            }
        }

       
        .product-card .placeholder-glow .placeholder {
            background-color: #e0e0e0;
            border-radius: .25rem;
        }
    </style>
</head>
<body>
    <?php include "component/header.php"; ?>

    <div class="container">
        <h1 class="mt-4 mb-4">Available Blankets from All Manufacturers</h1>
        
        <div id="productGrid" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="product-card">
                    <div class="product-image">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title placeholder-glow"><span class="placeholder col-8"></span></h5>
                        <p class="text-muted placeholder-glow"><span class="placeholder col-6"></span></p>
                        <div class="product-stock placeholder-glow">
                            <span class="placeholder col-4"></span>
                        </div>
                        <p class="product-cost placeholder-glow"><span class="placeholder col-5"></span></p>
                        <div class="order-section">
                            <div class="quantity-input-wrapper placeholder-glow">
                                <label class="quantity-label placeholder col-6"></label>
                                <input type="number" class="form-control quantity-input placeholder col-8" value="1" min="1" disabled>
                            </div>
                            <button class="btn btn-primary btn-place-order disabled placeholder col-6"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="product-card">
                    <div class="product-image">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title placeholder-glow"><span class="placeholder col-8"></span></h5>
                        <p class="text-muted placeholder-glow"><span class="placeholder col-6"></span></p>
                        <div class="product-stock placeholder-glow">
                            <span class="placeholder col-4"></span>
                        </div>
                        <p class="product-cost placeholder-glow"><span class="placeholder col-5"></span></p>
                        <div class="order-section">
                            <div class="quantity-input-wrapper placeholder-glow">
                                <label class="quantity-label placeholder col-6"></label>
                                <input type="number" class="form-control quantity-input placeholder col-8" value="1" min="1" disabled>
                            </div>
                            <button class="btn btn-primary btn-place-order disabled placeholder col-6"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="product-card">
                    <div class="product-image">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title placeholder-glow"><span class="placeholder col-8"></span></h5>
                        <p class="text-muted placeholder-glow"><span class="placeholder col-6"></span></p>
                        <div class="product-stock placeholder-glow">
                            <span class="placeholder col-4"></span>
                        </div>
                        <p class="product-cost placeholder-glow"><span class="placeholder col-5"></span></p>
                        <div class="order-section">
                            <div class="quantity-input-wrapper placeholder-glow">
                                <label class="quantity-label placeholder col-6"></label>
                                <input type="number" class="form-control quantity-input placeholder col-8" value="1" min="1" disabled>
                            </div>
                            <button class="btn btn-primary btn-place-order disabled placeholder col-6"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="alert-container" id="customAlertContainer"></div>

    
    <script>
       
        const fromUserID = <?php echo json_encode($distributorId); ?>;

       
        const API_BASE_URL_BLANKET = 'https://localhost:7033/api/BlanketModels';
        const API_URL_PLACE_ORDER = 'https://localhost:7033/api/DistributorOrder/add';
        const API_URL_UPDATE_BLANKET = 'https://localhost:7033/api/BlanketModels/update'; 
        
        const API_BASE_URL_DISTRIBUTOR_USER = 'https://localhost:7033/api/Distributor'; 
        const API_BASE_URL_MANUFACTURER_USER = 'https://localhost:7033/api/Manufacturer'; /

        
        async function fetchData(url, options = {}) {
            try {
                const response = await fetch(url, options);

                if (!response.ok) {
                    const errorResponse = response.clone();
                    let errorMessage = `HTTP Error! Status: ${response.status} ${response.statusText}`;
                    
                    try {
                        const errorText = await errorResponse.text();
                        if (errorText) {
                            try {
                                const errorJson = JSON.parse(errorText);
                                if (errorJson.errors) {
                                    errorMessage += ' - Validation Errors: ';
                                    for (const key in errorJson.errors) {
                                        errorMessage += `${key}: ${errorJson.errors[key].join(', ')}. `;
                                    }
                                } else {
                                    errorMessage += ` - ${errorJson.detail || errorJson.title || errorJson.message || errorText}`;
                                }
                            } catch (e) {
                                errorMessage += ` - ${errorText}`;
                            }
                        }
                    } catch (e) {
                        console.error("Failed to read error response as text:", e);
                    }
                    
                    throw new Error(errorMessage);
                }

                if (response.status === 204 || response.headers.get('Content-Length') === '0') {
                    return null;
                }

                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return await response.json();
                }
                return await response.text(); 
            } catch (error) {
                console.error("API Fetch Error:", error);
                showCustomAlert('Error', `Data fetch failed: ${error.message || 'Unknown error'}`);
                throw error;
            }
        }

        /
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

        
        function getStockClass(stock) {
            if (stock > 10) return 'in-stock';
            if (stock > 0) return 'low-stock';
            return 'out-of-stock';
        }

        function getStockText(stock) {
            if (stock > 10) return 'In Stock';
            if (stock > 0) return 'Low Stock';
            return 'Out of Stock';
        }

        
        function formatDateForBackend(dateString) {
            const date = new Date(dateString);
            if (isNaN(date.getTime())) { 
                return new Date().toISOString().split('T')[0];
            }
            return date.toISOString().split('T')[0];
        }

        
        async function loadBlankets() {
            const gridContainer = document.getElementById('productGrid');
            gridContainer.innerHTML = `
                <div class="col-12 text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading blankets...</span>
                    </div>
                    <p class="mt-2">Loading blankets from all manufacturers...</p>
                </div>
            `;

            try {
                const blankets = await fetchData(`${API_BASE_URL_BLANKET}/get-all`);
                console.log("Fetched blankets:", blankets); 
                
                gridContainer.innerHTML = ''; 

                if (blankets && blankets.length > 0) {
                    blankets.forEach(blanket => {
                        const stock = blanket.currentStock !== undefined && blanket.currentStock !== null ? blanket.currentStock : 0;
                        
                       
                        const manufacturerIdForBlanket = (typeof blanket.manufacturerID === 'number' && blanket.manufacturerID > 0) 
                                                                     ? blanket.manufacturerID 
                                                                     : (typeof blanket.ManufacturerID === 'number' && blanket.ManufacturerID > 0)
                                                                       ? blanket.ManufacturerID
                                                                       : 4; 

                        const cardHtml = `
                            <div class="col">
                                <div class="product-card">
                                    <div class="product-image">
                                        ${blanket.base64Image ? 
                                            `<img src="data:image/jpeg;base64,${blanket.base64Image}" 
                                                alt="${blanket.modelName}"
                                                onerror="this.onerror=null;this.src='https://placehold.co/300x220/cccccc/333333?text=Image+Not+Found'">` : 
                                            `<img src="https://placehold.co/300x220/cccccc/333333?text=No+Image" alt="No Image">`
                                        }
                                    </div>
                                    <div class="product-info">
                                        <div>
                                            <h5 class="product-title">${blanket.modelName}</h5>
                                            <p class="product-description">${blanket.description || 'No description provided.'}</p>
                                            <p class="product-material">Material: ${blanket.material || 'N/A'}</p>
                                        </div>
                                        <div class="product-bottom-section">
                                            <p class="product-cost">Unit Cost: <strong>LKR ${blanket.unitCost ? parseFloat(blanket.unitCost).toFixed(2) : '0.00'}</strong></p>
                                            <p class="product-material">Manufacturer ID: ${manufacturerIdForBlanket}</p>
                                            <div class="product-stock">
                                                <span class="stock-badge ${getStockClass(stock)}">
                                                    ${getStockText(stock)}
                                                </span>
                                                <span class="ms-2">${stock} available</span>
                                            </div>
                                            <div class="order-section">
                                                <div class="quantity-input-wrapper">
                                                    <label for="qty-${blanket.modelID}" class="quantity-label">Quantity:</label>
                                                    <input type="number" id="qty-${blanket.modelID}" class="form-control quantity-input" value="1" min="1" max="${stock}" 
                                                        data-manufacturer-id="${manufacturerIdForBlanket}" ${stock === 0 ? 'disabled' : ''}>
                                                </div>
                                                <button class="btn btn-primary btn-place-order" 
                                                        data-blanket-id="${blanket.modelID}" 
                                                        data-blanket-name="${blanket.modelName}"
                                                        data-current-stock="${stock}"
                                                        data-manufacturer-id="${manufacturerIdForBlanket}"
                                                        ${stock === 0 ? 'disabled' : ''}>
                                                    ${stock === 0 ? 'Out of Stock' : '<i class="fas fa-shopping-cart me-1"></i> Add to Order'}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        gridContainer.innerHTML += cardHtml;
                    });

                    document.querySelectorAll('.btn-place-order').forEach(button => {
                        button.addEventListener('click', handlePlaceOrder);
                    });
                } else {
                    gridContainer.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-info" role="alert">
                                No blankets currently available for purchase from any manufacturer. Please check back later!
                            </div>
                        </div>
                    `;
                }
            } catch (error) {
                console.error("Error loading blankets:", error); 
                gridContainer.innerHTML = `
                    <div class="col-12 text-center text-danger">
                        <p class="mt-2">Failed to load blankets. Please ensure your backend API is running and CORS is configured correctly. Check the browser console for more details.</p>
                    </div>
                `;
            }
        }

        
        async function handlePlaceOrder(event) {
            const button = event.currentTarget;
            const blanketId = button.dataset.blanketId;
            const blanketName = button.dataset.blanketName;
            const currentStock = parseInt(button.dataset.currentStock);
            const manufacturerId = parseInt(button.dataset.manufacturerId);

            const quantityInput = button.closest('.order-section').querySelector('.quantity-input');
            const quantity = parseInt(quantityInput.value);

            
            
            if (isNaN(quantity) || quantity <= 0) {
                showCustomAlert('Invalid Quantity', 'Please enter a valid quantity greater than 0.');
                return;
            }
            if (quantity > currentStock) {
                showCustomAlert('Insufficient Stock', `Requested quantity (${quantity}) exceeds available stock (${currentStock}) for ${blanketName}.`);
                return;
            }
           
            if (isNaN(manufacturerId) || manufacturerId <= 0) { 
                showCustomAlert('Error', 'Manufacturer ID for this blanket is invalid. Cannot place order.');
                return;
            }

            button.disabled = true;
            const originalButtonHtml = button.innerHTML;
            button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Placing Order...';

            let fullBlanketModel; 
            let actualFromUser;
            let actualToUser;

            try {
                
                fullBlanketModel = await fetchData(`${API_BASE_URL_BLANKET}/get/${blanketId}`);
                if (!fullBlanketModel) {
                    throw new Error(`Could not retrieve full details for Blanket Model ID: ${blanketId}`);
                }
                
                fullBlanketModel = {
                    ModelID: fullBlanketModel.modelID || fullBlanketModel.ModelID || parseInt(blanketId), 
                    ModelName: fullBlanketModel.modelName || fullBlanketModel.ModelName || 'N/A',
                    Description: fullBlanketModel.description || fullBlanketModel.Description || 'No description provided.',
                    Material: fullBlanketModel.material || fullBlanketModel.Material || 'N/A',
                    ProductionDate: formatDateForBackend(fullBlanketModel.productionDate || fullBlanketModel.ProductionDate || new Date()),
                    UnitCost: fullBlanketModel.unitCost || fullBlanketModel.UnitCost || 0.00,
                    CurrentStock: fullBlanketModel.currentStock || fullBlanketModel.CurrentStock || 0,
                    Base64Image: fullBlanketModel.base64Image || fullBlanketModel.Base64Image || "",
                    ManufacturerID: fullBlanketModel.manufacturerID || fullBlanketModel.ManufacturerID || manufacturerId 
                };

                
                if (fromUserID <= 0) {
                    throw new Error(`Invalid Distributor ID from session: ${fromUserID}. Please log in again.`);
                }
                actualFromUser = await fetchData(`${API_BASE_URL_DISTRIBUTOR_USER}/get/${fromUserID}`);
                if (!actualFromUser) {
                    throw new Error(`Could not retrieve full details for Distributor ID: ${fromUserID}. Check if distributor with this ID exists.`);
                }
               
                actualFromUser = {
                    Id: actualFromUser.id || actualFromUser.Id,
                    FullName: actualFromUser.fullName || actualFromUser.FullName || `Distributor ${fromUserID}`,
                    Address: actualFromUser.address || actualFromUser.Address || "N/A",
                    MobileNo: actualFromUser.mobileNo || actualFromUser.MobileNo || "N/A",
                    DateOfBirth: formatDateForBackend(actualFromUser.dateOfBirth || actualFromUser.DateOfBirth || "2000-01-01"),
                    Email: actualFromUser.email || actualFromUser.Email || `distributor${fromUserID}@example.com`,
                    Password: actualFromUser.password || actualFromUser.Password || "Password123!", 
                    Role: actualFromUser.role || actualFromUser.Role || "Distributor",
                    Base64Image: actualFromUser.base64Image || actualFromUser.Base64Image || ""
                };

               
                actualToUser = await fetchData(`${API_BASE_URL_MANUFACTURER_USER}/get/${manufacturerId}`);
                if (!actualToUser) {
                    throw new Error(`Could not retrieve full details for Manufacturer ID: ${manufacturerId}. Check if manufacturer with this ID exists.`);
                }
                
                actualToUser = {
                    Id: actualToUser.id || actualToUser.Id,
                    FullName: actualToUser.fullName || actualToUser.FullName || `Manufacturer ${manufacturerId}`,
                    Address: actualToUser.address || actualToUser.Address || "N/A",
                    MobileNo: actualToUser.mobileNo || actualToUser.MobileNo || "N/A",
                    DateOfBirth: formatDateForBackend(actualToUser.dateOfBirth || actualToUser.DateOfBirth || "1995-05-15"),
                    Email: actualToUser.email || actualToUser.Email || `manufacturer${manufacturerId}@example.com`,
                    Password: actualToUser.password || actualToUser.Password || "Password123!", 
                    Role: actualToUser.role || actualToUser.Role || "Manufacturer",
                    Base64Image: actualToUser.base64Image || actualToUser.Base64Image || ""
                };

            } catch (fetchError) {
                console.error("Error fetching user/blanket details:", fetchError);
                showCustomAlert('Error', `Failed to get required user/blanket details for order: ${fetchError.message}`);
                button.disabled = false;
                button.innerHTML = originalButtonHtml;
                return;
            }

           
            const orderPayload = {
                Quantity: quantity,
                Notes: `Order for ${blanketName} placed by distributor: ${actualFromUser.FullName || fromUserID}`,
                Status: 'pending',
                BlanketModel: fullBlanketModel, 
                FromUser: actualFromUser,        
                ToUser: actualToUser        
            };

            try {
                const orderResult = await fetchData(API_URL_PLACE_ORDER, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(orderPayload)
                });

                if (orderResult) {
                    showCustomAlert('Order Placed!', `Your order for ${quantity}x ${blanketName} (Order ID: ${orderResult.orderID || 'N/A'}) has been placed successfully!`, 'success');

                    
                    fullBlanketModel.CurrentStock = currentStock - quantity; 
                    
                    const updateResult = await fetchData(`${API_BASE_URL_BLANKET}/update/${blanketId}`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(fullBlanketModel)
                    });

                    if (updateResult) {
                        showCustomAlert('Stock Updated', `Stock for ${blanketName} updated successfully to ${fullBlanketModel.CurrentStock}.`, 'info');
                    } else {
                        showCustomAlert('Stock Update Warning', `Could not confirm stock update for ${blanketName}. Please check manually.`, 'warning');
                    }
                } else {
                    showCustomAlert('Order Placed!', `Your order for ${quantity}x ${blanketName} has been placed successfully.`, 'success');
                }
                
                loadBlankets(); 

            } catch (error) {
                console.error("Error during order placement or stock update:", error);
                showCustomAlert('Error', `Order failed or stock update issue: ${error.message}`);
            } finally {
                button.disabled = false;
                button.innerHTML = originalButtonHtml;
            }
        }

        document.addEventListener('DOMContentLoaded', loadBlankets);
    </script>
    <?php include "component/footer.php"; ?>
</body>
</html>