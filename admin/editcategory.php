

<!-- categories lai edit garni  -->

<?php include 'header.php'; 

$id = $_GET['id'];
$qry = "SELECT * FROM categories WHERE id=$id";
include '../includes/dbconnection.php';
$result = mysqli_query($conn, $qry);
include '../includes/closeconnection.php';
$row = mysqli_fetch_assoc($result);
?>

<!-- <body class="bg-blue-100"> -->

<div class="max-w-4xl mx-auto px-6 py-8">
    <h1 class="text-4xl font-semibold text-gray-800 mb-6">Edit Category</h1>
    <hr class="my-3 h-1 bg-indigo-500">

    <form action="actioncategory.php" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        
        <!-- Hidden Category ID -->
        <input type="hidden" name="categoryid" value="<?php echo $row['id'] ?>">

        <!-- Priority Input -->
        <input type="text" name="priority" value="<?php echo $row['priority']; ?>" placeholder="Enter Priority" 
        class="p-3 bg-gray-100 border rounded w-full block my-4 text-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

        <!-- Category Name Input -->
        <input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="Enter Category Name" 
        class="p-3 bg-gray-100 border rounded w-full block my-4 text-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

        <!-- Update and Exit Buttons -->
        <div class="my-5 flex justify-center gap-6">
            <input type="submit" name="update" value="Update Category" class="bg-green-600 text-white px-6 py-3 rounded-lg transform hover:scale-105 transition-all duration-200">
            <a href="categories.php" class="bg-red-600 text-white px-6 py-3 rounded-lg transform hover:scale-105 transition-all duration-200">
                Exit
            </a>
        </div>

    </form>
</div>

<?php include 'footer.php'; ?>
