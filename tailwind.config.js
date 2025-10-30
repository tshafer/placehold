/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#f0f9ff',
                    100: '#e0f2fe',
                    200: '#bae6fd',
                    300: '#7dd3fc',
                    400: '#38bdf8',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                    900: '#0c4a6e',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                'vt323': ['"VT323"', 'monospace'],
                'jersey-25': ['"Jersey 25"', 'sans-serif'],
            },
            keyframes: {
                logoSpin: {
                    '0%': { transform: 'rotate(0deg)' },
                    '100%': { transform: 'rotate(360deg)' },
                },
                fadeInUp: {
                    'from': {
                        opacity: '0',
                        transform: 'translateY(20px)',
                    },
                    'to': {
                        opacity: '1',
                        transform: 'translateY(0)',
                    },
                },
                pulse: {
                    '0%, 100%': {
                        opacity: '1',
                    },
                    '50%': {
                        opacity: '0.5',
                    },
                },
                bounce: {
                    '0%, 100%': {
                        transform: 'translateY(-25%)',
                        animationTimingFunction: 'cubic-bezier(0.8, 0, 1, 1)',
                    },
                    '50%': {
                        transform: 'translateY(0)',
                        animationTimingFunction: 'cubic-bezier(0, 0, 0.2, 1)',
                    },
                },
                logoSpinTakeoff: {
                    '0%': { transform: 'rotate(0deg) scale(1)' },
                    '50%': { transform: 'rotate(180deg) scale(1.2)' },
                    '100%': { transform: 'rotate(360deg) scale(1)' },
                },
                menuHover: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-5px)' },
                },
                neonFlicker: {
                    '0%, 19%, 21%, 23%, 25%, 54%, 56%, 100%': {
                        textShadow:
                            '-0.2rem -0.2rem 1rem #fff, 0.2rem 0.2rem 1rem #fff, 0 0 2rem #f40, 0 0 4rem #f40, 0 0 6rem #f40, 0 0 8rem #f40, 0 0 10rem #f40',
                    },
                    '20%, 24%, 55%': {
                        textShadow: 'none',
                    },
                },
                iconSpin: {
                    '0%': { transform: 'rotate(0deg)' },
                    '100%': { transform: 'rotate(360deg)' },
                },
                iconPulse: {
                    '0%, 100%': { transform: 'scale(1)' },
                    '50%': { transform: 'scale(1.1)' },
                },
                secretAnimation: {
                    '0%': { transform: 'scale(1) rotate(0deg)' },
                    '50%': { transform: 'scale(1.5) rotate(180deg)' },
                    '100%': { transform: 'scale(1) rotate(360deg)' },
                },
                rainbowText: {
                    '0%': { color: 'red' },
                    '14%': { color: 'orange' },
                    '28%': { color: 'yellow' },
                    '42%': { color: 'green' },
                    '57%': { color: 'blue' },
                    '71%': { color: 'indigo' },
                    '85%': { color: 'violet' },
                    '100%': { color: 'red' },
                },
                matrixRain: {
                    '0%': { top: '-10%' },
                    '100%': { top: '100%' },
                },
            },
            animation: {
                logoSpin: 'logoSpin 2s linear infinite',
                fadeInUp: 'fadeInUp 0.5s ease-out',
                pulse: 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                bounce: 'bounce 1s infinite',
                logoSpinTakeoff: 'logoSpinTakeoff 0.5s linear infinite',
                menuHover: 'menuHover 0.5s ease-in-out infinite',
                neonFlicker: 'neonFlicker 1.5s infinite alternate',
                iconSpin: 'iconSpin 1s linear infinite',
                iconPulse: 'iconPulse 1s ease-in-out infinite',
                secretAnimation: 'secretAnimation 2s ease-in-out',
                rainbowText: 'rainbowText 5s linear infinite',
                matrixRain: 'matrixRain 5s linear infinite',
            },
        },
    },
    plugins: [],
}
