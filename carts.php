<?php 
include 'includes/header.php'; 
if(!isset($_SESSION['islogin'])) {
    $_SESSION['msg'] = "Please Login First";
    header('location: login.php');
}

$user_id = $_SESSION['userid'];
$qrycart = "SELECT * FROM carts WHERE user_id = $user_id";
include 'includes/dbconnection.php';
$resultcart = mysqli_query($conn, $qrycart);
include 'includes/closeconnection.php';

// Calculate total price for order summary
$total_price = 0;
foreach ($resultcart as $rowcart) {
    $qryprd = "SELECT price FROM products WHERE id=" . $rowcart['product_id'];
    include 'includes/dbconnection.php';
    $resultprd = mysqli_query($conn, $qryprd);
    $rowprd = mysqli_fetch_assoc($resultprd);
    $total_price += $rowprd['price'] * $rowcart['quantity'];
    include 'includes/closeconnection.php';
}
?>

<div class="min-h-screen bg-white py-10">
    <!-- Page Title -->
     
    <h1 class="text-center text-5xl font-bold text-gray-800 mb-16">
    <span class="text-black">My</span> <span class="text-gradient bg-gradient-to-r from-purple-600 
    via-pink-500 to-red-500 text-transparent bg-clip-text">Cart</span>
</h1>

    </h1>

    <!-- Cart Section -->
    <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 px-8">
        <?php foreach ($resultcart as $rowcart) {
            $qryprd = "SELECT * FROM products WHERE id=" . $rowcart['product_id'];
            include 'includes/dbconnection.php';
            $resultprd = mysqli_query($conn, $qryprd);
            $rowprd = mysqli_fetch_assoc($resultprd);
            include 'includes/closeconnection.php';
        ?>
        <!-- Product Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
            <!-- Product Image -->
            <div class="relative">
                <img src="uploads/<?php echo $rowprd['photopath']; ?>" alt="<?php echo $rowprd['name']; ?>" 
                     class="w-full h-48 object-cover">
                <div class="absolute top-4 right-4 bg-gradient-to-r from-pink-500 to-red-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                25% Off
                </div>
            </div>

            <!-- Product Info -->
            <div class="p-4 space-y-3">
                <h2 class="text-xl font-bold text-gray-800"><?php echo $rowprd['name']; ?></h2>
                <p class="text-gray-600 text-base">Price: <span class="text-indigo-600 font-bold">NPR. <?php echo $rowprd['price']; ?>/-</span></p>
                <p class="text-gray-600 text-base">Quantity: <span class="text-black font-bold"><?php echo $rowcart['quantity']; ?></span></p>
                <p class="text-lg font-bold text-green-600">Total: NPR. <?php echo $rowprd['price'] * $rowcart['quantity']; ?>/-</p>
                <div class="text-sm text-gray-500 italic">Free delivery on this product <span class="not-italic">🚚</span></div>

            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center p-4 bg-gradient-to-r from-gray-50 to-gray-100">
                <a href="actioncart.php?deleteid=<?php echo $rowcart['id']; ?>" 
                   onclick="return confirm('Are you sure you want to remove this item?')" 
                   class="text-white bg-red-500 hover:bg-red-600 px-3 py-2 rounded-lg text-sm font-bold shadow-lg transition">
                    Remove
                </a>
                <form action="actionorder.php" method="POST">
                    <input type="hidden" name="cart_id" value="<?php echo $rowcart['id']; ?>">
                    <button type="submit" 
                            class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-sm font-bold shadow-lg transition">
                        Buy Now
                    </button>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- Summary Section -->
    <div class="mt-16 bg-white shadow-xl rounded-lg py-8 px-10 mx-auto w-full max-w-3xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Order Summary</h2>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-lg text-gray-600 font-bold">Subtotal</span>
                <span class="text-lg font-bold text-gray-800">NPR. <?php echo number_format($total_price, 2); ?>/-</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-lg text-gray-600 font-bold">Shipping fee </span>
                <span class="text-lg font-bold text-gray-800">Free</span>
            </div>
            <hr class="my-4">
            <div class="flex justify-between items-center">
                <span class="text-lg text-gray-800 font-extrabold">Total</span>
                <span class="text-lg font-extrabold text-indigo-600">NPR. <?php echo number_format($total_price, 2); ?>/-</span>
            </div>
        </div>
        <div class="mt-6 text-center">
            <a href="index.php" 
               class="text-white bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-900 hover:to-gray-700 px-5 py-2 rounded-lg text-lg font-bold shadow-lg transition">
                Continue Shopping
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
