<?php

require_once 'config/config.php';

//

$response_data = $_POST;

$transRef = filter_input(INPUT_POST, 'tranRef');
if (!$transRef) die('Transaction reference is not set');

//

echo "<h2> Transaction reference: <b>{$transRef}</b> </h2>";


/** Verify PayTabs response: Option 1 */

echo "<h3>Local Payment validation</h3>";

$is_valid = $pt_api->is_valid_redirect($response_data);

if (!$is_valid) {
    die('Not a valid PayTabs response');
}

//

$is_success = $response_data['respStatus'] === 'A';
pt_echo_result($is_success, $response_data['respMessage']);


/** Verify PayTabs response: Option 2 */

echo "<h3>Remote Payment validation</h3>";

$verify_result = $pt_api->verify_payment($transRef);
pt_echo_result($verify_result->success, $verify_result->message);


//

echo "<hr> Return to <a href='index.php'> the main </a> page";

function pt_echo_result($success, $message = null)
{
    if ($success) {
        echo 'Payment succeed <br>';
    } else {
        echo 'Payment failed <br>';
    }
    if ($message) {
        echo "Response message: <strong> {$message} </strong> <br>";
    }
}
