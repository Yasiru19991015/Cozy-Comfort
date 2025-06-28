<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Contact Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary: #007bff;
            --primary-dark: #0056b3;
            --background-light: #f8f9fa;
            --text-dark: #343a40;
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
            padding-top: 30px;
            padding-bottom: 50px;
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 1.5rem 2rem;
            text-align: center;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }

        .header-section h1 {
            font-weight: 700;
            margin-bottom: 0;
            font-size: 2.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .table {
            background-color: var(--card-background);
            border-radius: 10px;
            overflow: hidden; 
        }

        .table thead th {
            background-color: var(--primary);
            color: white;
            border-bottom: none;
            padding: 12px 15px;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-top: 1px solid #e9ecef;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f6fc; 
        }

        .table tbody tr:hover {
            background-color: #e0f2fe; 
        }

        .no-messages-found {
            text-align: center;
            padding: 40px;
            font-size: 1.1rem;
            color: var(--text-muted);
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
        <div class="header-section">
            <h1>Contact Messages</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Received Enquiries</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Email</th>
                                <th scope="col">Message</th>
                            </tr>
                        </thead>
                        <tbody id="messagesTableBody">
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading messages...</span>
                                    </div>
                                    <p class="mt-2 text-muted">Loading messages...</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="alert-container" id="customAlertContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
       
        const API_URL_GET_CONTACT_MESSAGES = 'https://localhost:7033/api/contactus/get-all';

      
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

        async function fetchContactMessages() {
            const messagesTableBody = document.getElementById('messagesTableBody');
            messagesTableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading messages...</span>
                        </div>
                        <p class="mt-2 text-muted">Loading messages...</p>
                    </td>
                </tr>
            `;

            try {
                const response = await fetch(API_URL_GET_CONTACT_MESSAGES);

                if (!response.ok) {
                    let errorMessage = `HTTP Error! Status: ${response.status} ${response.statusText}`;
                    try {
                        const errorText = await response.text();
                        errorMessage += ` - ${errorText}`;
                    } catch (e) {
                       
                    }
                    throw new Error(errorMessage);
                }

                const messages = await response.json(); 

                messagesTableBody.innerHTML = ''; 

                if (messages && messages.length > 0) {
                    
                    messages.sort((a, b) => (b.Id || b.id) - (a.Id || a.id));

                    messages.forEach(message => {
                        const row = document.createElement('tr');
                        const messageId = message.Id || message.id; 
                        const fullName = message.FullName || message.fullName || '';
                        const mobileNo = message.MobileNo || message.mobileNo || 'N/A';
                        const email = message.Email || message.email || '';
                        const msgContent = message.Message || message.message || '';

                        row.innerHTML = `
                            <td>${messageId}</td>
                            <td>${fullName}</td>
                            <td>${mobileNo}</td>
                            <td>${email}</td>
                            <td>${msgContent}</td>
                        `;
                        messagesTableBody.appendChild(row);
                    });
                } else {
                    messagesTableBody.innerHTML = `
                        <tr>
                            <td colspan="5" class="no-messages-found">No contact messages found.</td>
                        </tr>
                    `;
                }

            } catch (error) {
                console.error("Error fetching contact messages:", error);
                messagesTableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center text-danger py-4">Failed to load messages: ${error.message}. Please check API connection.</td>
                    </tr>
                `;
                showCustomAlert('Error', `Failed to load messages: ${error.message}`, 'danger');
            }
        }

      
        document.addEventListener('DOMContentLoaded', fetchContactMessages);
    </script>
    <?php include "component/footer.php"; ?>
</body>
</html>
