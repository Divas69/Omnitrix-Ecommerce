<?php
session_start();
$qrycat = "SELECT * FROM categories ORDER BY priority";
include 'includes/dbconnection.php';
$resultcat = mysqli_query($conn, $qrycat);
include 'includes/closeconnection.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- offline bootstrap css -->
    <link rel="stylesheet" type="text/css" href="file:///Applications/XAMPP/xamppfiles/htdocs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="file:///Applications/XAMPP/xamppfiles/htdocs/bootstrap-5.3.3-dist/js/bootstrap.min.js"> </script>

<!--omnitrix -->
<link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



</head>
<body>

<?php if(isset($_SESSION['msg'])){?>

    <!-- notification -->

    <div id="msg" class="fixed right-4 top-4 bg-green-500 text-white px-10 py-4 
    rounded-xl text-xl font-bold z-50">
    
        <p><?php echo $_SESSION['msg']; ?></p>
    </div>
    <script>
         setTimeout(function(){
            document.getElementById('msg').style.display = 'none';
        }, 2000);
    </script>
    <?php
    unset($_SESSION['msg']);
    }?>


<!-- main flex  -->

<nav class="flex bg-gray-900 px-20 py-3 items-center justify-between">
    <!-- omnitrix Logo Text -->
    <h1 class="text-white text-5xl tracking-wide font-bold" style="font-family: 'Bangers', cursive;">
    ⏱️ OMNITRIX
</h1>





    <!-- Navigation Links -->
    <div>
    <a href="index.php" 
    class="text-lg font-bold px-5 text-white font-serif hover:scale-105 transition-transform duration-300">
   Home
</a>

        <?php
        while($rowcat = mysqli_fetch_assoc($resultcat)){ 
        ?>
        <a href="categoryproduct.php?category=<?php echo $rowcat['id'];?>" 
   class="text-lg font-bold px-5 text-white font-serif hover:scale-105 transition-transform duration-300">
   <?php echo $rowcat['name']; ?>
</a>

        <?php } ?>
        <?php if(isset($_SESSION['islogin'])) { ?>
        <!-- User Dropdown -->
        <div class="text-lg font-bold text-white p-5 relative group inline cursor-pointer z-20">
            <i class="ri-user-fill"></i>
            <div  class="absolute top-10 right-0 hidden group-hover:block border rounded-lg bg-gray-100 text-gray-800 w-40 text-sm shadow-lg z-30">
                <a href="" class="p-2 block rounded hover:bg-gray-200 hover:text-red-500"><i class="ri-user-fill"></i> My Profile</a>
                <hr>
                <a  href="carts.php" class="p-2 block rounded hover:bg-gray-200 hover:text-red-500">
                    <p ><i class="ri-shopping-cart-2-line"></i> My Cart</p>
                </a>
                <hr>
                <a href="oders.php" class="p-2 block rounded hover:bg-gray-200 hover:text-red-500">
                    <p><i class="ri-product-hunt-line"></i> My Orders</p>
                </a>
                <hr>
                <a href="admin/logout.php" class="p-2 block rounded hover:bg-gray-200 hover:text-red-500"><i class="ri-logout-box-line"></i> Logout</a>
            </div>
        </div>
        <?php } else { ?>
        <a href="login.php" class="text-lg font-bold text-white px-5">Login</a>
        <?php } ?>
    </div>
</nav>
