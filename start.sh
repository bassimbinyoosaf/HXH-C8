#!/bin/bash
# HXH-C8 Hunter x Hunter CTF Challenge Launcher

PORT=${1:-3002}
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

echo "=========================================================="
echo "   ⚔️  HUNTER x HUNTER CTF CHALLENGE: HXH-C8  ⚔️"
echo "=========================================================="
echo "Starting local PHP development server..."
echo "Access the challenge at: http://127.0.0.1:$PORT"
echo "Press Ctrl+C to stop the server."
echo "=========================================================="

php -S 0.0.0.0:$PORT -t "$DIR" "$DIR/router.php"
