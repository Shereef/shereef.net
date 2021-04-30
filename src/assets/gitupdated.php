<?php
try {
    echo "Running.";
    $command = 'cd /home/shereef.net/Shereef.net && git reset --hard && git pull --ff-only && npm i && npm run build && cp -fR dist/shereef /home/shereef.net/public_html && echo Done!';
    shell_exec('nohup sh -c"' . $command . '" > /dev/null &');
    echo "Ran.";
} catch ( Exception $e ) {
    $msg = $e->getMessage();
    echo $msg;
}