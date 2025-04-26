<?php
session_start(); // Start the session

// Database connection
$servername = "localhost";
$username = "root";
$password = "Cerufixime250.";
$dbname = "xuremi_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo json_encode(["error" => "User not logged in."]);
    exit;
}

// Get the user's email
$user_email = $_SESSION['user']['email'];

// Fetch user-specific invoices
$sql = "SELECT c.id, c.plan_name, c.plan_price, c.payment_method, c.created_at
        FROM checkout c
        JOIN users u ON c.user_id = u.id
        WHERE u.email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email); // Bind the user email parameter
$stmt->execute();
$result = $stmt->get_result(); // Get the result set from the prepared statement

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Invoices</title>
    <style>
        /* Add styles for a clean table layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<h1>Your Invoices</h1>
<table>
    <tr>
        <th>Invoice ID</th>
        <th>Plan Name</th>
        <th>Price</th>
        <th>Payment Method</th>
        <th>Date</th>
    </tr>
    <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['plan_name']); ?></td>
                <td>$<?php echo number_format($row['plan_price'], 2); ?></td>
                <td><?php echo ucfirst(htmlspecialchars($row['payment_method'])); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else : ?>
        <tr>
            <td colspan="5">No invoices found.</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>

<?php
$stmt->close(); // Close the prepared statement
$conn->close(); // Close the database connection
?>
