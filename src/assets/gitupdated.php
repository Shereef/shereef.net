<?php
try {
    echo "Running.\r\n<br />";
    $command = 'cd /home/shereef.net/Shereef.net && git reset --hard && git pull --ff-only && npm i && npm run build && cp -fR dist/shereef/* /home/shereef.net/public_html --verbose && echo Done!';
    shell_exec('nohup sh -c"' . $command . '" > $(date +"%F")$(date +"%T").log &');
    echo "Ran.\r\n<br />";
} catch ( Exception $e ) {
    $msg = $e->getMessage();
    echo $msg;
}