<?php include 'includes/header.php'; ?>
<!-- register -->

<div class="flex justify-center items-center my-10">
    <form action="" method="POST" class="bg-gray-100 w-8/12 p-10 rounded shadow" onsubmit="return validateForm()">
        <h1 class="text-center font-bold text-4xl my-10">Register</h1>
        <div class="relative">
            <input type="text" class="w-full p-2 my-3 border-2 border-gray-300" 
            name="fullname" id="fullname" placeholder="Full name">
            <small id="fullname-error" class="text-red-500 hidden"></small>
        </div>
        <div class="relative">
            <input type="email" class="w-full p-2 my-3 border-2 border-gray-300" 
            name="email" id="email" placeholder="Email">
            <small id="email-error" class="text-red-500 hidden"></small>
        </div>
        <div class="relative">
            <input type="text" class="w-full p-2 my-3 border-2 border-gray-300" 
            name="phone" id="phone" placeholder="Phone">
            <small id="phone-error" class="text-red-500 hidden"></small>
        </div>
        <div class="relative">
            <input type="text" class="w-full p-2 my-3 border-2 border-gray-300" 
            name="address" id="address" placeholder="Address">
            <small id="address-error" class="text-red-500 hidden"></small>
        </div>
        <div class="relative">
            <input type="password" class="w-full p-2 my-3 border-2 border-gray-300" 
            name="password" id="password" placeholder="Password">
            <small id="password-error" class="text-red-500 hidden"></small>
        </div>
        <div class="relative">
            <input type="password" class="w-full p-2 my-3 border-2 border-gray-300" 
            name="cpassword" id="cpassword" placeholder="Confirm Password">
            <small id="cpassword-error" class="text-red-500 hidden"></small>
        </div>
        <button type="submit" name="register" class="w-full p-2 my-5 bg-green-600 
        text-white font-bold">Register</button>
        <div class="my-5">
        <p class="text-center">Already have an account? <a 
        href="login.php" class="text-blue-700">Login Now</a></p>
    </div>
    </form>
</div>

<script>
function showError(inputId, message) {
    const errorElement = document.getElementById(inputId + '-error');
    errorElement.textContent = message;
    errorElement.classList.remove('hidden');
}

function clearError(inputId) {
    const errorElement = document.getElementById(inputId + '-error');
    errorElement.textContent = '';
    errorElement.classList.add('hidden');
}

function validateForm() {
    let isValid = true;

    let fullname = document.getElementById('fullname').value.trim();
    let email = document.getElementById('email').value.trim();
    let phone = document.getElementById('phone').value.trim();
    let address = document.getElementById('address').value.trim();
    let password = document.getElementById('password').value.trim();
    let cpassword = document.getElementById('cpassword').value.trim();

    let nameRegex = /^[a-zA-Z ]{4,}$/;
    if (!nameRegex.test(fullname)) {
        showError('fullname', 'Full name must be at least 4 characters long and contain no special characters.');
        isValid = false;
    } else {
        clearError('fullname');
    }

    if (!email.includes('@')) {
        showError('email', 'Email must contain @.');
        isValid = false;
    } else {
        clearError('email');
    }

    let phoneRegex = /^[0-9]{10}$/;
    if (!phoneRegex.test(phone)) {
        showError('phone', 'Please enter a valid 10-digit phone number.');
        isValid = false;
    } else {
        clearError('phone');
    }

    let addressRegex = /^[a-zA-Z0-9 ]+$/;
    if (!addressRegex.test(address)) {
        showError('address', 'Address must not contain any special characters.');
        isValid = false;
    } else {
        clearError('address');
    }

    let passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;
    if (!passwordRegex.test(password)) {
        showError('password', 'Password must be at least 6 characters long, and include at least one uppercase letter, one number, and one special character.');
        isValid = false;
    } else {
        clearError('password');
    }

    if (password !== cpassword) {
        showError('cpassword', 'Password and Confirm Password do not match.');
        isValid = false;
    } else {
        clearError('cpassword');
    }

    return isValid;
}
</script>

<?php
if (isset($_POST['register'])) {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);

    // Server-side validation
    if (empty($fullname) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($cpassword)) {
        echo "<script>alert('All fields are required.');</script>";
    } elseif (!preg_match('/^[a-zA-Z ]{4,}$/', $fullname)) {
        echo "<script>alert('Full name must be at least 4 characters long and contain no special characters.');</script>";
    } elseif (strpos($email, '@') === false) {
        echo "<script>alert('Email must contain @.');</script>";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        echo "<script>alert('Invalid phone number.');</script>";
    } elseif (!preg_match('/^[a-zA-Z0-9 ]+$/', $address)) {
        echo "<script>alert('Address must not contain any special characters.');</script>";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/', $password)) {
        echo "<script>alert('Password must be at least 6 characters long, and include at least one uppercase letter, one number, and one special character.');</script>";
    } elseif ($password !== $cpassword) {
        echo "<script>alert('Password and Confirm Password do not match.');</script>";
    } else {
        $password = md5($password);
        $qry = "INSERT INTO users (fullname, email, phone, address, password) VALUES ('$fullname', '$email', '$phone', '$address', '$password')";

        include 'includes/dbconnection.php';
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>alert('User Registered successfully'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('User Registration Failed');</script>";
        }
        include 'includes/closeconnection.php';
    }
}
?>

<?php include 'includes/footer.php'; ?>
