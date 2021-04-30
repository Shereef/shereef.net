#!/bin/sh
cd /home/shereef.net/Shereef.net
git reset --hard
git pull --rebase --ff-only
npm i && npm run build
echo Done!