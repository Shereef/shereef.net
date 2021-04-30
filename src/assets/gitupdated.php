<?php
exec('nohup "cd /home/shereef.net/Shereef.net && git pull && npm i && npm run build" > /dev/null 2>/dev/null &');
echo '{"executed":true}';
?>
