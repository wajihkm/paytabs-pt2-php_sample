<?php

require_once 'config/config.php';

$tran_prev = $_GET['tran'];

$pt_holder = new PaytabsTokenHolder();

//


$cart_id = 'cart_22222';
$cart_desc = 'Black shirt (2), iPhone cover (1)';
$amount = 90;
$currency = 'AED';

//

$pt_holder
    ->set20Token($tran_prev)
    ->set02Transaction(PaytabsEnum::TRAN_TYPE_SALE, PaytabsEnum::TRAN_CLASS_RECURRING)
    ->set03Cart($cart_id, $currency, $amount, $cart_desc)
    ->set99PluginInfo('API', 0);


$pp_params = $pt_holder->pt_build();
$paypage = $pt_api->create_pay_page($pp_params);

if ($paypage->success) {
    echo 'Recurring Payment succeced <br>';
} else {
    echo '<b style="color: red">Failed</b><br>';
}
var_dump($paypage);
