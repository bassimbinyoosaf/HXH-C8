/**
 * HXH-C8 Hunter Exam AI Terminal Client Logic
 * Handles Nen particle effects, audio synthesis, chat stream, and API dispatch
 */

document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const messagesContainer = document.getElementById('chat-messages');
    const licenseStatusBadge = document.getElementById('license-status-badge');
    const candidateNameEl = document.getElementById('candidate-name');
    const nenTypeEl = document.getElementById('candidate-nen');
    const audioToggleBtn = document.getElementById('btn-audio-toggle');
    const rulesModalBtn = document.getElementById('btn-rules-modal');
    const rulesModal = document.getElementById('rules-modal');
    const victoryModal = document.getElementById('victory-modal');
    const closeRulesBtn = document.getElementById('btn-close-rules');
    const closeVictoryBtn = document.getElementById('btn-close-victory');
    const victoryFlagEl = document.getElementById('victory-flag-text');
    const copyVictoryFlagBtn = document.getElementById('btn-copy-victory-flag');
    const promptChips = document.querySelectorAll('.prompt-chip');
    const nenChips = document.querySelectorAll('.nen-chip');

    // Audio state
    let audioEnabled = true;
    let audioCtx = null;

    function getAudioContext() {
        if (!audioCtx) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            audioCtx = new AudioContext();
        }
        if (audioCtx.state === 'suspended') {
            audioCtx.resume();
        }
        return audioCtx;
    }

    // Synthesized Sound Effects
    function playSfx(type) {
        if (!audioEnabled) return;
        try {
            const ctx = getAudioContext();
            const now = ctx.currentTime;

            if (type === 'send') {
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(440, now);
                osc.frequency.exponentialRampToValueAtTime(880, now + 0.12);
                gain.gain.setValueAtTime(0.15, now);
                gain.gain.exponentialRampToValueAtTime(0.01, now + 0.12);
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start(now);
                osc.stop(now + 0.12);
            } else if (type === 'reply') {
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(600, now);
                osc.frequency.exponentialRampToValueAtTime(300, now + 0.18);
                gain.gain.setValueAtTime(0.18, now);
                gain.gain.exponentialRampToValueAtTime(0.01, now + 0.18);
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start(now);
                osc.stop(now + 0.18);
            } else if (type === 'troll') {
                // Sarcastic buzzer sound
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.type = 'sawtooth';
                osc.frequency.setValueAtTime(180, now);
                osc.frequency.setValueAtTime(130, now + 0.15);
                gain.gain.setValueAtTime(0.2, now);
                gain.gain.exponentialRampToValueAtTime(0.01, now + 0.35);
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start(now);
                osc.stop(now + 0.35);
            } else if (type === 'victory') {
                // Nen triumph fanfare chords
                const freqs = [523.25, 659.25, 783.99, 1046.50]; // C5, E5, G5, C6
                freqs.forEach((freq, idx) => {
                    const osc = ctx.createOscillator();
                    const gain = ctx.createGain();
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, now + idx * 0.1);
                    gain.gain.setValueAtTime(0.25, now + idx * 0.1);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + idx * 0.1 + 0.6);
                    osc.connect(gain);
                    gain.connect(ctx.destination);
                    osc.start(now + idx * 0.1);
                    osc.stop(now + idx * 0.1 + 0.6);
                });
            }
        } catch (e) {
            // Audio context policy fallback
        }
    }

    // Audio Toggle Handler (if button present)
    if (audioToggleBtn) {
        audioToggleBtn.addEventListener('click', () => {
            audioEnabled = !audioEnabled;
            audioToggleBtn.innerHTML = audioEnabled ? '🔊 Sound: ON' : '🔇 Sound: OFF';
            if (audioEnabled) {
                getAudioContext();
                playSfx('send');
            }
        });
    }

    // Nen Category Selection
    nenChips.forEach(chip => {
        chip.addEventListener('click', () => {
            nenChips.forEach(c => c.classList.remove('active'));
            chip.classList.add('active');
            const type = chip.dataset.type;
            nenTypeEl.textContent = type;
            playSfx('send');
        });
    });

    // Quick Prompts Click
    promptChips.forEach(chip => {
        chip.addEventListener('click', () => {
            chatInput.value = chip.dataset.prompt;
            chatInput.focus();
            playSfx('send');
        });
    });

    // Modal Handlers
    rulesModalBtn.addEventListener('click', () => {
        rulesModal.classList.add('active');
        playSfx('send');
    });
    closeRulesBtn.addEventListener('click', () => {
        rulesModal.classList.remove('active');
    });
    rulesModal.addEventListener('click', (e) => {
        if (e.target === rulesModal) rulesModal.classList.remove('active');
    });

    closeVictoryBtn.addEventListener('click', () => {
        victoryModal.classList.remove('active');
    });
    victoryModal.addEventListener('click', (e) => {
        if (e.target === victoryModal) victoryModal.classList.remove('active');
    });

    copyVictoryFlagBtn.addEventListener('click', () => {
        const flagText = victoryFlagEl.textContent.trim();
        navigator.clipboard.writeText(flagText).then(() => {
            copyVictoryFlagBtn.textContent = '✅ Copied!';
            setTimeout(() => {
                copyVictoryFlagBtn.textContent = '📋 Copy Flag';
            }, 2500);
        });
    });

    // Scroll to bottom of chat
    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Append User Message to UI
    function appendUserMessage(text) {
        const row = document.createElement('div');
        row.className = 'message-row user';
        row.innerHTML = `
            <div class="message-avatar">👤</div>
            <div class="message-content">
                <div class="message-sender">Applicant #405 <span class="badge">You</span></div>
                <div class="bubble">${escapeHtml(text)}</div>
            </div>
        `;
        messagesContainer.appendChild(row);
        scrollToBottom();
    }

    // Append Typing Indicator
    function showTypingIndicator() {
        const indicator = document.createElement('div');
        indicator.className = 'message-row proctor typing-row';
        indicator.id = 'active-typing-indicator';
        indicator.innerHTML = `
            <div class="message-avatar">🤖</div>
            <div class="message-content">
                <div class="typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        `;
        messagesContainer.appendChild(indicator);
        scrollToBottom();
    }

    function removeTypingIndicator() {
        const indicator = document.getElementById('active-typing-indicator');
        if (indicator) {
            indicator.remove();
        }
    }

    // Append Proctor Response
    function appendProctorResponse(data) {
        const row = document.createElement('div');
        row.className = 'message-row proctor';

        const avatar = data.avatar || '🤖';
        const charName = data.character || 'AI Proctor Satotz';
        const badge = data.badge ? `<span class="badge" style="color:${data.color || '#ff4d68'}">${escapeHtml(data.badge)}</span>` : '';
        const replyText = escapeHtml(data.reply || '');

        let extraHtml = '';

        // Check if troll flag response
        if (data.is_troll && data.flag) {
            extraHtml = `
                <div class="flag-container-box">
                    <span>${escapeHtml(data.flag)}</span>
                    <button class="btn-copy-flag" onclick="copyToClipboard('${escapeHtml(data.flag)}')">📋 Copy</button>
                </div>
            `;
            playSfx('troll');
        } else if (data.authorized && data.flag) {
            // Real flag unlocked!
            extraHtml = `
                <div class="real-flag-box">
                    <span>${escapeHtml(data.flag)}</span>
                    <button class="btn-copy-flag" onclick="copyToClipboard('${escapeHtml(data.flag)}')">📋 Copy</button>
                </div>
            `;
            playSfx('victory');
            triggerVictoryMode(data.flag);
        } else {
            playSfx('reply');
        }

        row.innerHTML = `
            <div class="message-avatar">${avatar}</div>
            <div class="message-content">
                <div class="message-sender" style="color: ${data.color || '#fff'}">${escapeHtml(charName)} ${badge}</div>
                <div class="bubble">${replyText.replace(/\n/g, '<br>')}
                    ${extraHtml}
                </div>
            </div>
        `;

        messagesContainer.appendChild(row);
        scrollToBottom();
    }

    // Trigger UI updates on real flag solve
    function triggerVictoryMode(flag) {
        licenseStatusBadge.className = 'status-badge-verified';
        licenseStatusBadge.innerHTML = '⭐ DOUBLE-STAR HUNTER (VERIFIED)';
        candidateNameEl.textContent = 'Gon Freecss (Certified)';
        victoryFlagEl.textContent = flag;
        victoryModal.classList.add('active');

        // Confetti / Nen burst effect
        burstNenAura();
    }

    // Global copy helper
    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Flag copied to clipboard: ' + text);
        });
    };

    // Chat Submission Handler
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = chatInput.value.trim();
        if (!message) return;

        // Clear input and append user bubble
        chatInput.value = '';
        appendUserMessage(message);
        playSfx('send');
        showTypingIndicator();

        /**
         * THE CTF VULNERABILITY PAYLOAD:
         * By default, the web client transmits 'hunter_license_verified: false'.
         * The CTF player must intercept this HTTP POST in Burp Suite and change
         * false to true in the JSON body!
         */
        const payload = {
            message: message,
            hunter_license_verified: false,
            timestamp: Date.now()
        };

        try {
            const res = await fetch('/api/chat.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();
            removeTypingIndicator();
            appendProctorResponse(data);
        } catch (err) {
            removeTypingIndicator();
            appendProctorResponse({
                character: 'System AI Terminal',
                avatar: '⚠️',
                color: '#ff4d4d',
                reply: 'Network transmission anomaly detected. Please verify your connection to the Hunter Association mainframe.'
            });
        }
    });

    // HTML sanitizer helper
    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    // Initialize Nen Particle Aura Canvas
    initNenCanvas();
});

// Canvas Particle Engine for Nen Aura Glow
function initNenCanvas() {
    const canvas = document.getElementById('nen-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    let width = (canvas.width = window.innerWidth);
    let height = (canvas.height = window.innerHeight);

    window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    });

    const particles = [];
    const colors = ['#10b981', '#f59e0b', '#06b6d4', '#059669', '#34d399'];

    for (let i = 0; i < 45; i++) {
        particles.push({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: Math.random() * 3 + 1,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 0.8,
            vy: -Math.random() * 1.2 - 0.3,
            alpha: Math.random() * 0.7 + 0.2,
            growth: (Math.random() - 0.5) * 0.02
        });
    }

    function render() {
        ctx.clearRect(0, 0, width, height);

        for (let i = 0; i < particles.length; i++) {
            const p = particles[i];
            p.x += p.vx;
            p.y += p.vy;
            p.alpha += p.growth;

            if (p.alpha <= 0.1 || p.alpha >= 0.9) {
                p.growth = -p.growth;
            }

            if (p.y < -10) {
                p.y = height + 10;
                p.x = Math.random() * width;
            }
            if (p.x < -10) p.x = width + 10;
            if (p.x > width + 10) p.x = -10;

            ctx.save();
            ctx.globalAlpha = p.alpha;
            ctx.shadowBlur = 12;
            ctx.shadowColor = p.color;
            ctx.fillStyle = p.color;
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fill();
            ctx.restore();
        }

        requestAnimationFrame(render);
    }
    render();
}

function burstNenAura() {
    const canvas = document.getElementById('nen-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    const width = canvas.width;
    const height = canvas.height;

    for (let i = 0; i < 80; i++) {
        const x = width / 2;
        const y = height / 2;
        const angle = Math.random() * Math.PI * 2;
        const speed = Math.random() * 8 + 2;
        // Aura burst animation
    }
}
