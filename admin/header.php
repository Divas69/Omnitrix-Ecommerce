<?php session_start(); 
if(!isset($_SESSION['islogin']))
{
    header('location:../login.php');
}

if($_SESSION['role'] != 'admin')
{
    header('location:../register.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
      <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    

    

    

</head>
<body>
    <?php if(isset($_SESSION['msg'])){?>
        <!-- notification  -->
    <div id="msg" class="fixed right-4 top-4 bg-green-500 text-white px-10 py-4 
    rounded-xl text-xl font-bold">
    
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

    <div class="flex">
    <nav class="h-screen bg-blue-200 shadow-sm w-56 ">


            <img class="bg-blue-200 p-5 rounded-full" src="https://img.freepik.com/premium-vector/cartoon-alarm-cute-clock-clock-smiling-doodle_1047931-80.jpg" alt="">

             <div class="mt-5 text-lg font-bold">

                <p class="text-center font-bold"> <b> नमस्ते , </b>
                   <?php echo $_SESSION['username']; ?> Sir </p>


                <a href="dashboard.php"  class="block p-5 hover:bg-white   my-2 rounded-l-full">Dashboard   <i class="bi bi-house-gear ml-5"  style="font-size:2rem;"></i>  </a>
                <a href="categories.php" class="block p-5 hover:bg-white   my-2 rounded-l-full">Categories  <i class="bi bi-tags ml-5"        style="font-size:2rem;"></i>  </a>
                <a href="products.php"   class="block p-5 hover:bg-white    my-2 rounded-l-full">Products   <i class="bi bi-box-seam ml-8"    style="font-size:2rem;"></i>  </a>
                <a href="customers.php"  class="block p-5 hover:bg-white    my-2 rounded-l-full">Customers  <i class="bi bi-person ml-4"      style="font-size:2rem;"></i>  </a>
                <a href="orders.php"     class="block p-5 hover:bg-white     my-2 rounded-l-full">Orders   <i class="bi bi-cart ml-12"        style="font-size:2rem;"></i>  </a>
                <a href="logout.php"     class="block p-5 hover:bg-white     my-2 rounded-l-full">Logout   <i class="bi bi-box-arrow-right ml-2"                     ></i>  </a>
             </div>
        </nav>
        <!-- For Content Part -->
        <div class="p-4 flex-1">







        