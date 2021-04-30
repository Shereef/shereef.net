<?php

/*
 * Endpoint for Github Webhook URLs
 *
 * see: https://help.github.com/articles/post-receive-hooks
 *
 */

// script errors will be send to this email:
$error_mail = "admin@shereef.net";

function run() {
    // execute update script, and record its output
    ob_start();
    passthru('update.sh');
    $output = ob_end_contents();
    //echo $output;
    return true;

}

try {
    if (!isset($_POST['payload'])) {
        echo "Works fine.";
    } else {
        echo "Running.";
        run();
        echo "Ran.";
    }
} catch ( Exception $e ) {
    $msg = $e->getMessage();
    mail($error_mail, $msg, ''.$e);
    echo $msg;
}