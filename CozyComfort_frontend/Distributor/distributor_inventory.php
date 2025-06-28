<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); 
    exit();
}

$distributorId = $_SESSION['user_id'];
$loggedInUserName = $_SESSION['fullname'] ?? 'Distributor';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributor Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        
        :root {
            --primary: #4CAF50; 
            --primary-light: #81C784; 
            --accent: #FFC107; 
            --accent-light: #FFEB3B; 
            --light-bg: #F8FCEF; 
            --text-dark: #2E7D32; 
            --text-light: #66BB6A; 
            --success: #28a745; 
            --danger: #dc3545; 
            --warning: #ffc107; 
            --info: #17a2b8; 
            --accepted: #28a745; 
            --rejected: #e65100; 
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
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
            box-shadow: 0 12px 40px rgba(76, 175, 80, 0.25);
            padding: 3rem;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 1.75rem 2.5rem;
            text-align: center;
            border-radius: 12px;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 20px rgba(76, 175, 80, 0.3);
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

        
        #orderHistoryContainer {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); 
            gap: 30px;
        }

        
        .order-card {
            background-color: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
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
            flex-direction: column;
            gap: 15px;
            margin-top: 15px;
            align-items: center; 
        }

       
        .order-details img {
            width: 200px;
            height: 200px; 
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--primary-light);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 15px; 
        }
        

        .order-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            text-align: center; 
        }

        .order-info p {
            margin: 0;
            line-height: 1.5;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .order-info p strong {
            color: var(--primary-light);
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
        }

        .status-badge.accepted {
            background-color: var(--accepted);
        }

        .status-badge.rejected {
            background-color: var(--rejected);
        }

        .status-badge.pending {
            background-color: var(--warning);
            color: var(--text-dark);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid transparent;
            font-size: 0.95rem;
            animation: fadeIn 0.5s ease-out;
            display: flex;
            align-items: center;
            position: relative;
        }
        .alert strong {
            margin-right: 5px;
        }
        .alert .btn-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
            transition: opacity 0.2s ease;
            padding: 0.5rem;
            margin: -0.5rem -0.5rem -0.5rem auto;
        }
        .alert .btn-close:hover {
            opacity: 1;
        }

        .alert-success { background-color: #e6ffed; color: var(--success); border-color: #b2f5d7; }
        .alert-danger { background-color: #ffe6e8; color: var(--danger); border-color: #ffb3b8; }
        .alert-warning { background-color: #fff9e6; color: var(--warning); border-color: #ffeb99; }
        .alert-info { background-color: #e6f9ff; color: var(--info); border-color: #b3e7ff; }
        .alert-accepted {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .alert-rejected {
            background-color: #ffe0b2;
            color: #e65100;
            border-color: #ffcc80;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
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
            
            #orderHistoryContainer {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 20px;
            }
            .order-details {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            .order-info {
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
            }
            .order-header h3 {
                font-size: 1.3rem;
            }
            .order-header p {
                font-size: 1rem;
            }
           
            .order-details img {
                width: 150px; 
                height: 150px; 
            }
           
            .order-info p {
                font-size: 0.9rem;
            }
            
            #orderHistoryContainer {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <?php include "component/header.php"; ?>
    <div class="container-fluid">
        <div class="header-section">
            <h1>My Inventory</h1> <p>Logged in as: <?php echo htmlspecialchars($loggedInUserName); ?></p>
        </div>

        <div id="alertContainer"></div>

        <div id="orderHistoryContainer">
            <p class="text-center text-muted py-4 w-100">Loading accepted orders...</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const API_BASE_URL_ORDER = 'https://localhost:7033/api/DistributorOrder';
        const DISTRIBUTOR_ID = <?php echo json_encode($distributorId); ?>;

        const alertContainer = document.getElementById('alertContainer');
        const orderHistoryContainer = document.getElementById('orderHistoryContainer');

        document.addEventListener('DOMContentLoaded', () => {
            loadOrderHistory();
        });

        async function fetchData(url, options = {}) {
            try {
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

        function showAlert(title, message, type) {
            const existingAlert = alertContainer.querySelector('.alert');
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
            alertContainer.prepend(alertDiv);

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
                        if (key.toLowerCase().includes('cost') || key.toLowerCase().includes('price')) {
                            return obj[key].toFixed(2);
                        }
                        return obj[key];
                    }
                    return obj[key];
                }
            }
            return defaultValue;
        }

        async function loadOrderHistory() {
            orderHistoryContainer.innerHTML = `
                <p class="text-center text-muted py-4 w-100">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Loading accepted orders...</p>
                </p>`;

            try {
                const orderHistory = await fetchData(`${API_BASE_URL_ORDER}/distributor/${DISTRIBUTOR_ID}`);

                if (!orderHistory || orderHistory.length === 0) {
                    orderHistoryContainer.innerHTML = '<p class="text-center text-muted py-4 w-100">No orders found in your history.</p>';
                    return;
                }

                const acceptedOrders = orderHistory.filter(order =>
                    getSafeValue(order, ['status', 'Status']).toLowerCase() === 'accepted'
                );

                if (acceptedOrders.length === 0) {
                    orderHistoryContainer.innerHTML = '<p class="text-center text-muted py-4 w-100">No accepted orders found in your history.</p>';
                    return;
                }

                orderHistoryContainer.innerHTML = ''; 

                acceptedOrders.sort((a, b) => {
                    const orderIdA = parseInt(getSafeValue(a, ['orderID', 'OrderID']));
                    const orderIdB = parseInt(getSafeValue(b, ['orderID', 'OrderID']));
                    return orderIdB - orderIdA;
                });

                for (const order of acceptedOrders) {
                    const orderCard = document.createElement('div');
                    orderCard.className = 'order-card';

                    const orderId = getSafeValue(order, ['orderID', 'OrderID']);
                    const status = getSafeValue(order, ['status', 'Status']); 
                    const quantity = getSafeValue(order, ['quantity', 'Quantity']);
                    const notes = getSafeValue(order, ['notes', 'Notes'], 'No notes provided by distributor.');
                    const manufacturerReason = getSafeValue(order, ['reason', 'Reason'], 'N/A');

                    const blanket = order.blanketModel || order.BlanketModel || {};
                    const blanketName = getSafeValue(blanket, ['modelName', 'ModelName']);
                    const blanketDescription = getSafeValue(blanket, ['description', 'Description'], 'No description provided.');
                    const blanketMaterial = getSafeValue(blanket, ['material', 'Material']);
                    const blanketUnitCost = getSafeValue(blanket, ['unitCost', 'UnitCost'], 0.00);
                    const manufacturerCurrentStock = getSafeValue(blanket, ['currentStock', 'CurrentStock'], 0); 

                   
                    const totalOrderValue = (parseFloat(blanketUnitCost) * parseInt(quantity)).toFixed(2);

                    let blanketImageRaw = getSafeValue(blanket, ['base64Image', 'Base64Image'], '');
                    let imageUrl = 'https://via.placeholder.com/200x200?text=No+Image';
                    if (blanketImageRaw && typeof blanketImageRaw === 'string' && blanketImageRaw.trim() !== '') {
                        if (!blanketImageRaw.startsWith('data:image/')) {
                            imageUrl = `data:image/jpeg;base64,${blanketImageRaw}`;
                        } else {
                            imageUrl = blanketImageRaw;
                        }
                    }

                    const toUser = order.toUser || order.ToUser || {};
                    const manufacturerFullName = getSafeValue(toUser, ['fullName', 'FullName']);
                    const manufacturerEmail = getSafeValue(toUser, ['email', 'Email']);
                    const manufacturerMobileNo = getSafeValue(toUser, ['mobileNo', 'MobileNo']);
                    const manufacturerAddress = getSafeValue(toUser, ['address', 'Address']);

                    orderCard.innerHTML = `
                        <div class="order-header">
                            <p><strong>Quantity:</strong>  ${quantity}</p>
                        </div>
                        <div class="order-details">
                            <img src="${imageUrl}" alt="${blanketName} Image">
                            <div class="order-info">
                                <p><strong>Blanket:</strong> ${blanketName}</p>
                                <p><strong>Description:</strong> ${blanketDescription}</p>
                                <p><strong>Material:</strong> ${blanketMaterial}</p>
                                 <p><strong>Unit Cost:</strong> LKR ${blanketUnitCost}</p>
                                <p><strong>Distributor's Current Stock:</strong> ${quantity} units</p> 
                            </div>
                        </div>
                    `;
                    orderHistoryContainer.appendChild(orderCard);
                }

            } catch (error) {
                console.error("Error loading accepted orders:", error);
                orderHistoryContainer.innerHTML = '<p class="text-center text-danger py-4 w-100">Failed to load accepted order history. Please try again.</p>';
                showAlert('Error', `Failed to load accepted orders: ${error.message}`, 'danger');
            }
        }
    </script>
    <?php include "component/footer.php"; ?>
</body>
</html>