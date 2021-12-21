#!/bin/bash
git pull
./sail-prod up -d --build
./sail-prod artisan migrate --force
