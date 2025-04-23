
<!-- naya products haru add garni right mah click garerw -->

<?php include 'header.php'; 

include '../includes/dbconnection.php';
$qry = "SELECT * FROM categories ORDER BY priority";
$result = mysqli_query($conn, $qry);
include '../includes/closeconnection.php';
?>

<!-- <body class="bg-blue-100"> -->

<div class="max-w-4xl mx-auto px-6 py-8">
    <h1 class="text-4xl font-semibold text-gray-800 mb-6"> Add New Product</h1>
    <hr class="my-3 h-1 bg-indigo-500">

    <form action="actionproduct.php" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        
        <!-- Category Select -->
        <select name="category_id" id="" class="p-3 bg-gray-100 border rounded w-full block my-4 text-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php } ?>
        </select>

        <!-- Product Name Input -->
        <input type="text" name="name" placeholder="Enter Product Name" class="p-3 bg-gray-100 border rounded w-full block my-4 text-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

        <!-- Product Description Input -->
        <input type="text" name="description" placeholder="Enter Description" class="p-3 bg-gray-100 border rounded w-full block my-4 text-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

        <!-- Price Input -->
        <input type="text" name="price" placeholder="Enter Price" class="p-3 bg-gray-100 border rounded w-full block my-4 text-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

        <!-- Stock Input -->
        <input type="text" name="stock" placeholder="Enter Stock" class="p-3 bg-gray-100 border rounded w-full block my-4 text-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

        <!-- Status Select -->
        <select name="status" id="" class="p-3 bg-gray-100 border rounded w-full block my-4 text-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="Show">Show</option>
            <option value="Hide">Hide</option>
        </select>

        <!-- File Input -->
        <input type="file" name="photopath" class="p-3 bg-gray-100 border rounded w-full block my-4 text-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

        <!-- Submit and Exit Buttons -->
        <div class="my-5 flex justify-center gap-6">
            <input type="submit" name="store" value="Add Product" class="bg-green-600 text-white px-6 py-3 rounded-lg transform hover:scale-105 transition-all duration-200">
            <a href="products.php" class="bg-red-600 text-white px-6 py-3 rounded-lg transform hover:scale-105 transition-all duration-200">
                Exit
            </a>
        </div>

    </form>
</div>

<?php include 'footer.php'; ?>
