#!/usr/bin/env bash

export SYMFONY_ENV=dev
$(dirname $0)/../bin/symfony-console server:start 127.0.0.1:8002 \
    --router=src/App/Infrastructure/Ui/Http/Symfony/app.php \
    --docroot=src/App/Infrastructure/Ui/Http/Symfony/public \
    --force
