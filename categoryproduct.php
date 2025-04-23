<?php include('includes/header.php'); 
$id = $_GET['category'];
$qrycat = "SELECT * FROM categories WHERE id=$id";
$qry = "SELECT * FROM products WHERE category_id = $id ORDER BY product_date DESC";
include('includes/dbconnection.php');
$resultcat = mysqli_query($conn, $qrycat);
$rowcat = mysqli_fetch_assoc($resultcat);
$result = mysqli_query($conn, $qry);
include('includes/dbconnection.php');
?>

<!-- rolex omega casio apple    -->

    <h1 class="text-center font-bold text-4xl my-10"><?php echo $rowcat
    ['name']; ?> <span class="text-gradient bg-gradient-to-r from-purple-600 via-pink-500 to-red-500 text-transparent bg-clip-text"> Products </span></h1>

    <div class="grid grid-cols-4 gap-10 px-20">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>


             <!--  hover effect that changes text color -->

        <a href="viewproduct.php?id=<?php echo $row['id'];?>" class="hover:-translate-y-2
         duration-300 hover:shadow-lg hover:text-green-400">

            <div class="bg-gray-100 rounded shadow">
                <img src="uploads/<?php echo $row['photopath']; ?>" class="w-full h-60 object-cover rounded">
                <div class="p-2">
                    <h2 class="text-lg font-bold"><?php echo $row['name']; ?></h2>
                    <p class="text-sm text-gray-600">NPR.<?php echo $row['price']; ?></p>
                </div>
            </div>
        </a>
        <?php } ?>
    </div>

<?php include('includes/footer.php'); ?>