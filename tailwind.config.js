// Colors are CSS variables (space-separated RGB) set in resources/css/app.css,
// so light/dark themes and opacity modifiers (bg-surface/70) both work.
const c = (name) => `rgb(var(--c-${name}) / <alpha-value>)`;

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
                surface: {
                    DEFAULT: c('surface'),
                    dim: c('surface'),
                    bright: c('surface-bright'),
                    tint: c('primary'),
                    variant: c('surface-container'),
                },
                'surface-container': {
                    lowest: c('surface-container-lowest'),
                    low: c('surface-container-low'),
                    DEFAULT: c('surface-container'),
                    high: c('surface-container-high'),
                    highest: c('surface-container-highest'),
                },
                primary: {
                    DEFAULT: c('primary'),
                    container: c('primary-container'),
                    fixed: c('primary'),
                    'fixed-dim': c('primary'),
                },
                secondary: {
                    DEFAULT: c('secondary'),
                    container: c('secondary-container'),
                    fixed: c('secondary'),
                    'fixed-dim': c('secondary'),
                },
                tertiary: {
                    DEFAULT: c('tertiary'),
                    container: c('tertiary-container'),
                    fixed: c('tertiary'),
                    'fixed-dim': c('tertiary'),
                },
                error: {
                    DEFAULT: c('error'),
                    container: c('error-container'),
                },
                outline: {
                    DEFAULT: c('outline'),
                    variant: c('outline-variant'),
                },
                'on-surface': c('on-surface'),
                'on-surface-variant': c('on-surface-variant'),
                'on-primary': c('surface'),
                'on-primary-container': c('on-primary-container'),
                'on-secondary': c('surface'),
                'on-secondary-container': c('on-secondary-container'),
                'on-tertiary': c('surface'),
                'on-tertiary-container': c('on-primary-container'),
                'on-error': c('surface'),
                'on-error-container': c('on-error-container'),
                'inverse-surface': c('on-surface'),
                'inverse-on-surface': c('surface'),
                'inverse-primary': c('secondary'),
                background: c('surface'),
                'on-background': c('on-surface'),
            },
            fontFamily: {
                headline: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                body: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                label: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
            },
            // Monospace reads badly with wide tracking; keep the class names, tone the values down.
            letterSpacing: {
                tighter: '-0.02em',
                wider: '0.02em',
                widest: '0.04em',
            },
            borderRadius: {
                DEFAULT: '0',
                sm: '0',
                md: '0',
                lg: '0',
                xl: '0',
                full: '9999px',
            },
            keyframes: {
                'fade-in-up': {
                    from: { opacity: '0', transform: 'translateY(16px)' },
                    to: { opacity: '1', transform: 'translateY(0)' },
                },
            },
            animation: {
                'fade-in-up': 'fade-in-up 0.5s ease-out',
            },
        },
    },
    plugins: [],
}
