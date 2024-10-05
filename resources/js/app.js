import './bootstrap';

// Cookie Consent
const cookieConsent = document.getElementById('cookie-consent');
const acceptCookies = document.getElementById('accept-cookies');

acceptCookies?.addEventListener('click', () => {
    cookieConsent.style.display = 'none';
    document.cookie = "cookie_consent=accepted; max-age=31536000; path=/";
});

cookieConsent.style.display = document.cookie.includes('cookie_consent=accepted') ? 'none' : 'block';

// Secret animation on 'p' key press
document.addEventListener('keydown', ({ key }) => {
    if (key.toLowerCase() === 'p') {
        const logo = document.querySelector('svg[width="40"]');
        if (logo) {
            logo.classList.add('secret-animation');
            setTimeout(() => logo.classList.remove('secret-animation'), 2000);
        }
    }
});

// Reorganize main tiles on 't' key press with flying animation and pizzazz
document.addEventListener('keydown', ({ key }) => {
    if (key.toLowerCase() === 't') {
        const tiles = document.getElementById('tiles');
        if (tiles) {
            const tilesArray = Array.from(tiles.children);
            const originalPositions = tilesArray.map(tile => tile.getBoundingClientRect());

            tilesArray.sort(() => Math.random() - 0.5);

            tilesArray.forEach((tile, index) => {
                const originalPos = originalPositions[index];
                const newPos = tile.getBoundingClientRect();

                tile.style.cssText = `
                    position: absolute;
                    left: ${originalPos.left}px;
                    top: ${originalPos.top}px;
                    z-index: 1000;
                    transform: scale(1.05);
                `;

                requestAnimationFrame(() => {
                    tile.style.transition = 'all 1.5s cubic-bezier(0.34, 1.56, 0.64, 1)';
                    tile.style.left = `${newPos.left}px`;
                    tile.style.top = `${newPos.top}px`;
                    tile.style.transform = `rotate(${360 + Math.random() * 360}deg) scale(1)`;
                });

                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                sparkle.style.cssText = `
                    opacity: 0;
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background: radial-gradient(circle, rgba(255,255,255,0.8) 10%, transparent 70%);
                    mix-blend-mode: overlay;
                `;
                tile.appendChild(sparkle);

                setTimeout(() => {
                    sparkle.style.transition = 'opacity 0.5s ease-in-out';
                    sparkle.style.opacity = '1';
                }, 100);

                setTimeout(() => {
                    tile.style.transition = 'transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1)';
                    tile.style.transform = 'scale(1.1)';
                    setTimeout(() => tile.style.transform = 'scale(1)', 150);
                }, 1400);

                setTimeout(() => {
                    tile.style.cssText = '';
                    sparkle.remove();
                }, 1800);

                tiles.appendChild(tile);
            });

            createConfetti();
        }
    }
});

// Confetti effect function
function createConfetti() {
    const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];
    const confettiCount = 100;

    for (let i = 0; i < confettiCount; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.cssText = `
            position: fixed;
            left: ${Math.random() * 100}vw;
            top: -5vh;
            width: 10px;
            height: 10px;
            background-color: ${colors[Math.floor(Math.random() * colors.length)]};
            transform: rotate(${Math.random() * 360}deg);
            opacity: ${Math.random()};
            transition: all 3s ease-out;
        `;

        document.body.appendChild(confetti);

        setTimeout(() => {
            confetti.style.top = '105vh';
            confetti.style.left = `${Math.random() * 100}vw`;
        }, 100);

        setTimeout(() => confetti.remove(), 3000);
    }
}

// Secret Konami Code animation
const konamiCode = ['ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight', 'b', 'a'];
let konamiCodePosition = 0;

document.addEventListener('keydown', ({ key }) => {
    if (key === konamiCode[konamiCodePosition]) {
        konamiCodePosition++;
        if (konamiCodePosition === konamiCode.length) {
            activateKonamiCode();
            konamiCodePosition = 0;
        }
    } else {
        konamiCodePosition = 0;
    }
});

function activateKonamiCode() {
    document.body.style.transition = 'transform 5s';
    document.body.style.transform = 'rotate(360deg)';
    setTimeout(() => {
        document.body.style.transition = '';
        document.body.style.transform = '';
    }, 5000);
}

// Secret 'Matrix' effect on 'm' key press
let matrixInterval;
let matrixCanvas;

document.addEventListener('keydown', ({ key }) => {
    if (key.toLowerCase() === 'm') {
        matrixCanvas ? cancelMatrixEffect() : createMatrixEffect();
    }
});

function createMatrixEffect() {
    matrixCanvas = document.createElement('canvas');
    matrixCanvas.width = window.innerWidth;
    matrixCanvas.height = window.innerHeight;
    matrixCanvas.style.cssText = 'position: fixed; top: 0; left: 0; z-index: 9999;';
    document.body.appendChild(matrixCanvas);

    const ctx = matrixCanvas.getContext('2d');
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    const fontSize = 10;
    const columns = Math.floor(matrixCanvas.width / fontSize);
    const drops = new Array(columns).fill(1);

    function draw() {
        ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
        ctx.fillRect(0, 0, matrixCanvas.width, matrixCanvas.height);
        ctx.fillStyle = '#0F0';
        ctx.font = `${fontSize}px monospace`;

        drops.forEach((drop, i) => {
            const text = characters[Math.floor(Math.random() * characters.length)];
            ctx.fillText(text, i * fontSize, drop * fontSize);
            if (drop * fontSize > matrixCanvas.height && Math.random() > 0.975) {
                drops[i] = 0;
            }
            drops[i]++;
        });
    }

    matrixInterval = setInterval(draw, 33);
}

function cancelMatrixEffect() {
    clearInterval(matrixInterval);
    matrixInterval = null;
    document.body.removeChild(matrixCanvas);
    matrixCanvas = null;
}

// Rainbow Wave effect on 'l' key press
document.addEventListener('keydown', ({ key }) => {
    if (key.toLowerCase() === 'l') {
        createRainbowWave();
    }
});

function createRainbowWave() {
    const wave = document.createElement('div');
    wave.style.cssText = 'position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 9998; pointer-events: none;';
    document.body.appendChild(wave);

    const colors = ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'];
    let colorIndex = 0;

    function animateWave() {
        wave.style.background = `radial-gradient(circle at 50% 50%, ${colors[colorIndex]} 0%, transparent 70%)`;
        wave.style.transition = 'background 0.5s ease-in-out';
        colorIndex = (colorIndex + 1) % colors.length;

        if (colorIndex !== 0) {
            requestAnimationFrame(animateWave);
        } else {
            setTimeout(() => {
                wave.style.transition = 'opacity 1s ease-out';
                wave.style.opacity = '0';
                setTimeout(() => wave.remove(), 1000);
            }, 500);
        }
    }

    requestAnimationFrame(animateWave);
}

// Fireworks effect on 'f' key press
document.addEventListener('keydown', ({ key }) => {
    if (key.toLowerCase() === 'f') {
        createFireworks();
    }
});

function createFireworks() {
    const fireworksContainer = document.createElement('div');
    fireworksContainer.style.cssText = 'position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 9999; pointer-events: none;';
    document.body.appendChild(fireworksContainer);

    const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];

    function createParticle(x, y) {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: ${colors[Math.floor(Math.random() * colors.length)]};
            left: ${x}px;
            top: ${y}px;
        `;
        return particle;
    }

    function explode(x, y) {
        for (let i = 0; i < 50; i++) {
            const particle = createParticle(x, y);
            fireworksContainer.appendChild(particle);

            const angle = Math.random() * Math.PI * 2;
            const velocity = 1 + Math.random() * 3;
            const lifetime = 1000 + Math.random() * 1000;

            const startTime = Date.now();

            function animateParticle() {
                const progress = (Date.now() - startTime) / lifetime;
                if (progress >= 1) {
                    fireworksContainer.removeChild(particle);
                    return;
                }

                const easeOutExpo = 1 - Math.pow(2, -10 * progress);
                const translateX = Math.cos(angle) * 200 * velocity * easeOutExpo;
                const translateY = Math.sin(angle) * 200 * velocity * easeOutExpo;

                particle.style.transform = `translate(${translateX}px, ${translateY}px)`;
                particle.style.opacity = 1 - progress;

                requestAnimationFrame(animateParticle);
            }

            requestAnimationFrame(animateParticle);
        }
    }

    for (let i = 0; i < 5; i++) {
        setTimeout(() => {
            explode(Math.random() * window.innerWidth, Math.random() * window.innerHeight);
        }, i * 300);
    }

    setTimeout(() => fireworksContainer.remove(), 3000);
}
