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
                    DEFAULT: '#0c1322',
                    dim: '#0c1322',
                    bright: '#323949',
                    tint: '#abc7ff',
                    variant: '#2e3545',
                },
                'surface-container': {
                    lowest: '#070e1d',
                    low: '#141b2b',
                    DEFAULT: '#191f2f',
                    high: '#232a3a',
                    highest: '#2e3545',
                },
                primary: {
                    DEFAULT: '#abc7ff',
                    container: '#468fff',
                    fixed: '#d7e2ff',
                    'fixed-dim': '#abc7ff',
                },
                secondary: {
                    DEFAULT: '#ddb7ff',
                    container: '#6f00be',
                    fixed: '#f0dbff',
                    'fixed-dim': '#ddb7ff',
                },
                tertiary: {
                    DEFAULT: '#2fd9f4',
                    container: '#009fb4',
                    fixed: '#a2eeff',
                    'fixed-dim': '#2fd9f4',
                },
                error: {
                    DEFAULT: '#ffb4ab',
                    container: '#93000a',
                },
                outline: {
                    DEFAULT: '#8b919f',
                    variant: '#414754',
                },
                'on-surface': '#dce2f7',
                'on-surface-variant': '#c1c6d6',
                'on-primary': '#002f66',
                'on-primary-container': '#00285a',
                'on-secondary': '#490080',
                'on-secondary-container': '#d6a9ff',
                'on-tertiary': '#00363e',
                'on-tertiary-container': '#002f36',
                'on-error': '#690005',
                'on-error-container': '#ffdad6',
                'inverse-surface': '#dce2f7',
                'inverse-on-surface': '#293040',
                'inverse-primary': '#005cbd',
                background: '#0c1322',
                'on-background': '#dce2f7',
            },
            fontFamily: {
                headline: ['"Space Grotesk"', 'system-ui', 'sans-serif'],
                body: ['"Inter"', 'system-ui', 'sans-serif'],
                label: ['"Inter"', 'system-ui', 'sans-serif'],
                mono: ['"JetBrains Mono"', '"Fira Code"', 'monospace'],
            },
            borderRadius: {
                DEFAULT: '0.125rem',
                sm: '0.125rem',
                md: '0.375rem',
                lg: '0.25rem',
                xl: '0.5rem',
                full: '0.75rem',
            },
            keyframes: {
                'beacon-pulse': {
                    '0%, 100%': { opacity: '1', transform: 'scale(1)' },
                    '50%': { opacity: '0.6', transform: 'scale(1.3)' },
                },
                'glow-breathe': {
                    '0%, 100%': { boxShadow: '0 0 12px rgba(47, 217, 244, 0.2)' },
                    '50%': { boxShadow: '0 0 24px rgba(47, 217, 244, 0.4)' },
                },
                'fade-in-up': {
                    from: { opacity: '0', transform: 'translateY(16px)' },
                    to: { opacity: '1', transform: 'translateY(0)' },
                },
            },
            animation: {
                'beacon-pulse': 'beacon-pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'glow-breathe': 'glow-breathe 3s ease-in-out infinite',
                'fade-in-up': 'fade-in-up 0.5s ease-out',
            },
        },
    },
    plugins: [],
}
