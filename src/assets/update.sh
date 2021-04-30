#!/bin/sh
cd /home/shereef.net/Shereef.net
git reset --hard
git pull --rebase --ff-only
npm i && npm run build
chmod 775 -R /home/shereef.net/Shereef.net
chmod +x -R /home/shereef.net/Shereef.net
echo Done!