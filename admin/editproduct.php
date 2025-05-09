
<!-- Products lai edit garni  -->
<?php include 'header.php';

include '../includes/dbconnection.php';
// $qry1 = "SELECT * FROM categories ORDER BY priority";
// $pid = $_GET['id'];
// $qry2 = "SELECT * FROM products WHERE id = $pid";
// $presult = mysqli_query($conn,$qry2);
// $presult = mysqli_fetch_assoc($presult);
// $result = mysqli_query($conn,$qry1);
// $result = mysqli_query($conn,$qry2);
// $product = mysqli_fetch_assoc($result);
    $qry1 = "SELECT * FROM categories ORDER BY priority";
    $pid = $_GET['id'];
    $result = mysqli_query($conn,$qry1);
    $qry2 = "SELECT * FROM products WHERE id = $pid";
    $result2 = mysqli_query($conn,$qry2);
    $product = mysqli_fetch_assoc($result2);
include '../includes/closeconnection.php';

?>


   <!-- <body class="bg-blue-100"> -->

    
     <h1 class="text-3xl font-bold">Edit Product</h1>
     <hr class="my-3 h-1 bg-indigo-500">

     <form action="actionproduct.php" method="POST" enctype="multipart/form-data">
        
     <input type="hidden" name="id" value="<?php echo $product['id']; ?>">   
     <select name="category_id" id="" class="p-2 bg-gray-100 border 
        rounded w-full block my-3">
        <?php while ($row = mysqli_fetch_assoc($result)){ ?>
            <option value="<?php echo $row['id']; ?>" 
            <?php echo ($product['category_id'] == $row['id'])? 'selected':'';
        ?>
        ><?php echo $row['name']; ?></option>
        <?php } ?>

        
     </select>
        <input type="text" name="name" value="<?php echo $product['name']?>" placeholder="Enter Product Name" class="p-2 bg-gray-100 border 
        rounded w-full block my-3">

        <input type="text" name="description" value="<?php echo $product['description']?>" placeholder="Enter Description" class="p-2 bg-gray-100 border 
        rounded w-full block my-3">

        <input type="text" name="price" value="<?php echo $product['price']?>" placeholder="Enter Price" class="p-2 bg-gray-100 border 
        rounded w-full block my-3">

        <input type="text" name="stock" value="<?php echo $product['stock']?>" placeholder="Enter Stock" class="p-2 bg-gray-100 border 
        rounded w-full block my-3">

        <select name="status" id="" class="p-2 bg-gray-100 border rounded w-fully block my-3">
            <option value="Show" <?php echo ($product['status']=='Show')? 'selected':''?> >Show</option>
            <option value="Hide" <?php echo ($product['status']=='Hide')? 'selected':''?> >Hide</option>

        </select>

        <p>Current image:</p>
        <img src="../uploads/<?php echo $product['photopath'];?>" alt="" class="h-40">
        <input type="hidden" name="oldpath" value="<?php echo $product['photopath'];?>">
        <input type="file" name="photopath" class="p-2 bg-gray-100 border rounded w-full block my-3">

        <div class="flex justify-center gap-5 mt-5">
            <input type="submit" name="update" value="Update Product" class="bg-green-600 text-white px-4
            py-2 rounded cursor-pointer">
            <a href="products.php" class="bg-red-500 text-white px-8 py-2 rounded">Exit</a>
        </div>

        
    </form>

<?php include 'footer.php';?>        