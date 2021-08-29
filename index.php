<?php

require_once 'config/config.php';


$pt_holder = new PaytabsRequestHolder();

//

$cart_id = 'cart_12345';
$cart_desc = 'Black shirt (2), iPhone cover (1)';
$amount = 90;
$currency = 'AED';

$return_url = 'https://localhost/pt2/sample/result.php'; // Must be HTTPS, otherwise no post data from paytabs
$callback_url = null; // Must be public IP address, using HTTPS (try online service like: https://webhook.site)

//

$pt_holder
    ->set01PaymentCode('all') // ['card', 'stcpay', 'amex' ...]
    ->set02Transaction(PaytabsEnum::TRAN_TYPE_SALE, PaytabsEnum::TRAN_CLASS_ECOM)
    ->set03Cart($cart_id, $currency, $amount, $cart_desc)
    ->set04CustomerDetails('first last', 'test@temp.com', '0555555555', 'baha street', 'Dubai', 'Dubai', 'ARE', '12345', '10.10.10.10')
    ->set05ShippingDetails(true)
    ->set06HideShipping(false)
    ->set07URLs($return_url, $callback_url)
    ->set09Framed(false)
    ->set10Tokenise(true)
    ->set99PluginInfo('API', 0);


$pp_params = $pt_holder->pt_build();
$paypage = $pt_api->create_pay_page($pp_params);

if ($paypage->success) {
    echo 'Creating PayPage succeced <br>';
    echo "Click this link to go to payment page: <a href='{$paypage->payment_url}'>Payment Page</a>";
} else {
    echo 'Failed to create payment page <br>';
    var_dump($paypage);
}
