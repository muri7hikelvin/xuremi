<?php
// Database connection
$host = 'localhost';
$dbname = 'xuremico_xuremi_db';
$username = 'xuremico_xuremi_db';
$password = 'Cerufixime250.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname: " . $e->getMessage());
} 

// 1. Get total revenue from all paid invoices
$query = $pdo->prepare("SELECT SUM(price) as total_revenue FROM orders WHERE orders.order_id IN (SELECT order_id FROM invoices WHERE status='paid')");
$query->execute();
$totalRevenue = $query->fetch(PDO::FETCH_ASSOC)['total_revenue'] ?? 0;

// 2. Get total pending charges from unpaid invoices
$query = $pdo->prepare("SELECT SUM(price) as pending_charges FROM orders WHERE orders.order_id IN (SELECT order_id FROM invoices WHERE status='pending')");
$query->execute();
$pendingCharges = $query->fetch(PDO::FETCH_ASSOC)['pending_charges'] ?? 0;

// 3. Get the total number of paid invoices and their amount
$query = $pdo->prepare("SELECT COUNT(*) as total_paid_invoices, SUM(price) as total_paid_amount FROM orders WHERE orders.order_id IN (SELECT order_id FROM invoices WHERE status='paid')");
$query->execute();
$paidData = $query->fetch(PDO::FETCH_ASSOC);
$totalPaidInvoices = $paidData['total_paid_invoices'] ?? 0;
$totalPaidAmount = $paidData['total_paid_amount'] ?? 0;

// 4. Monthly revenue growth (last 12 months)
$monthlyRevenueData = [];
$query = $pdo->prepare("
    SELECT DATE_FORMAT(order_date, '%Y-%m') as month, SUM(price) as monthly_revenue 
    FROM orders 
    JOIN invoices ON orders.order_id = invoices.order_id
    WHERE invoices.status='paid'
    GROUP BY month
    ORDER BY month DESC
    LIMIT 12
");
$query->execute();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $monthlyRevenueData[] = $row;
}

?>
