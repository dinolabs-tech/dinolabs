<?php
session_start();
include_once 'functions/payment_functions.php'; // Include the new payment functions
include_once 'db_connect.php'; // Ensure db_connect.php is included for $conn

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data safely
    $client_id = $conn->real_escape_string($_POST['client_id'] ?? '');
    $payment_amount = $conn->real_escape_string($_POST['payment_amount'] ?? '');
    $business_name = $conn->real_escape_string($_POST['business_name'] ?? '');
    $license_subscription = 'License Purchase'; // Default for license payments
    $flutterwave_transaction_id = $conn->real_escape_string($_POST['flutterwave_transaction_id'] ?? '');

    // Set session variables (optional, depending on further usage)
    $_SESSION['client_id'] = $client_id;
    $_SESSION['payment_amount'] = $payment_amount;

    // Fetch Flutterwave Secret Key
    $flutterwave_secret_key = getFlutterwaveSecretKey();

    if (!$flutterwave_secret_key) {
        error_log("Flutterwave Secret Key is not configured.");
        echo "Error: Payment gateway not configured.";
        $conn->close();
        exit();
    }

    if (empty($flutterwave_transaction_id)) {
        error_log("Flutterwave Transaction ID is missing for verification.");
        echo "Error: Transaction ID missing.";
        $conn->close();
        exit();
    }

    // Flutterwave Transaction Verification
    $curl = curl_init();
    $transaction_id_for_verification = urlencode($flutterwave_transaction_id);
    $verification_url = "https://api.flutterwave.com/v3/transactions/{$transaction_id_for_verification}/verify";

    curl_setopt_array($curl, array(
        CURLOPT_URL => $verification_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $flutterwave_secret_key
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        error_log("cURL Error #:" . $err);
        echo "Error: Payment verification failed.";
        $conn->close();
        exit();
    } else {
        $res = json_decode($response);

        if ($res->status === 'success') {
            $transaction_status = $res->data->status;
            $charged_amount = $res->data->charged_amount;
            $currency = $res->data->currency;
            $tx_ref = $res->data->tx_ref; // Can be used to match with local tx_ref if needed

            // Verify that the transaction is successful and the amount matches
            if ($transaction_status === 'successful' && $charged_amount == $payment_amount && $currency === 'NGN') {
                // Transaction is verified, save to database
                $sql = "INSERT INTO transactions (client_id, payment_amount, transaction_date, business_name, license_subscription, flutterwave_transaction_id)
                        VALUES ('$client_id', '$payment_amount', NOW(), '$business_name', '$license_subscription', '$flutterwave_transaction_id')";

                if ($conn->query($sql) === TRUE) {
                    echo "Transaction saved successfully!";
                } else {
                    error_log("Database Error: " . $conn->error);
                    echo "Error: Could not save transaction to database.";
                }
            } else {
                error_log("Flutterwave Verification Failed: Status: {$transaction_status}, Charged Amount: {$charged_amount}, Expected Amount: {$payment_amount}, Currency: {$currency}");
                echo "Error: Payment verification failed. Amount mismatch or unsuccessful status.";
            }
        } else {
            error_log("Flutterwave API Error: " . ($res->message ?? "Unknown error"));
            echo "Error: Payment verification failed with Flutterwave API.";
        }
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
