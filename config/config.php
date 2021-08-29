<?php

require_once 'paytabs_core.php';

//

$pt_region = 'ARE';
$pt_profile_id = 47000;
$pt_server_key = 'S2JNLKKWJR-xxxxxxxxxx-HZNMBN9TNG';

//

$pt_api = PaytabsApi::getInstance($pt_region, $pt_profile_id, $pt_server_key);
