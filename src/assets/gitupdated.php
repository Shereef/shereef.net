<?php
exec('cd /home/shereef.net/Shereef.net && git pull && npm i && npm run build');
echo '{"executed":true}';
?>
