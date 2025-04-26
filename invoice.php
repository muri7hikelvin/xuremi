<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Cerufixime250.";
$dbname = "xuremi_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture data from the URL
$checkout_id = $_GET['checkout_id'];
$plan_name = $_GET['plan_name'];
$plan_price = $_GET['plan_price'];
$name = $_GET['name'];
$email = $_GET['email'];
$address = $_GET['address'];
$city = $_GET['city'];
$state = $_GET['state'];
$zip = $_GET['zip'];

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        .invoice-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header .logo {
            font-size: 40px;
            font-weight: bold;
            color: #007bff;
        }
        .company-details {
            text-align: right;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .invoice-details,
        .client-details {
            margin-bottom: 20px;
        }
        .details-table,
        .total-section {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details-table th,
        .details-table td,
        .total-section td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .details-table th {
            background-color: #f4f4f4;
        }
        .total-section {
            border: none;
        }
        .total-section .label {
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }

        /* MAIN CONTAINER */
        .main {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #131419;
            box-shadow: 8px 8px 15px #0e0f13, -8px -8px 15px #17181d;
            border-radius: 20px;
            margin: 20px;
        }

        /* NEUMORPHIC NAVBAR */
        .navbar {
            width: 100%;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        /* LOGO */
        .logo {
            color: #FFFFFF;
            font-size: 35px;
            font-family: 'Amarante', cursive;
        }
        .logo-image {
            height: 50px; /* Adjust height as needed */
            width: auto; /* Maintain aspect ratio */
            margin-right: 15px; /* Space between logo and text */
        }

        /* MENU */
        .menu {
            display: flex;
            align-items: center;
        }

        .menu ul {
            display: flex;
            justify-content: space-around;
            width: 100%;
            align-items: center;
        }

        .menu ul li {
            list-style: none;
            margin: 0 20px;
        }

        .menu ul li a {
            text-decoration: none;
            color: #FBFFFF;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 14px;
            transition: 0.4s ease-in-out;
        }

        .menu ul li a:hover {
            color:  #F08080;
        }

        /* NEUMORPHIC SEARCH BAR */
        .search {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search__input {
            width: 250px;
            height: 40px;
            border: none;
            border-radius: 20px;
            padding-left: 50px;
            background-color: #131419;
            box-shadow: inset 8px 8px 15px #0e0f13, inset -8px -8px 15px #17181d;
            color: #FBFFFF;
            font-size: 14px;
        }

        .search__input::placeholder {
            color: #aaaaaa;
        }

        .search__icon {
            position: absolute;
            left: 15px;
            color: #aaaaaa;
            font-size: 20px;
        }

        /* HAMBURGER MENU */
        .hamburger {
            display: none;
            font-size: 30px;
            color: #FBFFFF;
            cursor: pointer;
        }

        /* DROPDOWN EFFECT FOR MENU */
        .menu ul {
            transition: max-height 0.3s ease;
        }

        .menu ul.collapsed {
            max-height: 0;
            overflow: hidden;
            display: none;
            position: fixed;
        }

        .menu ul.expanded {
            max-height: 500px;
            display: flex;
            flex-direction: column;
            background-color: #131419;
            border-radius: 20px;
            box-shadow: 8px 8px 15px #0e0f13, -8px -8px 15px #17181d;
            position: absolute;
            top: 75px;
            right: 20px;
            width: 250px;
        }
    </style>
</head>
<body>
<div class="main">
    <div class="navbar">
        <div class="icon">
            <h2 class="logo">xuremi</h2>
        </div>
        <div class="menu" id="menu">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="customercompany.php">PRODUCTS</a></li>
                <li><a href="About.html">ABOUT</a></li>
                <li><a href="news.php">NEWS</a></li>
                <li><a href="#">REVIEWS</a></li>
                <li class="search-menu-item">
                    <div class="search">
                        <input type="text" class="search__input" placeholder="Search...">
                        <div class="search__icon">
                            <ion-icon name="search"></ion-icon>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="hamburger" id="hamburger">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
    </div>
</div>

<div class="invoice-container">
    <div class="header">
        <div class="logo">xuremi</div>
        <div class="company-details">
            <p><strong>Xuremi Solutions</strong></p>
            <p>00618 Main Street</p>
            <p>Nairobi, Kenya,00100 </p>
            <p>Phone: (254) 746-195-016</p>
            <p>Email: info@xuremi.com</p>
        </div>
    </div>

    <h1>Invoice #<?php echo htmlspecialchars($checkout_id); ?></h1>
    
    <div class="invoice-details">
        <p><strong>Invoice Date:</strong> <?php echo date("Y-m-d"); ?></p>
    </div>

    <div class="client-details">
        <p><strong>Billing To:</strong></p>
        <p><?php echo htmlspecialchars($name); ?></p>
        <p><?php echo htmlspecialchars($address); ?></p>
        <p><?php echo htmlspecialchars($city . ', ' . $state . ' ' . $zip); ?></p>
        <p><?php echo htmlspecialchars($email); ?></p>
    </div>

    <table class="details-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($plan_name); ?></td>
                <td>1</td>
                <td><?php echo htmlspecialchars($plan_price); ?></td>
                <td><?php echo htmlspecialchars($plan_price); ?></td>
            </tr>
        </tbody>
    </table>

    <table class="total-section">
        <tr>
            <td class="label">Subtotal:</td>
            <td><?php echo htmlspecialchars($plan_price); ?></td>
        </tr>
        <tr>
            <td class="label">Tax (0%):</td>
            <td>0.00</td>
        </tr>
        <tr>
            <td class="label">Total:</td>
            <td><?php echo htmlspecialchars($plan_price); ?></td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for your business!</p>
    </div>
</div>
</body>
</html>
