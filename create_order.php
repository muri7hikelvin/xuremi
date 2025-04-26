<?php
// Database connection details
$host = 'localhost';
$dbname = 'xuremi_db';
$username = 'root';
$password = 'Cerufixime250.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname: " . $e->getMessage());
}

// Order details with validation
$planName = isset($_POST['plan_name']) ? $_POST['plan_name'] : null;
$price = isset($_POST['price']) ? $_POST['price'] : null;
$customerEmail = isset($_POST['customer_email']) ? $_POST['customer_email'] : null;

if (!$planName || !$price || !$customerEmail) {
    die("Please fill in all required fields.");
}

// Insert order into orders table
$stmt = $pdo->prepare("INSERT INTO orders (plan_name, price, customer_email) VALUES (?, ?, ?)");
$stmt->execute([$planName, $price, $customerEmail]);
$orderId = $pdo->lastInsertId();

// Create invoice
$stmt = $pdo->prepare("INSERT INTO invoices (order_id) VALUES (?)");
$stmt->execute([$orderId]);

// Send invoice email
$subject = "Invoice for Your Order - Plan: $planName";
$message = "
<html>
<head>
  <title>Invoice for Order #$orderId</title>
</head>
<body>
  <h2>Thank you for your order!</h2>
  <p>Order ID: $orderId</p>
  <p>Plan: $planName</p>
  <p>Price: \$$price</p>
  <p>Click <a href='http://yourwebsite.com/view_invoice.php?order_id=$orderId'>here</a> to view your invoice online.</p>
</body>
</html>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@yourwebsite.com" . "\r\n";

mail($customerEmail, $subject, $message, $headers);

// Redirect to view invoice
header("Location: view_invoice.php?order_id=$orderId");
exit;
?>
