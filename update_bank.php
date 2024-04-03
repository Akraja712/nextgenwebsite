<?php
session_start(); // Start the session if not already started
$servername = "localhost";
$username = "u152146582_nextgencareer";
$password = "Nextgen@2023";
$database = "u152146582_nextgencareer";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alert_message = ""; // Initialize alert message variable

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $user_id = $_SESSION['user_id'];
    
    // Fetch user details from the database using user_id
    $sql = "SELECT holder_name, account_num, ifsc,bank FROM users WHERE id='$user_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $holder_name = $row['holder_name'];
        $account_num = $row['account_num'];
        $ifsc = $row['ifsc'];
        $bank = $row['bank'];

    }
} else {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $holder_name = $_POST['holder_name'];
    $account_num = $_POST['account_num'];
    $ifsc = $_POST['ifsc'];
    $bank = $_POST['bank'];
   
    
    // Update bank details in the database
    $update_sql = "UPDATE users SET holder_name='$holder_name', account_num='$account_num', ifsc='$ifsc', bank='$bank' WHERE id='$user_id'";
    
    if ($conn->query($update_sql) === TRUE) {
        $alert_message = "Bank details updated successfully.";
    } else {
        $alert_message = "Error updating bank details: " . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Bank</title>
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
        }
        .header-container {
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
}

.header {
    display: flex;
    align-items: center; /* Center vertically */
}

.icon {
    margin-right: 80px; /* Adjust margin as needed */
}

.text-center {
    margin-right:65px; /* Remove default margin */
}

        .custom-container {
            width: 450px; 
            margin: 0 auto;
            padding: 40px;
            border: 2px solid #9de45f;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
            background: rgb(255, 255, 255);
        }
        .btn-custom {
            width: 100%;
            margin-top:25px;
            border-radius: 15px;
        }
        .btn-customs {
            width: 100%;
            border-radius: 15px;
           
        }
        @media (max-width: 576px) {
            .nowrap-mobile {
                white-space: nowrap;
                font-size: 10px;
            }
            .text-center {
    margin-right:70px; /* Remove default margin */
    font-size: 18px;
    white-space: nowrap;

}
        }

    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="custom-container">
        <div class="header-container">
    <div class="header">
        <div class="icon">
            <a href="profile.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
            </a>
        </div>
        <h2 class="text-center">Update Bank</h2>
    </div>
</div>
<br>
            <form method="post" action="update_bank.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Holder Name:</label>
                    <input type="text" class="form-control" id="holder_name" name="holder_name" placeholder="Holder Name"  value="<?php echo isset($holder_name) ? $holder_name : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="number">Account Number:</label>
                    <input type="number" class="form-control" id="account_num" name="account_num" placeholder="Account Number"  value="<?php echo isset($account_num) ? $account_num : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="ifsc">IFSC Code:</label>
                    <input type="text" class="form-control" id="ifsc" name="ifsc" placeholder="IFSC Code"  value="<?php echo isset($ifsc) ? $ifsc : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="bank">Bank Name:</label>
                    <input type="text" class="form-control" id="bank" name="bank" placeholder="Bank Name" value="<?php echo isset($bank) ? $bank : ''; ?>"  required>
                </div>
              
                <center>
                <div class="row">
                        <button type="submit" class="btn btn-primary btn-custom">Update</button>
                    </div>
                    </center>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for displaying alert message -->
    <script>
        // Check if the alert message is not empty
        <?php if(!empty($alert_message)): ?>
            // Display the alert message
            alert("<?php echo $alert_message; ?>");
        <?php endif; ?>
    </script>
</body>
</html>
