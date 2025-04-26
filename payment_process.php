<?php
// Database connection
$servername = "localhost";
$username = "root"; // adjust as per your database settings
$password = "Cerufixime250.";
$dbname = "xuremi_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$plan_name = $_POST['plan_name'];
$plan_price = $_POST['plan_price'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$payment_method = $_POST['payment_method'];

// Insert user details if not already present
$user_id = null;
$sql_check_user = "SELECT id FROM users WHERE email = '$email'";
$result = $conn->query($sql_check_user);

if ($result->num_rows > 0) {
    $user_id = $result->fetch_assoc()['id'];
} else {
    $sql_insert_user = "INSERT INTO users (name, email, address, city, state, zip) VALUES ('$name', '$email', '$address', '$city', '$state', '$zip')";
    if ($conn->query($sql_insert_user) === TRUE) {
        $user_id = $conn->insert_id;
    }
}

// Retrieve plan details
$sql_get_plan = "SELECT id, price FROM plans WHERE name = '$plan_name'";
$plan = $conn->query($sql_get_plan)->fetch_assoc();
$plan_id = $plan['id'];
$price = $plan['price'];

// Create invoice
$sql_create_invoice = "INSERT INTO invoices (user_id, plan_id, payment_method) VALUES ('$user_id', '$plan_id', '$payment_method')";
$conn->query($sql_create_invoice);

// Display invoice
$invoice_id = $conn->insert_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice #<?php echo $invoice_id; ?></h1>
    <p><strong>Plan:</strong> <?php echo $plan_name; ?></p>
    <p><strong>Price:</strong> $<?php echo number_format($plan_price, 2); ?></p>
    <p><strong>Customer Name:</strong> <?php echo $name; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Payment Method:</strong> <?php echo ucfirst($payment_method); ?></p>
    <h3>Total Amount Due: $<?php echo number_format($price, 2); ?></h3>
</body>
</html>

<?php $conn->close(); ?>
