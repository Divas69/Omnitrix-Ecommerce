<?php include 'includes/header.php'; 
$id = $_GET['id'];
$qry = "SELECT * FROM products WHERE id = $id";
include 'includes/dbconnection.php';
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_assoc($result);
include 'includes/closeconnection.php';
?>
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-16 px-6 lg:px-16">
        <!-- Product Image -->
        <div class="col-span-1">
            <img src="uploads/<?php echo $row['photopath']; ?>" class="w-full h-auto object-cover rounded-lg shadow-md border border-gray-200">
        </div>

        <!-- Product Details -->
        <div class="col-span-1 lg:col-span-2 space-y-8">
            <h1 class="text-4xl font-bold text-gray-800"><?php echo $row['name']; ?></h1>
            <p class="text-2xl font-semibold text-amber-600">NPR. <?php echo $row['price']; ?>/-</p>
            <p class="text-lg text-gray-800"><span class="font-medium">Stock:</span> <?php echo $row['stock']; ?></p>
            
            <form action="actioncart.php" method="POST" class="space-y-4">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <div class="flex items-center space-x-4">
                    <label for="quantity" class="text-lg font-medium text-gray-700">Quantity:</label>
                    <input 
                        name="quantity" 
                        id="quantity" 
                        class="w-20 border border-gray-300 rounded-lg text-lg p-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500" 
                        type="number" 
                        min="1" 
                        max="<?php echo $row['stock']; ?>" 
                        value="1" 
                        required>
                </div>
                <button 
                    type="submit" 
                    name="cart" 
                    class="w-full bg-blue-800 hover:bg-indigo-700 text-white text-lg font-semibold py-3 rounded-lg shadow-lg transition-transform transform hover:-translate-y-1">
                    <i class="ri-shopping-cart-fill"></i> Add to Cart
                </button>
            </form>
        </div>
    </div>

    <!-- Description Section -->
    <div class="max-w-7xl mx-auto mt-16 px-6 lg:px-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Product Description</h2>
        <p class="text-lg text-gray-700 leading-relaxed"><?php echo $row['description']; ?></p>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
