<?php
include 'includes/header.php';
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['islogin'])) {
    $_SESSION['msg'] = "Please Login First";
    header('location: login.php');  // Redirect to login page if not logged in
    exit;
}

$user_id = $_SESSION['userid'];  // Get the user ID from the session

// Include the database connection file
include 'includes/dbconnection.php';

// SQL query to fetch orders of the logged-in user
$qryorders = "SELECT orders.id, order_date, products.name, products.price, orders.quantity, orders.status 
              FROM orders 
              INNER JOIN products ON orders.product_id = products.id 
              WHERE orders.user_id = $user_id";  // Only fetch orders for the logged-in user

// Execute the query
$result = mysqli_query($conn, $qryorders);

// Calculate the total amount
$totalAmount = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $totalAmount += $row['price'] * $row['quantity'];
}

// Reset the result pointer for table display
mysqli_data_seek($result, 0);  // Reset the result pointer to fetch data again

// Close the database connection
include 'includes/closeconnection.php';
?>

<!-- Include the header for consistent UI and a font css  -->
<?php include '../header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<!-- Page Heading -->
<div class="bg-white py-6">
    <h1 class="text-center text-5xl font-bold text-gray-800 mb-10">
        <span class="text-black">My</span> <span class="text-gradient bg-gradient-to-r from-purple-600 via-pink-500 to-red-500 text-transparent bg-clip-text">Orders</span>
    </h1>
</div>

<!-- order table css   -->
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f3f4f6;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 1100px;
        margin: 40px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        overflow: hidden;
        border-radius: 8px;
    }
    thead {
        background-color: #ff7043;
        color: white;
    }
    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #e5e7eb;
    }
    th {
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }
    tbody tr:nth-child(even) {
        background-color: #f9fafb;
    }
    tbody tr:hover {
        background-color: #f3f4f6;
        transition: background-color 0.3s;
    }
    tbody td {
        font-size: 16px;
        color: #4b5563;
    }
    tbody td:nth-child(4), tbody td:nth-child(5) {
        font-weight: bold;
        color: #111827;
    }
    .status {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: bold;
    }
    .status.completed {
        background-color: #d1fae5;
        color: #047857;
    }
    .status.pending {
        background-color: #fee2e2;
        color: #b91c1c;
    }
    .status.processing {
        background-color: #fef3c7;
        color: #92400e;
    }
    .status.cancelled {
        background-color: #fee2e2;
        color: #b91c1c;
    }
    h1 {
        color: #1f2937;
    }
</style>

<div class="container mx-auto">
    <!-- Orders Table -->
    <table>
        <thead>
            <tr>
                <th>Order Date</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>NPR. <?php echo $row['price']; ?>/-</td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>NPR. <?php echo $row['price'] * $row['quantity']; ?>/-</td>
                    <td><span class="status <?php echo strtolower($row['status']); ?>"><?php echo ucfirst($row['status']); ?></span></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Total Amount -->
    <div class="mt-6 text-center">
        <h2 class="text-2xl font-bold">Total Amount: NPR. <?php echo $totalAmount; ?>/-</h2>
    </div>
</div>

<!-- Include the footer for consistent UI -->
<?php include '../footer.php'; ?>
