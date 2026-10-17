# HXH-C8 — Hunter × Hunter CTF Web Challenge

An anime-themed web exploitation CTF challenge featuring the **288th Hunter Exam Secret AI Terminal**.

## Challenge Synopsis
- Title: HXH-C8: Hunter Exam Secret AI Terminal
- Category: Web Exploitation / Client-Side Request Tampering
- Flag: `SSP{PRANKED_YOU_CA82F71E}`
- Theme: Hunter × Hunter

## Quick Start

### Standalone PHP
```bash
./start.sh 8080
```
Visit `http://127.0.0.1:8080`

### Docker Compose
```bash
docker-compose up -d --build
```
Access: `http://<SERVER_IP>:30008`

## Challenge Workflow
1. Explore multi-page portal
2. Discover chatbot endpoints via directory fuzzing (e.g. `/bot`, `/api/chat.php`)
3. Chatbot gives prank flags on asking for flag
4. Intercept `/api/chat.php` request and change `"hunter_license_verified": false` to `true`
5. Receive real flag: `SSP{PRANKED_YOU_CA82F71E}`

## Walkthrough
See `WALKTHROUGH C8.txt` for full details.
