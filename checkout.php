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

// Capture form data
$plan_name = $_GET['plan'] ?? $_POST['plan_name'];
$plan_price = $_GET['price'] ?? $_POST['plan_price'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $payment_method = $_POST['payment_method'];
    
    // Check if user exists and get their ID
    $sql_check_user = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check_user);
    if ($result->num_rows > 0) {
        $user_id = $result->fetch_assoc()['id'];
    } else {
        die("User not found. Please register first.");
    }

    // Insert checkout data into checkout table
    $sql_insert_checkout = "INSERT INTO checkout (user_id, plan_name, plan_price, address, city, state, zip, payment_method) 
                            VALUES ('$user_id', '$plan_name', '$plan_price', '$address', '$city', '$state', '$zip', '$payment_method')";
    if ($conn->query($sql_insert_checkout) === TRUE) {
        $checkout_id = $conn->insert_id;
        // Redirect to the invoice page with relevant data
        header("Location: invoice.php?checkout_id=$checkout_id&plan_name=" . urlencode($plan_name) . "&plan_price=" . urlencode($plan_price) . "&name=" . urlencode($name) . "&email=" . urlencode($email) . "&address=" . urlencode($address) . "&city=" . urlencode($city) . "&state=" . urlencode($state) . "&zip=" . urlencode($zip));
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
    <style>
        /* Reset and base styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column; /* Change to column to stack elements vertically */
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            margin-top: 20px; /* Add margin for spacing */
        }
        h2 {
            color: #333;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .plan-info {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .plan-price {
            font-size: 24px;
            color: #007bff;
            font-weight: bold;
        }
        .form-group.inline {
            display: flex;
            gap: 10px;
        }
        .form-group.inline label {
            flex: 1;
        }

        /* NEUMORPHIC NAVBAR */
        .navbar {
            width: 100%;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            background-color: #131419; /* Add background color to navbar */
            box-shadow: 0 4px 10px rgba(0,0,0,0.3); /* Optional shadow for the navbar */
        }

        /* LOGO */
        .logo {
            color: #FFFFFF;
            font-size: 35px;
            font-family: 'Amarante', cursive;
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

<!-- Navigation Bar -->
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
        </ul>
    </div>
</div>

<!-- Checkout Form -->
<div class="container">
    <h2>Checkout - <?php echo ucfirst($plan_name); ?> Plan</h2>
    <div class="plan-info">
        <p><strong>Selected Plan:</strong> <?php echo ucfirst($plan_name); ?></p>
        <p class="plan-price">$<?php echo number_format($plan_price, 2); ?></p>
    </div>
    <form action="checkout.php" method="POST">
        <input type="hidden" name="plan_name" value="<?php echo $plan_name; ?>">
        <input type="hidden" name="plan_price" value="<?php echo $plan_price; ?>">

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
        </div>

        <div class="form-group inline">
            <label for="city">City</label>
            <input type="text" id="city" name="city" required>
            <label for="state">State</label>
            <input type="text" id="state" name="state" required>
        </div>

        <div class="form-group">
            <label for="zip">Zip Code</label>
            <input type="number" id="zip" name="zip" required>
        </div>

        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select id="payment_method" name="payment_method" required>
                <option value="credit-card">Credit/Debit Card</option>
                <option value="paypal">PayPal</option>
                <option value="mpesa">M-Pesa</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Proceed to Payment</button>
    </form>
</div>

</body>
</html>

<?php
}
?>
