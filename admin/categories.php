
<!-- categories ko main page -->

<?php include 'header.php'; 
$qry = "SELECT * FROM categories ORDER BY priority";
include '../includes/dbconnection.php';
$result = mysqli_query($conn, $qry);
include '../includes/closeconnection.php';
?>

<!-- <body class="bg-blue-100"> -->

<!-- Page Heading -->
<div class="max-w-7xl mx-auto px-6 py-8">
    <h1 class="text-5xl font-bold text-gray-800 mb-6 text-center"> Categories</h1>
    <hr class="my-3 h-1 bg-indigo-500">

    <!-- Add Category Button (with hover effect) -->
    <div class="text-right my-5">
    <a href="createcategory.php" 
   class="bg-blue-500 text-white px-10 py-3 rounded-lg shadow-lg transform hover:translate-y-2 hover:bg-blue-800 transition-all duration-300 ease-in-out text-lg">
   + Add Category
</a>

    </div>

    <!-- Categories Table -->
    <div class="overflow-x-auto rounded-lg shadow-lg bg-white">
        <table class="min-w-full table-auto text-lg">
            <thead>
                <tr class="bg-purple-600 text-white">
                    <th class="py-3 px-6 text-left">Priority</th>
                    <th class="py-3 px-6 text-left">Category Name</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr class="transition-colors hover:bg-indigo-50">
                        <td class="py-4 px-6"><?php echo $row['priority']; ?></td>
                        <td class="py-4 px-6"><?php echo $row['name']; ?></td>
                        <td class="py-4 px-6 space-x-6">
                            <!-- Edit Button with Hover Effect -->
                            <a href="editcategory.php?id=<?php echo $row['id']; ?>" 
                               class="bg-green-500 text-white py-2 px-6 rounded-lg hover:bg-green-600 transition-all duration-200 transform hover:translate-y-1 text-lg">
                                Edit
                            </a>
                            <!-- Delete Button with Hover Effect -->
                            <a href="actioncategory.php?deleteid=<?php echo $row['id']; ?>" 
                               class="bg-red-500 text-white py-2 px-6 rounded-lg hover:bg-red-600 transition-all duration-200 transform hover:translate-y-1 text-lg"
                               onclick="return confirm('Are you sure to delete?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
