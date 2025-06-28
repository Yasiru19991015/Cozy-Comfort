<?php

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$manufacturerId = 1; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blankets | Cozy Comfort</title>
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
            --info: #2196F3;
            --warning: #FFC107;
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

        .header-section h2 {
            font-weight: 700;
            margin-bottom: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.15);
            letter-spacing: 0.5px;
            flex-grow: 1;
            text-align: left;
        }

        .btn-add-new {
            background-color: var(--accent-light);
            color: var(--text-dark);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .btn-add-new:hover {
            background-color: var(--accent);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 112, 67, 0.3);
        }

        .table-responsive {
            margin-top: 1.5rem;
        }

        .table-blankets {
            border-collapse: separate;
            border-spacing: 0 10px; /* Space between rows */
            width: 100%;
        }

        .table-blankets th,
        .table-blankets td {
            padding: 15px;
            vertical-align: middle;
            border: none;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .table-blankets tbody tr {
            transition: var(--transition);
        }

        .table-blankets tbody tr:hover {
            background-color: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .table-blankets thead th {
            background-color: var(--primary-light);
            color: white;
            font-weight: 600;
            border-bottom: none;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        .table-blankets thead th:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .table-blankets thead th:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .table-blankets tbody tr:first-child td {
            border-top: none;
        }

        .table-blankets tbody tr:last-child td {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .blanket-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--text-light);
        }

        .btn-action {
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            margin: 0 2px;
            transition: var(--transition);
        }

        .btn-action:hover {
            transform: translateY(-1px);
        }

        .btn-edit {
            background-color: var(--info);
            color: white;
        }
        .btn-edit:hover { background-color: #1976D2; }

        .btn-delete {
            background-color: var(--error);
            color: white;
        }
        .btn-delete:hover { background-color: #C62828; }

        .stock-control {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stock-btn {
            background-color: var(--primary-light);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            margin: 0 5px;
        }

        .stock-btn:hover {
            background-color: var(--primary);
            transform: scale(1.1);
        }

        .stock-quantity {
            font-weight: 600;
            min-width: 40px;
            text-align: center;
        }

    
        .status-active {
            color: var(--success);
            font-weight: 600;
        }
        .status-inactive {
            color: var(--text-light);
        }

        .alert-messages {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: 350px;
        }
        .alert {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            animation: slideInRight 0.5s ease-out;
            margin-bottom: 10px;
        }
        .alert.alert-delete-error {
        background-color: #ffeded;
        border-color: #d32f2f; 
        color: #b71c1c; 
        box-shadow: 0 4px 15px rgba(211, 47, 47, 0.2); 
    }

    .alert.alert-delete-error .btn-close {
        filter: invert(0) grayscale(0%) brightness(100%); 
    }

    .alert.alert-delete-error .fa-exclamation-circle {
        color: #d32f2f; 
    }

     
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }

        
        .modal-content {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            background: var(--light-bg);
            border: none;
        }
        .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 1.5rem;
            border-bottom: none;
        }
        .modal-title {
            font-weight: 700;
        }
        .modal-footer {
            border-top: none;
            padding: 1.5rem;
        }
        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

       
        @media (max-width: 992px) {
            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }
            .header-section h2 {
                margin-bottom: 1rem;
                text-align: center;
            }
            .btn-add-new {
                width: 100%;
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
            .table-blankets th, .table-blankets td {
                padding: 10px;
                font-size: 0.9rem;
            }
            .blanket-img {
                width: 50px;
                height: 50px;
            }
            .btn-action {
                padding: 6px 10px;
                font-size: 0.75rem;
            }
            .stock-btn {
                width: 25px;
                height: 25px;
                font-size: 0.9rem;
            }
            .stock-quantity {
                min-width: 30px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <?php include "component/header.php"; ?>
    <div class="container-fluid">
        <div class="header-section">
            <h2>Manage Blanket Models</h2>
            <button class="btn btn-add-new" onclick="location.href='blanketsadd.php'">
                <i class="fas fa-plus-circle me-2"></i> Add New Blanket
            </button>
        </div>

        <div id="alertMessages" class="alert-messages"></div>

        <div class="table-responsive">
            <table class="table table-blankets" id="blanketTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Model Name</th>
                        <th>Material</th>
                        <th>Unit Cost (LKR)</th>
                        <th>Current Stock</th>
                        <th>Production Date</th>
                        <th>Status</th> <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" class="text-center py-4"> <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">Loading blanket data...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStockModalLabel">Adjust Stock Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Model: <strong id="modalModelName"></strong></p>
                    <div class="mb-3">
                        <label for="newStockQuantity" class="form-label">New Stock Quantity:</label>
                        <input type="number" class="form-control" id="newStockQuantity" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveStockBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete "<strong id="deleteModalModelName"></strong>" (ID: <span id="deleteModalModelId"></span>)? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const API_BASE_URL = "https://localhost:7033/api/BlanketModels";
        const blanketTableBody = document.querySelector('#blanketTable tbody');
        const alertMessagesContainer = document.getElementById('alertMessages');
        
        
        const editStockModal = new bootstrap.Modal(document.getElementById('editStockModal'));
        const modalModelName = document.getElementById('modalModelName');
        const newStockQuantityInput = document.getElementById('newStockQuantity');
        const saveStockBtn = document.getElementById('saveStockBtn');

        
        const deleteConfirmationModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        const deleteModalModelName = document.getElementById('deleteModalModelName');
        const deleteModalModelId = document.getElementById('deleteModalModelId');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');


        let currentEditingBlanketId = null;
        let currentBlanketIdToDelete = null; 

        
        function getAuthToken() {
           
            return localStorage.getItem('authToken') || ''; 
        }

      
        function getManufacturerId() {
            
            return '<?php echo htmlspecialchars($manufacturerId); ?>';
        }

      
        function showAlert(message, type = 'danger', extraClass = '') { 
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show ${extraClass}" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas ${type === 'danger' ? 'fa-exclamation-circle' : (type === 'success' ? 'fa-check-circle' : 'fa-info-circle')} me-2"></i>
                        <span>${message}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            const alertElement = document.createElement('div');
            alertElement.innerHTML = alertHtml;
            alertMessagesContainer.prepend(alertElement); 

           
            setTimeout(() => {
                const bsAlert = bootstrap.Alert.getInstance(alertElement.querySelector('.alert')) || new bootstrap.Alert(alertElement.querySelector('.alert'));
                bsAlert.close();
                
                setTimeout(() => alertElement.remove(), 500); 
            }, 5000);
        }

        
        async function fetchBlankets() {
           
            blanketTableBody.innerHTML = `
                <tr>
                    <td colspan="8" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Loading blanket data...</p>
                    </td>
                </tr>
            `;
            try {
                const response = await fetch(`${API_BASE_URL}/get-all`, {
                    headers: {
                        'Authorization': `Bearer ${getAuthToken()}`
                    }
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(`Failed to fetch blankets: ${response.status} - ${errorText}`);
                }

                const blankets = await response.json();
                console.log("Fetched blankets:", blankets); 

                if (blankets.length === 0) {
                    blanketTableBody.innerHTML = `
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No blanket models found. Click "Add New Blanket" to add one.</td>
                        </tr>
                    `;
                    return;
                }

                blanketTableBody.innerHTML = ''; 

                blankets.forEach(blanket => {
                    const row = blanketTableBody.insertRow();
                    row.dataset.modelId = blanket.modelID; 

                    const productionDate = blanket.productionDate ? new Date(blanket.productionDate).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }) : 'N/A';
                    const imageUrl = blanket.base64Image ? `data:image/jpeg;base64,${blanket.base64Image}` : 'https://via.placeholder.com/70?text=No+Image';
                    
                    const statusText = blanket.isActive ? 'Active' : 'Inactive';
                    const statusClass = blanket.isActive ? 'status-active' : 'status-inactive';

                    row.innerHTML = `
                        <td><img src="${imageUrl}" alt="${blanket.modelName}" class="blanket-img"></td>
                        <td>${blanket.modelName}</td>
                        <td>${blanket.material}</td>
                        <td>${blanket.unitCost ? parseFloat(blanket.unitCost).toFixed(2) : '0.00'}</td>
                        <td>
                            <div class="stock-control">
                                <button class="stock-btn decrease-stock" data-id="${blanket.modelID}" data-current-stock="${blanket.currentStock}">-</button>
                                <span class="stock-quantity" id="stock-${blanket.modelID}">${blanket.currentStock}</span>
                                <button class="stock-btn increase-stock" data-id="${blanket.modelID}" data-current-stock="${blanket.currentStock}">+</button>
                            </div>
                        </td>
                        <td>${productionDate}</td>
                        <td><span class="${statusClass}">${statusText}</span></td> <td>
                            <a href="blanketedit.php?id=${blanket.modelID}" class="btn btn-info btn-action btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="btn btn-danger btn-action btn-delete" data-id="${blanket.modelID}" data-model-name="${blanket.modelName}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </td>
                    `;
                });
                addEventListenersToButtons(); 
            } catch (error) {
                console.error('Error fetching blankets:', error);
                showAlert(`Error loading blankets: ${error.message}`, 'danger');
                blanketTableBody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center py-4 text-danger">Failed to load blanket data. Please try again later.</td>
                    </tr>
                `;
            }
        }

       
        function addEventListenersToButtons() {
            
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.onclick = (event) => showDeleteConfirmation(event.currentTarget.dataset.id, event.currentTarget.dataset.modelName);
            });

            
            document.querySelectorAll('.stock-btn').forEach(button => {
                button.onclick = (event) => {
                    const modelId = event.currentTarget.dataset.id;
                    let currentStock = parseInt(document.getElementById(`stock-${modelId}`).textContent);
                    const type = event.currentTarget.classList.contains('increase-stock') ? 'increase' : 'decrease';

                    let newStock = currentStock;
                    if (type === 'increase') {
                        newStock = currentStock + 1;
                    } else if (type === 'decrease' && currentStock > 0) {
                        newStock = currentStock - 1;
                    } else if (type === 'decrease' && currentStock === 0) {
                        showAlert('Stock cannot go below zero.', 'warning');
                        return;
                    }
                    updateStock(modelId, newStock);
                };
            });
        }

        
        async function updateStock(modelId, newQuantity) {
            try {
                
                const fetchResponse = await fetch(`${API_BASE_URL}/get/${modelId}`, {
                    headers: {
                        'Authorization': `Bearer ${getAuthToken()}`
                    }
                });
                if (!fetchResponse.ok) {
                    const errorText = await fetchResponse.text();
                    throw new Error(`Failed to fetch existing blanket data for stock update: ${fetchResponse.status} - ${errorText}`);
                }
                const existingBlanket = await fetchResponse.json();

                
                const updatedData = {
                    modelID: existingBlanket.modelID,
                    modelName: existingBlanket.modelName,
                    manufacturerID: existingBlanket.manufacturerID, 
                    description: existingBlanket.description,
                    material: existingBlanket.material,
                    productionDate: existingBlanket.productionDate,
                    unitCost: existingBlanket.unitCost,
                    currentStock: newQuantity, 
                    base64Image: existingBlanket.base64Image,
                    isActive: existingBlanket.isActive 
                };
                
                const response = await fetch(`${API_BASE_URL}/update/${modelId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${getAuthToken()}`
                    },
                    body: JSON.stringify(updatedData)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || `Failed to update stock quantity for ${existingBlanket.modelName}.`);
                }

                document.getElementById(`stock-${modelId}`).textContent = newQuantity;
                showAlert('Stock quantity updated successfully!', 'success');

            } catch (error) {
                console.error('Error updating stock:', error);
                showAlert(`Error updating stock: ${error.message}`, 'danger');
            }
        }

       
        function showDeleteConfirmation(modelId, modelName) {
            currentBlanketIdToDelete = modelId;
            deleteModalModelName.textContent = modelName;
            deleteModalModelId.textContent = modelId;
            deleteConfirmationModal.show();
        }

        
        async function confirmDelete() {
            if (!currentBlanketIdToDelete) {
                return;
            }

            try {
                const response = await fetch(`${API_BASE_URL}/delete/${currentBlanketIdToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${getAuthToken()}`
                    }
                });

                if (!response.ok) {
                    let errorMessage = 'Failed to delete blanket model.';
                    try {
                        const errorData = await response.json();
                        errorMessage = errorData.message || errorData.title || errorMessage;
                    } catch (jsonError) {
                        errorMessage = await response.text() || errorMessage;
                    }
                    throw new Error(errorMessage); 
                }

                showAlert(`Blanket model "${deleteModalModelName.textContent}" deleted successfully!`, 'success');
                fetchBlankets(); 
                deleteConfirmationModal.hide(); 

            } catch (error) {
                console.error('Error deleting blanket:', error);
                showAlert(`Error deleting blanket: ${error.message}`, 'danger', 'alert-delete-error'); 
                deleteConfirmationModal.hide(); 
            } finally {
                currentBlanketIdToDelete = null; 
            }
        }


       
        document.getElementById('blanketTable').addEventListener('click', (event) => {
           
            const stockQuantitySpan = event.target.closest('.stock-quantity');
            if (stockQuantitySpan) {
                const modelId = stockQuantitySpan.closest('tr').dataset.modelId;
                
                const modelName = stockQuantitySpan.closest('tr').children[1].textContent; 
                const currentStock = parseInt(stockQuantitySpan.textContent);

                currentEditingBlanketId = modelId;
                modalModelName.textContent = modelName;
                newStockQuantityInput.value = currentStock;

                editStockModal.show();
            }
        });

       
        saveStockBtn.addEventListener('click', () => {
            const newQuantity = parseInt(newStockQuantityInput.value);
            if (isNaN(newQuantity) || newQuantity < 0) {
                showAlert('Please enter a valid non-negative number for stock.', 'warning');
                return;
            }
            if (currentEditingBlanketId) {
                updateStock(currentEditingBlanketId, newQuantity);
                editStockModal.hide();
            }
        });

       
        confirmDeleteBtn.addEventListener('click', confirmDelete);

        
        document.addEventListener('DOMContentLoaded', fetchBlankets);
    </script>
    <?php include "component/footer.php"; ?>
</body>
</html>