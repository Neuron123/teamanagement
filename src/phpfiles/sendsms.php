<?php

function sendSMS($message, $phoneNumber, $serviceID = 1) {
    // Bongasms API endpoint
    $url = 'http://167.172.14.50:4002/v1/send-sms';

    // Bongasms API credentials
    $apiClientID = '144';
    $key = 'HYLkgX8k0O3bpV2';
    $secret = 'psBcEDXFsACiU4B2F6JvBUXAlswgcc';

    // Prepare the request data
    $data = array(
        'apiClientID' => $apiClientID,
        'key' => $key,
        'secret' => $secret,
        'txtMessage' => $message,
        'MSISDN' => $phoneNumber,
        'serviceID' => $serviceID,
    );

    // Send the POST request to Bongasms API
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        return 'Error: ' . curl_error($ch);
    } else {
        // Decode the JSON response
        $responseData = json_decode($response, true);

        // Check the status of the request
        if ($responseData['status'] === 222) {
            return 'SMS sent successfully. Unique ID: ' . $responseData['unique_id'];
        } else {
            return 'Failed to send SMS. Error: ' . $responseData['status_message'];
        }
    }

    // Close the curl session
    curl_close($ch);
}

// sendSMS("hi, there","0708584227");
?>
