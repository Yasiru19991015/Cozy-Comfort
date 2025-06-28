<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); 
    exit();
}

$distributorId = $_SESSION['user_id'];
$loggedInUserName = $_SESSION['username'] ?? 'Distributor';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributor Dashboard - Pending Orders</title>
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
            --success: #28a745; 
            --danger: #dc3545; 
            --warning: #ffc107; 
            --info: #17a2b8; 
            --rejected: #e65100; 
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            min-height: 100vh;
            padding: 2rem;
            background-image: linear-gradient(135deg, rgba(255,248,240,0.9), rgba(255,248,240,0.9)),
                                 url('https://images.unsplash.com/photo-1600369672890-ac00f1907858?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .container-fluid {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(93, 64, 55, 0.25);
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
            box-shadow: 0 4px 20px rgba(93, 64, 55, 0.3);
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
            transition: var(--transition);
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
            color: var(--primary-light);
            font-weight: 600;
        }

        .actions {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px dashed #eee;
            text-align: right; 
        }

        .actions button {
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            margin-left: 15px;
            min-width: 120px; 
        }

        .actions .accept-btn {
            background-color: var(--success);
            color: white;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
        }
        .actions .accept-btn:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(40, 167, 69, 0.35);
        }

        .actions .reject-btn {
            background-color: var(--danger);
            color: white;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.25);
        }
        .actions .reject-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(220, 53, 69, 0.35);
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
        .alert-rejected { 
            background-color: #fff3e0; 
            color: var(--rejected); 
            border-color: #ffb74d; 
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
            .order-details {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            .order-info {
                grid-template-columns: 1fr; 
                text-align: center;
            }
            .actions {
                text-align: center;
            }
            .actions button {
                margin: 10px 5px; 
                width: calc(50% - 10px); 
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
            .actions button {
                width: 100%; 
                margin-left: 0;
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <?php include "component/header.php"; ?>
    <div class="container-fluid">
        <div class="header-section">
            <h1>Distributor Dashboard - Pending Orders</h1>
            <p>Logged in as: <?php echo htmlspecialchars($loggedInUserName); ?></p>
        </div>

        <div id="alertContainer"></div>

        <div id="pendingOrdersContainer">
            <p class="text-center text-muted py-4">Loading pending orders...</p>
        </div>
    </div>

    <div class="modal fade" id="customConfirmModal" tabindex="-1" aria-labelledby="customConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customConfirmModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="customConfirmModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmActionButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectReasonModal" tabindex="-1" aria-labelledby="rejectReasonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white"> <h5 class="modal-title" id="rejectReasonModalLabel">Reject Order - Reason Required</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button> </div>
                <div class="modal-body">
                    <p id="rejectModalMessage"></p>
                    <div class="mb-3">
                        <label for="rejectionReasonInput" class="form-label">Reason for rejection:</label>
                        <textarea class="form-control" id="rejectionReasonInput" rows="3" placeholder="Enter reason here..."></textarea>
                        <div class="invalid-feedback">
                            Please provide a reason for rejection.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="submitRejectionReasonBtn">Reject Order</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    
    const API_BASE_URL_ORDER = 'https://localhost:7033/api/SellerOrder';

    
    const DISTRIBUTOR_ID = <?php echo json_encode($distributorId); ?>;

    const alertContainer = document.getElementById('alertContainer');
    const pendingOrdersContainer = document.getElementById('pendingOrdersContainer'); 

   
    let customConfirmModalInstance; 
    let rejectReasonModalInstance; 

    document.addEventListener('DOMContentLoaded', () => {
        const customConfirmModalElement = document.getElementById('customConfirmModal');
        if (customConfirmModalElement) {
            customConfirmModalInstance = new bootstrap.Modal(customConfirmModalElement);
        } else {
            console.error("Custom Confirm Modal element not found! Ensure its HTML exists and ID is correct.");
            showCustomAlert("Error", "Critical: Custom confirm modal structure missing. Please contact support.", "danger");
        }

        
        const rejectReasonModalElement = document.getElementById('rejectReasonModal');
        if (rejectReasonModalElement) {
            rejectReasonModalInstance = new bootstrap.Modal(rejectReasonModalElement);
        } else {
            console.error("Reject Reason Modal element not found! Ensure its HTML exists and ID is correct.");
            showCustomAlert("Error", "Critical: Reject reason modal structure missing. Please contact support.", "danger");
        }

        loadPendingOrders(); 
    });

    
    function showCustomAlert(title, message, type) {
       
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
                <i class="fas ${type === 'danger' ? 'fa-exclamation-circle' : (type === 'success' ? 'fa-check-circle' : (type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'))} me-2"></i>
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

    
    function getSafeValue(obj, keys, defaultValue = 'N/A') {
        if (!obj) return defaultValue;
        for (const key of keys) {
            if (obj.hasOwnProperty(key) && obj[key] !== undefined && obj[key] !== null && obj[key] !== '') {
                if (typeof obj[key] === 'number') {
                    if (key.toLowerCase().includes('cost')) {
                        return obj[key].toFixed(2); 
                    }
                    return obj[key];
                }
                return obj[key]; 
            }
        }
        return defaultValue; 
    }

    
    async function loadPendingOrders() {
        pendingOrdersContainer.innerHTML = `
            <p class="text-center text-muted py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Loading pending orders...</p>
            </p>`;

        try {
          
            const pendingOrders = await fetchData(`${API_BASE_URL_ORDER}/distributor/${DISTRIBUTOR_ID}?status=Pending`);

            if (!pendingOrders || pendingOrders.length === 0) {
                pendingOrdersContainer.innerHTML = '<p class="text-center text-muted py-4">No pending orders found.</p>';
                return;
            }

            pendingOrdersContainer.innerHTML = '';

            for (const order of pendingOrders) {
                const orderCard = document.createElement('div');
                orderCard.className = 'order-card';

                
                const orderId = getSafeValue(order, ['orderID', 'OrderID']);
                const status = getSafeValue(order, ['status', 'Status']);
                const quantity = getSafeValue(order, ['quantity', 'Quantity']);
                const notes = getSafeValue(order, ['notes', 'Notes'], 'No notes provided.');

                
                const blanket = order.blanketModel || order.BlanketModel || {};
                const blanketName = getSafeValue(blanket, ['modelName', 'ModelName']);
                const blanketDescription = getSafeValue(blanket, ['description', 'Description'], 'No description provided.');
                const blanketMaterial = getSafeValue(blanket, ['material', 'Material']);
                const blanketUnitCost = getSafeValue(blanket, ['unitCost', 'UnitCost'], 0.00);
                const blanketCurrentStock = getSafeValue(blanket, ['currentStock', 'CurrentStock'], 0);
                let blanketImageRaw = getSafeValue(blanket, ['base64Image', 'Base64Image'], '');

                let imageUrl = 'https://via.placeholder.com/120x120?text=No+Image';
                if (blanketImageRaw && typeof blanketImageRaw === 'string' && blanketImageRaw.trim() !== '') {
                    if (!blanketImageRaw.startsWith('data:image/')) {
                        imageUrl = `data:image/jpeg;base64,${blanketImageRaw}`; 
                    } else {
                        imageUrl = blanketImageRaw;
                    }
                }

                
                const fromUser = order.fromUser || order.FromUser || {};
                const distributorFullName = getSafeValue(fromUser, ['fullName', 'FullName']);
                const distributorEmail = getSafeValue(fromUser, ['email', 'Email']);
                const distributorMobileNo = getSafeValue(fromUser, ['mobileNo', 'MobileNo']);
                const distributorAddress = getSafeValue(fromUser, ['address', 'Address']);

                orderCard.innerHTML = `
                    <div class="order-header">
                        <h3>Order ID: ${orderId}</h3>
                        <p>Status: <strong>${status}</strong></p>
                    </div>
                    <div class="order-details">
                        <img src="${imageUrl}" alt="${blanketName} Image">
                        <div class="order-info">
                            <p><strong>Blanket:</strong> ${blanketName}</p>
                            <p><strong>Description:</strong> ${blanketDescription}</p>
                            <p><strong>Material:</strong> ${blanketMaterial}</p>
                            <p><strong>Unit Cost:</strong> LKR ${blanketUnitCost}</p>
                            <p><strong>Ordered Quantity:</strong> ${quantity}</p>
                            <p><strong>Current Stock:</strong> ${blanketCurrentStock}</p>
                            <p><strong>Distributor:</strong> ${distributorFullName} (${distributorEmail})</p>
                            <p><strong>Distributor Mobile:</strong> ${distributorMobileNo}</p>
                            <p><strong>Distributor Address:</strong> ${distributorAddress}</p>
                            <p><strong>Notes:</strong> ${notes}</p>
                        </div>
                    </div>
                    <div class="actions">
                        ${status.toLowerCase() === 'pending' ? `
                            <button class="btn accept-btn" data-order-id="${orderId}" data-distributor-name="${distributorFullName}">
                                <i class="fas fa-check-circle me-2"></i>Accept Order
                            </button>
                            <button class="btn reject-btn" data-order-id="${orderId}" data-distributor-name="${distributorFullName}">
                                <i class="fas fa-times-circle me-2"></i>Reject Order
                            </button>
                        ` : `
                            <p class="text-muted">Order ${status}</p>
                        `}
                    </div>
                `;
                pendingOrdersContainer.appendChild(orderCard);
            }

            attachEventListeners();

        } catch (error) {
            console.error("Error loading pending orders:", error);
            pendingOrdersContainer.innerHTML = '<p class="text-center text-danger py-4">Failed to load orders. Please try again.</p>';
            showCustomAlert('Error', `Failed to load orders: ${error.message}`, 'danger');
        }
    }

    
    function attachEventListeners() {
        
        document.querySelectorAll('.accept-btn').forEach(button => {
            button.onclick = null;
            button.onclick = (event) => {
                const orderId = event.currentTarget.dataset.orderId;
                const distributorName = event.currentTarget.dataset.distributorName;
                showCustomConfirm(orderId, 'Accepted', distributorName);
            };
        });

        document.querySelectorAll('.reject-btn').forEach(button => {
            button.onclick = null;
            button.onclick = (event) => {
                const orderId = event.currentTarget.dataset.orderId;
                const distributorName = event.currentTarget.dataset.distributorName;
                showRejectReasonModal(orderId, distributorName); 
            };
        });
    }

    
    function showCustomConfirm(orderId, newStatus, distributorName) {
        if (!customConfirmModalInstance) {
            console.error("Custom confirm modal instance is not initialized.");
            showCustomAlert("Error", "Confirmation modal not ready. Please refresh.", "danger");
            return;
        }

        const customConfirmModalBody = document.getElementById('customConfirmModalBody');
        const confirmActionButton = document.getElementById('confirmActionButton');

        const message = `Are you sure you want to <strong>${newStatus.toLowerCase()}</strong> the order from <strong>${distributorName}</strong> (Order ID: ${orderId})?`;
        customConfirmModalBody.innerHTML = message;

       
        confirmActionButton.onclick = null;

        
        confirmActionButton.onclick = async () => {
            customConfirmModalInstance.hide(); 
            await handleOrderAction(orderId, newStatus, 'Order accepted'); 
        };

        customConfirmModalInstance.show();
    }

    
    function showRejectReasonModal(orderId, distributorName) {
        if (!rejectReasonModalInstance) {
            console.error("Reject reason modal instance is not initialized.");
            showCustomAlert("Error", "Rejection modal not ready. Please refresh.", "danger");
            return;
        }

        const rejectModalMessage = document.getElementById('rejectModalMessage');
        const rejectionReasonInput = document.getElementById('rejectionReasonInput');
        const submitRejectionReasonBtn = document.getElementById('submitRejectionReasonBtn');

        rejectModalMessage.innerHTML = `Please provide a reason for rejecting Order ID: <strong>${orderId}</strong> from <strong>${distributorName}</strong>.`;
        rejectionReasonInput.value = ''; 
        rejectionReasonInput.classList.remove('is-invalid'); 

        
        submitRejectionReasonBtn.onclick = null;

        submitRejectionReasonBtn.onclick = async () => {
            const reason = rejectionReasonInput.value.trim();
            if (reason === '') {
                rejectionReasonInput.classList.add('is-invalid'); 
                return;
            }

            rejectionReasonInput.classList.remove('is-invalid');
            rejectReasonModalInstance.hide(); 
            await handleOrderAction(orderId, 'Rejected', reason);
        };

        rejectReasonModalInstance.show();
    }

    
    async function handleOrderAction(orderId, newStatus, reason = '') {
        const url = `${API_BASE_URL_ORDER}/update-status/${orderId}`;
        const payload = {
            NewStatus: newStatus,
            Reason: reason
        };

        try {
            const response = await fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                const errorBody = await response.text();
                let errorMessage = `Failed to update order status for ID ${orderId}. Status: ${response.status}.`;
                try {
                    const errorJson = JSON.parse(errorBody);
                    errorMessage += ` Details: ${errorJson.Message || errorJson.Error || errorBody}`;
                } catch (e) {
                    errorMessage += ` Raw error: ${errorBody}`;
                }
                throw new Error(errorMessage);
            }

            const result = await response.json();
            showCustomAlert('Success', result.Message || 'Order status updated successfully!', 'success');
            loadPendingOrders();
        } catch (error) {
            console.error("Error updating order status:", error);
            showCustomAlert('Error', `Error: ${error.message}`, 'danger');
        }
    }
</script>
<?php include "component/footer.php"; ?>
</body>
</html>