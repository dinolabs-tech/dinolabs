<?php
function encryptString($input, $key, $iv) {
    // Make sure the key and iv lengths are correct
    $key = substr($key, 0, 24); // 24 bytes = 192 bits
    $iv = substr($iv, 0, 16);   // 16 bytes = 128 bits

    // Encrypt using AES-192-CBC
    $encrypted = openssl_encrypt($input, 'aes-192-cbc', $key, OPENSSL_RAW_DATA, $iv);

    // Encode as Base64 to match VB.NET output
    return base64_encode($encrypted);
}

// Example usage
$key = "abcdefghijklmnopqrstuvwx";
$iv = "1234567890123456";

$subdate = $_POST['subdate'] ?? '2025-05-18';
$txtcapacity = $_POST['txtcapacity'] ?? '200';
$txtpackage = $_POST['txtpackage'] ?? 'Premium';
$enddate_raw = $_POST['enddate'];
$enddate = date('m/d/Y', strtotime($enddate_raw));

$combinedString = $enddate . '|' . $txtcapacity . '|' . $txtpackage;

$encryptedText = encryptString($combinedString, $key, $iv);
echo "Encrypted Text: " . $encryptedText;
?>
