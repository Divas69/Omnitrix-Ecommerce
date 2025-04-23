
<!-- Admin ko main dashboard -->

<?php include 'header.php'; 
$qrycat = "SELECT count(id) as totalcategories FROM categories";
$qryproduct = "SELECT count(id) as totalproducts FROM products";
include '../includes/dbconnection.php';
$resultcat = mysqli_query($conn,$qrycat);
$resultproduct = mysqli_query($conn,$qryproduct);
$rowcat = mysqli_fetch_assoc($resultcat);
$rowproduct = mysqli_fetch_assoc($resultproduct);
include '../includes/closeconnection.php';
?>
<!-- <body class="bg-blue-100"> -->

<!--  dashboard  -->

          <h1 class="text-5xl font-bold text-gray-800 mb-12 text-center"> Dashboard</h1>
<hr class="my-6 h-1 bg-gradient-to-r from-indigo-600 to-purple-600">

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-6">
    <!-- Total Categories Card -->
    <div class="bg-white shadow-lg rounded-2xl p-8 flex flex-col justify-between transition-all duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">

                <div class="bg-blue-500 text-white p-4 rounded-full shadow-lg">
                    <i class="fas fa-cogs text-3xl"></i>
                </div>
                <h2 class="ml-4 text-2xl font-semibold text-gray-700">Total Categories</h2>
            </div>
            <div class="text-sm text-gray-500">Last updated: 2 days ago</div>
        </div>
        <h3 class="text-5xl font-bold text-gray-900 mt-2"><?php echo $rowcat['totalcategories']; ?></h3>
        <div class="flex justify-between items-center mt-6">
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-500 h-2 rounded-full" style="width: 80%"></div>
            </div>
            <div class="text-xs text-gray-500 ml-2">80% Complete</div>
        </div>
    </div>

    <!-- Total Products Card -->
    <div class="bg-white shadow-lg rounded-2xl p-8 flex flex-col justify-between transition-all duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">

                <div class="bg-teal-500 text-white p-4 rounded-full shadow-lg">
                    <i class="fas fa-box-open text-3xl"></i>
                </div>
                <h2 class="ml-4 text-2xl font-semibold text-gray-700">Total Products</h2>
            </div>
            <div class="text-sm text-gray-500">Last updated: 5 days ago</div>
        </div>
        <h3 class="text-5xl font-bold text-gray-900 mt-2"><?php echo $rowproduct['totalproducts']; ?></h3>
        <div class="flex justify-between items-center mt-6">
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-teal-500 h-2 rounded-full" style="width: 60%"></div>
            </div>
            <div class="text-xs text-gray-500 ml-2">60% Complete</div>
        </div>
    </div>

    <!-- Total Orders Card -->
    <div class="bg-white shadow-lg rounded-2xl p-8 flex flex-col justify-between transition-all duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center"
            >
                <div class="bg-green-500 text-white p-4 rounded-full shadow-lg">
                    <i class="fas fa-cart-arrow-down text-3xl"></i>
                </div>
                <h2 class="ml-4 text-2xl font-semibold text-gray-700">Total Orders</h2>
            </div>
            <div class="text-sm text-gray-500">Last updated: 1 hour ago</div>
        </div>
        <h3 class="text-5xl font-bold text-gray-900 mt-2">5</h3>
        <div class="flex justify-between items-center mt-6">
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 90%"></div>
            </div>
            <div class="text-xs text-gray-500 ml-2">90% Complete</div>
        </div>
    </div>
</div>



<?php include 'footer.php';?>


<!-- Product Market Value Graph Section -->
<div class="mt-12">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Products Market Value </h2> 
    <div class="bg-white shadow-xl p-8 rounded-2xl">
        <canvas id="marketValueChart" class="w-full h-72"></canvas>
    </div>
</div>


<!-- css of graph  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('marketValueChart').getContext('2d');
    const marketValueChart = new Chart(ctx, {
        type: 'bar', // Bar chart type
        data: {
            labels: ['Rolex', 'Omega', 'Casio', 'Apple'], // Example products
            datasets: [{
                label: 'Market Value (NPR)',
                data: [5000, 12000, 8000, 15000, 10000], // Example values for market price
                backgroundColor: '#4CAF50', // Green color for the bars
                borderColor: '#388E3C', // Darker green for the border
                borderWidth: 1,
                barThickness: 10, // Smaller bar size
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return 'USD ' + tooltipItem.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'USD ' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false, // Hide grid lines for X-axis
                    }
                }
            }
        }
    });
</script>