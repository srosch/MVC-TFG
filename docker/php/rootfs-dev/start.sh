#!/usr/bin/env bash
set -Eeuo pipefail
/xdebug.sh
exec apache2-foreground
