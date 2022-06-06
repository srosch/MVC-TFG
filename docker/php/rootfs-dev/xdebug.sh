#!/usr/bin/env bash
set -Eeuo pipefail
hostmachine_addresses=(
    'host.docker.internal'
    'hostmachine.docker'
    '10.254.254.254'
)
xdebug_remote_autostart=0
xdebug_remote_host="127.0.0.1"
for address in "${hostmachine_addresses[@]}"; do
    if ping -W 1 -c 1 "${address}" &> /dev/null; then
        xdebug_remote_autostart=1
        xdebug_remote_host="${address}"
        break
    fi
done
cat > /usr/local/etc/php/conf.d/xdebug.ini << __EOF__
#zend_extension=xdebug.so
xdebug.remote_enable=1
xdebug.remote_autostart=${xdebug_remote_autostart}
xdebug.remote_host=${xdebug_remote_host}
xdebug.profiler_enable=0
xdebug.profiler_enable_trigger=1
xdebug.idekey=docker
xdebug.profiler_output_dir=/app/xdebug/logs
__EOF__

