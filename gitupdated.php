<?php
echo '<pre>';
passthru ('cd /home/shereef.net/Shereef.net && git pull && npm i && npm run build && cp gitupdated.php /home/shereef.net/public_html/gitupdated.php');
echo '</pre>';
?>
