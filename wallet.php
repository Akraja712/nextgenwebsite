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

// Set the timezone to your local timezone
date_default_timezone_set('Asia/Kolkata');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT name, mobile, balance, withdrawal_status, bank, ifsc, holder_name, account_num FROM users WHERE id='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $mobile = $row['mobile'];
        $balance = $row['balance'];
        $withdrawal_status = $row['withdrawal_status'];
        $bank = $row['bank'];
        $ifsc = $row['ifsc'];
        $holder_name = $row['holder_name'];
        $account_num = $row['account_num'];
    }
} else {
    header("Location: login.php");
    exit();
}

$withdrawal_records = array();
$sql_withdrawals = "SELECT amount, datetime, status FROM withdrawals WHERE user_id='$user_id'";
$result_withdrawals = $conn->query($sql_withdrawals);
if ($result_withdrawals->num_rows > 0) {
    while ($row_withdrawal = $result_withdrawals->fetch_assoc()) {
        $withdrawal_records[] = $row_withdrawal;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $withdrawal_amount = $_POST['withdrawal_amount'];

    // Check if the withdrawal status is 1 and withdrawal amount is greater than or equal to 250
    if ($withdrawal_status == 1 && $withdrawal_amount >= 250 && $withdrawal_amount <= $balance) {
        // Check if bank details are updated
        if ($bank && $ifsc && $holder_name && $account_num) {
            // Proceed with the withdrawal process
            $conn->begin_transaction();

            $datetime = date('Y-m-d H:i:s');

            $update_balance_sql = "UPDATE users SET balance = balance - $withdrawal_amount WHERE id = $user_id";

            if ($conn->query($update_balance_sql) === TRUE) {
                $insert_withdrawal_sql = "INSERT INTO withdrawals (user_id, amount, status) VALUES ('$user_id', '$withdrawal_amount', '0')";

                if ($conn->query($insert_withdrawal_sql) === TRUE) {
                    $insert_transaction_sql = "INSERT INTO transactions (user_id, type, datetime, amount) VALUES ('$user_id', 'withdrawal', '$datetime', '$withdrawal_amount')";

                    if ($conn->query($insert_transaction_sql) === TRUE) {
                        $conn->commit();
                        header("Location: wallet.php");
                        exit();
                    } else {
                        $conn->rollback();
                        echo "Error inserting transaction: " . $conn->error;
                    }
                } else {
                    $conn->rollback();
                    echo "Error inserting withdrawal: " . $conn->error;
                }
            } else {
                $conn->rollback();
                echo "Error updating balance: " . $conn->error;
            }
        } else {
            echo "<script>alert('Please update your bank details before making a withdrawal.');</script>";
        }
    } elseif ($withdrawal_status == 0) {
        echo "<script>alert('Your withdrawal is disabled. Please contact the admin.');</script>";
    } elseif ($withdrawal_amount < 250) {
        echo "<script>alert('Withdrawal amount should be at least 250.');</script>";
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
   
    <h4>Main Balance</h4>
    <div class="row justify-content-center">
        <div class="col-md-5 col-12 mb-3">
        <div class="p-2 text-center" style="height:40px; color:black;">
            <?php if(isset($balance)): ?>     
                <p style="color:black; font-weight: bold;">₹<?php echo $balance; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <br>
    <h5>Withdrawal amount</h5>
    <form id="withdrawalForm" action="#" method="post">
    <div class="form-group row justify-content-center">
    <div class="col-md-8 col-12">
        <input id="withdrawalAmount" style="background-color:white;height:60px;border-radius:10px; margin-left:10px; text-align: center; color: black; font-weight: bold;" type="number" class="form-control" name="withdrawal_amount" placeholder="Enter amount">
        <?php if($balance == 0): ?>
                    <p style="color: red;">Your Balance is 0</p>
                <?php endif; ?>  
    </div>
</div>
<div class="form-group row justify-content-center">
            <div class="col-md-6 col-12 mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Withdraw</button>
            </div>
        </div>
    </form>
    <h5>Withdrawal Record</h5>
    <div class="row justify-content-center">
        <div class="col-md-10 col-12 mb-3">
            <?php
            foreach ($withdrawal_records as $record) {
                echo '<div class="card p-2 text-center mb-3" style="background-color:white; border-radius:20px;">';
                echo '<table class="table table-borderless">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" class="text-black font-weight-bold">Amount</th>';
                echo '<th scope="col" class="text-black font-weight-bold">Time</th>';
                echo '<th scope="col" class="text-black font-weight-bold">Status</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td class="text-black">' . $record['amount'] . '</td>'; 
                echo '<td class="text-black" style="white-space: nowrap;">' . $record['datetime'] . '</td>'; 
                echo '<td>';
                if ($record['status'] == 1) {
                    echo "<span class='text-success'>Completed</span>"; 
                } else {
                    echo "<span class='text-primary'>Pending</span>"; 
                }
                echo '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>


<script>
    document.getElementById('withdrawalForm').addEventListener('submit', function(event) {
        var withdrawalAmount = document.getElementById('withdrawalAmount').value;
        if (withdrawalAmount < 250) {
            alert('Withdrawal amount should be at least 250.');
            event.preventDefault(); // Prevent form submission if amount is less than 250
        }
    });
</script>
</body>
</html>

