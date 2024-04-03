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

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT name, mobile, balance FROM users WHERE id='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $mobile = $row['mobile'];
        $balance = $row['balance'];
    }
} else {
    header("Location: login.php");
    exit();
}

$transaction_records = array();
$sql_transaction = "SELECT amount, datetime, type FROM transactions WHERE user_id='$user_id'";
$result_transaction = $conn->query($sql_transaction);
if ($result_transaction->num_rows > 0) {
    while ($row_transaction = $result_transaction->fetch_assoc()) {
        $transaction_records[] = $row_transaction;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
         /* Hide the spinner */
         input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }
       
       body {
            font-family: Arial, sans-serif;
            background: linear-gradient(
                to right,
                #6f5de5,
                #7497f3,
                #62d2e8
            );
        }
        .container {
            background:white;
            max-width: 600px;
            height: auto;
            margin: 0 auto;
            padding:55px;
            border: 2px solid #9de45f;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h4 {
            text-align: center;
            color:black;
            font-size:20px;
            font-weight: bold;
        }
        .container h5 {
            margin-left: 60px;
            color:black;
            font-weight: bold;
        }
        .container th,
        .container td {
            font-size: 15px; 
        }
        @media (max-width: 767.98px) {
        .table td, .table th {
            padding: 0.5rem; 
            font-size: 11px;
        }
        .container h4 {
            text-align: center;
            color:black;
            font-size:14px;
            font-weight: bold;
        }
        .container h5 {
            margin-left: 10px;
            color:black;
            font-weight: bold;
            font-size:14px;
        }
    }
    </style>
</head>
<body>
<div class="container">

   
    <h5>Transaction Record :</h5>
    <div class="row justify-content-center">
        <div class="col-md-10 col-12 mb-3">
            <?php
            foreach ($transaction_records as $record) {
                echo '<div class="card p-2 text-center mb-3" style="background-color:white; border-radius:20px;">';
                echo '<table class="table table-borderless">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" class="text-black font-weight-bold">Amount</th>';
                echo '<th scope="col" class="text-black font-weight-bold">DateTime</th>';
                echo '<th scope="col" class="text-black font-weight-bold">Type</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td class="text-black">' . $record['amount'] . '</td>'; 
                echo '<td class="text-black" style="white-space: nowrap;">' . $record['datetime'] . '</td>';
                echo '<td class="text-black">' . $record['type'] . '</td>';  
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

</div>
</body>
</html>


