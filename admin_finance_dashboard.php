<?php include 'admin_finance.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Finance Dashboard</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

h1, h2 {
    text-align: center;
    color: #333;
}

.finance-summary {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    background-color: #fff;
    text-align: left;
    border-radius: 8px;
}

.chart-container {
    max-width: 800px;
    margin: 40px auto;
}

    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Finance Dashboard</h1>

    <div class="finance-summary">
        <h2>Summary</h2>
        <p>Total Revenue: $<?= number_format($totalRevenue, 2) ?></p>
        <p>Pending Charges: $<?= number_format($pendingCharges, 2) ?></p>
        <p>Total Paid Invoices: <?= $totalPaidInvoices ?></p>
        <p>Total Paid Amount: $<?= number_format($totalPaidAmount, 2) ?></p>
    </div>

    <div class="chart-container" style="width: 75%; margin: auto;">
        <h2>Monthly Revenue Growth</h2>
        <canvas id="monthlyRevenueChart"></canvas>
    </div>

    <script>
        const monthlyRevenueData = <?= json_encode($monthlyRevenueData) ?>;
        
        const labels = monthlyRevenueData.map(item => item.month);
        const data = monthlyRevenueData.map(item => parseFloat(item.monthly_revenue));

        const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.reverse(),
                datasets: [{
                    label: 'Monthly Revenue',
                    data: data.reverse(),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Monthly Revenue Growth'
                    }
                }
            }
        });
    </script>
</body>
</html>
