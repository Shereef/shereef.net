<?php
try {
    echo "Running.\r\n<br />";
    $command = 'cd /home/shereef.net/Shereef.net && git reset --hard && git pull --ff-only && npm i && npm run build && rm -vfR /home/shereef.net/public_html/* && cp -fR dist/shereef/* /home/shereef.net/public_html --verbose && cd /home/shereef.net/public_html && git clone git@github.com-shereef.net-pizzaday:Shereef/PizzaDay.git && echo Done!';
    shell_exec('nohup sh -c "' . $command . '" > /home/shereef.net/logs/deployments/$(date +"%F")$(date +"%T").log &');
    echo "Ran.\r\n<br />";
} catch ( Exception $e ) {
    $msg = $e->getMessage();
    echo $msg;
}
