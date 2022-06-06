#!/usr/bin/env bash
set -Eeuo pipefail
while ! nc -z ${MONGO_HOST} ${MONGO_PORT} &> /dev/null; do
    sleep 1
done