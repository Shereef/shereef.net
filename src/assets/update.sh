#!/bin/sh
cd /home/shereef.net/Shereef.net
git pull --rebase --ff-only
npm i && npm run build
echo Done!