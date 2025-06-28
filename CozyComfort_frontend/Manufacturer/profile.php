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
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5D4037; /* Warm brown */
            --accent: #FF7043; /* Soft orange */
            --secondary: #26A69A; /* Teal */
            --light-bg: #FFF8F0; /* Cream */
            --text-dark: #3E2723; /* Dark brown */
            --text-light: #8D6E63; /* Light brown */
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            --shadow-sm: 0 2px 8px rgba(93, 64, 55, 0.1);
            --shadow-md: 0 4px 20px rgba(93, 64, 55, 0.15);
            --shadow-lg: 0 8px 30px rgba(93, 64, 55, 0.2);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex-grow: 1;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: var(--shadow-md);
            margin-top: 2rem !important; /* Override default Bootstrap margin */
            margin-bottom: 2rem;
        }

        h2 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .profile-img {
            width: 150px; /* Increased size for better visibility */
            height: 150px;
            object-fit: cover;
            border: 4px solid var(--accent);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: block; /* To center the image */
            margin: 0 auto 1.5rem auto; /* Center and add bottom margin */
        }

        .profile-img:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-md);
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            line-height: 1.6;
        }

        p strong {
            color: var(--accent);
            font-weight: 600;
            min-width: 80px; /* Align text better */
            display: inline-block;
        }

        /* Basic responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
                margin-top: 1rem !important;
                margin-bottom: 1rem;
            }

            h2 {
                font-size: 1.8rem;
                margin-bottom: 1rem;
            }

            .profile-img {
                width: 120px;
                height: 120px;
            }

            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
<?php include "component/header.php"; ?>

<div class="container mt-4">
    <h2>My Profile</h2>
    <img src="data:image/png;base64,<?= $_SESSION["image"] ?>" alt="User Profile Picture" class="rounded-circle mb-3 profile-img">
    <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION["fullname"]) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION["email"] ?? 'Hidden') ?></p>
    <p><strong>Role:</strong> <?= htmlspecialchars($_SESSION["role"]) ?></p>
</div>
<?php include "component/footer.php"; ?>
</body>
</html>