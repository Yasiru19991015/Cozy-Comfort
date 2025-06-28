<?php
session_start();

$currentUserId = isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) ? (int)$_SESSION["user_id"] : 1; 
$loggedInUserName = $_SESSION['fullname'] ?? 'Customer'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Accepted Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            --accepted: #28a745; 
            --rejected: #dc3545; 
            --pending: #ffc107; 
            --shipped: #17a2b8; 
        }

        body {
            background-color: var(--background-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            padding: 2rem;
            background-image: linear-gradient(135deg, rgba(248,252,239,0.9), rgba(248,252,239,0.9)),
                              url('https://images.unsplash.com/photo-1542382257271-456070a91176?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .container-fluid {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(0, 123, 255, 0.25); 
            padding: 3rem;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
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

       
        .order-card {
            background-color: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            transition: var(--transition-speed) ease-in-out;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .order-header h3 {
            margin: 0;
            color: var(--primary);
            font-weight: 600;
            font-size: 1.5rem;
        }

        .order-header p {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .order-header strong {
            color: var(--accent);
        }

        .order-details {
            display: flex;
            gap: 25px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .order-details img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--primary-light);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .order-info {
            flex-grow: 1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 10px 20px;
        }

        .order-info p {
            margin: 0;
            line-height: 1.5;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .order-info p strong {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 0.4em 0.8em;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: capitalize;
            color: white;
            white-space: nowrap; 
        }

        .status-badge.accepted {
            background-color: var(--accepted);
        }
        .status-badge.pending {
            background-color: var(--pending);
            color: var(--text-dark);
        }
        .status-badge.rejected {
            background-color: var(--rejected);
        }
        .status-badge.shipped {
            background-color: var(--shipped);
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

        
        .no-results-message {
            text-align: center;
            padding: 30px;
            font-size: 1.1rem;
            color: var(--text-muted);
        }

       
        @media (max-width: 992px) {
            .header-section {
                flex-direction: column;
                align-items: flex-start;
                padding: 1.5rem 2rem;
            }
            .header-section h1 {
                margin-bottom: 1rem;
                text-align: center;
                width: 100%;
            }
            .container-fluid {
                padding: 2rem;
            }
            .order-details {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            .order-info {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            .container-fluid {
                padding: 1.5rem;
            }
            .header-section {
                padding: 1rem 1.5rem;
            }
            .header-section h1 {
                font-size: 1.8rem;
            }
            .order-card {
                padding: 20px;
                margin-bottom: 20px;
            }
            .order-header h3 {
                font-size: 1.3rem;
            }
            .order-header p {
                font-size: 1rem;
            }
            .order-details img {
                width: 100px;
                height: 100px;
            }
            .order-info p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <?php include "component/header.php";?>

    <div class="container-fluid">
        <div class="header-section">
            <h1>My Orders</h1>
            <p>Logged in as: <?php echo htmlspecialchars($loggedInUserName); ?></p>
        </div>
        
        <div id="customAlertContainer"></div>

        <div id="ordersContainer" class="row">
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Loading your accepted orders...</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        const customerId = <?php echo json_encode($currentUserId); ?>; 
        const loggedInUserName = <?php echo json_encode($loggedInUserName); ?>; 

        
        const API_URL_GET_CUSTOMER_ORDERS = 'https://localhost:7033/api/UserOrder/all'; 

        const customAlertContainer = document.getElementById('customAlertContainer'); 
        const ordersContainer = document.getElementById('ordersContainer');

        
        async function fetchData(url, options = {}) {
            try {
                console.log(`Fetching from: ${url}`);
                const response = await fetch(url, options);
                if (!response.ok) {
                    let errorMessage = `HTTP error! Status: ${response.status}`;
                    try {
                        const errorText = await response.text();
                        const errorJson = JSON.parse(errorText);

                       
                        if (errorJson.errors && typeof errorJson.errors === 'object') {
                            const validationErrors = Object.values(errorJson.errors).flat();
                            errorMessage += `, Validation Errors: ${validationErrors.join('; ')}`;
                        } else if (errorJson.title) {
                            errorMessage += `, Message: ${errorJson.title}`;
                        } else if (errorJson.message) {
                            errorMessage += `, Message: ${errorJson.message}`;
                        } else {
                            errorMessage += `, Raw Response: ${errorText}`; 
                        }
                    } catch (parseError) {
                        
                        const rawText = await response.text(); 
                        errorMessage += `, Details: ${rawText || 'No additional details available'}`;
                    }
                    throw new Error(errorMessage);
                }

               
                if (response.status === 204) {
                    return null;
                }

                const contentType = response.headers.get("content-type");
                if (contentType && contentType.includes("application/json")) {
                    return await response.json();
                } else {
                    
                    return await response.text();
                }
            } catch (error) {
                console.error("Fetch error in fetchData:", error);
                
                throw error;
            }
        }

      
        function showCustomAlert(title, message, type = 'danger') { 
            
            const existingAlert = customAlertContainer.querySelector('.alert');
            if (existingAlert) {
                const bsAlert = bootstrap.Alert.getInstance(existingAlert);
                if (bsAlert) bsAlert.dispose();
                existingAlert.remove();
            }

            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.setAttribute('role', 'alert');
            alertDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas ${type === 'danger' ? 'fa-exclamation-circle' : (type === 'success' ? 'fa-check-circle' : (type === 'warning' ? 'fa-exclamation-triangle' : (type === 'info' ? 'fa-info-circle' : 'fa-check-circle')))} me-2"></i>
                    <strong>${title}:</strong> ${message}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            customAlertContainer.prepend(alertDiv);

           
            setTimeout(() => {
                const bsAlert = bootstrap.Alert.getInstance(alertDiv) || new bootstrap.Alert(alertDiv);
                if (bsAlert) bsAlert.dispose();
                alertDiv.remove();
            }, 5000);
        }

        function getSafeValue(obj, keys, defaultValue = 'N/A') {
            if (!obj) return defaultValue;
            for (const key of keys) {
                if (obj.hasOwnProperty(key) && obj[key] !== undefined && obj[key] !== null && obj[key] !== '') {
                    if (typeof obj[key] === 'number') {
                        
                        if (key.toLowerCase().includes('price') || key.toLowerCase().includes('cost')) {
                            return obj[key].toFixed(2); 
                        }
                        return obj[key];
                    }
                    return obj[key]; 
                }
            }
            return defaultValue; 
        }

        function getStatusClass(status) {
            const lowerStatus = status.toLowerCase();
            if (lowerStatus === 'accepted') return 'status-accepted';
            if (lowerStatus === 'pending') return 'status-pending';
            if (lowerStatus === 'rejected') return 'status-rejected';
            if (lowerStatus === 'shipped') return 'status-shipped';
            return ''; 
        }

        async function loadAcceptedOrders() {
            ordersContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading accepted orders...</span>
                    </div>
                    <p class="mt-2">Loading your accepted orders...</p>
                </div>
            `;

            try {
               
                const allOrders = await fetchData(`${API_URL_GET_CUSTOMER_ORDERS}`);

                ordersContainer.innerHTML = ''; 

                if (allOrders && Array.isArray(allOrders) && allOrders.length > 0) {
                    const acceptedOrders = allOrders.filter(order => {
                        const status = getSafeValue(order, ['status', 'Status']);
                        return status.toLowerCase() === 'accepted';
                    });

                    if (acceptedOrders.length > 0) {
                        
                        acceptedOrders.sort((a, b) => {
                            const dateA = new Date(getSafeValue(a, ['orderDate', 'OrderDate'], 0));
                            const dateB = new Date(getSafeValue(b, ['orderDate', 'OrderDate'], 0));
                            return dateB - dateA; 
                        });

                        acceptedOrders.forEach(order => {
                            const orderId = getSafeValue(order, ['id', 'Id', 'orderID', 'OrderID']);
                            const blanketModel = order.blanketModel || order.BlanketModel || {};
                            const modelName = getSafeValue(blanketModel, ['modelName', 'ModelName']);
                            const description = getSafeValue(blanketModel, ['description', 'Description'], 'No description provided.');
                            const material = getSafeValue(blanketModel, ['material', 'Material']);
                            const totalOrderPrice = getSafeValue(order, ['totalPrice', 'TotalPrice'], 0.00); 
                            const quantity = getSafeValue(order, ['quantity', 'Quantity'], 0);
                            const sellerName = getSafeValue(order.toUser, ['fullName', 'FullName'], 'Unknown Seller');
                            const sellerEmail = getSafeValue(order.toUser, ['email', 'Email']);
                            const sellerMobileNo = getSafeValue(order.toUser, ['mobileNo', 'MobileNo']);
                            const sellerAddress = getSafeValue(order.toUser, ['address', 'Address']);
                            const orderDate = getSafeValue(order, ['orderDate', 'OrderDate']);
                            const formattedDate = orderDate ? new Date(orderDate).toLocaleDateString('en-US', {
                                year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit'
                            }) : 'N/A';
                            const status = getSafeValue(order, ['status', 'Status']);
                            let blanketImageRaw = getSafeValue(blanketModel, ['base64Image', 'Base64Image'], '');

                            let imageUrl = 'https://via.placeholder.com/120x120?text=No+Image'; 
                            if (blanketImageRaw && typeof blanketImageRaw === 'string' && blanketImageRaw.trim() !== '') {
                                if (!blanketImageRaw.startsWith('data:image/')) {
                                    imageUrl = `data:image/jpeg;base64,${blanketImageRaw}`;
                                } else {
                                    imageUrl = blanketImageRaw; 
                                }
                            }

                            const colDiv = document.createElement('div');
                            colDiv.className = 'col-12 col-md-6 col-lg-4';
                            colDiv.innerHTML = `
                                <div class="order-card">
                                    <div class="order-header">
                                        <h3>Order ID: ${orderId}</h3>
                                        <p>Status: <span class="status-badge ${getStatusClass(status)}">${status}</span></p>
                                    </div>
                                    <div class="order-details">
                                        <img src="${imageUrl}" alt="${modelName} Image">
                                        <div class="order-info">
                                            <p><strong>Blanket:</strong> ${modelName}</p>
                                            <p><strong>Description:</strong> ${description}</p>
                                            <p><strong>Material:</strong> ${material}</p>
                                            <p><strong>Ordered Quantity:</strong> ${quantity}</p>
                                            <p><strong>Total Price:</strong> LKR ${totalOrderPrice}</p>
                                            <p><strong>Seller:</strong> ${sellerName} (${sellerEmail})</p>
                                            <p><strong>Seller Mobile:</strong> ${sellerMobileNo}</p>
                                            <p><strong>Seller Address:</strong> ${sellerAddress}</p>
                                            <p><strong>Order Date:</strong> ${formattedDate}</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                            ordersContainer.appendChild(colDiv);
                        });
                    } else {
                        ordersContainer.innerHTML = '<p class="col-12 no-results-message">You currently have no accepted orders.</p>';
                    }
                } else {
                    ordersContainer.innerHTML = '<p class="col-12 no-results-message">No orders found for your account.</p>';
                }
            } catch (error) {
                console.error("Error loading accepted orders:", error);
                ordersContainer.innerHTML = '<p class="col-12 text-center text-danger py-4">Failed to load your orders. Please try again.</p>';
                showCustomAlert('Error', `Failed to load your orders: ${error.message}`, 'danger');
            }
        }

        document.addEventListener('DOMContentLoaded', async () => {
            await loadAcceptedOrders();
        });
    </script>
    <?php include "component/footer.php"; ?>
</body>
</html>
