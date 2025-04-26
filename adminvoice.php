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

$sql = "SELECT u.email, COUNT(c.id) AS order_count, SUM(c.plan_price) AS total_spent
        FROM checkout c
        JOIN users u ON c.user_id = u.id
        GROUP BY u.email";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Invoices Grouped by Email</title>
    <style>
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

<h1>Invoices Grouped by Email</h1>
<table>
    <tr>
        <th>User Email</th>
        <th>Number of Orders</th>
        <th>Total Spent</th>
    </tr>
    <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['order_count']; ?></td>
                <td>$<?php echo number_format($row['total_spent'], 2); ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else : ?>
        <tr>
            <td colspan="3">No invoices found.</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
