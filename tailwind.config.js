/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
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
            },
            animation: {
                logoSpin: 'logoSpin 2s linear infinite',
                fadeInUp: 'fadeInUp 0.5s ease-out',
                pulse: 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                bounce: 'bounce 1s infinite',
                logoSpinTakeoff: 'logoSpinTakeoff 0.5s linear infinite',
            },
        },
    },
    plugins: [],
}
