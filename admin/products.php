<?php include 'header.php';
$qry = "SELECT * FROM products";
include '../includes/dbconnection.php';
$result = mysqli_query($conn, $qry);
include '../includes/closeconnection.php';
?>


   <!-- <body class="bg-blue-100"> -->


<div class="max-w-7xl mx-auto px-6 py-8">
    <h1 class="text-5xl font-bold text-gray-800 mb-6 text-center">Products</h1>
    <hr class="my-4 h-1 bg-indigo-500 rounded">

    <!-- Add Product Button -->
    <div class="text-right mb-10">
        <a href="createproduct.php" 
        class="bg-blue-500 text-white px-10 py-3 rounded-lg shadow-lg transform hover:translate-y-2 hover:bg-blue-800 transition-all duration-300 ease-in-out text-lg"> 
        + Add Product</a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white shadow-md rounded-xl">
            <thead>
                <tr class="bg-purple-600 text-white text-md">
                    <th class="border px-3 py-2">Product Date</th>
                    <th class="border px-3 py-2">Name</th>
                    <th class="border px-3 py-2">Description</th>
                    <th class="border px-3 py-2">Price</th>
                    <th class="border px-3 py-2">Stock</th>
                    <th class="border px-3 py-2">Category</th>
                    <th class="border px-3 py-2">Photo</th>
                    <th class="border px-3 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $qrycat = "SELECT name FROM categories WHERE id = " . $row['category_id'];
                    include '../includes/dbconnection.php';
                    $resultcat = mysqli_query($conn, $qrycat);
                    $rowcat = mysqli_fetch_assoc($resultcat);
                    include '../includes/closeconnection.php';
                    ?>
                    <tr class="text-center hover:bg-indigo-50">

                        <td class="border px-6 py-4 text-gray-700">
                            <?php echo $row['product_date']; ?>
                        </td>
                        <td class="border px-6 py-4 text-gray-700">
                            <?php echo $row['name']; ?>
                        </td>
                        <td class="border px-6 py-4 text-gray-600 text-sm">
                            <?php echo $row['description']; ?>
                        </td>
                        <td class="border px-6 py-4 font-bold text-green-600 text-lg">
                            <?php echo $row['price']; ?>
                        </td>
                        <td class="border px-6 py-4 text-gray-700">
                            <?php echo $row['stock']; ?>
                        </td>
                        <td class="border px-6 py-4 text-gray-700">
                            <?php echo $rowcat['name']; ?>
                        </td>
                        <td class="border px-6 py-4">
                            <img class="h-25 object-cover rounded-lg shadow-md" src="../uploads/<?php echo $row['photopath']; ?>" alt="Product Image">
                        </td>
                        <td class="border px-6 py-4 space-y-4">
                            <a href="editproduct.php?id=<?php echo $row['id']; ?>" class="bg-green-500 hover:bg-green-600 
                            text-white px-5 py-2 rounded-md shadow font-medium block">Edit</a>
                            <a href="actionproduct.php?deleteid=<?php echo $row['id']; ?>" class="bg-red-500 hover:bg-red-600 
                            text-white px-5 py-2 rounded-md shadow font-medium block" onclick="return confirm('Are you sure to Delete?');">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
