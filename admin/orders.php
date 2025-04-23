<?php
include 'header.php'; 

$qryorder = "SELECT orders.id,order_date,products.name,products.price,orders.quantity,fullname,
address,phone,orders.status FROM orders INNER JOIN products ON orders.product_id=products.id 
INNER JOIN users ON orders.user_id=users.id";
include '../includes/dbconnection.php';
$result = mysqli_query($conn, $qryorder);

// Initialize Grand Total
$grandTotal = 0;

include '../includes/closeconnection.php';
?>

  <!-- <body class="bg-blue-100"> -->


<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

<div class="max-w-7xl mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center"> 📦 Order Management</h1>
    <hr class="my-3 h-1 bg-indigo-500">

    <table class="w-full bg-white rounded-lg shadow-md overflow-hidden">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="p-3 text-left">Order ID</th>
                <th class="p-3 text-left">Order Date</th>
                <th class="p-3 text-left">Product</th>
                <th class="p-3 text-left">Price</th>
                <th class="p-3 text-left">Quantity</th>
                <th class="p-3 text-left">Total</th>
                <th class="p-3 text-left">Customer</th>
                <th class="p-3 text-left">Address</th>
                <th class="p-3 text-left">Phone</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php while ($row = mysqli_fetch_assoc($result)) { 
                $orderTotal = $row['price'] * $row['quantity'];
                $grandTotal += $orderTotal; // Calculate Grand Total
            ?>
            <tr class="hover:bg-indigo-50 transition-colors">
                <td class="p-3 text-gray-800"><?php echo $row['id']; ?></td>
                <td class="p-3 text-gray-800"><?php echo $row['order_date']; ?></td>
                <td class="p-3 text-gray-800"><?php echo $row['name']; ?></td>
                <td class="p-3 text-gray-800"><?php echo $row['price']; ?></td>
                <td class="p-3 text-gray-800"><?php echo $row['quantity']; ?></td>
                <td class="p-3 text-green-600 font-bold"><?php echo $orderTotal; ?></td>
                <td class="p-3 text-gray-800"><?php echo $row['fullname']; ?></td>
                <td class="p-3 text-gray-800"><?php echo $row['address']; ?></td>
                <td class="p-3 text-gray-800"><?php echo $row['phone']; ?></td>
                <td class="p-3 text-gray-800">
                    <span class="px-3 py-1 rounded-full text-sm 
                        <?php echo $row['status'] == 'pending' ? 'bg-red-200 text-red-800' : 
                                   ($row['status'] == 'processing' ? 'bg-yellow-200 text-yellow-800' : 
                                   'bg-green-200 text-green-800'); ?>">
                        <?php echo ucfirst($row['status']); ?>
                    </span>
                </td>
                <td class="p-3 flex justify-center space-x-3">
                    <a href="orderstatus.php?status=pending&orderid=<?php echo $row['id']; ?>" 
                        class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition" 
                        onclick="return confirm('Are you sure you want to change status to Pending?')">
                        <i class="ri-hourglass-fill"></i>
                    </a>
                    <a href="orderstatus.php?status=processing&orderid=<?php echo $row['id']; ?>" 
                        class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition" 
                        onclick="return confirm('Are you sure you want to change status to Processing?')">
                        <i class="ri-loop-right-line"></i>
                    </a>
                    <a href="orderstatus.php?status=completed&orderid=<?php echo $row['id']; ?>" 
                        class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition" 
                        onclick="return confirm('Are you sure you want to change status to Completed?')">
                        <i class="ri-checkbox-circle-fill"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Grand Total Section -->
    <div class="mt-4 flex justify-between items-center bg-gray-100 p-4 rounded-lg shadow hover:bg-indigo-50 transition-colors"> 
    <span class="text-2xl font-bold text-gray-800">Grand Total:</span>
    <span class="text-2xl font-bold">
        <span class="text-gray-800">NPR.</span>
        <span class="text-gray-600"><?php echo $grandTotal; ?>/-</span>
    </span>
</div>

</div>

<?php include 'footer.php'; ?>
