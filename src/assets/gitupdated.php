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
    passthru('cd /home/shereef.net/Shereef.net && git reset --hard && git pull --ff-only && npm i && npm run build && echo Done!');
    $output = ob_end_contents();
    //echo $output;
    return true;

}

try {
    echo "Running.";
    run();
    echo "Ran.";
} catch ( Exception $e ) {
    $msg = $e->getMessage();
    mail($error_mail, $msg, ''.$e);
    echo $msg;
}