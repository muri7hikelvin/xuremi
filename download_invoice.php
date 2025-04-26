<?php
require 'vendor/autoload.php'; // Load dompdf

use Dompdf\Dompdf;

$host = 'localhost';
$dbname = 'xuremi_db';
$username = 'root';
$password = 'Cerufixime250.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

$orderId = $_GET['order_id'];
$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Invoice not found.");
}

$dompdf = new Dompdf();
$html = "
<h2>Invoice for Order #{$order['order_id']}</h2>
<p>Plan: {$order['plan_name']}</p>
<p>Price: \${$order['price']}</p>
<p>Date: {$order['order_date']}</p>
";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("invoice_order_{$orderId}.pdf", ["Attachment" => true]);
?>