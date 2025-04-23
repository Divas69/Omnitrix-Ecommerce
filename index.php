<?php include 'includes/header.php'; ?>

<!-- Banner Section -->
<!-- Banner Video Section -->
<div class="banner py-20 text-center relative z-0">
    <video autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-[-1]">
        <source src="uploads/background-video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="relative z-10">
        <h2 class="text-5xl font-bold text-white mb-6">Welcome to Our Exclusive Collection.</h2>
        <p class="text-xl mt-4 text-gray-200 mb-8">Discover the latest products with amazing discounts.</p>
        <a  href= "#all-products"class="mt-6 inline-block bg-yellow-500 hover:bg-yellow-600 text-black py-3 px-8 rounded-full text-lg font-semibold transition duration-300">
            Shop Now <i class="bi bi-cart-fill"></i>

        </a>
    </div> 
</div>


<!-- Main php file --->

<?php 
$qry = "SELECT * FROM products ORDER BY product_date DESC LIMIT 4";
$qryall= "SELECT * FROM products ORDER BY RAND()";
include 'includes/dbconnection.php';
$result = mysqli_query($conn, $qry);
$resultall= mysqli_query($conn, $qryall);
include 'includes/closeconnection.php';
?>

<h1 class="text-center font-bold text-4xl my-10">Recent <span class="text-gradient bg-gradient-to-r from-purple-600 
via-pink-500 to-red-500 text-transparent bg-clip-text"> Products </span></h1>

<div class="grid grid-cols-4 gap-10 px-20">
    <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <a href="viewproduct.php?id=<?php echo $row['id'];?>" class="hover:-translate-y-2 
        duration-300 hover:shadow-lg hover:text-teal-600">
        
            <div class="bg-gray-100 rounded shadow">
                <img src="uploads/<?php echo $row['photopath']; ?>" class="w-full h-60 
                  object-cover rounded">
                <div class="p-2">
                    <h2 class="text-lg font-bold hover:text-green-400"><?php echo $row['name']; ?></h2>
                    <p class="text-sm text-gray-600">NPR.<?php echo $row['price']; ?></p>
                </div>
            </div>
        </a>
    <?php } ?>
</div>

<h1 id="all-products"class="text-center font-bold text-4xl my-10">All <span class="text-gradient bg-gradient-to-r from-purple-600 
via-pink-500 to-red-500 text-transparent bg-clip-text"> Products </span></h1>

<div class="grid grid-cols-4 gap-10 px-20">
    <?php while($row = mysqli_fetch_assoc($resultall)) { ?>
        
        <a href="viewproduct.php?id=<?php echo $row['id'];?>" class="hover:-translate-y-2 
        duration-300 hover:shadow-lg hover:text-teal-600">
        
            <div class="bg-gray-100 rounded shadow">
                <img src="uploads/<?php echo $row['photopath']; ?>" class="w-full h-52 
                  object-cover rounded">
                <div class="p-2">
                    <h2 class="text-lg font-bold hover:text-green-400"><?php echo $row['name']; ?></h2>
                    <p class="text-sm text-gray-600">NPR.<?php echo $row['price']; ?></p>
                </div>
            </div>
        </a>
    <?php } ?>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Banner and Product Section CSS -->
 
<style>
    .banner {
        background: url('path/to/your/banner-image.jpg') no-repeat center center/cover;
        color: white;
        text-align: center;
        position: relative;
    }

    .banner h2 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .banner p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }

    .banner a {
        background-color: #fbbf24; /* Yellow button color */
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 30px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .banner a:hover {
        background-color: #f59e0b; /* Darker yellow on hover */
    }

    /* Grid Section for Products */
    .grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2.5rem;
        padding-left: 5rem;
        padding-right: 5rem;
    }

    .grid a {
        text-decoration: none;
    }

    .grid img {
        width: 100%;
        height: 15rem;
        object-fit: cover;
        border-radius: 0.5rem;
    }

    .grid .p-2 {
        padding: 0.5rem;
    }

    .grid h2 {
        font-size: 1.125rem;
        font-weight: bold;
        color: #333;
    }

    .grid p {
        font-size: 0.875rem;
        color: #666;
    }

    /* Hover effect */
    .grid a:hover {
        transform: translateY(-0.5rem);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 

    }

    .grid a:hover h2, .grid a:hover p {
    color: #10b981; /* Change to your desired hover text color */
}
</style>
