<?php
require_once 'config/config.php';

$is_validation_req = false;
$response_str = filter_input(INPUT_POST, 'response_str');
$response_signature = filter_input(INPUT_POST, 'response_signature');
$server_key = filter_input(INPUT_POST, 'server_key') ?? false;

if ($response_str && $response_signature) {
    $is_valid_signature = $pt_api->is_valid_ipn($response_str, $response_signature, $server_key);
    $is_validation_req = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature validation tool</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Signature validation Tool</h2>

        <form action="" method="post" class="form">
            <div class="mb-3">
                <label for="response_str" class="form-label">Response String</label>
                <textarea name="response_str" id="response_str" class="form-control"><?= $response_str ?></textarea>
            </div>

            <div class="mb-3">
                <label for="response_signature" class="form-label">Response Signature</label>
                <input type="text" name="response_signature" id="response_signature" class="form-control" value="<?= $response_signature ?>" />
            </div>

            <div class="mb-3">
                <label for="server_key" class="form-label">Server Key</label>
                <input type="text" name="server_key" id="server_key" class="form-control" value="<?= $server_key ?>" />
            </div>

            <?php
            if ($is_validation_req) :
            ?>
                <div class="alert alert-secondary" role="alert">
                    Data:
                    <p><?= $response_str ?></p>
                    Signature:
                    <p><?= $response_signature ?></p>
                </div>
                <?php
                if ($is_valid_signature) :
                ?>
                    <div class="alert alert-success" role="alert">
                        Valid Signature
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        Invalid Signature

                        <p>
                        <b>Calculated signature:</b>
                        <?= $pt_api->calc_signature($response_str, $server_key) ?></p>
                    </div>
            <?php
                endif;
            endif;
            ?>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>