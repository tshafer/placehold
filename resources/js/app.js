import './bootstrap';

document.addEventListener('keydown', ({ key }) => {
    if (key.toLowerCase() === 'p') {
        const logo = document.querySelector('svg[width="40"]');
        if (logo) {
            logo.classList.add('secret-animation');
            setTimeout(() => logo.classList.remove('secret-animation'), 2000);
        }
    }
});

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
