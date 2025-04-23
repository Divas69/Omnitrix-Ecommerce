<?php
session_start();
if (!isset($_SESSION['islogin'])) {
    $_SESSION['msg'] = "Please Login First";
    header('location: login.php');
    exit();
}

include 'includes/dbconnection.php';

$user_id = $_SESSION['userid'];

// Fetch all items from the user's cart
$qrycart = "SELECT * FROM carts WHERE user_id = $user_id";
$resultcart = mysqli_query($conn, $qrycart);

// Check if cart is not empty
if (mysqli_num_rows($resultcart) > 0) {
    while ($rowcart = mysqli_fetch_assoc($resultcart)) {
        $product_id = $rowcart['product_id'];
        $quantity = $rowcart['quantity'];

        // Fetch product details
        $qryprd = "SELECT price FROM products WHERE id = $product_id";
        $resultprd = mysqli_query($conn, $qryprd);
        $rowprd = mysqli_fetch_assoc($resultprd);

        $price = $rowprd['price'];
        $total = $price * $quantity;

        // Insert into orders table
        $qryorder = "INSERT INTO orders (user_id, product_id, quantity, total_price, order_date) 
                     VALUES ($user_id, $product_id, $quantity, $total, NOW())";
        mysqli_query($conn, $qryorder);
    }

    // Clear the cart after successful checkout
    $qryclear = "DELETE FROM carts WHERE user_id = $user_id";
    mysqli_query($conn, $qryclear);

    // Redirect to a confirmation page or admin panel
    $_SESSION['msg'] = "Checkout Successful! Your order has been placed.";
    header('location: admin/orders.php'); // Adjust this URL as per your admin panel structure
} else {
    $_SESSION['msg'] = "Your cart is empty!";
    header('location: index.php');
}

include 'includes/closeconnection.php';
?>
