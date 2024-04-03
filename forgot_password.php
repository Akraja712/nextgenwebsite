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
    $mobile = isset($_SESSION['mobile']) ? $_SESSION['mobile'] : '';

        if(isset($_POST['password'])) {
            $password = $_POST['password'];

            $sql = "UPDATE users SET password='$password' WHERE mobile='$mobile'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Password updated successfully');</script>";
            } else {
                echo "<script>alert('Error updating password: " . $conn->error . "');</script>";
            }
            
        } else {
            echo "Password not provided";
        }
    } 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password Page</title>
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
            .btn-customs {
            width: 100%;
            border-radius: 15px;
            margin-top:6px;
           
        }
     
        }

    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="custom-container">
            <h2 class="text-center">Forgot Password</h2>
            <br>
            <form id="forgotpassword" method="post" action="#" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="mobile">Phone Number:</label>
                    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" value="<?php echo isset($_SESSION['mobile']) ? $_SESSION['mobile'] : ''; ?>" <?php echo isset($_SESSION['mobile']) ? 'readonly' : ''; ?>>

                </div>
                <label for="otp">OTP:</label>
                <div class="row">
                    <div class="col-md-12  d-flex justify-content-start justify-content-md-between">
                        <div class="form-group">
                            <input type="number" class="form-control" id="otp" name="otp" placeholder="Enter OTP" required>
                        </div>
                         <div class="form-group col-6 mt-0 mt-md-0">
                          <button id="send" class="btn btn-primary btn-block" style="white-space: nowrap;">Get OTP</button>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-custom">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var otpSent = false; // Flag to track whether OTP has been sent
        var sentOTP; // Variable to store the OTP sent by the server

        $('#send').click(function(e) {
            e.preventDefault();
            var mobile = $('#mobile').val();

            if (mobile.trim() === '') {
                alert('Please enter your Phone number.');
                return;
            }

            $.ajax({
                type: 'POST',
                url: 'check_mobile.php',
                data: { mobile: mobile },
                success: function(response) {
                    if (response === 'registered') {
                        alert('Mobile number is already registered. Please use a different mobile number.');
                        $('#mobile').prop('disabled', false); // Enable the mobile input
                    } else {
                        if (!otpSent) { // Check if OTP has not been sent already
                            // Generate a random OTP
                            var otp = Math.floor(100000 + Math.random() * 900000);
                            sentOTP = otp; // Store the OTP sent by the server

                            // Make AJAX call to the API endpoint to send OTP
                            $.ajax({
                                type: 'GET',
                                url: 'https://api.authkey.io/request',
                                data: {
                                    authkey: 'b45c58db6d261f2a',
                                    mobile: mobile,
                                    country_code: '91',
                                    sid: '9214',
                                    otp: otp,
                                    company: 'Next gen'
                                },
                                success: function() {
                                    alert('OTP sent successfully to ' + mobile);
                                    otpSent = true; 
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                        $('#mobile').prop('readonly', true);
                        $('#send').text('Verify').addClass('btn-success').removeClass('btn-primary').prop('disabled', false);
                        $('#send').attr('id', 'verify');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).on('click', '#verify', function(e) {
            e.preventDefault();
            var otp = $('#otp').val();
            if (otp.trim() === '') {
                alert('Please enter the OTP.');
            } else {
                // Verify OTP
                var enteredOTP = parseInt(otp, 10);
                if (enteredOTP === sentOTP) {
                    alert('OTP verified successfully.');
                   
                } else {
                    alert('Invalid OTP. Please try again.');
                }
            }
        });
    });
</script>


</body>
</html>
