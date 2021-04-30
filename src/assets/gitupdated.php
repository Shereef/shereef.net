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
    global $rawInput;

    $postBody = $_POST['payload'];
    $payload = json_decode($postBody);

    $headers = 'From: yourserver@shereef.net\r\n';
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // check if the push came from the right repository and branch
    if ($payload->repository->url == 'https://github.com/Shereef/Shereef.net'
        && $payload->ref == 'refs/heads/master') {

        // execute update script, and record its output
        ob_start();
        passthru('update.sh');
        $output = ob_end_contents();

        // prepare and send the notification email
        // send mail to someone, and the github user who pushed the commit
        $body = '<p>The Github user <a href="https://github.com/'
        . $payload->pusher->name .'">@' . $payload->pusher->name . '</a>'
        . ' has pushed to ' . $payload->repository->url
        . ' and consequently, something has been changed on the server'
        . '.</p>';

        $body .= '<p>Here\'s a brief list of what has been changed:</p>';
        $body .= '<ul>';
        foreach ($payload->commits as $commit) {
            $body .= '<li>'.$commit->message.'<br />';
            $body .= '<small style="color:#999">added: <b>'.count($commit->added)
                .'</b> &nbsp; modified: <b>'.count($commit->modified)
                .'</b> &nbsp; removed: <b>'.count($commit->removed)
                .'</b> &nbsp; <a href="' . $commit->url
                . '">read more</a></small></li>';
        }
        $body .= '</ul>';
        $body .= '<p>What follows is the output of the script:</p><pre>';
        $body .= $output. '</pre>';
        $body .= '<p>Cheers, <br/>Github Webhook Endpoint</p>';

        mail('yourservertoyou@shereef.net', 'something has been changed on the server', $body, $headers);
        return true;
    }

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