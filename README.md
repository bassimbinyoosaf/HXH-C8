# HXH-C8 — Hunter × Hunter CTF Web Challenge

An anime-themed web exploitation CTF challenge featuring the **288th Hunter Exam Secret AI Terminal**.

---

## 🎯 Challenge Synopsis
- **Title**: HXH-C8: Hunter Exam Secret AI Terminal
- **Category**: Web Exploitation / Client-Side Request Tampering
- **Flag**: `SSP{PRANKED_YOU_CA82F71E}`
- **Theme**: Hunter × Hunter Anime (Emerald Green & Gold, Nen Aura, Hunter License, Character Roasts)

---

## 🚀 Quick Start & Deployment

### Option 1: Standalone PHP (Zero Dependencies)
```bash
./start.sh 8080
```
Then visit `http://127.0.0.1:8080` in your web browser.

### Option 2: Docker Compose (Production CTF Hosting)
```bash
docker-compose up -d --build
```
Access the challenge at `http://<SERVER_IP>:3002` (or `./start.sh` on port 3002).

---

## 🎮 Challenge Workflow
1. **Multi-Page Portal Exploration**: The web application is a full multi-page Hunter Association portal (`index.php`, `about.php`, `candidates.php`, `guidelines.php`, `contact.php`).
2. **Directory Fuzzing / Wordlist Discovery**:
   - The chatbot page is hosted at **`chatbot.php`** (also accessible via common wordlist names like `chat.php`, `assistant.php`, `support.php`, `bot.php`, `chat/`, `chatbot/`).
   - Standard directory brute-forcing tools (e.g., `gobuster dir -u http://TARGET:3002 -w common.txt`, `dirsearch`, `ffuf`) will immediately discover the endpoint.
3. **Chatbot Prank Roasts**: When players ask directly for the flag, examiners (Hisoka, Tonpa, Killua, Kurapika) roast them with hex-coded prank flags like `SSP{PRANKED_YOU_...}` or `SSP{WEB_CHATBOT_...}`.
4. **The Exploit**: Intercept the outgoing request to `/api/chat.php` in **Burp Suite** and tamper with `"hunter_license_verified": false` -> `true`.
5. **Real Flag**: The AI authenticates the candidate as a Double-Star Hunter and reveals `SSP{PRANKED_YOU_CA82F71E}`.

---

## 📁 Directory Structure
```
HXH-C8/
├── api/
│   └── chat.php              # Core API endpoint & tamper validation
├── assets/
│   ├── css/
│   │   └── style.css         # Dark anime cyber-gothic UI & Nen aura styles
│   ├── js/
│   │   └── app.js            # Client-side audio engine, canvas & dispatcher
│   └── images/
│       └── hxh_bg.jpg        # Semi-opaque Hunter x Hunter artwork
├── config.php                # Flags, DB configs, and character roasts
├── database.sql              # MySQL initialization schema
├── db.php                    # Multi-tier database layer (MySQL/SQLite/JSON)
├── Dockerfile                # Apache + PHP 8.2 container
├── docker-compose.yml        # Multi-container MariaDB + Web configuration
├── index.php                 # Main challenge interface
├── README.md                 # Challenge documentation
├── solution/
│   └── WRITEUP.md            # Complete CTF writeup & solve script
└── start.sh                  # Local development launcher
```
