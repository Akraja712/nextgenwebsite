<?php
session_start();


$servername = "localhost";
$username = "u152146582_nextgencareer";
$password = "Nextgen@2023";
$database = "u152146582_nextgencareer";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['mobile'])) {
    $_SESSION['mobile'] = $_GET['mobile'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($mobile) && !empty($password)) {
        $sql_query = "SELECT id ,referred_by FROM users WHERE mobile='$mobile'";
        $result = $conn->query($sql_query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];
            $referred_by = $row['referred_by'];
            if ($referred_by == "ABCD" || $referred_by == "NextGen" || $referred_by == "AMAIL" || $referred_by == "UNLIMITED" || $referred_by == "CHAMPION") {
                if ($mobile == $password) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['referred_by'] = $referred_by;
                    $_SESSION['mobile'] = $mobile; // Store mobile number in session
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Mobile number and password do not match";
                }
            } else {
                $sql_query = "SELECT * FROM users WHERE mobile='$mobile' AND password='$password'";
                $result = $conn->query($sql_query);

                if ($result->num_rows > 0) {
                    $_SESSION['loggedin'] = true;
                    // Fetch the user_id from the result
                    $row = $result->fetch_assoc();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['referred_by'] = $referred_by;
                    $_SESSION['mobile'] = $mobile; // Store mobile number in session
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Invalid mobile number or password";
                }
            }
        } else {
            $error = "Mobile number not registered";
        }
    } else {
        $error = "Please provide mobile number and password";
    }
    echo "<script>alert('$error');</script>";
}

// Ensure $conn is available for subsequent queries
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT name, mobile FROM users WHERE id='$user_id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $mobile = $row['mobile'];
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
         input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6f5de5, #7497f3, #62d2e8);
            height: 100vh;
        }
        .container {
            background-color: white;
            max-width: 400px; 
        }
        .custom-border {
            border: 2px solid #9de45f;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="container custom-border">
            <h2 class="text-center mb-4">Login</h2>
            <form method="post" action="#" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="mobile">Phone number:</label>
                    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="text-center mb-3">
    <a onclick="redirectToForgotPassword()" class="text-primary" id="forgotPasswordLink">Forgot Password?</a>
</div>

                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-custom w-100">Login</button>
                    </div>
                    <div class="col-6">
                        <a href="register.php" class="btn btn-success btn-custom w-100">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    function redirectToForgotPassword() {
        var mobile = document.getElementById('mobile').value;
        var redirectURL = "forgot_password.php?mobile=" + mobile;
        window.location.href = redirectURL;
    }
</script>

</body>
</html>

