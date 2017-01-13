#!/usr/bin/env bash

export SYMFONY_ENV=dev
$(dirname $0)/../bin/symfony-console server:stop 127.0.0.1:8002
