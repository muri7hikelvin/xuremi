<?php
// success.php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$db = 'xuremi_db';
$user = 'root';
$pass = 'Cerufixime250.';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the invoice ID from the URL
$invoice_id = $_GET['invoice_id'] ?? '';

// Fetch invoice details
$stmt = $conn->prepare("SELECT * FROM invoices WHERE id = ?");
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$result = $stmt->get_result();
$invoice = $result->fetch_assoc();

if (!$invoice) {
    die("Invoice not found.");
}

// Display the invoice details
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice Details</h1>
    <p>Invoice ID: <?php echo htmlspecialchars($invoice['id']); ?></p>
    <p>User ID: <?php echo htmlspecialchars($invoice['user_id']); ?></p>
    <p>Plan ID: <?php echo htmlspecialchars($invoice['plan_id']); ?></p>
    <p>Payment Method: <?php echo htmlspecialchars($invoice['payment_method']); ?></p>
    <p>Created At: <?php echo htmlspecialchars($invoice['created_at']); ?></p>
</body>
</html>
<?php
// Close connections
$stmt->close();
$conn->close();
?>
