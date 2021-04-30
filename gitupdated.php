<?php
exec('nohup cd /home/shereef.net/Shereef.net && git pull && npm i && npm run build && cp gitupdated.php /home/shereef.net/public_html/gitupdated.php > /dev/null 2>/dev/null &');
echo '{"executed":true}';
?>
