#!/usr/bin/env bash
set -Eeuo pipefail
while ! nc -z ${MAILHOG_HOST} ${MAILHOG_PORT} &> /dev/null; do
    sleep 1
done
