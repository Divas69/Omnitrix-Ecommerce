<?php include 'header.php'; 
$qry="SELECT * FROM users WHERE role='user'";
include '../includes/dbconnection.php';
$result=mysqli_query($conn, $qry);
include '../includes/closeconnection.php';
?>

<!-- <body class="bg-blue-100"> -->


<div class="max-w-6xl mx-auto px-6 py-8">
    <h1 class="text-5xl font-bold text-gray-800 mb-6 text-center">👤Customer Details </h1>
    <hr class="my-3 h-1 bg-indigo-500 mb-6">

    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="w-full border-collapse text-left text-gray-700">
            <thead>
                <tr class="bg-purple-600 text-white">
                    <th class="p-4 border-b-2 border-gray-200 text-lg">Name</th>
                    <th class="p-4 border-b-2 border-gray-200 text-lg">Email</th>
                    <th class="p-4 border-b-2 border-gray-200 text-lg">Phone</th>
                    <th class="p-4 border-b-2 border-gray-200 text-lg">Address</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr class="hover:bg-indigo-50">
                    <td class="p-4 border-b border-gray-200"><?php echo $row['fullname']; ?></td>
                    <td class="p-4 border-b border-gray-200"><?php echo $row['email']; ?></td>
                    <td class="p-4 border-b border-gray-200"><?php echo $row['phone']; ?></td>
                    <td class="p-4 border-b border-gray-200"><?php echo $row['address']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>



