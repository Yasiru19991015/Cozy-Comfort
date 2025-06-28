<?php
session_start();
$sellerId = isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) ? (int)$_SESSION["user_id"] : 2; 
$loggedInUserName = $_SESSION['fullname'] ?? 'Seller'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Blankets from Distributors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
        }

        .container {
            padding-top: 20px;
            padding-bottom: 40px;
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 1.75rem 2.5rem;
            text-align: center;
            border-radius: 12px;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 123, 255, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .header-section h1 {
            font-weight: 700;
            margin-bottom: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.15);
            letter-spacing: 0.5px;
            flex-grow: 1;
            text-align: left;
            font-size: 2.2rem;
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
            color: var(--accent); 
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

        .btn-purchase {
            flex-grow: 1; 
            min-width: 150px; 
            background-color: var(--accent); 
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
            box-shadow: 0 2px 5px rgba(40, 167, 69, 0.2);
        }

        .btn-purchase:hover {
            background-color: #218838; 
            transform: translateY(-2px); 
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3); 
        }

        .btn-purchase:active {
            background-color: #1e7e34; 
            transform: translateY(0); 
            box-shadow: 0 1px 3px rgba(40, 167, 69, 0.2);
        }

        .btn-purchase:disabled {
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
            .btn-purchase {
                width: 100%; 
                min-width: auto; 
            }
        }

        
        .product-card .placeholder-glow .placeholder {
            background-color: #e0e0e0;
            border-radius: .25rem;
        }

        
        #distributorFilterContainer {
            margin-bottom: 30px;
            text-align: center;
        }

        #distributorSelect {
            padding: 10px 15px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            width: 100%;
            max-width: 300px;
            font-size: 1rem;
            background-color: #fff;
            color: var(--text-dark);
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        #distributorSelect:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        #distributorSelect option {
            padding: 8px 15px;
        }

        
        .no-results-message {
            grid-column: 1 / -1; 
            text-align: center;
            padding: 30px;
            font-size: 1.1rem;
            color: var(--text-muted);
        }
    </style>
</head>
<body>
    <?php include "component/header.php"; ?>

    <div class="container">
        <div class="header-section">
            <h1>Purchase Blankets from Distributors</h1>
            <p>Logged in as: <?php echo htmlspecialchars($loggedInUserName); ?></p>
        </div>
        
        <div id="distributorFilterContainer" class="mb-4">
            <label for="distributorSelect" class="form-label mb-2">Filter by Distributor:</label>
            <select id="distributorSelect" class="form-select">
                <option value="">-- View All Distributors' Stock --</option>
            </select>
        </div>

        <div id="productGrid" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Loading available blankets...</p>
            </div>
        </div>
    </div>

    <div class="alert-container" id="customAlertContainer" style="position: fixed; top: 70px; right: 20px; z-index: 1050; max-width: 350px;"></div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const sellerId = <?php echo json_encode($sellerId); ?>;
        const loggedInUserName = <?php echo json_encode($loggedInUserName); ?>; 

        const API_BASE_URL_DISTRIBUTOR_USERS = 'https://localhost:7033/api/Distributor';
        const API_BASE_URL_SELLER_USERS = 'https://localhost:7033/api/Seller';
        const API_URL_PLACE_SELLER_ORDER = 'https://localhost:7033/api/SellerOrder/add';
        const API_URL_GET_DISTRIBUTOR_BLANKETS_BASE = 'https://localhost:7033/api/DistributorOrder/distributor'; 
        const API_URL_UPDATE_DISTRIBUTOR_ORDER_ITEM = 'https://localhost:7033/api/DistributorOrder'; 

        let allAvailableBlanketsData = [];

        async function fetchData(url, options = {}) {
            try {
                console.log(`Fetching from: ${url}`);
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
            if (stock > 0) return `Low Stock (${stock} left)`;
            return 'Out of Stock';
        }

        async function loadDistributors() {
            const distributorSelect = document.getElementById('distributorSelect');
            distributorSelect.innerHTML = '<option value="">-- View All Distributors\' Stock --</option>'; 

            try {
                const distributors = await fetchData(`${API_BASE_URL_DISTRIBUTOR_USERS}/get-all`);
                if (distributors && distributors.length > 0) {
                    distributors.sort((a, b) => {
                        const nameA = (a.distributorName || a.DistributorName || a.fullName || a.FullName || '').toLowerCase();
                        const nameB = (b.distributorName || b.DistributorName || b.fullName || b.FullName || '').toLowerCase();
                        return nameA.localeCompare(nameB);
                    });

                    distributors.forEach(distributor => {
                        const option = document.createElement('option');
                        const distributorID = distributor.distributorID || distributor.DistributorID || distributor.id || distributor.Id;
                        const distributorName = distributor.distributorName || distributor.DistributorName || distributor.fullName || distributor.FullName || `Distributor ${distributorID}`;
                        if (distributorID) { 
                            option.value = distributorID;
                            option.textContent = distributorName;
                            distributorSelect.appendChild(option);
                        }
                    });
                } else {
                    showCustomAlert('Info', 'No distributors found in the system.', 'info');
                }
            } catch (error) {
                console.error("Error loading distributors:", error);
                showCustomAlert('Error', 'Failed to load distributor list. Please try again later.', 'danger');
            }
        }

        async function loadAllDistributorsBlankets(selectedDistributorId = null) {
            const gridContainer = document.getElementById('productGrid');
            gridContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading blankets...</span>
                    </div>
                    <p class="mt-2">Loading available blankets...</p>
                </div>
            `;
            allAvailableBlanketsData = []; 

            let distributorPromises = [];

            try {
                const distributors = await fetchData(`${API_BASE_URL_DISTRIBUTOR_USERS}/get-all`);
                
                if (!distributors || distributors.length === 0) {
                    gridContainer.innerHTML = '<p class="col-12 no-results-message">No distributors found, so no blankets to display.</p>';
                    return;
                }

                for (const distributor of distributors) {
                    const distributorId = distributor.distributorID || distributor.DistributorID || distributor.id || distributor.Id;
                    const distributorName = distributor.distributorName || distributor.DistributorName || distributor.fullName || distributor.FullName;

                    if (selectedDistributorId && String(selectedDistributorId) !== String(distributorId)) {
                        continue;
                    }
                    
                    if (distributorId) { 
                        distributorPromises.push(
                            fetchData(`${API_URL_GET_DISTRIBUTOR_BLANKETS_BASE}/${distributorId}`)
                            .then(inventories => {
                                if (inventories && Array.isArray(inventories)) {
                                    const acceptedItems = inventories.filter(item => {
                                        const status = item.status || item.Status || '';
                                        const quantity = item.quantity || item.Quantity || 0;
                                        return status.toLowerCase() === 'accepted' && quantity > 0;
                                    });

                                    return acceptedItems.map(item => {
                                        const blanketModel = item.blanketModel || item.BlanketModel;
                                        if (blanketModel && (item.distributorOrderItemID || item.DistributorOrderItemID || item.orderID || item.OrderID)) {
                                            return {
                                                ...item,
                                                distributorOrderItemID: item.distributorOrderItemID || item.DistributorOrderItemID || item.orderID || item.OrderID, 
                                                blanketModel: blanketModel,
                                                distributorID: distributorId,
                                                distributorName: distributorName
                                            };
                                        }
                                        console.warn("Skipping malformed inventory item:", item);
                                        return null;
                                    }).filter(Boolean); 
                                }
                                return [];
                            })
                            .catch(error => {
                                console.warn(`Could not fetch blankets for distributor ${distributorName} (ID: ${distributorId}):`, error.message);
                                return [];
                            })
                        );
                    }
                }

                const results = await Promise.all(distributorPromises);
                results.forEach(items => {
                    allAvailableBlanketsData.push(...items);
                });

                gridContainer.innerHTML = ''; 

                if (allAvailableBlanketsData.length > 0) {
                    allAvailableBlanketsData.sort((a, b) => {
                        const distributorNameA = (a.distributorName || '').toLowerCase();
                        const distributorNameB = (b.distributorName || '').toLowerCase();
                        const modelNameA = (a.blanketModel?.modelName || a.blanketModel?.ModelName || '').toLowerCase();
                        const modelNameB = (b.blanketModel?.modelName || b.blanketModel?.ModelName || '').toLowerCase();
                        
                        if (distributorNameA < distributorNameB) return -1;
                        if (distributorNameA > distributorNameB) return 1;
                        return modelNameA.localeCompare(modelNameB);
                    });

                    for (const inventoryItem of allAvailableBlanketsData) {
                        
                        const distributorOrderItemID = inventoryItem.distributorOrderItemID || inventoryItem.DistributorOrderItemID || inventoryItem.orderID || inventoryItem.OrderID;
                        const quantityOnHand = inventoryItem.quantity || inventoryItem.Quantity || 0;
                        const distributorID = inventoryItem.distributorID;
                        const distributorName = inventoryItem.distributorName;
                        
                        const blanketModel = inventoryItem.blanketModel || inventoryItem.BlanketModel;

                        if (!blanketModel || quantityOnHand <= 0 || !distributorOrderItemID) {
                            console.warn(`Skipping item due to missing data or out of stock:`, inventoryItem);
                            continue;
                        }

                        const modelName = blanketModel.modelName || blanketModel.ModelName || 'Unknown Model';
                        const description = blanketModel.description || blanketModel.Description || 'No description provided.';
                        const material = blanketModel.material || blanketModel.Material || 'N/A';
                        const unitPrice = inventoryItem.unitPrice || inventoryItem.UnitPrice || 
                                          (blanketModel.pricePerUnit || blanketModel.PricePerUnit || blanketModel.unitCost || blanketModel.UnitCost || 0.00);
                        const imageBase64 = blanketModel.base64Image || blanketModel.Base64Image;
                        const imageUrl = imageBase64 ? `data:image/jpeg;base64,${imageBase64}` : 'https://via.placeholder.com/200x200?text=No+Image';
                        const blanketId = blanketModel.blanketID || blanketModel.BlanketID; 

                        const colDiv = document.createElement('div');
                        colDiv.className = 'col';
                        colDiv.innerHTML = `
                            <div class="product-card" data-order-item-id="${distributorOrderItemID}" data-distributor-id="${distributorID}">
                                <div class="product-image">
                                    <img src="${imageUrl}" alt="${modelName}">
                                </div>
                                <div class="product-info">
                                    <h5 class="product-title">${modelName}</h5>
                                    <p class="product-description">${description}</p>
                                    <p class="product-material"><strong>Material:</strong> ${material}</p>
                                    <p class="product-cost">LKR ${unitPrice.toFixed(2)}</p>
                                    <div class="product-stock">
                                        <span class="stock-badge ${getStockClass(quantityOnHand)}">${getStockText(quantityOnHand)}</span>
                                        <span class="ms-2">(${quantityOnHand} available)</span>
                                    </div>
                                    <p class="text-muted" style="font-size: 0.8em;">From: ${distributorName}</p>
                                    <div class="order-section">
                                        <div class="quantity-input-wrapper">
                                            <label for="quantity-${distributorOrderItemID}" class="quantity-label">Quantity:</label>
                                            <input type="number" id="quantity-${distributorOrderItemID}" class="form-control quantity-input" 
                                                    value="1" min="1" max="${quantityOnHand}" 
                                                    ${quantityOnHand === 0 ? 'disabled' : ''}>
                                        </div>
                                        <button class="btn btn-purchase"
                                            data-order-item-id="${distributorOrderItemID}"
                                            data-blanket-id="${blanketId}"
                                            data-distributor-id="${distributorID}"
                                            data-unit-price="${unitPrice}"
                                            data-max-quantity="${quantityOnHand}"
                                            data-seller-id="${sellerId}" ${quantityOnHand === 0 ? 'disabled' : ''}>
                                            <i class="fas fa-shopping-cart me-2"></i> Purchase
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        gridContainer.appendChild(colDiv);
                    }

                    document.querySelectorAll('.btn-purchase').forEach(button => {
                        button.addEventListener('click', handlePurchase);
                    });

                } else {
                    gridContainer.innerHTML = '<p class="col-12 no-results-message">No accepted blanket stock found from distributors.</p>';
                }
            } catch (error) {
                console.error("Error loading all distributors' blankets:", error);
                gridContainer.innerHTML = '<p class="col-12 text-center text-danger py-4">Failed to load blankets. Please try again.</p>';
                showCustomAlert('Error', `Failed to load blankets: ${error.message}`, 'danger');
            }
        }

        async function handlePurchase(event) {
            const button = event.currentTarget;

            
            const distributorOrderItemID = button.dataset.orderItemId; 
            const blanketId = button.dataset.blanketId;
            const sellerId = button.dataset.sellerId; 
            const distributorId = button.dataset.distributorId;
            const unitPrice = parseFloat(button.dataset.unitPrice);
            const maxQuantity = parseInt(button.dataset.maxQuantity); 

           
            if (!distributorOrderItemID || !blanketId || !sellerId || !distributorId || isNaN(unitPrice)) {
                showCustomAlert('Error', 'Missing critical purchase data. Cannot proceed. Please refresh the page.', 'danger');
                console.error('Missing data for purchase:', { distributorOrderItemID, blanketId, sellerId, distributorId, unitPrice });
                return;
            }

            const quantityInput = document.getElementById(`quantity-${distributorOrderItemID}`);
            const purchaseQuantity = parseInt(quantityInput?.value);

            if (isNaN(purchaseQuantity) || purchaseQuantity <= 0) {
                showCustomAlert('Warning', 'Please enter a valid quantity.', 'warning');
                return;
            }
            
            if (purchaseQuantity > maxQuantity) {
                showCustomAlert('Warning', `You can only purchase up to ${maxQuantity} units.`, 'warning');
                return;
            }

          
            const selectedBlanketItem = allAvailableBlanketsData.find(item =>
                (String(item.distributorOrderItemID) === distributorOrderItemID) || (String(item.DistributorOrderItemID) === distributorOrderItemID)
            );

            if (!selectedBlanketItem || !selectedBlanketItem.blanketModel) {
                showCustomAlert('Error', 'Blanket details not found for purchase. Please refresh.', 'danger');
                console.error('Selected blanket item or its model not found in cache:', selectedBlanketItem);
                return;
            }

            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Purchasing...';

            try {
               
                const purchaseData = {
                    DistributorOrderItemID: parseInt(distributorOrderItemID),
                    BlanketID: parseInt(blanketId),
                    SellerID: parseInt(sellerId), 
                    DistributorID: parseInt(distributorId),
                    Quantity: purchaseQuantity,
                    TotalPrice: (purchaseQuantity * unitPrice),
                    
                    Notes: `Order placed by ${loggedInUserName} for ${purchaseQuantity} units of ${selectedBlanketItem.blanketModel.modelName || 'a blanket'}.`,
                    Status: 'Pending', 
                    
                  
                    ToUser: { 
                        Id: parseInt(distributorId),
                        FullName: selectedBlanketItem.distributorName || 'Distributor Name',
                        Address: "Distributor Address", 
                        MobileNo: "0771234567",
                        Email: `distributor${distributorId}@example.com`,
                        Password: "Password123!", 
                        Role: "Distributor", 
                        Base64Image: "" 
                    },
                    FromUser: {
                        Id: parseInt(sellerId),
                        FullName: loggedInUserName,
                        Address: "Seller Address", 
                        MobileNo: "0719876543",
                        Email: `seller${sellerId}@example.com`,
                        Password: "Password123!", 
                        Role: "Seller", 
                        Base64Image: "" 
                    },
                    BlanketModel: selectedBlanketItem.blanketModel 
                };
                
                console.log("Sending Purchase Data to SellerOrder/add:", purchaseData);

                const result = await fetchData(API_URL_PLACE_SELLER_ORDER, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(purchaseData)
                });

                if (result) {
                    showCustomAlert('Success', `Successfully placed purchase order for ${purchaseQuantity} units.`, 'success');
                    const selectedDistributorId = document.getElementById('distributorSelect').value;
                    await loadAllDistributorsBlankets(selectedDistributorId || null); 
                } else {
                    showCustomAlert('Purchase Failed', `Could not complete purchase. No data returned from API.`, 'danger');
                }

            } catch (error) {
                console.error("Error during purchase:", error);
                showCustomAlert('Error', `An error occurred during purchase: ${error.message}`, 'danger');
            } finally {
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-shopping-cart me-2"></i> Purchase';
            }
        }

        document.addEventListener('DOMContentLoaded', async () => {
            await loadDistributors();
            await loadAllDistributorsBlankets(); 
            
            document.getElementById('distributorSelect').addEventListener('change', (event) => {
                const selectedDistributorId = event.target.value;
                loadAllDistributorsBlankets(selectedDistributorId || null);
            });
        });

    </script>
    <?php include "component/footer.php"; ?>
</body>
</html>