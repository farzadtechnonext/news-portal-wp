#!/bin/bash
set -e

# Runs in the background: waits until WordPress core has been copied on first
# start, then makes sure Apache (www-data) can read and write wp-content.
fix_perms() {
  for i in $(seq 1 120); do
    [ -f /var/www/html/wp-includes/version.php ] && break
    sleep 1
  done
  chown -R www-data:www-data /var/www/html/wp-content 2>/dev/null || true
  chmod -R u+rwX,g+rwX,o+rX /var/www/html/wp-content 2>/dev/null || true
}

if [ "$(id -u)" = "0" ]; then
  fix_perms &
fi

# Hand over to the official WordPress entrypoint
exec docker-entrypoint.sh "$@"
